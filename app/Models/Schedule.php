<?php

namespace App\Models;

use App\Models\CourseCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_room_id',
        'course_code_id',
        'time_slot_id',
        'day_id',
    ];

    public function classRoom()
    {
        return $this->belongsTo(ClassRoom::class, 'class_room_id', 'id');
    }

    public function courseCode()
    {
        return $this->belongsTo(CourseCode::class, 'course_code_id', 'id');
    }

    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'time_slot_id', 'id');
    }

    public function day()
    {
        return $this->belongsTo(Day::class);
    }
}
