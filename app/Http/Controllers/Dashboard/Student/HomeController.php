<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Student;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use DataTraits;
    public function __invoke(){
        abort_if(!Gate::allows('isStudent'),403);
            $this->getProfileData(Student::class);
            return view('web.dashboard.student.home.index');
    }
}