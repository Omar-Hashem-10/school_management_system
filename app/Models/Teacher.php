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
    ];
    
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
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

    public function courseTeachers()
    {
        return $this->hasMany(CourseTeacher::class, 'teacher_id');
    }
    public function calculateMonthlySalary($month, $year)
    {
        $baseSalary = $this->role->base_salary;

        $date = Date::where(['day' => null, 'month' => $month, 'year' => $year])->first();

        $adjustments = $date
            ? $this->salaries()->where('date_id', $date->id)->sum('amount')
            : 0;

        return $baseSalary + $adjustments;
    }
    public function amounts($month, $year)
    {
        $date = Date::where(['day' => null, 'month' => $month, 'year' => $year])->first();

        $adjustments = $date
            ? $this->salaries()->where('date_id', $date->id)->sum('amount')
            : 0;

        return $adjustments;
    }
}