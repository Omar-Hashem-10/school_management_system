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
    public function rules()
    {
        return [
            'class_room_id' => 'required|exists:class_rooms,id',
            'course_code_id' => [
                'required',
                'exists:course_codes,id',
            ],
            'day_id' => [
                'required',
                'exists:days,id',
            ],
            'time_slot_id' => [
                'required',
                'exists:time_slots,id',
                function ($attribute, $value, $fail) {
                    $schedule = $this->route('schedule');

                    $query = Schedule::where('day_id', $this->day_id)
                        ->where('time_slot_id', $value);

                    if ($schedule) {
                        $query->where('id', '!=', $schedule->id);
                    }

                    if ($query->exists()) {
                        $fail('The selected time slot is already taken for this day.');
                    }
                },
            ],
        ];
    }


}
