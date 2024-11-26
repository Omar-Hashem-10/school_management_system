<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'name'                => 'required|string|max:255',
            'possition'           => 'required|string|max:255',
            'gender'              => 'required|in:male,female',
            'phone'               => 'nullable|string',
            'salary'              => 'required|numeric',
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')->ignore(($this->employee) ? $this->employee : null),
            ],
            'image'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}