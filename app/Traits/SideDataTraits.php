<?php


namespace App\Traits;

use App\Models\ClassRoom;


trait SideDataTraits
{
    public function getSideData()
    {
        $class_room_names = session('class_room_names');
        $course_codes = session('course_codes');
        $classRooms = ClassRoom::all();
        return compact('class_room_names', 'course_codes', 'classRooms');
    }
}
