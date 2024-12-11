<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attend extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_id',
        'attendable_id',
        'attendable_type',
        'status',
        'academic_year_id',
    ];
    public function attendable()
    {
        return $this->morphTo();
    }
    public function date()
    {
        return $this->belongsTo(Date::class, 'date_id');
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class, 'academic_year_id');
    }
}
