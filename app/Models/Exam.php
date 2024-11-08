<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_name',
        'exam_date',
        'exam_duration',
        'half_grade',
        'class_level_id',
        'teacher_id',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function questions()
{
    return $this->belongsToMany(Question::class, 'exam_questions', 'exam_id', 'question_id');
}

public function grades()
{
    return $this->hasMany(Grade::class, 'exam_id', 'id');
}

public function feedbacks()
{
    return $this->hasMany(Feedback::class, 'exam_id', 'id');
}

}
