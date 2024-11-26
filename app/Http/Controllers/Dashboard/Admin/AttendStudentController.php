<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Date;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Models\AttendStudent;
use App\Traits\SideDataTraits;
use App\Models\AttendanceStudent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceStudentRequest;
use App\Models\ClassRoom;

class AttendStudentController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Date $date,ClassRoom $class_room)
    {
        // dd($date,$class_room);
        $sideData = $this->getSideData();
        $students = Student::where('class_room_id',$class_room->id)->orderBy('id','DESC')->paginate(10);
        return view('web.dashboard.admin.attend_students.index',$sideData,compact('students','date','class_room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceStudentRequest $request)
    {
        
    }




    /**
     * Display the specified resource.
     */
    public function show($classRoom)
    {
        session()->put('previous_url', url()->current());
        $dates = Date::where('day', '!=',null)->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.attend_students.dates', $sideData, compact('dates','classRoom'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}