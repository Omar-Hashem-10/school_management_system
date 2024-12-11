<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'experience',
        'subject_id',
        'user_id',
        'role_id',
        'salary'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }

    public function courseCodes()
    {
        return $this->belongsToMany(CourseCode::class, 'course_teachers', 'teacher_id', 'course_code_id')
                    ->withPivot('class_room_id', 'id')
                    ->distinct();
    }


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'teacher_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'teacher_id', 'id');
    }
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }
    public function salaries()
    {
        return $this->morphMany(Salary::class, 'person');
    }
    public function calculateMonthlySalary($date)
    {
        $baseSalary = $this->salary;


        $adjustments = $date
            ? $this->user->salaries()->with('salaries')->where('date_id', $date)->sum('amount')
            : 0;
        return $baseSalary + $adjustments;
    }
    public function amounts(Date $date)
    {
        $adjustments = $date
            ? $this->user->salaries()->where('date_id', $date->id)->sum('amount')
            : 0;

        return $adjustments;
    }
}