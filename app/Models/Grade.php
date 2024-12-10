<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'grade',
        'student_id',
        'exam_id',
        'academic_year_id',
    ];

    public function exam()
{
    return $this->belongsTo(Exam::class, 'exam_id', 'id');
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
