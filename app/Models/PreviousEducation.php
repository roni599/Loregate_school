<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousEducation extends Model
{
    use HasFactory;
    protected $table = 'previouseducations';
    protected $fillable = ['education_name','status'];
}
