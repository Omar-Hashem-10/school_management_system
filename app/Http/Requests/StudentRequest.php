<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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

        $studentRules = [
            'class_room_id'       => 'required|integer|exists:class_rooms,id',
            'guardian_id'         => 'required|integer|exists:guardians,id',
            'relation'            => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(($this->student)?$this->student->user:null),
            ],
        ];

        return array_merge($userRules, $studentRules);
    }
}