<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JawabanMuridModel;

class LatihanSoalModel extends Model
{
    use HasFactory;
    protected $table = 'latihan_soal';
    protected $fillable = ['judul', 'deskripsi', 'soal', 'kunci_jawaban','jawaban_murid'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function jawabanMurid() {
        return $this->hasMany(JawabanMuridModel::class);
    }
    
    public function paketSoal() {
        return $this->belongsToMany(PaketSoal::class, 'paket_soal_detail', 'soal_id', 'paket_id');
    }

    
}