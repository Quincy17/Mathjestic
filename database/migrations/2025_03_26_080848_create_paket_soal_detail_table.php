<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('paket_soal_detail', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paket_id')->constrained('paket_soal')->onDelete('cascade');
            $table->foreignId('soal_id')->constrained('latihan_soal')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('paket_soal_detail');
    }
};
