<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatihanSoalModel extends Model
{
    use HasFactory;
    protected $table = 'latihan_soal';
    protected $fillable = ['judul', 'deskripsi', 'soal', 'jawaban'];
}