<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;
    protected $fillable = [
        'day',
        'month',
        'year',
    ];

public function salaries()
{
    return $this->hasMany(Salary::class);
}
public function attendances()
{
    return $this->hasMany(Attendance::class);
}
}