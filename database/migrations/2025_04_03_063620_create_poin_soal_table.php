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
        Schema::create('poin_soal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_soal_id')->constrained('paket_soal')->onDelete('cascade');
            $table->foreignId('latihan_soal_id')->constrained('latihan_soal')->onDelete('cascade');
            $table->integer('poin')->default(0);
            $table->timestamps();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poin_soal');
    }
};
