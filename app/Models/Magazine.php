<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;
    protected $fillable = [
        'subject',
        'heading',
        'writer',
        'data_sources',
        'description',
        'date',
        'image'
    ];
}
