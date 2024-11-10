<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\ClassRoom;
use App\Traits\SideDataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class  AttendController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sideData = $this->getSideData();

        return view('web.dashboard.admin.attends.index', $sideData , compact('ClassRooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.attends.create', $sideData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.attends.edit', $sideData);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
