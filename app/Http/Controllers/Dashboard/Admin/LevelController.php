<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Level;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Http\Requests\LevelRequest;
use App\Http\Controllers\Controller;

class LevelController extends Controller
{
    use DataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $levels = Level::paginate(5);
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.levels.index', $sideData , compact('levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.levels.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LevelRequest $request)
    {
        Level::create($request->validated());
        return redirect()->route('dashboard.admin.levels.create')->with('success','Created Level Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $level)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.levels.edit', $sideData , compact('level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LevelRequest $request, Level $level)
    {
        $level->update($request->validated());

        return redirect()->route('dashboard.admin.levels.index')->with('success','Updated Level Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level)
    {
        $level->delete();

        return redirect()->route('dashboard.admin.levels.index')->with('success','Deleted Level Successfully!');
    }
}