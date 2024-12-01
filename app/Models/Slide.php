<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;
    protected $fillable = ['pictures'];

    // Ensure pictures is cast to array when retrieved
    protected $casts = [
        'pictures' => 'array',
    ];
}
