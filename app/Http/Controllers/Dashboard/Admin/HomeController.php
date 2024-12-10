<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\ClassRoom;
use App\Traits\SideDataTraits;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use  SideDataTraits;

    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        abort_if(!(Gate::allows('isAdmin') || Gate::allows('isManager')|| Gate::allows('isHR')|| Gate::allows('isAcademicAffairs')),403) ;
            $classRooms = ClassRoom::all();
            $sideData = $this->getSideData();
            return view('web.dashboard.admin.home.index',$sideData, compact('classRooms'));
    }
}
