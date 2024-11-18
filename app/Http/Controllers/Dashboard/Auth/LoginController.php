<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    use DataTraits;
    public function show(){
        return view('web.dashboard.login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role && $user->role->for === 'admins') {
                $this->getProfileData(Admin::class);
                return redirect()->intended('/dashboard/admin/home');
            }


            if ($user->role && $user->role->for === 'teachers') {
               
                $this->getProfileData(Teacher::class); 
                return redirect()->intended('/dashboard/teacher/home');
            }
            if ($user->role && $user->role->for === 'students') {
                $this->getProfileData(Student::class);
                return redirect()->intended('/dashboard/student/home');
            }

            elseif ($user->role && $user->role->role_name === 'student') {
                return redirect()->intended('/dashboard/student/home');
            }

            else{
                return redirect()->intended('/home');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


}