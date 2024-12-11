<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Student;
use App\Models\Guardian;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\SendMailToGuardianEvent;

class SendMailController extends Controller
{
    use JsonResponseTrait;

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $guardian_id = $request->query('guardian_id');
        $guardian = Guardian::findOrFail($guardian_id);
        $student_id = $request->query('student_id');
        $student = Student::findOrFail($student_id);
        if($student)
        {
            session()->put('student_name', $student->user->first_name);
        }
        if($guardian)
        {
            session()->put('guardian_name', $guardian->user->first_name);
            session()->put('guardian_email', $guardian->user->email);
        }
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

        return $this->responseSuccess('Send Email Successfully!');

    }
}
