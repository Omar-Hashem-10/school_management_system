<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Events\SendMailToGuardianEvent;
use App\Models\User;
use App\Models\Student;
use App\Models\Guardian;
use App\Traits\SideDataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SendMailController extends Controller
{
    use SideDataTraits;
    /**
     * Show the form for creating a new resource.
     */
    public function create($student_id)
    {
        $user = User::find($student_id);
        $student = Student::find($user->student->id);
        if($student)
        {
            session()->put('student_name', $student->user->first_name);
        }
        $guardian = Guardian::findOrFail($student->guardian_id);
        if($guardian)
        {
            session()->put('guardian_name', $guardian->user->first_name);
            session()->put('guardian_email', $guardian->user->email);
        }

        $sideData = $this->getSideData();
        return view('web.dashboard.admin.students.send-mail', $sideData, compact('guardian'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function sendMail(Request $request)
    {
        $data = [
            'guardianName'   => session('guardian_name'),
            'studentName'    => session('student_name'),
            'subject'        => $request->subject,
            'importantNotes' => $request->message,
        ];

        if (empty($data['guardianName']) || empty($data['studentName']) || empty($data['subject']) || empty($data['importantNotes'])) {
            return redirect()->back()->with('error', 'Some required data is missing.');
        }

        $email = session('guardian_email');

        if (empty($email)) {
            return redirect()->back()->with('error', 'Guardian email is missing.');
        }

        event(new SendMailToGuardianEvent($data, $email));

        return redirect()->route('dashboard.admin.students.index')->with('success', 'Send Email Successfully!');
    }
}
