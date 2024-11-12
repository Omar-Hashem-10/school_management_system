<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Admin;
use App\Models\Level;
use App\Models\ClassRoom;
use App\Traits\DataTraits;
use App\Traits\SideDataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRoomRequest;

class ClassRoomController extends Controller
{
    use DataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $class_rooms = ClassRoom::paginate(5);
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.class_rooms.index', $sideData , compact('class_rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.class_rooms.create', $sideData , compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClassRoomRequest $request)
    {
        ClassRoom::create($request->validated());
        return redirect()->route('dashboard.admin.class_rooms.create')->with('success','Created Class Room Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassRoom $class_room)
    {
        $levels = Level::get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.class_rooms.edit', $sideData , compact('levels', 'class_room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClassRoomRequest $request, ClassRoom $class_room)
    {
        $class_room->update($request->validated());
        return redirect()->route('dashboard.admin.class_rooms.index')->with('success','Updated Class Room Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassRoom $class_room)
    {
        $class_room->delete();
        return redirect()->route('dashboard.admin.class_rooms.index')->with('success','Deleted Class Room Successfully!');
    }
}