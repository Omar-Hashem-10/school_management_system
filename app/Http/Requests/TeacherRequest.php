<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TeacherRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userRules = UserRequest::rules();
        $teacherRules = [
            'subject_id'          => 'nullable|integer|exists:subjects,id',
            'experience'          => 'nullable|integer',
            'salary'              => 'required|numeric',
            'email'               => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(($this->teacher) ? $this->teacher->user : null),
            ],
        ];

        return array_merge($userRules, $teacherRules);
    }
}