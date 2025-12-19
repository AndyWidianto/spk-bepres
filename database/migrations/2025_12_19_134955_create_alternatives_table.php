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
            $table->decimal('gpa', total: 3, places: 2); // IPK
            $table->decimal('income_parents', total: 12, places: 0); // Penghasilan orang tua
            $table->integer('achievement'); // jumlah/level prestasi
            $table->decimal('wp_score', total: 10, places: 4); // Skor WP
            $table->enum('status', ['lolos', 'tidak lolos']); // Status
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
