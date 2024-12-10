<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Choice;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChoiceRequest;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $course_code_id = $request->query('course_code_id');
        $teacher_id = $request->query('teacher_id');

        $questions = Question::where('course_code_id', $course_code_id)->where('teacher_id', $teacher_id)->orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$questions->toArray());
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
                    return $this->responseFailure('Please include the correct answer in the choices!',404);

                }else{
                    return $this->responseFailure('Please include the correct answer in the choices!',404);
                }
            }

        } else {
            $validatedChoiceData['choice_text'] = $request_choice->choice_text;
        }

        $question = Question::create($request_question->validated());

        $validatedChoiceData['question_id'] = $question->id;


        Choice::create($validatedChoiceData);

        return $this->responseSuccess('Created Question Successfully!',$question->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Question $question)
    {
        $cohices = Choice::where('question_id', $question->id)->get();
        $data = [
            'question' => $question->toArray(),
            'cohices' => $cohices->toArray(),
        ];
        return $this->responseSuccess('Retrieved Successfully!',$data);
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

        Choice::where('question_id', $question->id)
                ->update(['is_correct' => $is_correct]);
        }

        return $this->responseSuccess('Updated Question Successfully!',$question->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return $this->responseSuccess('Deleted Question Successfully!',$question->toArray());
    }
}
