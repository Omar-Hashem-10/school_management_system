<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $fillable = [
        'base_salary', 'bonus', 'deduction', 'total_salary', 'month', 'year', 'person_id', 'role_id','person_type'
    ];

    public function person()
    {
        return $this->morphTo();
    }
}