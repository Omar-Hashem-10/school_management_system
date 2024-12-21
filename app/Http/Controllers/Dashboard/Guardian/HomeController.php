<?php

namespace App\Http\Controllers\Dashboard\Guardian;

use App\Models\Student;
use App\Models\Guardian;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    use DataTraits;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        abort_if(!Gate::allows('isGuardian'), 403);

        session()->put('allowdFromGuardian', 1);

        $this->getProfileData(Guardian::class);

        $students_guardian = Student::where('guardian_id', auth()->user()->guardian->id)->get();

        if($students_guardian)
        {
            session()->put('students_guardian', $students_guardian);
        }

        return view('web.dashboard.guardian.home.index', compact('students_guardian'));
    }
}
