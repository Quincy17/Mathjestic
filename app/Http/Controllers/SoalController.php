<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SoalModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\LogsModel;

class SoalController extends Controller
{
    public function index(Request $request)
    {
        $query = SoalModel::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'LIKE', "%$search%")
                ->orWhere('description', 'LIKE', "%$search%");
        }

        $soals = $query->get();
        return view('soal.index', compact('soals'));
    }

    public function create()
    {
        return view('soal.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'files.*' => 'required|file|max:2048', // Validasi array file
        ]);

        foreach ($request->file('files') as $file) {
            $filename = time() . '_' . $file->getClientOriginalName();

            // Simpan ke storage
            $file->storeAs('public/soal_files', $filename);

            // Simpan ke database
            $soal = SoalModel::create([
                'title' => pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME), // Judul diambil dari nama file tanpa ekstensi
                'description' => $request->description,    
                'file_path' => $filename,   
                'original_filename' => $file->getClientOriginalName(),
                'created_by' => Auth::id(),
            ]);

            // Simpan ke log jika user login
            if (Auth::check()) {
                LogsModel::create([
                    'user_id' => Auth::id(),
                    'activity' => 'create_soal',
                    'description' => 'Menambahkan soal: ' . $soal->title,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Soal berhasil diunggah!');
    }

    public function download($soal_id)
    {
        $soal = SoalModel::findOrFail($soal_id);
        $filePath = 'public/soal_files/' . $soal->file_path;

        // Gunakan Storage::path() agar file bisa ditemukan dengan benar
        if (!Storage::exists($filePath)) {
            return redirect()->back()->with('error', 'File tidak ditemukan.');
        }

        // Pastikan log hanya dicatat jika user login   
        if (Auth::check()) {
            $existingLog = LogsModel::where('user_id', Auth::id())
                ->where('activity', 'download_soal')
                ->where('description', 'Siswa mengunduh soal: ' . $soal->title)
                ->where('created_at', '>=', now()->subSeconds(3)) // Cek dalam 3 detik terakhir
                ->exists();
    
            if (!$existingLog) {
                LogsModel::create([ 
                    'user_id' => Auth::id(),
                    'activity' => 'download_soal',
                    'description' => 'Siswa mengunduh soal: ' . $soal->title,
                ]);
            }
        }

        return response()->download(storage_path('app/' . $filePath), $soal->original_filename);
    }

    public function edit($soal_id)
    {
        $soal = SoalModel::findOrFail($soal_id);
        return view('soal.edit', compact('soal'));
    }

    public function update(Request $request, $soal_id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $soal = SoalModel::findOrFail($soal_id);
        $soal->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if (Auth::check()) {
            LogsModel::create([
                'user_id' => Auth::id(),
                'activity' => 'update_soal',
                'description' => 'Memperbarui soal: ' . $request->title,
            ]);
        }

        return redirect()->route('soal.index')->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy($soal_id)
    {
        $soal = SoalModel::findOrFail($soal_id);

        // Hapus file jika ada
        if (Storage::exists('public/soal_files/' . $soal->file_path)) {
            Storage::delete('public/soal_files/' . $soal->file_path);
        }

        $soal->delete();

        if (Auth::check()) {
            LogsModel::create([
                'user_id' => Auth::id(),
                'activity' => 'delete_soal',
                'description' => 'Menghapus soal: ' . $soal->title,
            ]);
        }

        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus.');
    }
}
