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
        Schema::create('scores', function (Blueprint $table) {
            $table->bigIncrements('score_id'); // Id skor
            $table->unsignedBigInteger('alternative_id'); // Alternative id (FK)
            $table->unsignedBigInteger('criteria_id'); // Kriteria id (FK)
            $table->decimal('score', 12, 2); // Nilai mentah sebelum perhitungan WP
            $table->foreign('alternative_id')->references('alternative_id')->on('alternatives')->onDelete('cascade');
            $table->foreign('criteria_id')->references('criteria_id')->on('criterias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
