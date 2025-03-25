<?php

namespace App\Http\Controllers;

use App\Models\LatihanSoalModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use ParsedownExtra;

class LatihanSoalController extends Controller
{
    public function index() {
        $latihanSoal = LatihanSoalModel::all();
        return view('latihan_soal.index', compact('latihanSoal'));
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
    
    public function edit(LatihanSoalModel $latihan_soal) {
        return view('latihan_soal.edit', compact('latihan_soal'));
    }
    
    public function update(Request $request, LatihanSoalModel $latihan_soal) {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required|string',
            'soal' => 'required',
            'jawaban' => 'required',
        ]);
        $latihan_soal->update($request->all());
        return redirect()->route('latihan_soal.index')->with('success', 'Soal berhasil diperbarui!');
    }
    
    public function show($id)
    {
        $latihanSoal = LatihanSoalModel::findOrFail($id); // Ambil soal berdasarkan ID

        return view('latihan_soal.show', compact('latihanSoal'));
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
            'jawaban' => 'required|string',
        ]);

        $soal = LatihanSoalModel::findOrFail($id);

        // Simpan jawaban murid jika diperlukan (bisa ke database)

        return view('latihan_soal.submit');
    }

}