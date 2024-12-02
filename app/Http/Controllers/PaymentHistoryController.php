<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Level;
use App\Models\Payment;
use App\Models\Student;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class PaymentHistoryController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $studentId)
    {
        $student = Student::with('classRoom.level')->findOrFail($studentId);

        $payments = Payment::where('student_id', $studentId)
            ->where('guardian_id', auth()->user()->guardian->id)
            ->get();

        $currentDate = Carbon::now();

        $currentTerm = AcademicYear::where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->first();

        $terms = AcademicYear::all();

        $students_guardian = session('students_guardian');

        $level = $student->classRoom->level;

        return view('web.dashboard.guardian.payment-history.show', compact('payments', 'student', 'students_guardian', 'terms', 'currentTerm', 'level'));
    }
}
