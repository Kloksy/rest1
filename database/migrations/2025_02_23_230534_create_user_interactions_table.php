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
        Schema::create('user_interactions', function (Blueprint $table) {
            $table->id(); // ID записи
            $table->unsignedBigInteger('user_id'); // ID пользователя
            $table->unsignedBigInteger('establishment_id'); // ID заведения
            $table->unsignedBigInteger('review_id')->nullable()->after('viewed_at'); // Ссылка на review
            $table->timestamp('viewed_at')->nullable(); // Время просмотра заведения
            $table->timestamps();
        
            $table->foreign('review_id')->references('id')->on('user_reviews')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_interactions');
    }
};
