<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->nullable();
            $table->string('st_name')->nullable();
            $table->string('st_gender')->nullable();
            $table->string('st_religion')->nullable();
            $table->string('st_age')->nullable();
            $table->string('st_dob')->nullable();
            $table->string('st_birth_certificate_no')->nullable();
            $table->string('st_nid_no')->nullable();
            $table->string('st_passport_no')->nullable();
            $table->string('st_nationality')->nullable();
            $table->string('st_email')->nullable();
            $table->string('st_mobile')->nullable();
            $table->string('st_pre_division')->nullable();
            $table->string('st_pre_district')->nullable();
            $table->string('st_pre_sub_district')->nullable();
            $table->text('st_pre_address_details')->nullable();
            $table->string('st_per_division')->nullable();
            $table->string('st_per_district')->nullable();
            $table->string('st_per_sub_district')->nullable();
            $table->text('st_per_address_details')->nullable();
            $table->string('st_father_name')->nullable();
            $table->string('st_father_nid_no')->nullable();
            $table->string('st_father_passport_no')->nullable();
            $table->string('st_father_nationality')->nullable();
            $table->string('st_father_email')->nullable();
            $table->string('st_father_mobile')->nullable();
            $table->string('st_mother_name')->nullable();
            $table->string('st_mother_nid_no')->nullable();
            $table->string('st_mother_passport_no')->nullable();
            $table->string('st_mother_nationality')->nullable();
            $table->string('st_mother_email')->nullable();
            $table->string('st_mother_mobile')->nullable();
            $table->string('st_guardian_name')->nullable();
            $table->string('st_guardian_nid_no')->nullable();
            $table->string('st_guardian_passport_no')->nullable();
            $table->string('st_guardian_nationality')->nullable();
            $table->string('st_guardian_email')->nullable();
            $table->string('st_guardian_mobile')->nullable();
            $table->string('st_guardian_relation')->nullable();
            $table->text('st_guardian_address')->nullable();
            $table->string('st_guardian_contact_person')->nullable();
            $table->string('st_picture')->nullable();
            $table->string('st_signature')->nullable();
            $table->boolean('terms_condition')->default(true);
            $table->boolean('status')->default(true);
            $table->string('payment_data')->nullable();
            $table->string('payment_type')->nullable();
            $table->json('education')->nullable();
            $table->unsignedBigInteger('admission_id')->nullable();
            $table->unsignedBigInteger('admission_assign_id')->nullable();
            $table->foreign('admission_id')->references('id')->on('admissions')->onDelete('set null');
            $table->foreign('admission_assign_id')->references('id')->on('admissionassigns')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
