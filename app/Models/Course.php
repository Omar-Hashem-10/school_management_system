<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
    ];

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'course_levels', 'course_id', 'level_id')
        ->withPivot('course_code', 'id')
        ->withTimestamps();
        }

    public function teachers()
    {
        return $this->hasMany(Teacher::class,'course_id','id');
    }
}
