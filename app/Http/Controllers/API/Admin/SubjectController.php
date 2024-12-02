<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Subject;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$subjects->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        $subject = Subject::create($request->validated());
        return $this->responseSuccess('Created Successfully!',$subject->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject)
    {
        return $this->responseSuccess('Retrieved Successfully!',$subject->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());
        return $this->responseSuccess('Updated Successfully!',$subject->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}
