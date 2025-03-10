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
        Schema::create('working_hours', function (Blueprint $table) {
            $table->id(); // ID записи
            $table->unsignedBigInteger('establishment_id'); // ID заведения
            $table->string('day'); // День недели (Mo, Tu, We, Th, Fr, Sa, Su)
            $table->string('hours'); // Время работы (например, "10:00-22:00")
            $table->timestamps();
        
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('working_hours');
    }
};
