<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel users (siapa yang absen)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->date('tanggal'); // Tanggal hari ini
            $table->time('jam_masuk')->nullable(); // Jam ketika klik tombol masuk
            $table->time('jam_pulang')->nullable(); // Jam ketika klik tombol pulang
            
            // Keterangan status kehadiran
            $table->enum('status', ['Hadir', 'Izin', 'Sakit', 'Alfa'])->default('Hadir');
            
            // Opsional: Jika dosen minta alasan jika izin/sakit
            $table->text('keterangan')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};