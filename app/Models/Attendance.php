<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'status',
        'student_id',
        'class_room_id',
    ];


    public function student()
{
    return $this->belongsTo(Student::class, 'student_id', 'id');
}

public function classRoom()
{
    return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
}
}
