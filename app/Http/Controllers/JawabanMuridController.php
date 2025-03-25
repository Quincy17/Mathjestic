<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JawabanMuridModel;
use App\Models\LatihanSoal;
use Illuminate\Support\Facades\Auth;

class JawabanMuridController extends Controller {
    public function store(Request $request, $latihanSoalId) {
        $request->validate([
            'jawaban' => 'required|string',
        ]);

        JawabanMuridModel::create([
            'user_id' => Auth::id(),
            'latihan_soal_id' => $latihanSoalId,
            'jawaban' => $request->jawaban,
        ]);

        return redirect()->route('latihan_soal.show', $latihanSoalId)->with('success', 'Jawaban berhasil disimpan!');
    }
}
