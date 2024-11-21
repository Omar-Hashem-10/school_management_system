<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Subject;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;

class SubjectController extends Controller
{
    use  SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::paginate(5);
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.subjects.index', $sideData , compact('subjects'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.subjects.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        Subject::create($request->validated());
        return redirect()->route('dashboard.admin.subjects.create')->with('success','Created Subject Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.subjects.edit', $sideData , compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());
        return redirect()->route('dashboard.admin.subjects.index')->with('success','Updated Subject Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect()->route('dashboard.admin.subjects.index')->with('success','Deleted Subject Successfully!');
    }
}
