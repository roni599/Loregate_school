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
        Schema::create('boardnews', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->date('date');
            $table->string('writer');
            $table->string('data_sources');
            $table->text('description');
            $table->string('academy_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boardnews');
    }
};
