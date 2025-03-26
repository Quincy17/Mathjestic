<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model {
    use HasFactory;

    protected $table = 'paket_soal';
    protected $fillable = ['nama_paket', 'deskripsi'];

    public function soal() {
        return $this->belongsToMany(LatihanSoalModel::class, 'paket_soal_detail', 'paket_id', 'soal_id');
    }

    public function latihanSoal()
    {
        return $this->hasMany(LatihanSoalModel::class, 'paket_id', 'id');
    }

}
