<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback_text',
        'teacher_id',
        'student_id',
        'exam_id',
    ];

    public function teacher()
{
    return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
}

public function student()
{
    return $this->belongsTo(Student::class, 'student_id', 'id');
}

public function exam()
{
    return $this->belongsTo(Exam::class, 'exam_id', 'id');
}

}
