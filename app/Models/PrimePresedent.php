<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrimePresedent extends Model
{
    use HasFactory;
    protected $table='primepresedent';
    protected $fillable = [
        'prime_minister_name',
        'prime_minister_designation',
        'prime_minister_image',
        'president_name',
        'president_designation',
        'president_image',
        'academy_id'
    ];
}
