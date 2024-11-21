<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Level;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\LevelSubjectRequest;

class LevelSubjectController extends Controller
{
    use  SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subjects = Subject::with('levels')->get();

        $sideData = $this->getSideData();

        return view('web.dashboard.admin.level_subjects.index', $sideData, compact('subjects'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::get();
        $subjects = Subject::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.level_subjects.create', $sideData , compact('subjects', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LevelSubjectRequest $request)
    {
        $subject = Subject::findOrFail($request->subject_id);
        $level = Level::findOrFail($request->level_id);

        $subject->levels()->attach($level->id);

        return redirect()->route('dashboard.admin.level_subjects.create')->with('success', 'Created Course Level Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($subjectId, $levelId)
    {
        $subject = Subject::findOrFail($subjectId);
        $level = Level::findOrFail($levelId);
        $subjects = Subject::get();
        $levels = Level::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.level_subjects.edit', $sideData, compact('subject', 'level', 'subjects', 'levels'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(LevelSubjectRequest $request, Subject $subject, Level $level)
    {
        $newLevelId = $request->input('level_id');
        $newSubjectId = $request->input('subject_id');

        $subject->levels()->sync([$newLevelId => ['subject_id' => $newSubjectId]]);

        return redirect()->route('dashboard.admin.level_subjects.index')
                         ->with('success', 'Updated Subject Level successfully!');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($subjectId, $levelId)
    {
        $subject = Subject::findOrFail($subjectId);

        $subject->levels()->detach($levelId);

        return redirect()->route('dashboard.admin.level_subjects.index')->with('success', 'Deleted Subject Level successfully!');
    }


}
