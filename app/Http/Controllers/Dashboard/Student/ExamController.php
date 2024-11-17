<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Exam;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    use SideDataTraits;
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $sideData = $this->getSideData();
        $course_level_id = $request->query('course_level_id');

        $exams = Exam::where('course_level_id', $course_level_id)
            ->with(['grades' => function ($query) {
                $query->where('student_id', auth()->user()->student->id);
            }])
            ->get();

        $exam_ids = Answer::where('student_id', auth()->user()->student->id)
            ->distinct()
            ->pluck('exam_id')
            ->toArray();

        session()->put('course_level_id', $course_level_id);

        return view('web.dashboard.student.exam.index', $sideData, compact('exams', 'exam_ids'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        $sideData = $this->getSideData();
        $questions = $exam->questions()->with('choices')->paginate(2);

        $totalQuestions = $questions->total();

        session()->put('total_questions', $totalQuestions);

        return view('web.dashboard.student.exam.show', array_merge($sideData, compact('exam', 'questions', 'totalQuestions')));
    }



}
