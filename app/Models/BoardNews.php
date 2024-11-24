<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardNews extends Model
{
    use HasFactory;
    // protected $table = 'winnergallery';
    protected $table='boardnews';
    protected $fillable = [
        'heading',
        'date',
        'writer',
        'data_sources',
        'description',
        'academy_id'
    ];
}
