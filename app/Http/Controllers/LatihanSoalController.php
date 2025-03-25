<?php

namespace App\Http\Controllers;

use App\Models\LatihanSoalModel;
use Illuminate\Http\Request;

class LatihanSoalController extends Controller
{
    public function index() {
        $soal = LatihanSoalModel::all();
        return view('latihan_soal.index', compact('soal'));
    }
    
    public function create() {
        return view('latihan_soal.create');
    }
    
    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
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
            'soal' => 'required',
            'jawaban' => 'required',
        ]);
        $latihan_soal->update($request->all());
        return redirect()->route('latihan_soal.index')->with('success', 'Soal berhasil diperbarui!');
    }
    
    public function destroy(LatihanSoalModel $latihan_soal) {
        $latihan_soal->delete();
        return redirect()->route('latihan_soal.index')->with('success', 'Soal berhasil dihapus!');
    }
}