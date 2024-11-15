<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    protected $fillable = [
     'amount', 'date_id', 'person_id','person_type'
    ];

    public function person()
    {
        return $this->morphTo();
    }
    public function date(){
        return $this->belongsTo(Date::class);
    }
}