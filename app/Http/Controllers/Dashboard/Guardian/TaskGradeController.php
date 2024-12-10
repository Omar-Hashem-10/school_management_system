<?php

namespace App\Http\Controllers\Dashboard\Guardian;

use App\Models\Task;
use App\Models\Student;
use App\Models\Feedback;
use App\Models\ClassRoom;
use App\Models\AcademicYear;
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

        $classRooms = ClassRoom::all();

        $enrollmentYear = $student->start_academic_year_id;

        $academicYears = AcademicYear::where('id', '>=', $enrollmentYear)
            ->orderBy('id', 'asc')
            ->get();

        $selectedAcademicYear = null;
        if ($request->has('academic_year_id') && $request->academic_year_id != '') {
            $selectedAcademicYear = AcademicYear::find($request->academic_year_id);
        } else {
            $selectedAcademicYear = AcademicYear::latest()->first();
        }

        $feedbacksQuery = Feedback::where('student_id', $student->id)
            ->whereHas('task', function ($query) use ($selectedAcademicYear) {
                $query->where('academic_year_id', $selectedAcademicYear->id);
            });

        $feedbacks = $feedbacksQuery->get();

        if ($feedbacks->isNotEmpty() && $feedbacks->first()->task_id) {
            $task = Task::where('id', $feedbacks->first()->task_id)->first();
        } else {
            $task = null;
        }

        $students_guardian = session('students_guardian');

        return view('web.dashboard.guardian.task-grade.show', compact('feedbacks', 'student', 'students_guardian', 'academicYears', 'selectedAcademicYear', 'task', 'classRooms'));
    }
}
