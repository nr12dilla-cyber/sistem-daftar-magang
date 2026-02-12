<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'absensis';

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'keterangan',
    ];

    /**
     * Relasi ke Model User
     * Satu absen dimiliki oleh satu User (Mahasiswa)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}