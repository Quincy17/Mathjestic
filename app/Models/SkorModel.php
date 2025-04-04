<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkorModel extends Model
{
    use HasFactory;

    protected $table = 'skor_murid';

    protected $fillable = [
        'user_id',
        'paket_soal_id',
        'jumlah_poin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function paketSoal()
    {
        return $this->belongsTo(PaketSoal::class, 'paket_soal_id', 'id');
    }
}
