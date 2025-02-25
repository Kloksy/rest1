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
        Schema::create('user_preferred_types', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // ID пользователя
            $table->unsignedBigInteger('type_id'); // ID типа заведения
            $table->primary(['user_id', 'type_id']); // Комбинированный первичный ключ
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('establishment_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferred_types');
    }
};
