<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeftPicture extends Model
{
    use HasFactory;
    protected $table="leftpictures";
    protected $fillable = [
        'name',
        'designation',
        'image',
        'academy_id'
    ];
}
