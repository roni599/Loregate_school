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
        Schema::create('educationboard', function (Blueprint $table) {
            $table->id();
            $table->string('eminister_name');
            $table->string('edesignation');
            $table->string('e_image')->nullable();
            $table->string('bminister_name');
            $table->string('bdesignation');
            $table->string('b_image')->nullable();
            $table->string('academy_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educationboard');
    }
};
