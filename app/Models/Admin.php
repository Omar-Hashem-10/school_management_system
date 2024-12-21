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
        'salary',
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
    public function calculateMonthlySalary($date)
    {
        $baseSalary = $this->salary;

        $adjustments = $date
            ? $this->user->salaries()->with('salaries')->where('date_id', $date)->sum('amount')
            : 0;

        return $baseSalary + $adjustments;
    }
    public function amounts($date)
    {

        $adjustments = $date
            ? $this->salaries()->with('user')->where('date_id', $date)->sum('amount')
            : 0;

        return $adjustments;
    }
}