<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Level;
use App\Models\Subject;
use App\Traits\HelperFunctionsTrait;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\LevelSubjectRequest;

class LevelSubjectController extends Controller
{
    use  SideDataTraits, HelperFunctionsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sideData = $this->getSideData();

        $subjects = Subject::with('levels')->get();

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
        $subject = Subject::find($request->subject_id);
        $this->getError(!$subject, 'Subject not found. Please check the provided subject ID.');

        $level = Level::find($request->level_id);
        $this->getError(!$level, 'Level not found. Please check the provided level ID.');

        if($subject->levels()->where('level_id', $level->id)->exists())
        {
            return redirect()->back()->with('error', 'This subject is already associated with this level.');
        }

        $subject->levels()->attach($level->id);

        return redirect()->route('dashboard.admin.level_subjects.create')->with('success', 'Created Course Level Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($subjectId, $levelId)
    {
        $subject = Subject::find($subjectId);
        $this->getError(!$subject, 'Subject not found. Please check the provided subject ID.');

        $level = Level::find($levelId);
        $this->getError(!$level, 'Level not found. Please check the provided level ID.');

        $subjects = Subject::get();
        $levels = Level::get();

        $sideData = $this->getSideData();
        return view('web.dashboard.admin.level_subjects.edit', $sideData, compact('subject', 'level', 'subjects', 'levels'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(LevelSubjectRequest $request, Subject $subject)
    {
        $newLevelId = $request->input('level_id');
        $newSubjectId = $request->input('subject_id');

        $subject->levels()->updateExistingPivot($newLevelId, ['subject_id' => $newSubjectId]);

        return redirect()->route('dashboard.admin.level_subjects.index')
                         ->with('success', 'تم تحديث مستوى المادة بنجاح!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($subjectId, $levelId)
    {
        $subject = Subject::find($subjectId);
        $this->getError(!$subject, 'Subject not found. Please check the provided subject ID.');

        $subject->levels()->detach($levelId);

        return redirect()->route('dashboard.admin.level_subjects.index')->with('success', 'Deleted Subject Level successfully!');
    }


}
