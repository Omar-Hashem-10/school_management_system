<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'exam_duration',
        'half_grade',
        'course_code_id',
        'teacher_id',
        'class_room_id',
        'academic_year_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function questions()
{
    return $this->belongsToMany(Question::class, 'exam_questions', 'exam_id', 'question_id')->withPivot('question_grade')
    ->withTimestamps();
}

    public function grades()
    {
        return $this->hasMany(Grade::class, 'exam_id', 'id');
    }

    public function courseCode()
{
    return $this->belongsTo(CourseCode::class, 'course_code_id', 'id');
}

public function feedbacks()
{
    return $this->hasMany(Feedback::class, 'exam_id', 'id');
}

public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
