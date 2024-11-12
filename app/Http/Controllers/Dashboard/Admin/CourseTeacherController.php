<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Course;
use App\Models\Teacher;
use App\Models\ClassRoom;
<<<<<<< HEAD
=======
use App\Traits\DataTraits;
>>>>>>> c4c0e38b894c3dd74855721eb8be04f7a9a1936d
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseTeacherRequest;

class CourseTeacherController extends Controller
{
<<<<<<< HEAD
=======
    use DataTraits;
>>>>>>> c4c0e38b894c3dd74855721eb8be04f7a9a1936d
    /**
     * Display a listing of the resource.
     */
    public function index($teacher_id)
    {
        $course_teachers = CourseTeacher::with('classRoom')->where('teacher_id', $teacher_id)->get();
        $course_id = Teacher::where('id', $teacher_id)->pluck('course_id')->first();

        session()->put('course_id', $course_id);

        session()->put('teacher_id', $teacher_id);

        $courses = Course::with('levels')->get();

<<<<<<< HEAD
        return view('web.dashboard.admin.course_teachers.index', compact('course_teachers', 'courses'));
=======
        $sideData = $this->getSideData();

        return view('web.dashboard.admin.course_teachers.index', $sideData , compact('course_teachers', 'courses'));
>>>>>>> c4c0e38b894c3dd74855721eb8be04f7a9a1936d
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::with('levels')->get();
        $class_rooms = ClassRoom::get();
<<<<<<< HEAD
        return view('web.dashboard.admin.course_teachers.create', compact('courses', 'class_rooms'));
=======
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.course_teachers.create', $sideData , compact('courses', 'class_rooms'));
>>>>>>> c4c0e38b894c3dd74855721eb8be04f7a9a1936d
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseTeacherRequest $request)
    {
        CourseTeacher::create($request->validated());
        return redirect()->route('dashboard.admin.course_teachers.create')->with('success','Created Successfully!');
    }

    /**
<<<<<<< HEAD
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
=======
>>>>>>> c4c0e38b894c3dd74855721eb8be04f7a9a1936d
     * Show the form for editing the specified resource.
     */
    public function edit(CourseTeacher $course_teacher)
    {
        $courses = Course::with('levels')->get();
        $class_rooms = ClassRoom::get();
<<<<<<< HEAD
        return view('web.dashboard.admin.course_teachers.edit', compact('courses','class_rooms', 'course_teacher'));
=======
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.course_teachers.edit', $sideData , compact('courses','class_rooms', 'course_teacher'));
>>>>>>> c4c0e38b894c3dd74855721eb8be04f7a9a1936d
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseTeacherRequest $request, CourseTeacher $course_teacher)
    {
        $course_teacher->update($request->validated());
        return redirect()->route('dashboard.admin.course_teachers.index', ['teacher_id' => session('teacher_id')])->with('success','Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseTeacher $course_teacher)
    {
        $course_teacher->delete();
        return redirect()->route('dashboard.admin.course_teachers.index', ['teacher_id' => session('teacher_id')])->with('success', 'Deleted Successfully!');
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> c4c0e38b894c3dd74855721eb8be04f7a9a1936d
