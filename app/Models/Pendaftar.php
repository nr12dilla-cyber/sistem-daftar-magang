<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftar extends Model
{
    use HasFactory;

    protected $table = 'pendaftars';

    protected $fillable = [
        'nama', 
        'email', 
        'nomor_wa',
        'alamat',
        'jenis_kelamin',
        'asal_sekolah', 
        'posisi', 
        'jumlah_anggota', 
        'foto', 
        'surat', 
        'status'
    ];

    /**
     * Casting kolom foto menjadi array.
     * Ini sangat penting agar Laravel otomatis mengubah JSON dari database
     * menjadi Array PHP saat data dipanggil.
     */
    protected $casts = [
        'foto' => 'array',
    ];
}