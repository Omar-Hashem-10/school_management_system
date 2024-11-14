<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Day;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\TimeSlot;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $class_id = auth()->user()->student->class_room_id;

        $schedules = Schedule::where('class_room_id', $class_id)
                    ->join('time_slots', 'schedules.time_slot_id', '=', 'time_slots.id')
                    ->orderBy('time_slots.start_time')
                    ->select('schedules.*')
                    ->get();

        $time_slots = TimeSlot::get();
        $days = Day::get();
        $courses = Course::with('levels')->get();

        return view('web.dashboard.student.schedule.index', compact('schedules', 'time_slots', 'courses', 'days'));
    }
}
