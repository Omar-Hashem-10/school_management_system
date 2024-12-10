<?php

namespace App\Http\Controllers\Dashboard\Guardian;

use App\Models\Attend;
use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendanceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $studentId)
    {
        $student = Student::findOrFail($studentId);

        $classRooms = ClassRoom::all();


        $attendanceRecords = Attend::where('attendable_id', $student->user->id)->get();

        $students_guardian = session('students_guardian');

        return view('web.dashboard.guardian.attendance.show', compact('attendanceRecords', 'student', 'students_guardian', 'classRooms'));
    }
}
