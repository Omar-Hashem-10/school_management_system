<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function salaries()
    {
        return $this->morphMany(Salary::class, 'person');
    }
    public function calculateMonthlySalary($month, $year)
    {
        $baseSalary = $this->role->base_salary;

        $date = Date::where(['day' => null, 'month' => $month, 'year' => $year])->first();

        $adjustments = $date
            ? $this->salaries()->where('date_id', $date->id)->sum('amount')
            : 0;

        return $baseSalary + $adjustments;
    }
    public function amounts($month, $year)
    {
        $date = Date::where(['day' => null, 'month' => $month, 'year' => $year])->first();

        $adjustments = $date
            ? $this->salaries()->where('date_id', $date->id)->sum('amount')
            : 0;

        return $adjustments;
    }
}