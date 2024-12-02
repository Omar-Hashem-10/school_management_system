<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'guardian_id',
        'role_id',
        'class_room_id',
        'user_id',
        'relation',
    ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
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
    public function attends()
    {
        return $this->morphMany(Attend::class, 'attendable');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


}