<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'for',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function admins()
    {
        return $this->hasMany(Admin::class);
    }
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}