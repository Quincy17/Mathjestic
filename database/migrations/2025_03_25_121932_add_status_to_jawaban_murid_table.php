<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('jawaban_murid', function (Blueprint $table) {
            $table->enum('status', ['benar', 'salah'])->nullable()->after('jawaban');
        });
    }

    public function down()
    {
        Schema::table('jawaban_murid', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }

};
