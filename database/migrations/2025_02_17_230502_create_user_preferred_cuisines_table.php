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
        Schema::create('user_preferred_cuisines', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // ID пользователя
            $table->unsignedBigInteger('cuisine_id'); // ID кухни
            $table->primary(['user_id', 'cuisine_id']); // Комбинированный первичный ключ
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('cuisine_id')->references('id')->on('cuisines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferred_cuisines');
    }
};
