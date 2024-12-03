<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\CourseCode;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCodeRequest;

class CourseCodeController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $course_codes = CourseCode::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$course_codes->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseCodeRequest $request)
    {
        $course_code = CourseCode::create($request->validated());
        return $this->responseSuccess('Created Successfully!',$course_code->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(CourseCode $course_code)
    {
        return $this->responseSuccess('Retrieved Successfully!',$course_code->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseCodeRequest $request, CourseCode $course_code)
    {
        $course_code->update($request->validated());
        return $this->responseSuccess('Updated Successfully!',$course_code->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CourseCode $course_code)
    {
        $course_code->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}
