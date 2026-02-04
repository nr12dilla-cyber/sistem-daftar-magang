<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaporanHarian extends Model
{
    protected $table = 'laporan_harian';

    // Tetap false sesuai instruksi Anda
    public $timestamps = false; 

    protected $fillable = [
        'user_id',
        'tanggal',
        'kegiatan',
        // 'status_laporan', // Sudah tidak digunakan di tampilan, bisa dihapus atau tetap di sini jika masih ada di DB
        // 'komentar_admin'  // Sudah tidak digunakan di tampilan
    ];

    /**
     * Relasi ke model User.
     * Digunakan untuk mengambil nama mahasiswa dari tabel users.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}