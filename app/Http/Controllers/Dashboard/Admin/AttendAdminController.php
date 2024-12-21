<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Date;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;

class AttendAdminController extends Controller
{
    use SideDataTraits;
    public function index(Date $date){

        $sideData = $this->getSideData();
        $admins=Admin::with(['role','user'])->orderBy('id','DESC')->paginate(10);
        return view('web.dashboard.admin.attend_admins.index',$sideData,compact('admins','date'));
    }
    public function show()
    {
        session()->put('previous_url', url()->current());
        $dates = Date::where('day', '!=',null)->get();
        $sideData = $this->getSideData();
        return view('web.dashboard.admin.attend_admins.dates', $sideData, compact('dates'));
    }
}