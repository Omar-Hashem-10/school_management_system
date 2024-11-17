<?php

namespace App\Http\Controllers;

use App\Models\Day;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Requests\DayRequest;

class DayController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sideData = $this->getSideData();
        $days = Day::get();
        return view('web.dashboard.admin.days.index', $sideData, compact('days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.days.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DayRequest $request)
    {
        Day::create($request->validated());
        return redirect()->route('dashboard.admin.days.create')->with('success','Created Day Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Day $day)
    {
        $day->delete();
        return redirect()->route('dashboard.admin.days.index')->with('success','Deleted Day Successfully!');
    }
}
