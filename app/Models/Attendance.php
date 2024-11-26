<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendance_date',
        'class_room_id',
    ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }

    public function attendanceStudents()
    {
        return $this->hasMany(AttendanceStudent::class);
    }   
    public function date()
    {
        $this->belongsTo(Date::class);
    }
}