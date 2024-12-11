<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'semester',
        'start_date',
        'end_date',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function taskSends()
{
    return $this->hasMany(TaskSend::class);
}

public function students()
{
    return $this->hasMany(Student::class, 'start_academic_year_id');
}

public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'academic_year_id');
    }

    public function attends()
    {
        return $this->hasMany(Attend::class, 'academic_year_id');
    }
}
