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
        Schema::create('yandex_reviews', function (Blueprint $table) {
            $table->id(); // ID отзыва
            $table->string('user_name'); // Имя пользователя из Yandex Maps
            $table->unsignedBigInteger('establishment_id'); // ID заведения
            $table->text('content'); // Текст отзыва
            $table->float('rating', 3, 1)->nullable(); // Оценка пользователя
            $table->timestamp('created_at')->nullable(); // Дата создания отзыва
            $table->index('establishment_id');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('yandex_reviews');
    }
};
