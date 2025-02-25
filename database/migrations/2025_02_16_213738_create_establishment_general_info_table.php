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
        Schema::create('establishment_general_info', function (Blueprint $table) {
            $table->unsignedBigInteger('establishment_id');
            $table->unsignedBigInteger('general_info_id');
            $table->primary(['establishment_id', 'general_info_id']);
            $table->foreign('establishment_id')->references('id')->on('establishments')->onDelete('cascade');
            $table->foreign('general_info_id')->references('id')->on('general_info')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establishment_general_info');
    }
};
