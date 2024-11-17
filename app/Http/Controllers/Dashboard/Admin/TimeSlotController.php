<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\TimeSlot;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Http\Requests\TimeSlotRequest;

class TimeSlotController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sideData = $this->getSideData();
        $time_slots = TimeSlot::get();
        return view('web.dashboard.admin.time_slots.index', $sideData, compact('time_slots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.time_slots.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeSlotRequest $request)
    {
        TimeSlot::create($request->validated());
        return redirect()->route('dashboard.admin.time_slots.create')->with('success','Created Time Slot Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TimeSlot $time_slot)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.time_slots.edit', $sideData, compact('time_slot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimeSlotRequest $request, TimeSlot $time_slot)
    {
        $time_slot->update($request->validated());
        return redirect()->route('dashboard.admin.time_slots.index')->with('success','Updated Time Slot Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeSlot $time_slot)
    {
        $time_slot->delete();
        return redirect()->route('dashboard.admin.time_slots.index')->with('success','Deleted Time Slot Successfully!');
    }
}
