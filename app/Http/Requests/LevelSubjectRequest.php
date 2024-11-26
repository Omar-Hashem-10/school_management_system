<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LevelSubjectRequest extends FormRequest
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
            'subject_id' => 'required|exists:subjects,id',
            'level_id' => [
                'required',
                'exists:levels,id',
                Rule::unique('level_subjects', 'level_id')
                    ->ignore(request()->route('subject')->id ?? null, 'subject_id')
                    ->where('subject_id', request('subject_id')),
            ],
        ];
    }



}
