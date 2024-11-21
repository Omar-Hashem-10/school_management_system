<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function teacher()
{
    return $this->hasOne(Teacher::class, 'user_id', 'id');
}
public function student()
{
    return $this->hasOne(Student::class, 'user_id', 'id');
}
public function employee()
{
    return $this->hasOne(Employee::class);
}
public function admin()
{
    return $this->hasOne(Admin::class);
}
public function role()
{
    return $this->belongsTo(Role::class, 'role_id', 'id');
}
public function fullName(){
    return ucwords($this->first_name." ".$this->last_name);
} 
public function image(){
    return $this->morphOne(Image::class, 'imageable');
}
public function salaries()
{
    return $this->morphMany(Salary::class, 'person');
}
public function amounts($month, $year)
    {
        $date = Date::where(['day' => null, 'month' => $month, 'year' => $year])->first();

        $adjustments = $date
            ? $this->salaries()->where('date_id', $date->id)->sum('amount')
            : 0;

        return $adjustments;
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
}