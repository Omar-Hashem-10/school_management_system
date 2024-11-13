<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Admin;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Models\AttendanceStudent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendRequest;

class  AttendController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sideData = $this->getSideData();

        $class_room_id = $request->query('class_room_id');

        if ($class_room_id) {
            session()->put('class_room_id', $class_room_id);
        }

        $attendances = Attendance::where('class_room_id', session('class_room_id'))->get();

        return view('web.dashboard.admin.attends.index', $sideData,  compact('attendances'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.attends.create', $sideData);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendRequest $request)
    {
        $attendance = Attendance::create($request->validated());
        session()->put('attendance_id', $attendance->id);
        return redirect()->route('dashboard.admin.attend_students.create')->with('success','Created Attendance Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $status = null)
    {

        $attendance = Attendance::findOrFail($id);
        $sideData = $this->getSideData();

        $attendancesQuery = AttendanceStudent::where('attendance_id', $attendance->id);

        if ($status) {
            $attendancesQuery->where('status', $status);
        }

        $attendances = $attendancesQuery->get();

        return view('web.dashboard.admin.attends.show', $sideData, compact('attendance', 'attendances', 'status'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.attends.edit', $sideData, compact('attendance'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendRequest $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance->update($request->validated());
        return redirect()->route('dashboard.admin.attends.index')->with('success','Updated Attendance Date Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);

        $attendance->delete();

        return redirect()->route('dashboard.admin.attends.index')->with('success', 'Deleted Attendance Successfully!');
    }
}