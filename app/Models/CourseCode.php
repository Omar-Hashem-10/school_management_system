<?php

namespace App\Models;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'semester',
        'level_subject_id',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'course_code_id', 'id');
    }

    public function exams()
{
    return $this->hasMany(Exam::class, 'course_code_id', 'id');
}


public function teachers()
{
    return $this->belongsToMany(Teacher::class, 'course_teachers', 'course_code_id', 'teacher_id')
                ->withPivot('class_room_id', 'id')
                ->distinct();
}

public function classRooms()
{
    return $this->belongsToMany(ClassRoom::class, 'course_teachers', 'course_code_id', 'class_room_id')
                ->withPivot('teacher_id');
}

public function tasks()
{
    return $this->hasMany(Task::class, 'course_code_id');
}

public function certificates()
{
    return $this->belongsToMany(Certificate::class, 'certificate_courses', 'course_code_id', 'certificate_id')
                ->withPivot('subject_marks', 'id');
}
}
