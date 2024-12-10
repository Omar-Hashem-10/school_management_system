<?php

namespace App\Http\Controllers\Dashboard\Guardian;

use App\Models\Exam;
use App\Models\Grade;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
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
        $academicYears = AcademicYear::orderBy('id', 'desc')->get();
        $student = Student::findOrFail($studentId);

        $classRooms = ClassRoom::all();

        $selectedAcademicYear = null;
        if ($request->has('academic_year_id') && $request->academic_year_id) {
            $selectedAcademicYear = AcademicYear::find($request->academic_year_id);
        } else {
            $selectedAcademicYear = AcademicYear::latest()->first();
        }

        $gradesQuery = Grade::where('student_id', $student->id);
        $gradesQuery->whereHas('exam', function ($query) use ($selectedAcademicYear) {
            $query->where('academic_year_id', $selectedAcademicYear->id);
        });

        $students_guardian = session('students_guardian');

        $grades = $gradesQuery->get();

        if ($grades->isNotEmpty() && $grades->first()->exam_id) {
            $exam = Exam::where('id', $grades->first()->exam_id)->first();
        } else {
            $exam = null;
        }

        $classRooms = ClassRoom::all();
        $classRooms = ClassRoom::all();
        return view('web.dashboard.guardian.exam-grade.show', compact('student', 'grades', 'academicYears', 'selectedAcademicYear', 'students_guardian', 'exam', 'classRooms'));
    }


}
