<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\TimeSlot;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TimeSlotRequest;

class TimeSlotController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $time_slots = TimeSlot::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$time_slots->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TimeSlotRequest $request)
    {
        $time_slot = TimeSlot::create($request->validated());
        return $this->responseSuccess('Created Successfully!',$time_slot->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(TimeSlot $time_slot)
    {
        return $this->responseSuccess('Retrieved Successfully!',$time_slot->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TimeSlotRequest $request, TimeSlot $time_slot)
    {
        $time_slot->update($request->validated());
        return $this->responseSuccess('Updated Successfully!',$time_slot->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TimeSlot $time_slot)
    {
        $time_slot->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}
