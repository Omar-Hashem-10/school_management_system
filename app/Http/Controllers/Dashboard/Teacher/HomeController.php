<?php

namespace App\Http\Controllers\Dashboard\Teacher;

use App\Models\Teacher;
use App\Models\ClassRoom;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use DataTraits;
    public function __invoke()
    {
        abort_if(!Gate::allows('isTeacher'), 403);
        $this->getProfileData(Teacher::class);
        $user = auth()->user();
        $teacher = $user->teacher;
        session()->put('teacher_id', $teacher->id);
        $class_rooms = CourseTeacher::where('teacher_id', $teacher->id)
            ->distinct()
            ->pluck('class_room_id');

        $course_level_ids = CourseTeacher::where('teacher_id', $teacher->id)
            ->distinct()
            ->pluck('course_level_id');

        $class_room_names = ClassRoom::whereIn('id', $class_rooms)->pluck('class_name', 'id');

        $course_codes = DB::table('course_levels')
            ->whereIn('id', $course_level_ids)
            ->pluck('course_code', 'id');

        session()->put('class_room_names', $class_room_names);
        session()->put('course_codes', $course_codes);

        return view('web.dashboard.teacher.home.index', compact('class_room_names', 'course_codes'));
    }
}