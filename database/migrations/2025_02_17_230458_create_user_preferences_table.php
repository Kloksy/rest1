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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id(); // ID записи
            $table->unsignedBigInteger('user_id'); // ID пользователя
            $table->string('price_category')->nullable(); // Предпочитаемая ценовая категория
            $table->decimal('latitude', 10, 8)->nullable(); // Предпочитаемая широта (для фильтрации по локации)
            $table->decimal('longitude', 11, 8)->nullable(); // Предпочитаемая долгота
            $table->time('preferred_time_from')->nullable(); // Предпочтительное время начала работы заведения
            $table->time('preferred_time_to')->nullable(); // Предпочтительное время окончания работы заведения
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
