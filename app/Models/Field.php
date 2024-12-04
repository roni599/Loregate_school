<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    use HasFactory;
    protected $fillable = [
        'field_name',
        'field_type',
        'options',
        'required'
    ];

    protected $casts = [
        'options' => 'array',
    ];
}
