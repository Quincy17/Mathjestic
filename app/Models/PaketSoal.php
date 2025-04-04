<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoal extends Model {
    use HasFactory;

    protected $table = 'paket_soal';
    protected $fillable = ['nama_paket', 'deskripsi'];

    public function soal() {
        return $this->belongsToMany(LatihanSoalModel::class, 'poin_soal', 'paket_soal_id', 'latihan_soal_id')
                    ->withPivot('paket_soal_id','poin')
                    ->withTimestamps();
    }

    public function latihanSoal()
    {
        return $this->hasMany(LatihanSoalModel::class, 'paket_id', 'id');
    }

    public function paketSoalDetails()
    {
        return $this->hasMany(PaketSoalDetail::class);
    }

    
}
