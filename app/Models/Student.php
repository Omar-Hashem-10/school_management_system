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
        'class_id',
        'user_id',
      ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }

    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

public function attendances()
{
    return $this->hasMany(Attendance::class, 'student_id', 'id');
}

public function grades()
{
    return $this->hasMany(Grade::class, 'student_id', 'id');
}

public function feedbacks()
{
    return $this->hasMany(Feedback::class, 'student_id', 'id');
}

public function contacts()
{
    return $this->hasMany(Contact::class, 'student_id', 'id');
}
}