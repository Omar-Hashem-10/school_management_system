<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskSend extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_link',
        'task_id',
        'student_id',
        'academic_year_id',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function academicYear()
{
    return $this->belongsTo(AcademicYear::class);
}
}
