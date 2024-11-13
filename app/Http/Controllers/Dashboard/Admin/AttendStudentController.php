<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\AttendStudent;
use App\Traits\SideDataTraits;
use App\Models\AttendanceStudent;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceStudentRequest;

class AttendStudentController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        $students = Student::where('class_room_id', session('class_room_id'))->get();
        return view('web.dashboard.admin.attend_students.create', $sideData, compact('students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendanceStudentRequest $request)
    {
        $attendanceData = $request->input('status');
        $attendance_id = $request->input('attendance_id');
        $class_room_id = $request->input('class_room_id');

        foreach ($attendanceData as $student_id => $status) {
            AttendanceStudent::create([
                'attendance_id' => $attendance_id,
                'class_room_id' => $class_room_id,
                'student_id' => $student_id,
                'status' => $status,
            ]);
        }

        return redirect()->route('dashboard.admin.attends.index')
                         ->with('success', 'Attendance successfully created.');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $attendance = Attendance::findOrFail($id);
        $sideData = $this->getSideData();
        $attendance_students = AttendanceStudent::where('attendance_id', $attendance->id)->get();
        return view('web.dashboard.admin.attend_students.edit', $sideData, compact('attendance_students', 'attendance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendanceStudentRequest $request, $id)
    {
        $attendance = Attendance::findOrFail($id);

        $statuses = $request->input('status');

        if ($statuses) {
            foreach ($statuses as $studentId => $status) {
                $attendanceStudent = AttendanceStudent::where('attendance_id', $attendance->id)
                                                        ->where('student_id', $studentId)
                                                        ->first();

                if ($attendanceStudent) {
                    $attendanceStudent->status = $status;
                    $attendanceStudent->save();
                }
            }
        }

        return redirect()->route('dashboard.admin.attends.index')->with('success', 'updated Attendance Students successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
