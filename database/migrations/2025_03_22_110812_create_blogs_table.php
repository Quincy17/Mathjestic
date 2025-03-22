<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->text('content');
            $table->string('image')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('m_user')->onDelete('set null');
        });
    }

    public function down() {
        Schema::dropIfExists('blogs');
    }
};
