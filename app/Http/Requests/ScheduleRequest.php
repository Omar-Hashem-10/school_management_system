<?php

namespace App\Http\Requests;

use App\Models\Schedule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
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
            'class_room_id' => 'required|exists:class_rooms,id',
            'course_level_id' => 'required|exists:course_levels,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'day_id' => 'required|exists:days,id',
            'day_id' => [
                'required',
                'exists:days,id',
                function ($attribute, $value, $fail) {
                    $count = Schedule::where('day_id', $value)->count();

                    if ($count >= 5) {
                        $fail('No more than 5 lectures can be added on the same day.');
                    }
                }
            ]
        ];
    }

}
