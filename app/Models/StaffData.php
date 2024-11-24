<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffData extends Model
{
    use HasFactory;
    protected $fillable = [
        'teacher_staff_qty',
        'student_qty',
    ];
}
