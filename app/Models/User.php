<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'status_akun', // Tambahkan ini
        'role',        // Tambahkan ini
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
    public function laporans()
    {
        return $this->hasMany(LaporanHarian::class, 'user_id');
    }
}