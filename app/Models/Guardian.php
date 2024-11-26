<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guardian extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'role_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }
}