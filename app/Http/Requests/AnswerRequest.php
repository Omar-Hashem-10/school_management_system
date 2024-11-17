<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'question_id' => 'nullable', 'integer', 'exists:questions,id',
            'exam_id' => 'required', 'integer', 'exists:exams,id',
            'student_id' => 'required', 'integer', 'exists:students,id',
            'answer' => 'nullable', 'string', 'max:255',
        ];
    }

}
