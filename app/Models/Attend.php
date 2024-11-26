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
    ];
    public function attendable()
    {
        return $this->morphTo();
    }
    public function date()
    {
        $this->belongsTo(Date::class);
    }
}