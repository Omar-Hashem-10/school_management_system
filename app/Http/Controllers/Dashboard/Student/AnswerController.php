<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Exam;
use App\Models\Grade;
use App\Models\Answer;
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
    public function store(AnswerRequest $request)
    {
        $totalQuestions = session('total_questions');
        $answers = $request->input('answer');
        $totalGrade = 0;

        if (empty($answers) || count($answers) < $totalQuestions) {
            session(['answers' => $answers]);
            return redirect()->back()->with('error', 'You must answer all the questions!');
        }

        if (is_array($answers)) {
            foreach ($answers as $questionId => $answer) {
                $question = \App\Models\Question::whereHas('exams', function ($query) use ($request) {
                    $query->where('exam_id', $request->input('exam_id'));
                })->with(['exams' => function ($query) use ($request) {
                    $query->where('exam_id', $request->input('exam_id'));
                }])->find($questionId);

                if ($question) {
                    $isCorrect = false;
                    foreach ($question->choices as $choice) {
                        if ($choice->is_correct && $choice->is_correct == $answer) {
                            $isCorrect = true;
                            break;
                        }
                    }

                    if ($isCorrect) {
                        $questionGrade = $question->exams->first()->pivot->question_grade ?? 0;
                        $totalGrade += $questionGrade;
                    }

                    Answer::create([
                        'question_id' => $questionId,
                        'answer' => $answer,
                        'exam_id' => $request->input('exam_id'),
                        'student_id' => $request->input('student_id'),
                    ]);
                }
            }
        }

        Grade::create([
            'exam_id' => $request->input('exam_id'),
            'student_id' => $request->input('student_id'),
            'grade' => $totalGrade,
        ]);

        return redirect()->route('dashboard.student.exam.index', ['course_level_id' => session('course_level_id')])
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
