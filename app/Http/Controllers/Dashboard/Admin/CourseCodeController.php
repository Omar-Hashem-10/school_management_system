<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;

class CourseCodeController extends Controller
{
    use  SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('web.dashboard.admin.courses.index');
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('web.dashboard.admin.courses_codes.create');
        
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
        return view('web.dashboard.admin.courses_codes.edit');
        
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