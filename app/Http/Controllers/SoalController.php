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
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|file|max:2048',
        ]);

        $file = $request->file('file');
        $filename = time() . '_' . $file->getClientOriginalName();

        // Simpan ke `storage/app/public/soal_files/` agar bisa diakses melalui symlink
        $file->storeAs('public/soal_files', $filename);

        SoalModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filename,
            'original_filename' => $file->getClientOriginalName(),
            'created_by' => Auth::id(),
        ]);

        LogsModel::create([
            'user_id' => Auth::id(),
            'activity' => 'create_soal',
            'description' => 'Menambahkan soal : ' . $request->title,
        ]);

        return redirect()->back()->with('success', 'Soal berhasil diunggah!');
    }


        public function download($id)
    {
        $soal = SoalModel::findOrFail($id); // Cari soal berdasarkan ID
        $filePath = 'soal_files/' . $soal->file_path; // Sesuaikan dengan penyimpanan file

        if (!Storage::exists($filePath)) {
            abort(404, 'File tidak ditemukan.');
        }

        return Storage::download($filePath, $soal->original_filename);
    }

    public function edit($id)
    {
        $soal = SoalModel::findOrFail($id);
        return view('soal.edit', compact('soal'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $soal = SoalModel::findOrFail($id);
        $soal->title = $request->title;
        $soal->description = $request->description;
        $soal->save();

        LogsModel::create([
            'user_id' => Auth::id(),
            'activity' => 'update_soal',
            'description' => 'Memperbarui soal : ' . $request->title,
        ]);
        
        return redirect()->route('soal.index')->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $soal = SoalModel::findOrFail($id);

        // Hapus file dari storage
        Storage::delete('soal_files/' . $soal->file_path);

        // Hapus dari database
        $soal->delete();

        LogsModel::create([
            'user_id' => Auth::id(),
            'activity' => 'delete_soal',
            'description' => 'Menghapus soal : ' . $soal->title,
        ]);

        return redirect()->route('soal.index')->with('success', 'Soal berhasil dihapus.');
    }
}
