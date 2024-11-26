<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Day;
use App\Models\Level;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Schedule;
use App\Models\TimeSlot;
use App\Models\CourseCode;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;

class ScheduleController extends Controller
{
    use SideDataTraits;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $sideData = $this->getSideData();
        $class_id = auth()->user()->student->class_room_id;

        $schedules = Schedule::where('class_room_id', $class_id)
                    ->get();

        $time_slots = TimeSlot::get();
        $days = Day::get();
        $levels = Level::with('subjects')->get();

        $course_codes_schedules = CourseCode::get();

        $course_codes = session('course_codes');

        return view('web.dashboard.student.schedule.index', array_merge($sideData, compact('schedules', 'time_slots', 'levels', 'days', 'course_codes', 'course_codes_schedules')));
    }
}
