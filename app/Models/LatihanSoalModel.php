<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\JawabanMuridModel;

class LatihanSoalModel extends Model
{
    use HasFactory;
    protected $table = 'latihan_soal';
    protected $fillable = ['judul', 'deskripsi', 'soal', 'jawaban','jawaban_murid'];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function jawabanMurid() {
        return $this->hasMany(JawabanMuridModel::class);
    }
    
}