<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Session;

class LogoutController extends Controller
{
    public function __invoke(Request $request)
    {
        Session::flush();

        Auth::logout();

        return redirect()->route('dashboard.login.show');
    }
}
