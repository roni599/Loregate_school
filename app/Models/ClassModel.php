<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'classes';

    protected $fillable = [
        'class_name',
        'group',
        'session',
        'shift',
        'section',
        'status',
    ];
    public function admissions()
    {
        return $this->hasMany(Admission::class, 'class_id');
    }
    public function classInformations()
    {
        return $this->hasMany(ClassInformation::class, 'class_id');
    }
}
