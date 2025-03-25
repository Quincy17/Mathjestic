<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('jawaban_murid', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('user_id')->on('m_user')->onDelete('cascade');   
            $table->foreignId('latihan_soal_id')->constrained('latihan_soal')->onDelete('cascade'); // Relasi ke soal
            $table->text('jawaban'); // Jawaban murid
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('jawaban_murids');
    }
};
