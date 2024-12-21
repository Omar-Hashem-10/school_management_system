<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_marks',
        'level_id',
        'obtained_marks',
        'percentage',
        'grade',
        'student_id',
        'academic_year_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function courseCodes()
    {
        return $this->belongsToMany(CourseCode::class, 'certificate_courses', 'certificate_id', 'course_code_id')
                    ->withPivot('subject_marks', 'id');
    }

    public function level()
{
    return $this->belongsTo(Level::class);
}
}
