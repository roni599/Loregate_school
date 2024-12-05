<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassInformation extends Model
{
    use HasFactory;
    protected $table = 'class_informations';
    protected $fillable = ['class_name', 'information', 'status','date'];
}
