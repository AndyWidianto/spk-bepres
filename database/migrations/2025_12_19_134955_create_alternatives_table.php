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
        Schema::create('alternatives', function (Blueprint $table) {
            $table->bigIncrements('alternative_id'); // Id alternatif
            $table->string('name'); // Nama mahasiswa
            $table->string('nim');
            $table->string('program_study');
            $table->string('faculty');
            $table->string('university');
            $table->decimal('final_score', total: 10, places: 6)->nullable(); // Nilai akhir setelah perhitungan WP
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alternatives');
    }
};
