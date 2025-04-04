<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkorMuridTable extends Migration
{
    public function up()
    {
        Schema::create('skor_murid', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreignId('paket_soal_id')->constrained('paket_soal')->onDelete('cascade');
            $table->integer('jumlah_poin');
            
            // Menambahkan foreign key constraint
            $table->foreign('user_id')
            ->references('user_id') 
            ->on('m_user')
            ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('skor_murid');
    }
}

