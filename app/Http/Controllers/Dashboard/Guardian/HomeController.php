<?php

namespace App\Http\Controllers\Dashboard\Guardian;

use App\Models\Student;
use App\Models\Guardian;
use App\Traits\DataTraits;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use DataTraits;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        abort_if(!Gate::allows('isGuardian'), 403);

        $this->getProfileData(Guardian::class);

        $students_guardian = Student::where('guardian_id', auth()->user()->guardian->id)->get();

        if($students_guardian)
        {
            session()->put('students_guardian', $students_guardian);
        }
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();
        session()->put('academic_year', $academicYear);
        return view('web.dashboard.guardian.home.index', compact('students_guardian'));
    }
}