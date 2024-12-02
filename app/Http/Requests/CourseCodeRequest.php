<?php

namespace App\Http\Requests;

use App\Rules\UniqueTwice;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CourseCodeRequest extends FormRequest
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
            'code' => [
                'required',
                'string',
                'max:255',
                Rule::unique('course_codes')->ignore($this->route('course_code'))->where(function ($query) {
                    return $query->where('level_subject_id', $this->level_subject_id);
                }),
            ],
            'semester' => 'required|in:first,second',
            'level_subject_id' => [
                'required',
                'exists:level_subjects,id',
                new UniqueTwice('course_codes', 'level_subject_id', $this->route('course_code')),
            ],
        ];
    }
}
