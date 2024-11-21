<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Level;
use App\Models\CourseCode;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCodeRequest;

class CourseCodeController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::with('subjects')->get();
        $course_codes = CourseCode::get();
        $sideData = $this->getSideData();

        return view('web.dashboard.admin.course_codes.index', array_merge($sideData, compact('levels', 'course_codes')));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::with('subjects')->get();

        $sideData = $this->getSideData();
        return view('web.dashboard.admin.course_codes.create', $sideData, compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCodeRequest $request)
    {

        CourseCode::create($request->validated());
        return redirect()->route('dashboard.admin.course_codes.index')->with('success', 'Created Course Code Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CourseCode $course_code)
    {
        $sideData = $this->getSideData();
        $levels = Level::with('subjects')->get();
        return view('web.dashboard.admin.course_codes.edit', $sideData, compact('course_code', 'levels'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCodeRequest $request, CourseCode $course_code)
    {
        $course_code->update($request->validated());
        return redirect()->route('dashboard.admin.course_codes.index')->with('success', 'Updated Course Code Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCode $course_code)
    {
        $course_code->delete();
        return redirect()->route('dashboard.admin.course_codes.index')->with('success', 'Deleted Course Code Successfully!');
    }
}
