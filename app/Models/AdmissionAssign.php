<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionAssign extends Model
{
    use HasFactory;
    protected $table = 'admissionassigns';

    protected $fillable = [
        'class_name',
        'class_details',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'qty',
        'male_qty',
        'female_qty',
        'fee',
        'payment_type',
    ];
    public function classInformations()
    {
        return $this->hasMany(ClassInformation::class, 'assign_class_id');
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
