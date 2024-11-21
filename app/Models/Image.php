<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'path', 'imageable_id','imageable_type','all_text'
       ];    
    public function imageable()
    {
        return $this->morphTo();
    }
}