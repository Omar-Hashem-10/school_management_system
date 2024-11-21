<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\CourseCode;
use App\Models\Teacher;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function __invoke()
    {
        abort_if(!Gate::allows('isTeacher'), 403);
        $user = auth()->user();
        $teacher = $user->teacher;
        session()->put('teacher_id', $teacher->id);
        $teacher = Teacher::find(session('teacher_id'));
        $class_rooms = $teacher->courseCodes()
                    ->distinct()
                    ->pluck('class_room_id');

                    $course_code_ids = $teacher->courseCodes()
                    ->distinct()
                    ->pluck('course_code_id');

        $class_room_names = ClassRoom::whereIn('id', $class_rooms)->pluck('name', 'id');
        $course_codes = CourseCode::whereIn('id', $course_code_ids)->pluck('code', 'id');

        session()->put('class_room_names', $class_room_names);
        session()->put('course_codes', $course_codes);

        return view('web.dashboard.teacher.home.index', compact('class_room_names', 'course_codes'));
    }
}
