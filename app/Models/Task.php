<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'task_name',
        'start_date',
        'end_date',
        'full_grade',
        'course_code_id',
        'teacher_id',
        'class_room_id',
    ];

    public function feedback()
    {
        return $this->hasOne(Feedback::class, 'task_id');
    }


    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function taskSends()
    {
        return $this->hasMany(TaskSend::class);
    }

}
