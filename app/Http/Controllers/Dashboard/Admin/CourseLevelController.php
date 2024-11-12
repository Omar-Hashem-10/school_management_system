<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Level;
use App\Models\Course;
use App\Models\CourseLevel;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseLevelRequest;

class CourseLevelController extends Controller
{
    use DataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('levels')->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.course_levels.index', $sideData , compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::get();
        $levels = Level::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.course_levels.create', $sideData , compact('courses', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $course = Course::find($request->course_id);

        $course->levels()->attach($request->level_id, [
            'course_code' => $request->course_code,
        ]);


        return redirect()->route('dashboard.admin.course_levels.create')->with('success','Created Course Level Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course, Level $level)
    {
        $courses = Course::get();
        $levels = Level::get();

        $courseLevel = $course->levels()->where('level_id', $level->id)->first();

        $sideData = $this->getSideData();

        return view('web.dashboard.admin.course_levels.edit', $sideData , compact('course', 'level', 'courseLevel', 'courses', 'levels'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(CourseLevelRequest $request, Course $course, Level $level)
    {
        $course->levels()->updateExistingPivot($level->id, $request->validated());

        return redirect()->route('dashboard.admin.course_levels.index')->with('success', 'Update Course Level successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course, Level $level)
    {
        $course->levels()->detach($level->id);

        return redirect()->route('dashboard.admin.course_levels.index')->with('success', 'Deleted Course Level successfully!');
    }

}