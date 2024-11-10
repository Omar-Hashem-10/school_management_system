<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Http\Controllers\Controller;

class TeacherStudentController extends Controller
{
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

        $class_room_names = session('class_room_names');
        $course_codes = session('course_codes');

        return view('web.dashboard.teacher.students.index', compact('students', 'class_room_names', 'course_codes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
