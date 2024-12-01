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
        Schema::create('winnergallery', function (Blueprint $table) {
            $table->id();
            $table->string('event_name');
            $table->string('name');
            $table->string('class');
            $table->string('roll_or_uid');
            $table->string('winning_place');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->string('academy_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('winnergallery');
    }
};
