<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Exam;
use App\Models\Teacher;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExamQuestionRequest;

class ExamQuestionsController extends Controller
{
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
        $class_room_names = session('class_room_names');
        $course_codes = session('course_codes');

        $course_level_id = CourseTeacher::where('teacher_id', session('teacher_id'))
            ->where('class_room_id', session('class_room_id'))
            ->first();

        if ($course_level_id) {
            $questions = Question::where('teacher_id', session('teacher_id'))
                ->where('course_level_id', $course_level_id->id)
                ->get();
        } else {
            $questions = collect();
        }


        return view('web.dashboard.teacher.exam_questions.create', compact('class_room_names', 'course_codes', 'course_level_id', 'questions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExamQuestionRequest $request)
    {
        $exam_id = $request->input('exam_id');
        $question_ids = $request->input('questions');

        $exam = Exam::findOrFail($exam_id);

        foreach ($question_ids as $question_id) {
            $exam->questions()->attach($question_id);
        }

        return redirect()->route('dashboard.teacher.exams.index', ['class_room_id' => session('class_room_id')])
                            ->with('success', 'Add Questions In Exam Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $course_level_id = CourseTeacher::where('teacher_id', session('teacher_id'))
            ->where('class_room_id', session('class_room_id'))
            ->first();

        $questions_all = $course_level_id
            ? Question::where('teacher_id', session('teacher_id'))
                ->where('course_level_id', $course_level_id->id)
                ->get()
            : collect();

        $exam = Exam::findOrFail($id);

        $exam_question_ids = $exam->questions->pluck('id')->toArray();

        $questions_not_in_exam = $questions_all->filter(function ($question) use ($exam_question_ids) {
            return !in_array($question->id, $exam_question_ids);
        });

        $class_room_names = session('class_room_names');
        $course_codes = session('course_codes');
        session()->put('exam_id_edit', $id);

        return view('web.dashboard.teacher.exam_questions.edit', compact(
            'class_room_names', 'course_codes', 'exam', 'questions_not_in_exam', 'exam_question_ids'
        ));
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
                $exam->questions()->syncWithoutDetaching([$question_id]);
            }
        }
        $question_ids = $request->input('questions_in_exam', []);

        $current_question_ids = $exam->questions->pluck('id')->toArray();
        $removed_question_ids = array_diff($current_question_ids, $question_ids);

        if (!empty($removed_question_ids)) {
            $exam->questions()->detach($removed_question_ids);
        }

        if (count($question_ids) > 0) {
            foreach ($question_ids as $question_id) {
                $exam->questions()->syncWithoutDetaching([$question_id]);
            }
        } else {
            return redirect()->back()->with('error', 'Please select at least one question.');
        }

        return redirect()->route('dashboard.teacher.exams.index')->with('success', 'Questions updated successfully.');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
