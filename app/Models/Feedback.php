<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'feedback_text',
        'task_grade',
        'teacher_id',
        'student_id',
        'task_id',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
