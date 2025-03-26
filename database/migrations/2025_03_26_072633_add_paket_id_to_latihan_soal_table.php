<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::table('latihan_soal', function (Blueprint $table) {
            $table->foreignId('paket_id')->nullable()->constrained('paket_soal')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::table('latihan_soal', function (Blueprint $table) {
            $table->dropForeign(['paket_id']);
            $table->dropColumn('paket_id');
        });
    }
};
