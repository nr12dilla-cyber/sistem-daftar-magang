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
        'asal_sekolah', 
        'posisi', 
        'foto', 
        'surat', 
        'status'
    ];
}