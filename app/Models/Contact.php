<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'message',
        'student_id',
    ];

    public function student()
{
    return $this->belongsTo(Student::class, 'student_id', 'id');
}

}
