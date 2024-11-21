<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_name',
        'email',
        'phone',
        'image',
        'classroom_id',
        'user_id',
      ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'classroom_id', 'id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}
public function grades()
{
    return $this->hasMany(Grade::class, 'student_id', 'id');
}

public function feedbacks()
{
    return $this->hasMany(Feedback::class, 'student_id', 'id');
}

public function taskSends()
    {
        return $this->hasMany(TaskSend::class, 'student_id', 'id');
    }

public function contacts()
{
    return $this->hasMany(Contact::class, 'student_id', 'id');
}

public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function attendanceStudents()
    {
        return $this->hasMany(AttendanceStudent::class);
    }

}