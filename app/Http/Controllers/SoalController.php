<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalModel;
use Illuminate\Support\Facades\Auth;

class SoalController extends Controller
{
    public function index()
    {
        $soals = SoalModel::all();
        return view('soal.index', compact('soals'));
    }

    public function create()
    {
        return view('soal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $filePath = $request->file('file')->store('soal_files');

        SoalModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('soal.index')->with('success', 'Soal berhasil diunggah');
    }
}
