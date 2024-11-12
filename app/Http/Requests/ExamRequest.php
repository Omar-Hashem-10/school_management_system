<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamRequest extends FormRequest
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
            'exam_name' => 'required|string|min:3|max:50',
            'exam_date' => 'required|date',
            'exam_duration' => 'required|integer|min:1',
            'half_grade' => 'required|numeric|min:0',
            'course_level_id' => 'required|exists:course_levels,id',
            'teacher_id' => 'required|exists:teachers,id',
            'class_room_id' => 'required|exists:class_rooms,id',
        ];
    }

}
