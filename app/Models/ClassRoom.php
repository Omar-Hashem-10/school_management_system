<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'level_id',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'classroom_id','id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'classroom_id', 'id');
    }

public function schedule()
    {
        return $this->hasOne(Schedule::class, 'classroom_id', 'id');
    }

    public function courseTeachers()
    {
        return $this->hasMany(CourseTeacher::class, 'classroom_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}