<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanMuridModel extends Model {
    use HasFactory;
    protected $table = 'jawaban_murid';
    protected $fillable = ['user_id', 'latihan_soal_id','paket_soal_id','poin_didapat', 'jawaban','status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi ke tabel m_user dengan filter role murid
    public function murid()
    {
        return $this->belongsTo(User::class, 'user_id')->where('role', 'murid');
    }

    // Relasi ke latihan soal
    public function latihanSoal()   
    {
        return $this->belongsTo(LatihanSoalModel::class, 'latihan_soal_id');
    }

    public function paketSoal()
    {
        return $this->belongsTo(PaketSoal::class, 'paket_soal_id', 'id');
    }

}
