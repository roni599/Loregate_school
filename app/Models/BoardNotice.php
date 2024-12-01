<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardNotice extends Model
{
    use HasFactory;
    protected $table = 'boardnotices';
    protected $fillable = [
        'date',
        'reference',
        'subject',
        'description',
        'signature',
        'academy_id'
    ];
}
