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
        Schema::create('user_preferred_general_info', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // ID пользователя
            $table->unsignedBigInteger('general_info_id'); // ID параметра (Wi-Fi, доставка еды и т.д.)
            $table->primary(['user_id', 'general_info_id']); // Комбинированный первичный ключ
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('general_info_id')->references('id')->on('general_info')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferred_general_info');
    }
};
