<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        Schema::create('latihan_soal', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->text('soal');
            $table->text('jawaban');
            $table->timestamps();
        });
    }
    public function down() {
        Schema::dropIfExists('latihan_soal');
    }
};
