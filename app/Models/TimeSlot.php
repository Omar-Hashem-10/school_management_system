<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'time_slot_id', 'id');
    }
}
