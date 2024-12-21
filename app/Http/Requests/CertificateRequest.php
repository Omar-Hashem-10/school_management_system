<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
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
            'total_marks' => 'required|numeric|min:0',
            'obtained_marks' => 'required|numeric|min:0|lte:total_marks',
            'percentage' => 'required|numeric|min:0|max:100',
            'grade' => 'required|in:A+,A,A-,B+,B,B-,C+,C,C-,D+,D,D-,F',
            'level_id' => 'required|exists:levels,id',
            'student_id' => 'required|exists:students,id',
            'academic_year_id' => 'required|exists:academic_years,id',
        ];
    }



}
