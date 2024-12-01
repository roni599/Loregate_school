<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaLink extends Model
{
    use HasFactory;
    protected $fillable = ['links'];  // Allow mass assignment for 'links'

    protected $casts = [
        'links' => 'array', // Cast the 'links' column as an array
    ];
}
