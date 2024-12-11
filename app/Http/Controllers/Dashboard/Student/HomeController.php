<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Models\Student;
use App\Models\Schedule;
use App\Models\CourseCode;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use DataTraits;
    public function __invoke()
    {
        abort_if(!Gate::allows('isStudent'), 403);

        session()->put('student_id', auth()->user()->student->id);

        $this->getProfileData(Student::class);

        $student=Student::with(['user','payments','classRoom','classRoom.courseCodes','grades','classRoom.level'])->where('user_id',auth()->user()->id)->first();
        // $course_code_ids = Schedule::where('class_room_id', auth()->user()->student->class_room_id)
        //     ->distinct()
        //     ->pluck('course_code_id');

        // $course_codes = CourseCode::whereIn('id', $course_code_ids)->pluck('code', 'id');
        session()->put('student', $student);

        return view('web.dashboard.student.home.index', compact('student'));
    }

}