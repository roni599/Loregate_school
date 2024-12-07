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
            $table->unsignedBigInteger('class_id');
            $table->boolean('status')->default(true);
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
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
