<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaketSoalDetail extends Model {
    use HasFactory;

    protected $table = 'paket_soal_detail';
    protected $fillable = ['paket_id', 'soal_id'];
}

