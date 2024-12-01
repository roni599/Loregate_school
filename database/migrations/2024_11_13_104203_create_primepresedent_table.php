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
        Schema::create('primepresedent', function (Blueprint $table) {
            $table->id();
            $table->string('prime_minister_name');
            $table->string('prime_minister_designation');
            $table->string('prime_minister_image')->nullable();
            $table->string('president_name');
            $table->string('president_designation');
            $table->string('president_image')->nullable();
            $table->string('academy_id')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('primepresedent');
    }
};
