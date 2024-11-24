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
        Schema::create('boardnotices', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('reference');
            $table->string('subject');
            $table->text('description');
            $table->string('signature')->nullable();
            $table->string('academy_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boardnotices');
    }
};
