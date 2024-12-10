<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassInformation extends Model
{
    use HasFactory;
    protected $table = 'class_informations';
    protected $fillable = ['assign_class_id', 'information', 'status', 'date'];

    // public function class()
    // {
    //     return $this->belongsTo(ClassModel::class, 'class_id');
    // }
    public function admissionAssign()
    {
        return $this->belongsTo(AdmissionAssign::class, 'assign_class_id');
    }
}
