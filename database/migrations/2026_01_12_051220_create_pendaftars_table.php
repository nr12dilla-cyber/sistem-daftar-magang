<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendaftars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('asal_sekolah');
            $table->string('nomor_wa'); // Tambahan kolom untuk WhatsApp
            $table->string('posisi');
            $table->string('foto')->nullable(); // Tambahan untuk simpan nama file foto
            $table->string('surat')->nullable(); // Tambahan untuk simpan nama file PDF
            $table->enum('status', ['pending', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendaftars');
    }
};