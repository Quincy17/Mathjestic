<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaketSoal;
use App\Models\LatihanSoalModel;
use App\Models\JawabanMuridModel;
use Illuminate\Support\Facades\DB;
use App\Models\PaketSoalDetail;

class PaketSoalController extends Controller {
    public function index() {
        $paketSoal = PaketSoal::with('soal')->get(); // Memuat relasi soal
        return view('paket_soal.index', compact('paketSoal'));
    }

    public function create() {
        $soal = LatihanSoalModel::all();
        return view('paket_soal.create', compact('soal'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'soal' => 'required|array',
            'poin' => 'required|array',
        ]);

        $paket = PaketSoal::create([
            'nama_paket' => $request->nama_paket,
            'deskripsi' => $request->deskripsi
        ]);

        // Simpan soal yang dipilih ke tabel pivot `poin_soal`
        foreach ($request->soal as $soalId) {
            DB::table('poin_soal')->insert([
                'paket_soal_id' => $paket->id,
                'latihan_soal_id' => $soalId,
                'poin' => $request->poin[$soalId],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
        return redirect()->route('latihan_soal.index')->with('success', 'Paket Soal berhasil dibuat!');
    }

    public function show($id)
    {
        $paket = PaketSoal::with('soal')->find($id);

        if (!$paket) {
            return redirect()->route('paket-soal.index')->with('error', 'Paket tidak ditemukan');
        }

        return view('paket_soal.show', compact('paket'));
    }
      

    public function edit($id) {
        $paket = PaketSoal::with('soal')->findOrFail($id);
        $soal = LatihanSoalModel::all();
        return view('paket_soal.edit', compact('paket', 'soal'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nama_paket' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'soal' => 'required|array'
        ]);

        $paket = PaketSoal::findOrFail($id);
        $paket->update([
            'nama_paket' => $request->nama_paket,
            'deskripsi' => $request->deskripsi
        ]);

        $paket->soal()->sync($request->soal);

        return redirect()->route('latihan_soal.index')->with('success', 'Paket Soal berhasil diperbarui!');
    }

    public function destroy($id) {
        $paket = PaketSoal::findOrFail($id);
        $paket->delete();

        return redirect()->route('latihan_soal.index')->with('success', 'Paket Soal berhasil dihapus!');
    }

    public function showPaket($judul)
    {
        $soalPaket = LatihanSoalModel::where('judul', $judul)->get();
        return view('paket_soal.paket', compact('soalPaket', 'judul'));
    }

    public function kerjakan($id)
    {
        $paket = PaketSoal::with('soal')->findOrFail($id);
        return view('paket_soal.kerjakan', [
            'judul' => $paket->nama_paket, // Kirim judul paket ke view
            'soalPaket' => $paket->soal,
            'paket' => $paket, // Kirim objek paket ke view
        ]);
    }

    public function submitJawaban(Request $request, $id)
    {
        $request->validate([
            'jawaban_murid' => 'array',
            'jawaban_murid.*' => 'required|string',
        ]);

        $paketSoal = PaketSoal::with('soal')->findOrFail($id);

        foreach ($paketSoal->soal as $soal) {
            if (isset($request->jawaban_murid[$soal->id])) {
                JawabanMuridModel::updateOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'latihan_soal_id' => $soal->id,
                    ],  
                    [
                        'jawaban' => $request->jawaban_murid[$soal->id],
                    ]
                );
            }
        }

        return redirect()->route('latihan_soal.index')->with('success', 'Jawaban berhasil dikirim!');
    }

    public function getSoalPaket()
    {
        $soalList = LatihanSoalModel::select('id', 'judul', 'soal')->get();

        return response()->json($soalList);
    }
}
