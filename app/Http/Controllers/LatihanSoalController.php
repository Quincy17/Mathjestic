<?php

namespace App\Http\Controllers;

use App\Models\LatihanSoalModel;
use App\Models\JawabanMuridModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ParsedownExtra;
use App\Models\PaketSoal;

class LatihanSoalController extends Controller
{
    public function index(Request $request) {
        $search = $request->input('search');
        $paketSoal = PaketSoal::with('soal')->get(); // Ambil semua paket soal

        $latihanSoal = LatihanSoalModel::when($search, function ($query) use ($search) {
            return $query->where('judul', 'like', "%{$search}%")
                         ->orWhere('soal', 'like', "%{$search}%")
                         ->orWhere('deskripsi', 'like', "%{$search}%");
        })->paginate(10); // Pakai pagination biar lebih rapi

        // Query untuk mencari Paket Soal
        $paketSoal = PaketSoal::with('soal')
        ->when($search, function ($query) use ($search) {
            return $query->where('nama_paket', 'like', "%$search%")
                        ->orWhere('deskripsi', 'like', "%$search%");
        })
        ->get();
        
        return view('latihan_soal.index', compact('latihanSoal','paketSoal', 'search'));
    }
    

    public function create() {
        return view('latihan_soal.create');
    }
    
    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required|string',
            'soal' => 'required',
            'jawaban' => 'required',
        ]);
        LatihanSoalModel::create($request->all());
        return redirect()->route('latihan_soal.index')->with('success', 'Soal berhasil ditambahkan!');
    }
    
    public function edit($id) {
        $latihanSoal = LatihanSoalModel::findOrFail($id);
        return view('latihan_soal.edit', compact('latihanSoal'));
    }
    
    
    public function update(Request $request, $id) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required|string',
            'soal' => 'required',
            'jawaban' => 'required',
        ]);
    
        $latihanSoal = LatihanSoalModel::findOrFail($id);
        $latihanSoal->update($request->all());
    
        return redirect()->route('latihan_soal.index')->with('success', 'Soal berhasil diperbarui!');
    }
    
    
    public function show($id)
    {
        $latihanSoal = LatihanSoalModel::findOrFail($id);
    
        return view('latihan_soal.show', [
            'latihanSoal' => $latihanSoal,
            'deskripsi' => Str::markdown($latihanSoal->deskripsi),
            'soal' => Str::markdown($latihanSoal->soal),
            'jawaban' => Str::markdown($latihanSoal->jawaban)
        ]);
    }
    


    public function destroy(LatihanSoalModel $latihan_soal) {
        $latihan_soal->delete();
        return redirect()->route('latihan_soal.index')->with('success', 'Soal berhasil dihapus!');
    }

    public function kerjakan($id)
    {
        $latihanSoal = LatihanSoalModel::findOrFail($id);
        $parsedown = new ParsedownExtra();
        return view('latihan_soal.kerjakan', compact('latihanSoal', 'parsedown'));
    }


    public function submitJawaban(Request $request, $id)
    {
        $request->validate([
            'jawaban_murid' => 'required|string',
        ]);

        $latihanSoal = LatihanSoalModel::findOrFail($id);
        $latihanSoal->jawaban_murid = $request->jawaban_murid;
        $latihanSoal->save();

        return redirect()->route('latihan_soal.index')->with('success', 'Jawaban berhasil dikirim!');
    }

    public function paketSoal() {
        return $this->belongsTo(PaketSoal::class, 'paket_id');
    }
    
    public function submitPaket(Request $request, $judul    )
    {
        foreach ($request->jawaban as $soalId => $jawaban) {
            JawabanMuridModel::create([
                'user_id' => auth()->id(),
                'latihan_soal_id' => $soalId,
                'jawaban' => $jawaban,
            ]);
        }

        return redirect()->route('latihan_soal.index')->with('success', 'Jawaban berhasil dikirim!');
    }

}