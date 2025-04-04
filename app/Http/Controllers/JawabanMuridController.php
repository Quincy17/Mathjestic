<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JawabanMuridModel;
use App\Models\LatihanSoalModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\PaketSoal;
use Illuminate\Support\Facades\DB;
use App\Models\SkorModel;

class JawabanMuridController extends Controller {
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $jawabanMurid = JawabanMuridModel::with(['murid', 'paketSoal'])
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

    public function submitPaket(Request $request, $paketSoalId)
    {
        $userId = Auth::id();
        $paket = PaketSoal::with('soal')->findOrFail($paketSoalId);
        $jawabanInput = $request->input('jawaban', []);

        // 🔥 1. Hapus jawaban lama sebelum menyimpan yang baru
        JawabanMuridModel::where('user_id', $userId)
            ->where('paket_soal_id', $paketSoalId)
            ->delete();

        $totalPoin = 0;

        foreach ($paket->soal as $soal) {
            $jawabanMurid = $jawabanInput[$soal->id] ?? '';
            $kunciJawaban = $soal->kunci_jawaban;

            // Normalisasi jawaban
            $jawabanMuridBersih = trim(strtolower($jawabanMurid));
            $kunciJawabanBersih = trim(strtolower($kunciJawaban));
            $status = ($jawabanMuridBersih === $kunciJawabanBersih) ? 'benar' : 'salah';

            // Ambil poin dari pivot
            $poin = $soal->pivot->poin ?? 0;
            $poinDidapat = $status === 'benar' ? $poin : 0;
            $totalPoin += $poinDidapat;

            // Simpan jawaban baru
            JawabanMuridModel::create([
                'user_id' => $userId,
                'latihan_soal_id' => $soal->id,
                'paket_soal_id' => $paketSoalId,
                'jawaban' => $jawabanMurid,
                'status' => $status,
                'poin_didapat' => $poinDidapat,
            ]);
        }

        // 🔥 2. Hapus skor lama sebelum menyimpan skor baru
        SkorModel::where('user_id', $userId)
            ->where('paket_soal_id', $paketSoalId)
            ->delete();

        // 🔥 3. Simpan skor baru
        SkorModel::create([
            'user_id' => $userId,
            'paket_soal_id' => $paketSoalId,
            'jumlah_poin' => $totalPoin,
        ]);

        return redirect()->route('latihan_soal.index')
            ->with('success', 'Jawaban berhasil dikoreksi. Total poin: ' . $totalPoin);
    }


    
    public function show($id)
    {
        $jawaban = JawabanMuridModel::findOrFail($id);
        return view('latihan_soal.show-jawaban', compact('jawaban'));
    }
    
    public function arsipJawaban(Request $request)
    {
        $search = $request->input('search');

        $arsip = DB::table('skor_murid')
            ->join('m_user', 'm_user.user_id', '=', 'skor_murid.user_id') // Menggunakan m_user.user_id
            ->join('paket_soal', 'paket_soal.id', '=', 'skor_murid.paket_soal_id')
            ->select('m_user.name', 'paket_soal.nama_paket', 'skor_murid.jumlah_poin', 'skor_murid.paket_soal_id', 'skor_murid.user_id')
            ->when($search, function ($query) use ($search) {
                return $query->where('m_user.name', 'like', "%{$search}%")
                            ->orWhere('paket_soal.nama_paket', 'like', "%{$search}%");
            })
            ->orderByDesc('skor_murid.updated_at')
            ->paginate(10); 

        return view('admin.arsip-jawaban', compact('arsip'));
    }

    public function detailJawaban($paketSoalId, $userId)
    {
        $jawabanMurid = JawabanMuridModel::where('paket_soal_id', $paketSoalId)
            ->where('user_id', $userId)
            ->with('latihanSoal')
            ->get();

        // Menggunakan m_user.user_id
        $murid = DB::table('m_user')->where('user_id', $userId)->value('name');
        $paketSoal = DB::table('paket_soal')->where('id', $paketSoalId)->value('nama_paket');

        return view('admin.detail-jawaban', compact('jawabanMurid', 'murid', 'paketSoal'));
    }

}
