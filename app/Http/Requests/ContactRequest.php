<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'subject' => 'required|string|in:academic_inquiry,absence_and_attendance,technical_support,
                            academic_feedback,exams,curriculum,payments_and_fees,student_activities,registration_and_admission,
                            job_opportunities,counseling,reports_and_certificates,complaints,professional_development,leave_requests',
            'message' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ];

    }
}
