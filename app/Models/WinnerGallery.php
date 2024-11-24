<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WinnerGallery extends Model
{
    use HasFactory;
    protected $table = 'winnergallery';

    // Specify which attributes are mass assignable
    protected $fillable = [
        'event_name',
        'name',
        'class',
        'roll_or_uid',
        'winning_place',
        'price',
        'image',
    ];
}
