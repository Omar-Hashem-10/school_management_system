<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_text',
        'question_type',
        'teacher_id',
        'course_level_id',
    ];

    public function teacher()
{
    return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
}

public function choices()
{
    return $this->hasMany(Choice::class, 'question_id', 'id');
}

public function exams()
{
    return $this->belongsToMany(Exam::class, 'exam_questions', 'question_id', 'exam_id')->withPivot('question_grade')->withTimestamps();;
}

public function answers()
{
    return $this->hasMany(Answer::class);
}
}
