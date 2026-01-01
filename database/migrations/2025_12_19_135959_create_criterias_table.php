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
        Schema::create('criterias', function (Blueprint $table) {
            $table->bigIncrements('criteria_id'); // Id kriteria
            $table->string("code");
            $table->string('criteria_name'); // Nama kriteria
            $table->integer('weight'); // Bobot
            $table->enum('type', ['benefit', 'cost']); // Tipe
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterias');
    }
};
