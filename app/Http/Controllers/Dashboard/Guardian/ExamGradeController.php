<?php

namespace App\Http\Controllers\Dashboard\Guardian;

use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamGradeController extends Controller
{
    /**
     * Handle the incoming request to show exam grades for a student.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $studentId
     * @return \Illuminate\View\View
     */
    public function __invoke(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);

        $grades = Grade::where('student_id', $student->id)->get();

        $students_guardian = session('students_guardian');

        return view('web.dashboard.guardian.exam-grade.show', compact('student', 'grades', 'students_guardian'));
    }
}
