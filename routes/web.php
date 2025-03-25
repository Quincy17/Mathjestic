<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Models\SoalModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\LogsModel;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LatihanSoalController;
use App\Http\Controllers\JawabanMuridController;

// ✅ Bisa diakses tanpa login
Route::get('/home', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

// 🔒 Hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/pages/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/pages/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/pages/update-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::middleware('admin')->group(function () {
    Route::resource('soal', SoalController::class)->except(['index', 'show']);
    });

    Route::get('/admin', [AdminController::class, 'index']);

    Route::get('/soal/download/{soal_id}', [SoalController::class, 'download'])->name('soal.download');

    //Blog
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('/blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    Route::resource('latihan_soal', LatihanSoalController::class);
    Route::get('/latihan-soal', [LatihanSoalController::class, 'index'])->name('latihan-soal.index');
    Route::get('/latihan-soal/create', [LatihanSoalController::class, 'create'])->name('latihan-soal.create');
    Route::post('/latihan-soal', [LatihanSoalController::class, 'store'])->name('latihan-soal.store');
    Route::get('/latihan-soal/{id}', [LatihanSoalController::class, 'show'])->name('latihan-soal.show');
    Route::get('/latihan-soal/{id}/edit', [LatihanSoalController::class, 'edit'])->name('latihan-soal.edit');
    Route::put('/latihan-soal/{id}', [LatihanSoalController::class, 'update'])->name('latihan-soal.update');
    Route::delete('/latihan-soal/{id}', [LatihanSoalController::class, 'destroy'])->name('latihan-soal.destroy');
    Route::get('/latihan-soal/{id}/kerjakan', [LatihanSoalController::class, 'kerjakan'])->name('latihan_soal.kerjakan');
    Route::post('/latihan-soal/{id}/submit', [LatihanSoalController::class, 'submitJawaban'])->name('latihan_soal.submit');
    Route::post('/latihan-soal/{id}/submit', [LatihanSoalController::class, 'submitJawaban'])
    ->name('latihan_soal.submit')
    ->middleware('auth');
    Route::get('/latihan-soal/{id}/submit', function ($id) {
        return view('latihan_soal.submit', ['latihanSoalId' => $id]);
    })->name('latihan_soal.submit');
    Route::post('/latihan-soal/{latihanSoal}/jawaban', [JawabanMuridController::class, 'store'])->name('jawaban_murid.store');

}); 

Route::get('/admin/logs', function () {
    $logs = LogsModel::latest()->get();
    return view('admin.logs', compact('logs'));
})->middleware('admin');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logs', [AdminController::class, 'logs'])->name('admin.logs');
    Route::get('/admin/data-website', [AdminController::class, 'dataWebsite'])->name('admin.dataWebsite');
    Route::get('/admin/arsip-jawaban', [JawabanMuridController::class, 'arsipJawaban'])->name('arsip.jawaban');
});


Auth::routes();
