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
        Schema::create('establishments', function (Blueprint $table) {
            $table->id(); // ID заведения
            $table->string('name'); // Название заведения
            $table->unsignedBigInteger('type_id')->nullable(); // Тип заведения
            $table->string('average_bill')->nullable(); // Средний чек (строка)
            $table->string('price_category')->nullable(); // Категория цены (строка)
            $table->decimal('latitude', 10, 8)->nullable(); // Широта
            $table->decimal('longitude', 11, 8)->nullable(); // Долгота
            $table->string('address')->nullable(); // Адрес
            $table->float('rating', 3, 1)->nullable(); // Рейтинг
            $table->integer('reviews_count')->nullable(); // Количество отзывов
            $table->string('logo_url')->nullable(); // URL логотипа
            $table->timestamps();
        
            $table->foreign('type_id')->references('id')->on('establishment_types')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establishments');
    }
};
