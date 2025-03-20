<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->text('description')->nullable()->after('activity'); // Menambahkan kolom deskripsi setelah kolom activity
        });
    }

    public function down()
    {
        Schema::table('logs', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};

