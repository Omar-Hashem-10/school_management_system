<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Exam;
use App\Models\Grade;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\AnswerRequest;

class AnswerController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $answers = $request->input('answer', []);
    $totalGrade = 0;

    $questions = Question::whereHas('exams', function ($query) use ($request) {
        $query->where('exam_id', $request->input('exam_id'));
    })->get();

    foreach ($questions as $question) {
        $questionId = $question->id;
        $questionGrade = $question->exams()->where('exam_id', $request->input('exam_id'))->first()->pivot->question_grade ?? 0;

        $answer = isset($answers[$questionId]) ? $answers[$questionId] : 'no answer';

        $isCorrect = false;
        if ($answer !== 'no answer') {
            foreach ($question->choices as $choice) {
                if ($choice->is_correct && $choice->is_correct == $answer) {
                    $isCorrect = true;
                    break;
                }
            }
        }

        if ($isCorrect) {
            $totalGrade += $questionGrade;
        }

        Answer::create([
            'question_id' => $questionId,
            'answer' => $answer,
            'exam_id' => $request->input('exam_id'),
            'student_id' => $request->input('student_id'),
        ]);
    }

    Grade::create([
        'exam_id' => $request->input('exam_id'),
        'student_id' => $request->input('student_id'),
        'grade' => $totalGrade,
    ]);

    session()->forget('examAnswers');
    session()->forget('timeRemaining');

    return redirect()->route('dashboard.student.exam.index', ['course_code' => session('course_code_id')])
                        ->with('success', 'Answers saved successfully! Total grade: ' . $totalGrade);
}

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        $sideData = $this->getSideData();

        $answers = Answer::where('exam_id', $exam->id)->where('student_id', auth()->user()->student->id)->get();

        return view('web.dashboard.student.answer.show', $sideData, compact('answers', 'exam'));
    }
}
