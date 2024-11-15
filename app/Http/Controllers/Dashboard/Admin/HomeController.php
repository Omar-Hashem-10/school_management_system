<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use App\Traits\SideDataTraits;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Traits\DataTraits;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use  SideDataTraits;

    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        abort_if(!(Gate::allows('isAdmin') || Gate::allows('isManager')),403) ;
            $class_rooms = ClassRoom::all();
            $sideData = $this->getSideData();
            return view('web.dashboard.admin.home.index',$sideData, compact('class_rooms'));
    }
}