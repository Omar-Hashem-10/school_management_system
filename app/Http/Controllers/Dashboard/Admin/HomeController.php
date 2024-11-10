<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Models\Admin;
use App\Models\ClassRoom;
use App\Traits\DataTraits;
use Illuminate\Http\Request;
use App\Models\CourseTeacher;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    use DataTraits;

    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        
        if (Gate::allows('isAdmin') || Gate::allows('isManager')) {
            $this->getProfileData(Admin::class);
            $class_rooms = ClassRoom::all();
            $sideData = $this->getSideData();
            return view('web.dashboard.admin.home.index',$sideData, compact('class_rooms'));
        } elseif (Gate::allows('isTeacher')) {
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
        } elseif (Gate::allows('isStudent')) {
            $this->getProfileData(Student::class);
            return view('web.dashboard.student.home.index');
        }
    }
}