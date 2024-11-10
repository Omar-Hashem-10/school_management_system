<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Traits\SideDataTraits;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use SideDataTraits;
    public function index(){
        $sideData = $this->getSideData();
        return view('web.dashboard.profile.index', $sideData);
    }
}
