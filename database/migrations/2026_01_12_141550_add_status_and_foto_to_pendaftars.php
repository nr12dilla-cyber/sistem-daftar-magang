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
        Schema::table('pendaftars', function (Blueprint $table) {
            // Cek dulu apakah kolom status sudah ada, jika belum baru buat
            if (!Schema::hasColumn('pendaftars', 'status')) {
                $table->string('status')->default('Pending')->after('asal_sekolah');
            }

            // Cek dulu apakah kolom foto sudah ada, jika belum baru buat
            if (!Schema::hasColumn('pendaftars', 'foto')) {
                $table->string('foto')->nullable()->after('status');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftars', function (Blueprint $table) {
            $table->dropColumn(['status', 'foto']);
        });
    }
};