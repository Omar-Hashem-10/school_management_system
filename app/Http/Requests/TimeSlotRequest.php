<?php

namespace App\Http\Requests;

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
        return [
            'lecture_number' => 'required|string|unique:time_slots,lecture_number',
            'start_time' => 'required|date_format:H:i|unique:time_slots,start_time',
            'end_time' => 'required|date_format:H:i|after:start_time|unique:time_slots,end_time',
        ];
    }


}
