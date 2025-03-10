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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id(); // ID контакта
            $table->unsignedBigInteger('establishment_id'); // ID заведения
            $table->string('type'); // Тип контакта (website, telegram, viber, vk, whatsapp)
            $table->string('value'); // Значение контакта (URL или номер)
            $table->timestamps();
        
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
