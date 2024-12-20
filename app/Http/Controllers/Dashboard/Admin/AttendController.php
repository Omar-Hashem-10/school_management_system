<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Date;
use App\Models\Admin;
use App\Models\Attend;
use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\Attendance;
use App\Models\AcademicYear;
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
        // $sideData = $this->getSideData();

        // $class_room_id = $request->query('class_room_id');

        // if ($class_room_id) {
        //     session()->put('class_room_id', $class_room_id);
        // }

        // $attendances = Attendance::where('class_room_id', session('class_room_id'))->get();

        // return view('web.dashboard.admin.attends.index', $sideData,  compact('attendances'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $sideData = $this->getSideData();
        // return view('web.dashboard.admin.attends.create', $sideData);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Date $date,$person,$type,$status)
    {
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();

        if ($academicYear) {
            session()->put('academic_year_id', $academicYear->id);
        }
        $data=[
            'attendable_id'=>$person,
            'attendable_type'=>$type,
            'date_id'=>$date->id,
            'status'=>$status,
            'academic_year_id'=>$academicYear->id,
            'created_at'=>now(),
            'updated_at'=>now(),
        ];
        $attend=Attend::where('date_id',$date->id)->where('attendable_id',$person)->first();
        if($attend){
            $attend->delete();
        }
        Attend::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $status = null)
    {

        // $attendance = Attendance::findOrFail($id);
        // $sideData = $this->getSideData();

        // $attendancesQuery = AttendanceStudent::where('attendance_id', $attendance->id);

        // if ($status) {
        //     $attendancesQuery->where('status', $status);
        // }

        // $attendances = $attendancesQuery->get();

        // return view('web.dashboard.admin.attends.show', $sideData, compact('attendance', 'attendances', 'status'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // $attendance = Attendance::findOrFail($id);
        // $sideData = $this->getSideData();
        // return view('web.dashboard.admin.attends.edit', $sideData, compact('attendance'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendRequest $request, $id)
    {
        // $attendance = Attendance::findOrFail($id);

        // $attendance->update($request->validated());
        // return redirect()->route('dashboard.admin.attends.index')->with('success','Updated Attendance Date Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // $attendance = Attendance::findOrFail($id);

        // $attendance->delete();

        // return redirect()->route('dashboard.admin.attends.index')->with('success', 'Deleted Attendance Successfully!');
    }
}
