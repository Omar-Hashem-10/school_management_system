<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class TimeSlotRequest extends FormRequest
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
        $timeSlotId = $this->route('time_slot'); // الحصول على معرف الـ time_slot من الـ route

        return [
            'lecture_number' => [
                'required',
                'string',
                Rule::unique('time_slots', 'lecture_number')->ignore($timeSlotId), // تجاهل السجل الحالي
            ],
            'start_time' => [
                'required',
                'date_format:H:i',
                Rule::unique('time_slots', 'start_time')->ignore($timeSlotId), // تجاهل السجل الحالي
            ],
            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
                Rule::unique('time_slots', 'end_time')->ignore($timeSlotId), // تجاهل السجل الحالي
            ],
        ];
    }



}
