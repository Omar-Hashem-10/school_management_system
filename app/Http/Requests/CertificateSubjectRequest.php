<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CertificateSubjectRequest extends FormRequest
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
            'subject_marks' => 'required|min:0|max:100',
            'course_code_id' => [
                'required',
                'exists:course_codes,id',
                Rule::unique('certificate_courses', 'course_code_id')
                    ->ignore($this->route('course_code_id'))
                    ->where('certificate_id', $this->route('certificate_subjects')),
            ],
            'certificate_id' => 'required|exists:certificates,id',
        ];
    }


}
