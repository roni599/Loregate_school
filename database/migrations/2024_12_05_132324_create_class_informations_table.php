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
        Schema::create('class_informations', function (Blueprint $table) {
            $table->id();
            $table->text('information')->nullable();
            $table->text('date')->nullable();
            $table->unsignedBigInteger('assign_class_id')->nullable();
            $table->boolean('status')->default(true);
            $table->foreign('assign_class_id')->references('id')->on('admissionassigns')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_informations');
    }
};
