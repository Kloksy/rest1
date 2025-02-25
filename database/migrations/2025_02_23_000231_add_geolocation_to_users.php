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
        Schema::table('users', function (Blueprint $table) {
            // Добавляем поля для геолокации
            $table->decimal('latitude', 10, 8)->nullable()->after('email'); // Широта
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude'); // Долгота
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Удаляем добавленные поля при откате миграции
            $table->dropColumn('latitude');
            $table->dropColumn('longitude');
        });
    }
};
