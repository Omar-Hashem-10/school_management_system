<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return [
            'first_name'          => 'required|string|max:255',
            'last_name'           => 'required|string|max:255',
            'phone'               => 'nullable|string',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user),
            ],
            'gender'              => 'nullable|in:male,female',
            'type'                => 'required|in:admin,teacher,student,parent',
            'image'               => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'            => 'required|string|min:6',
            'subject_id'          => 'nullable|integer|exists:subjects,id',
            'classroom_id'        => 'nullable|integer|exists:classrooms,id',
            'role_id'             => 'required|integer|exists:roles,id',
            'experience'          => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => __('custom.validation.password.required'),
        ];
    }
}