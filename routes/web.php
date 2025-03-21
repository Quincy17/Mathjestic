<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Models\SoalModel;
use Illuminate\Support\Facades\Auth;
use App\Models\LogsModel;
use App\Http\Controllers\Auth\LoginController;

// ✅ Bisa diakses tanpa login
Route::get('/home', [HomeController::class, 'index']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/soal', [SoalController::class, 'index'])->name('soal.index');

// 🔒 Hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    // ✅ Gunakan Route::resource tanpa perlu manual menulis create/store
    Route::middleware('admin')->group(function () {
        Route::resource('soal', SoalController::class)->except(['index', 'show']);
    });

    Route::get('/admin', [AdminController::class, 'index']);

    Route::get('/soal/download/{soal_id}', [SoalController::class, 'download'])->name('soal.download');

}); 

Route::get('/admin/logs', function () {
    $logs = LogsModel::latest()->get();
    return view('admin.logs', compact('logs'));
})->middleware('admin');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/logs', [AdminController::class, 'logs'])->name('admin.logs');
    Route::get('/admin/data-website', [AdminController::class, 'dataWebsite'])->name('admin.dataWebsite');
});

   

Auth::routes();
