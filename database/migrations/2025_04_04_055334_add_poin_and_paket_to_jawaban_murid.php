<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('jawaban_murid', function (Blueprint $table) {
            $table->unsignedInteger('poin_didapat')->default(0);
            $table->unsignedBigInteger('paket_soal_id')->nullable();

            // Tambahkan foreign key jika kamu punya tabel paket_soal
            $table->foreign('paket_soal_id')->references('id')->on('paket_soal')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('jawaban_murid', function (Blueprint $table) {
            $table->dropForeign(['paket_soal_id']);
            $table->dropColumn(['poin_didapat', 'paket_soal_id']);
        });
    }
};
