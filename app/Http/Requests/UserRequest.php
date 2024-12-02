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
    public static function rules()
    {
        return [
            'first_name'          => 'required|string|max:255',
            'last_name'           => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone'               => 'nullable|string',
            'gender'              => 'nullable|in:male,female',
            'type'                => 'required|in:admin,teacher,student,parent',
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password'            => 'required|string|min:6',
            'role_id'             => 'required|integer|exists:roles,id',
        ];
    }
    public function messages()
    {
        return [
            'password.required' => __('custom.validation.password.required'),
            'password.confirm' => __('custom.validation.password.confirm'),
        ];
    }
}