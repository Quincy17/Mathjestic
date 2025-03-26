<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JawabanMuridModel;
use App\Models\LatihanSoalModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class JawabanMuridController extends Controller {
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $jawabanMurid = JawabanMuridModel::with(['murid', 'latihanSoal'])
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('murid', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('latihanSoal', function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");
                })->orWhere('jawaban', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')->paginate(10);
    
        return view('admin.arsip-jawaban', compact('jawabanMurid', 'search'));
    }
    public function store(Request $request, $latihanSoalId)
    {
        $request->validate([
            'jawaban' => 'required|string',
        ]);

        $jawabanMurid = $request->jawaban;
        $latihanSoal = LatihanSoalModel::findOrFail($latihanSoalId);
        $kunciJawaban = $latihanSoal->jawaban;

        // Debugging: Log nilai jawaban untuk memeriksa apakah memang sama
        Log::info('Jawaban Murid (Original): ' . $jawabanMurid);
        Log::info('Kunci Jawaban (Original): ' . $kunciJawaban);

        // Normalisasi jawaban (menghilangkan spasi berlebih dan menyamakan huruf kecil)
        // Membersihkan karakter tersembunyi
        function bersihkanJawaban($jawaban) {
            return preg_replace('/[^\PC\s]/u', '', trim(strtolower($jawaban)));
        }

        $jawabanMuridBersih = bersihkanJawaban($jawabanMurid);
        $kunciJawabanBersih = bersihkanJawaban($kunciJawaban);

        Log::info('Jawaban Murid (HEX): ' . bin2hex($jawabanMuridBersih));
        Log::info('Kunci Jawaban (HEX): ' . bin2hex($kunciJawabanBersih));

        $status = ($jawabanMuridBersih === $kunciJawabanBersih) ? 'benar' : 'salah';

        Log::info('Jawaban Murid (Bersih): ' . $jawabanMuridBersih);
        Log::info('Kunci Jawaban (Bersih): ' . $kunciJawabanBersih);
        Log::info('Status: ' . $status);
        
        // Simpan jawaban murid
        JawabanMuridModel::create([
            'user_id' => auth()->id(),  
            'latihan_soal_id' => $latihanSoalId,
            'jawaban' => $jawabanMurid,
            'status' => $status, 
        ]);

        return redirect()->route('latihan_soal.submit', $latihanSoalId)
            ->with('success', 'Jawaban berhasil dikirim dan dikoreksi! Hasil: ' . ucfirst($status));
    }


    public function arsipJawaban()
    {
        $jawabanMurid = JawabanMuridModel::with(['murid', 'latihanSoal'])->latest()->get();
        return view('admin.arsip-jawaban', compact('jawabanMurid'));
    }

    public function show($id)
    {
        $jawaban = JawabanMuridModel::findOrFail($id);
        return view('latihan_soal.show-jawaban', compact('jawaban'));
    }

    
}
