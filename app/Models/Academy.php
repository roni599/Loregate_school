<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    use HasFactory;
    protected $fillable = [
        'academy_name',
        'academy_address',
        'academy_mobile_number',
        'academy_logo',
    ];
}
