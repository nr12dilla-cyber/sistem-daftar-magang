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
        // Ubah dari 'pendaftarans' menjadi 'pendaftars'
        Schema::table('pendaftars', function (Blueprint $table) {
            // Menambahkan kolom 'surat' bertipe string untuk menyimpan nama file PDF
            $table->string('surat')->after('foto')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Ubah dari 'pendaftarans' menjadi 'pendaftars'
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->dropColumn('surat');
        });
    }
};