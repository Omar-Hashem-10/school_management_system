<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Schedule;
use App\Traits\JsonResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ScheduleRequest;

class ScheduleController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$schedules->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduleRequest $request)
    {
        $schedule = Schedule::create($request->validated());
        return $this->responseSuccess('Created Successfully!',$schedule->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Schedule $schedule)
    {
        return $this->responseSuccess('Retrieved Successfully!',$schedule->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScheduleRequest $request, Schedule $schedule)
    {
        $schedule->update($request->validated());
        return $this->responseSuccess('Updated Successfully!',$schedule->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}
