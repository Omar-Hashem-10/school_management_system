<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TeacherStudentController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $class_room_id = $request->query('class_room_id');
        if($class_room_id)
        {
            session()->put("class_room_id", $class_room_id);
        }

        $search = $request->query('search');


        $query = Student::where('class_room_id', session('class_room_id'))
                        ->with('user', 'classRoom');

        if ($search) {
            $query->whereHas('user', function($query) use ($search) {
                $query->where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'like', '%' . $search . '%');
            });
        }

        $students = $query->paginate(5);

        $sideData = $this->getSideData();
        return view('web.dashboard.teacher.students.index', $sideData, compact('students'));
    }
    public function show(Student $student)
    {
        $sideData = $this->getSideData();

        $courseCodeId = auth()->user()->teacher->courseCodes()
            ->wherePivot('class_room_id', session('class_room_id'))
            ->first()?->id;

        $grades = $student->grades()
            ->whereHas('exam', function ($query) use ($courseCodeId) {
                $query->where('course_code_id', $courseCodeId);
            })
            ->paginate(5);

        return view('web.dashboard.teacher.students.show', $sideData, compact('student', 'grades', 'courseCodeId'));
    }



}
