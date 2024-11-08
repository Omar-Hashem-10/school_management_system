<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_name',
        'amount',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_levels', 'level_id', 'course_id')
        ->withPivot('course_code', 'id')
        ->withTimestamps();
    }

    public function classRooms()
    {
        return $this->hasMany(ClassRoom::class, 'level_id', 'id');
    }
}