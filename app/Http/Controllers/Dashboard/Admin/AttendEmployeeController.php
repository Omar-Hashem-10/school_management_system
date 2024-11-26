<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Date;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;

class AttendEmployeeController extends Controller
{
    use SideDataTraits;
    public function index(Date $date){

        $sideData = $this->getSideData();
        $employees=Employee::orderBy('id','DESC')->paginate(10);
        return view('web.dashboard.admin.attend_employees.index',$sideData,compact('employees','date'));
    }
    public function show()
    {
        session()->put('previous_url', url()->current());
        $dates = Date::where('day', '!=',null)->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.attend_employees.dates', $sideData, compact('dates'));
    }
}