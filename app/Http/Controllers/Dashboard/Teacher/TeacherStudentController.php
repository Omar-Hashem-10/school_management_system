<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Student;
use App\Models\ClassRoom;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Http\Controllers\Controller;

class TeacherStudentController extends Controller
{
    use DataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index($class_room_id, Request $request)
    {
        session()->put("class_room_id", $class_room_id);

        $query = Student::where('class_room_id', $class_room_id);

        if ($request->has('student_name') && $request->student_name != '') {
            $query->where('student_name', 'like', '%' . $request->student_name . '%');
        }

        if ($request->has('sort_by') && in_array($request->sort_by, ['student_name', 'email', 'phone'])) {
            $query->orderBy($request->sort_by, $request->order ?? 'asc');
        } else {
            $query->orderBy('id', 'desc');
        }

        $students = $query->paginate(5);

        $sideData = $this->getSideData();

        return view('web.dashboard.teacher.students.index', $sideData , compact('students'));
    }
}