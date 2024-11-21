<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function levels()
    {
        return $this->belongsToMany(Level::class, 'level_subjects', 'subject_id', 'level_id')->withPivot('id');
    }

    public function teachers()
    {
        return $this->hasMany(Teacher::class,'subject_id','id');
    }
}
