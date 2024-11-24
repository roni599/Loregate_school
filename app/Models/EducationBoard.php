<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationBoard extends Model
{
    use HasFactory;
    protected $table = 'educationboard';
    protected $fillable = [
        'eminister_name',
        'edesignation',
        'e_image',
        'bminister_name',
        'bdesignation',
        'b_image',
        'academy_id'
    ];
}
