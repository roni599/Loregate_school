<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RightPicture extends Model
{
    use HasFactory;
    protected $table='rightpicture';
    protected $fillable = [
        'name',
        'designation',
        'image',
        'academy_id'
    ];
}
