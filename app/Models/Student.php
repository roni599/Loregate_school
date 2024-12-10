<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'student_id',
        'st_name',
        'st_gender',
        'st_religion',
        'st_age',
        'st_dob',
        'st_birth_certificate_no',
        'st_nid_no',
        'st_passport_no',
        'st_nationality',
        'st_email',
        'st_mobile',
        'st_pre_division',
        'st_pre_district',
        'st_pre_sub_district',
        'st_pre_address_details',
        'st_per_division',
        'st_per_district',
        'st_per_sub_district',
        'st_per_address_details',
        'st_father_name',
        'st_father_nid_no',
        'st_father_passport_no',
        'st_father_nationality',
        'st_father_email',
        'st_father_mobile',
        'st_mother_name',
        'st_mother_nid_no',
        'st_mother_passport_no',
        'st_mother_nationality',
        'st_mother_email',
        'st_mother_mobile',
        'st_guardian_name',
        'st_guardian_nid_no',
        'st_guardian_passport_no',
        'st_guardian_nationality',
        'st_guardian_email',
        'st_guardian_mobile',
        'st_guardian_relation',
        'st_guardian_address',
        'st_guardian_contact_person',
        'st_picture',
        'st_signature',
        'education',
        'admission_id',
        'admission_assign_id'
    ];
    protected $casts = [
        'education' => 'json',
    ];
    public function admission()
    {
        return $this->belongsTo(Admission::class);
    }
    public function admissionAssign()
    {
        return $this->belongsTo(AdmissionAssign::class, 'admission_assign_id');
    }
}
