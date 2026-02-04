<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    protected $table = 'laporan_harian'; // Menunjuk nama tabel kita tadi

    protected $fillable = [
        'user_id',
        'tanggal',
        'kegiatan',
        'status_laporan',
        'komentar_admin'
    ];
}