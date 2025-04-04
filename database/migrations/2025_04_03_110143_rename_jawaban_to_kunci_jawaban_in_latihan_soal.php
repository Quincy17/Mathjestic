<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameJawabanToKunciJawabanInLatihanSoal extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('latihan_soal', function (Blueprint $table) {
            // Mengganti nama kolom 'jawaban' menjadi 'kunci_jawaban'
            $table->renameColumn('jawaban', 'kunci_jawaban');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('latihan_soal', function (Blueprint $table) {
            // Kembalikan nama kolom menjadi 'jawaban' jika rollback
            $table->renameColumn('kunci_jawaban', 'jawaban');
        });
    }
}
