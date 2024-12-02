<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'semester',
        'start_date',
        'end_date',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
