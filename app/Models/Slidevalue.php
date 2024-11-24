<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slidevalue extends Model
{
    use HasFactory;
    // protected $tablle="slidevalues";
    protected $fillable = ['image1', 'image2', 'image3','academy_id'];
}
