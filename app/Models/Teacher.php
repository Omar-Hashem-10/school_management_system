<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_name',
        'email',
        'phone',
        'image',
        'experience',
        'course_id',
        'user_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

public function exams(){
    return $this->hasMany(Exam::class,'teacher_id', 'id');
}

public function questions()
{
    return $this->hasMany(Question::class, 'teacher_id', 'id');
}

public function feedbacks()
{
    return $this->hasMany(Feedback::class, 'teacher_id', 'id');
}


}
