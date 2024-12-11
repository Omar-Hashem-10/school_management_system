<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'salary',
        'possition',
        'gender'
    ];

    public function salaries()
    {
        return $this->morphMany(Salary::class, 'person');
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function attends()
    {
        return $this->morphMany(Attend::class, 'attendable');
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function calculateMonthlySalary($date)
    {
        $baseSalary = $this->salary;
        $adjustments = $date
            ? $this->salaries()->with('salaries')->where('date_id', $date)->sum('amount')
            : 0;

        return $baseSalary + $adjustments;
    }
    public function amounts($date)
    {
        $adjustments = $date
            ? $this->salaries()->where('date_id', $date)->sum('amount')
            : 0;

        return $adjustments;
    }
}