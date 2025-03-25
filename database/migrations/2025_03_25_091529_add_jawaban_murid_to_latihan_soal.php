<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('latihan_soal', function (Blueprint $table) {
            $table->text('jawaban_murid')->nullable()->after('jawaban');
        });
    }

    public function down()
    {
        Schema::table('latihan_soal', function (Blueprint $table) {
            $table->dropColumn('jawaban_murid');
        });
    }
};
