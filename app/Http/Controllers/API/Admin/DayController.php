<?php

namespace App\Http\Controllers\API\Admin;

use App\Models\Day;
use Illuminate\Http\Request;
use App\Http\Requests\DayRequest;
use App\Traits\JsonResponseTrait;
use App\Http\Controllers\Controller;

class DayController extends Controller
{
    use JsonResponseTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $days = Day::orderBy('id', 'DESC')->get();
        return $this->responseSuccess('Data Retrieved Successfully!',$days->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DayRequest $request)
    {
        $day = Day::create($request->validated());
        return $this->responseSuccess('Created Successfully!',$day->toArray());
    }

    /**
     * Display the specified resource.
     */
    public function show(Day $day)
    {
        return $this->responseSuccess('Retrieved Successfully!',$day->toArray());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DayRequest $request, Day $day)
    {
        $day->update($request->validated());
        return $this->responseSuccess('Updated Successfully!',$day->toArray());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Day $day)
    {
        $day->delete();
        return $this->responseSuccess('Deleted Successfully!');
    }
}
