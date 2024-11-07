<?php

namespace App\Http\Requests;

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
        return [
            'teacher_name'        => 'required|string|max:255',
            'email'               => 'required|email',
            'phone'               => 'nullable|string',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'user_id'             => 'nullable|integer|exists:users,id',
            'role_id'             => 'nullable|integer|exists:roles,id|in:3',
            'course_id'           => 'nullable|integer|exists:courses,id',
            'experience'          => 'nullable|string',
            'password'            => 'required|min:8',
        ];
    }
}