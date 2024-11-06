<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_name',
        'level_id',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }

    public function students()
    {
        return $this->hasMany(Student::class,'class_room_id','id');
    }

public function attendances()
{
    return $this->hasMany(Attendance::class, 'class_room_id', 'id');
}

public function schedule()
    {
        return $this->hasOne(Schedule::class, 'class_room_id', 'id');
    }


}
