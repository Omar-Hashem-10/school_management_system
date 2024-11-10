<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Course;
use App\Traits\SideDataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;

class CourseController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::paginate(5);
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.courses.index', $sideData , compact('courses'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.courses.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseRequest $request)
    {
        Course::create($request->validated());
        return redirect()->route('dashboard.admin.courses.create')->with('success','Created Course Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.courses.edit', $sideData , compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->validated());
        return redirect()->route('dashboard.admin.courses.index')->with('success','Updated Course Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('dashboard.admin.courses.index')->with('success','Deleted Course Successfully!');
    }
}
