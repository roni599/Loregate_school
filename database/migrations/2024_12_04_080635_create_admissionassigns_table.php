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
        Schema::create('admissionassigns', function (Blueprint $table) {
            $table->id();
            $table->string('class_name');
            $table->string('class_details');
            $table->date('start_date');
            $table->time('start_time');
            $table->date('end_date');
            $table->time('end_time');
            $table->integer('qty')->nullable();
            $table->integer('male_qty')->nullable();
            $table->integer('female_qty')->nullable();
            $table->decimal('fee', 8, 2);
            $table->string('payment_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissionassigns');
    }
};
