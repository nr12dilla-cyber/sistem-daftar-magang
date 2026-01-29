<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Portal Magang Binjai Smart City
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN DEPAN (Gunakan Redirect jika sudah login) ---
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// --- 2. AREA PENDAFTAR (PUBLIC) ---
Route::get('/daftar', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])->name('pendaftaran.store');

// --- 3. AREA ADMIN (PROTECTED) ---
// Middleware 'auth' memastikan admin harus login dulu
Route::middleware(['auth', 'verified'])->group(function () {
    
    // DASHBOARD: Statistik & Grafik
    Route::get('/dashboard', [PendaftaranController::class, 'adminDashboard'])->name('dashboard');

    // MANAJEMEN PENDAFTAR
    Route::prefix('dashboard/pendaftar')->group(function () {
        Route::get('/', [PendaftaranController::class, 'dataPendaftar'])->name('admin.pendaftar');
        Route::get('/cetak', [PendaftaranController::class, 'cetak_pdf'])->name('pendaftaran.cetak');
        
        // Aksi: Update Status & Hapus
        Route::patch('/status/{id}/{status}', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
        Route::delete('/hapus/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    });

    // MANAJEMEN ADMIN (Internal Diskominfo)
    Route::prefix('dashboard/admin')->group(function () {
        Route::get('/kelola', [PendaftaranController::class, 'adminManage'])->name('admin.manage');
        Route::get('/tambah', [PendaftaranController::class, 'formTambahAdmin'])->name('admin.register');
        Route::post('/simpan', [PendaftaranController::class, 'simpanAdmin'])->name('admin.register.store');
        Route::delete('/hapus/{id}', [PendaftaranController::class, 'hapusAdmin'])->name('admin.destroy');
    });

    // PROFILE SETTINGS
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';