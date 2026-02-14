<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendaftaranController;
// Bagian AbsensiController dihapus karena fungsinya ada di PendaftaranController
use Illuminate\Support\Facades\Route;

// --- 1. HALAMAN DEPAN ---
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// --- 2. AREA PENDAFTAR (PUBLIC) ---
Route::get('/daftar', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
Route::post('/daftar', [PendaftaranController::class, 'store'])->name('pendaftaran.store'); // Ubah dari /pendaftaran/store ke /daftar

// --- 3. AREA PROTECTED (ADMIN & MAHASISWA) ---
Route::middleware(['auth', 'verified'])->group(function () {
    
    // --- FITUR LOGOUT ---
    Route::post('/logout', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    // Dashboard Admin Utama
    Route::get('/dashboard', [PendaftaranController::class, 'adminDashboard'])->name('dashboard');

    // --- AREA MAHASISWA ---
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/dashboard', [PendaftaranController::class, 'showDashboardMahasiswa'])->name('dashboard.mahasiswa');
        Route::get('/laporan', [PendaftaranController::class, 'showLaporanMahasiswa'])->name('laporan.index');
        
        // Aksi CRUD Laporan
        Route::post('/laporan/simpan', [PendaftaranController::class, 'simpanLaporan'])->name('laporan.simpan');
        Route::put('/laporan/update/{id}', [PendaftaranController::class, 'updateLaporan'])->name('laporan.update');
        Route::delete('/laporan/hapus/{id}', [PendaftaranController::class, 'hapusLaporan'])->name('laporan.hapus');

        // --- PERBAIKAN: FITUR ABSENSI MAHASISWA (MENGARAH KE PendaftaranController) ---
        Route::get('/absen', [PendaftaranController::class, 'showAbsensiMahasiswa'])->name('absen.index');
        Route::post('/absen/masuk', [PendaftaranController::class, 'absenMasuk'])->name('absen.masuk');
        Route::post('/absen/pulang', [PendaftaranController::class, 'absenPulang'])->name('absen.pulang');
    });

    // --- AREA ADMIN (MANAJEMEN) ---
    Route::prefix('dashboard/admin')->group(function () {
        // Laporan Magang
        Route::get('/laporan-magang', [PendaftaranController::class, 'adminLaporan'])->name('admin.laporan');
        Route::patch('/laporan/status/{id}/{status}', [PendaftaranController::class, 'updateStatusLaporan'])->name('admin.laporan.status');

        // Kelola Admin
        Route::get('/kelola', [PendaftaranController::class, 'adminManage'])->name('admin.manage');
        Route::get('/tambah', [PendaftaranController::class, 'formTambahAdmin'])->name('admin.register');
        Route::post('/simpan', [PendaftaranController::class, 'simpanAdmin'])->name('admin.register.store');
        Route::delete('/hapus/{id}', [PendaftaranController::class, 'hapusAdmin'])->name('admin.destroy');

        // --- PERBAIKAN: MONITORING ABSENSI (MENGARAH KE PendaftaranController) ---
        Route::get('/monitoring-absen', [PendaftaranController::class, 'adminMonitoring'])->name('admin.absen.index');
    });

    // MANAJEMEN PENDAFTAR (Untuk Admin)
    Route::prefix('dashboard/pendaftar')->group(function () {
        Route::get('/', [PendaftaranController::class, 'dataPendaftar'])->name('admin.pendaftar');
        Route::get('/cetak', [PendaftaranController::class, 'cetak_pdf'])->name('pendaftaran.cetak');
        Route::patch('/status/{id}/{status}', [PendaftaranController::class, 'updateStatus'])->name('pendaftaran.updateStatus');
        Route::delete('/hapus/{id}', [PendaftaranController::class, 'destroy'])->name('pendaftaran.destroy');
    });

    // PROFILE SETTINGS
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
    });
});

require __DIR__.'/auth.php';