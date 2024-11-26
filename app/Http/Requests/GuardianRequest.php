<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use Illuminate\Foundation\Http\FormRequest;

class GuardianRequest extends FormRequest
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
        $userRules = UserRequest::rules(); 
        $guardianRules = [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(($this->guardian)?$this->guardian->user:null),
            ],
        ];

        return array_merge($userRules, $guardianRules);
    }
}