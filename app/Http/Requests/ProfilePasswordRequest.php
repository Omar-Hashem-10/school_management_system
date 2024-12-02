<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Http\FormRequest;

class ProfilePasswordRequest extends FormRequest
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
            'currentPassword'=>['required',
            function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    return $fail(__('custom.validation.currentPassword.notCorrect'));
                }
            },
        ],
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'password.required' => __('custom.validation.password.required'),
            'password.confirmed' => __('custom.validation.password.confirmed'),
            'password_confirmation' => __('custom.validation.password_confirmation'),
            'currentPassword.required' => __('custom.validation.currentPassword.required'),
        ];
    }
}