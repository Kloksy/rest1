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
        Schema::table('yandex_reviews', function (Blueprint $table) {
            // Добавляем foreign key
            $table->foreign('establishment_id')
                  ->references('id')
                  ->on('establishments')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('yandex_reviews', function (Blueprint $table) {
            // Удаляем foreign key
            $table->dropForeign(['establishment_id']);
        });
    }
};
