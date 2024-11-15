<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Course;
use App\Models\Schedule;
use App\Models\TimeSlot;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Requests\ScheduleRequest;

class ScheduleController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sideData = $this->getSideData();


        $class_room_id = $request->query('class_room_id');
        $day_filter = $request->query('day_filter');
        session()->put('day_filter_id', $day_filter);
        $days = Day::get();

        if ($class_room_id) {
            session()->put('class_room_id', $class_room_id);
        }

        $schedulesQuery = Schedule::where('class_room_id', session('class_room_id'));

        if ($day_filter) {
            $schedulesQuery->where('day_id', $day_filter);
        }

        $schedules = $schedulesQuery->get();

        $courses = Course::with('levels')->get();

        return view('web.dashboard.admin.schedules.index', $sideData, compact('schedules', 'courses', 'days'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::with('levels')->get();
        $class_room = ClassRoom::where('id', session('class_room_id'))->first();
        session()->put('class_room_level', $class_room->level_id);
        $time_slots = TimeSlot::orderBy('start_time')->get();
        $sideData = $this->getSideData();
        $days = Day::get();
        return view('web.dashboard.admin.schedules.create', $sideData, compact('courses', 'time_slots', 'days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduleRequest $request)
    {
        Schedule::create($request->validated());
        return redirect()->route('dashboard.admin.schedules.create')->with('success','Created Shedule Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $schedule)
    {
        $sideData = $this->getSideData();
        $courses = Course::with('levels')->get();
        $days = Day::get();
        $time_slots = TimeSlot::orderBy('start_time')->get();
        return view('web.dashboard.admin.schedules.edit', $sideData, compact('courses', 'schedule', 'time_slots', 'days'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $schedule->update($request->validated());
        $dayFilterId = session('day_filter_id', '');
        return redirect()->route('dashboard.admin.schedules.index', ['day_filter' => $dayFilterId])->with('success','Updated Schedule Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        $dayFilterId = session('day_filter_id', '');
        return redirect()->route('dashboard.admin.schedules.index', ['day_filter' => $dayFilterId])
        ->with('success', 'Deleted Schedule Successfully!');
    }
}
