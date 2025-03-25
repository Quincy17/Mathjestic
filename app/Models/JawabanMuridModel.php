<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanMuridModel extends Model {
    use HasFactory;
    protected $table = 'jawaban_murid';
    protected $fillable = ['user_id', 'latihan_soal_id', 'jawaban'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function latihanSoal() {
        return $this->belongsTo(LatihanSoalModel::class);
    }
}
