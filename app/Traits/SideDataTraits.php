<?php


namespace App\Traits;

use App\Models\Classroom;


trait SideDataTraits
{
    public function getSideData()
    {
        $class_room_names = session('class_room_names');
        $course_codes = session('course_codes');
        $classRooms = ClassRoom::get()->all();
        $course_level_codes = session('course_level_codes');
        $students_guardian = session('students_guardian');
        return compact('class_room_names', 'course_codes', 'classRooms', 'course_level_codes', 'students_guardian');
    }
}
