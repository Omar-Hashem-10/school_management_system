<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'task_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'full_grade' => 'required|numeric|min:0',
            'course_code_id' => 'required|exists:course_codes,id',
            'teacher_id' => 'required|exists:teachers,id',
            'class_room_id' => 'required|exists:class_rooms,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ];
    }
}
