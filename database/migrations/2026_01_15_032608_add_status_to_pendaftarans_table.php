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
        // Nama tabel disesuaikan menjadi 'pendaftars' sesuai gambar migrate:status kamu
        Schema::table('pendaftars', function (Blueprint $table) {
            if (!Schema::hasColumn('pendaftars', 'status')) {
                $table->string('status')->default('Pending')->after('surat');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            if (Schema::hasColumn('pendaftars', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};