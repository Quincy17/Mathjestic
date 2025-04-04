<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('latihan_soal', function (Blueprint $table) {
            if (!Schema::hasColumn('latihan_soal', 'paket_id')) {
                $table->unsignedBigInteger('paket_id')->nullable()->after('id');
                $table->foreign('paket_id')->references('id')->on('paket_soal')->onDelete('cascade');
            }
        });
    }


    public function down()
    {
        Schema::table('latihan_soal', function (Blueprint $table) {
            if (Schema::hasColumn('latihan_soal', 'paket_id')) {
                $table->dropForeign(['paket_id']);
                $table->dropColumn('paket_id');
            }
        });
    }

};
