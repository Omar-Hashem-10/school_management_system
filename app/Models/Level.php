<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
    ];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'level_subjects', 'level_id', 'subject_id')->withPivot('id');
    }

    public function classRooms()
    {
        return $this->hasMany(ClassRoom::class, 'level_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'level_id', 'id');
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }
}
