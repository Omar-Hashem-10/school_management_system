<?php

namespace App\Http\Controllers\Dashboard\Guardian;

use App\Models\Feedback;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskGradeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);

        $feedbacks = Feedback::where('student_id', $student->id)->get();
        $students_guardian = session('students_guardian');


        return view('web.dashboard.guardian.task-grade.show', compact('feedbacks', 'student', 'students_guardian'));
    }
}
