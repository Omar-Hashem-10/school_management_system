<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Exam;
use App\Models\Teacher;
use App\Models\Question;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamQuestionRequest;

class ExamQuestionsController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();

        $teacher = Teacher::find(session('teacher_id'));

        $course_code_id = $teacher->courseCodes()
                                        ->where('teacher_id', session('teacher_id'))
                                        ->where('class_room_id', session('class_room_id'))
                                        ->pluck('course_code_id')
                                        ->first();

            if ($course_code_id) {
                $questions = Question::where('teacher_id', session('teacher_id'))
                ->where('course_code_id', $course_code_id)
                ->get();
            } else {
                $questions = collect();
            }

        return view('web.dashboard.teacher.exam_questions.create', $sideData , compact('course_code_id', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamQuestionRequest $request)
    {
        $exam_id = $request->input('exam_id');
        $question_ids = $request->input('questions');
        $scores = $request->input('scores');

        if (empty($question_ids)) {
            return redirect()->back()->with('error', 'Please select at least one question.');
        }

        $exam = Exam::findOrFail($exam_id);
        $total_score = 0;

        foreach ($question_ids as $question_id) {
            $score = isset($scores[$question_id]) ? $scores[$question_id] : 0;
            $total_score += $score;
        }

        if ($total_score < $exam->half_grade) {
            return redirect()->back()->with('error', 'The total score is less than the required half grade.');
        }

        foreach ($question_ids as $question_id) {
            $score = isset($scores[$question_id]) ? $scores[$question_id] : 0;
            $exam->questions()->attach($question_id, ['question_grade' => $score]);
        }

        return redirect()->route('dashboard.teacher.exams.index', ['class_room_id' => session('class_room_id')])
                         ->with('success', 'Questions Added To Exam Successfully!');
    }





    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::find(session(key: 'teacher_id'));

            $course_code_id = $teacher->courseCodes()
                                        ->where('teacher_id', session('teacher_id'))
                                        ->where('class_room_id', session('class_room_id'))
                                        ->pluck('course_code_id')
                                        ->first();

        $questions_all = Question::where('teacher_id', session('teacher_id'))->where('course_code_id', $course_code_id)->get();

        $exam = Exam::findOrFail($id);
        $exam_question_ids = $exam->questions->pluck('id')->toArray();

        $exam_questions = $exam->questions()->withPivot('question_grade')->get();

        $questions_not_in_exam = $questions_all->filter(function ($question) use ($exam_question_ids) {
            return !in_array($question->id, $exam_question_ids);
        });

        $sideData = $this->getSideData();
        session()->put('exam_id_edit', $id);

        return view('web.dashboard.teacher.exam_questions.edit', $sideData, compact('exam', 'questions_not_in_exam', 'exam_question_ids', 'exam_questions'));
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(ExamQuestionRequest $request, string $id)
    {
        $exam = Exam::findOrFail($id);

        $question_ids_all = $request->input('questions_not_in_exam', []);

        foreach ($question_ids_all as $question_id) {
            if (!$exam->questions->contains($question_id)) {
                $exam->questions()->syncWithoutDetaching([
                    $question_id => [
                        'question_grade' => $request->input('scores.' . $question_id),
                    ]
                ]);
            }
        }

        $question_ids = $request->input('questions_in_exam', []);

        $current_question_ids = $exam->questions->pluck('id')->toArray();
        $removed_question_ids = array_diff($current_question_ids, $question_ids);

        if (!empty($removed_question_ids)) {
            $exam->questions()->detach($removed_question_ids);
        }

        foreach ($question_ids as $question_id) {
            $exam->questions()->updateExistingPivot($question_id, [
                'question_grade' => $request->input('scores.' . $question_id),
            ]);
        }

        if (count($question_ids) > 0) {
            return redirect()->route('dashboard.teacher.exams.index')->with('success', 'Questions updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Please select at least one question.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
