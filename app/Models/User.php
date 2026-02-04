<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne; // Tambahkan ini
use Illuminate\Database\Eloquent\Relations\HasMany; // Tambahkan ini

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang boleh diisi (Mass Assignable)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status_akun', 
        'role',        
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi: Satu User punya banyak Laporan
     */
    public function laporans(): HasMany
    {
        return $this->hasMany(LaporanHarian::class, 'user_id');
    }

    /**
     * TAMBAHAN: Relasi ke Model Pendaftar
     * Diperlukan agar Admin bisa menghubungi WA mahasiswa melalui tombol di Laporan
     */
    public function pendaftar(): HasOne
    {
        // Menghubungkan User dengan Pendaftar berdasarkan kesamaan Email
        return $this->hasOne(Pendaftar::class, 'email', 'email');
    }
}