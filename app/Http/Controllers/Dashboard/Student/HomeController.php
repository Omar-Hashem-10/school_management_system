<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Student;
use App\Models\Schedule;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use DataTraits;
    public function __invoke()
    {
        abort_if(!Gate::allows('isStudent'), 403);

        session()->put('student_id', auth()->user()->student->id);

        $this->getProfileData(Student::class);

        $course_level_ids = Schedule::where('class_room_id', auth()->user()->student->class_room_id)
            ->distinct()
            ->pluck('course_level_id');

            $course_level_codes = DB::table('course_levels')
            ->whereIn('id', $course_level_ids)
            ->pluck('course_code', 'id');

            session()->put('course_level_codes', $course_level_codes);

        return view('web.dashboard.student.home.index', compact('course_level_codes'));
    }

}
