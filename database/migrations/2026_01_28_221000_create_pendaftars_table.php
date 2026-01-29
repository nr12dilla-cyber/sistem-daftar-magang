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
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('asal_sekolah');
            $table->string('nomor_wa');
            $table->string('posisi');
            
            // Kolom untuk mendukung fitur slot foto dinamis per anggota
            $table->integer('jumlah_anggota')->default(1);

            // Tipe TEXT agar bisa menampung banyak nama file foto dalam format JSON
            $table->text('foto')->nullable(); 

            // Kolom untuk menyimpan nama file PDF surat pengantar
            $table->string('surat')->nullable(); 

            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};