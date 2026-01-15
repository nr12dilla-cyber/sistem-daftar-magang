<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Portal Magang Binjai Smart City
|--------------------------------------------------------------------------
*/

// --- 1. HALAMAN SELAMAT DATANG (Landing Page) ---
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// --- 2. AREA USER / PENDAFTAR ---
Route::get('/daftar', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::post('/cek-status', [PendaftaranController::class, 'cekStatus'])->name('pendaftaran.cekStatus');


// --- 3. AREA ADMIN (Wajib Login & Verifikasi) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // MENU 1: Dashboard (Statistik & Grafik)
    // Memanggil fungsi adminDashboard()
    Route::get('/dashboard', [PendaftaranController::class, 'adminDashboard'])->name('dashboard');

    // MENU 2: Data Pendaftar (Tabel Manajemen Lengkap)
    // Memanggil fungsi dataPendaftar() yang baru dibuat
    Route::get('/dashboard/pendaftar', [PendaftaranController::class, 'dataPendaftar'])->name('admin.pendaftar');

    // --- AKSI MANAJEMEN ---
    
    // Update Status: Menangani Terima & Tolak
    Route::patch('/pendaftaran/status/{id}/{status}', [PendaftaranController::class, 'updateStatus'])
        ->name('pendaftaran.updateStatus');

    // Hapus Data Pendaftar
    Route::delete('/pendaftaran/hapus/{id}', [PendaftaranController::class, 'destroy'])
        ->name('pendaftaran.destroy');

    // --- AREA PROFILE ADMIN ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';