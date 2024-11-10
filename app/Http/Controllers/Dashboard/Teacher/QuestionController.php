<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChoiceRequest;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $questions = Question::paginate(5);

        $class_room_names = session('class_room_names');
        $course_codes = session('course_codes');

        $course_level_id = $request->query('course_level_id');

        if (!empty($course_level_id)) {
            session(['course_level_id' => $course_level_id]);
        }

        return view('web.dashboard.teacher.questions.index', compact('class_room_names', 'course_codes', 'questions'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request_question, ChoiceRequest $request_choice)
    {
        $questionType = $request_question->question_type;

        $validatedChoiceData = $request_choice->validated();

        if (empty($request_choice->choice_text)) {
            $choiceText = implode(', ', $request_choice->choices);

            $hasCorrectAnswer = in_array($validatedChoiceData['is_correct'], $request_choice->choices);

            $validatedChoiceData['choice_text'] = $choiceText;
            if (!$hasCorrectAnswer) {
                if($questionType == 'true_false')
                {
                    return redirect()->route('dashboard.teacher.true_false')->with('error', 'Please include the correct answer in the choices!');
                }else{
                    return redirect()->route('dashboard.teacher.mcq')->with('error', 'Please include the correct answer in the choices!');
                }
            }

        } else {
            $validatedChoiceData['choice_text'] = $request_choice->choice_text;
        }

        $question = Question::create($request_question->validated());

        $validatedChoiceData['question_id'] = $question->id;


        Choice::create($validatedChoiceData);

        return redirect()->route('dashboard.teacher.questions.index')->with('success', 'Created Question Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        $class_room_names = session('class_room_names');
        $course_codes = session('course_codes');

        $choices = Choice::where('question_id', $question->id)->get();

        if ($question->question_type == 'mcq') {
            foreach ($choices as $choice) {
                $choice->choice_text = explode(', ', $choice->choice_text);
                $is_correct = $choice->is_correct;
            }

            return view('web.dashboard.teacher.questions.mcq_questions.edit', compact('choices', 'question', 'class_room_names', 'course_codes', 'is_correct'));
        }else{
            foreach ($choices as $choice) {
                $is_correct = $choice->is_correct;
            }
            return view('web.dashboard.teacher.questions.true_false_questions.edit', compact('question', 'choices', 'is_correct','course_codes', 'class_room_names'));
        }
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request_question, ChoiceRequest $request_choice, Question $question)
    {
        $question->update($request_question->validated());

        if ($question->question_type === 'mcq') {
            $choices = implode(', ', $request_choice->input('choices'));

            Choice::where('question_id', $question->id)->update(['choice_text' => $choices]);

            foreach ($request_choice->input('choices') as $index => $choice_text) {
                $is_correct = $request_choice->is_correct;

                Choice::where('question_id', $question->id)
                        ->update(['is_correct' => $is_correct]);
            }
        }else{
                $is_correct = $request_choice->is_correct;

        // تحديث الإجابة الصحيحة
        Choice::where('question_id', $question->id)
                ->update(['is_correct' => $is_correct]);
        }

        return redirect()->route('dashboard.teacher.questions.index')->with('success', 'Updated Question Successfully!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return redirect()->route('dashboard.teacher.questions.index')->with('success','Deleted Question Successfully!');
    }
}
