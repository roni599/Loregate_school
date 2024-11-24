<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Websitelink extends Model
{
    use HasFactory;
    protected $table = 'websitelink';
    protected $fillable = [
        'title',
        'link',
        'academy_id'
    ];
}
