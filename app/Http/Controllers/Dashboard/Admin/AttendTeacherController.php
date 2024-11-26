<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Date;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use App\Models\Teacher;

class AttendTeacherController extends Controller
{
    use SideDataTraits;
    /**
     * Display a listing of the resource.
     */
    public function index(Date $date)
    {
        $sideData = $this->getSideData();
        $teachers = Teacher::orderBy('id','DESC')->paginate(10);
        return view('web.dashboard.admin.attend_teachers.index',$sideData,compact('teachers','date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        
    }




    /**
     * Display the specified resource.
     */
    public function show()
    {
        session()->put('previous_url', url()->current());
        $dates = Date::where('day', '!=',null)->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.attend_teachers.dates', $sideData, compact('dates'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
         }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}