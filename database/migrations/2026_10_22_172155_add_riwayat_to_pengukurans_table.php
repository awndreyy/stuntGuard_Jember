<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengukurans', function (Blueprint $table) {
            $table->foreignId('balita_id')
                ->nullable()
                ->constrained('balitas', 'id_balita')
                ->nullOnDelete();

            $table->date('tanggal_pengukuran')
                ->nullable();

            $table->float('lingkar_kepala')->nullable();
            $table->float('lila')->nullable();

            $table->float('z_score_bbu')->nullable();
            $table->float('z_score_tbu')->nullable();
            $table->float('z_score_bbtb')->nullable();

            // NIK tidak boleh UNIQUE untuk riwayat
            // karena satu anak dapat diukur berkali-kali.
            $table->dropUnique('pengukurans_nik_unique');
        });
    }

    public function down(): void
    {
        Schema::table('pengukurans', function (Blueprint $table) {
            $table->dropForeign(['balita_id']);

            $table->dropColumn([
                'balita_id',
                'tanggal_pengukuran',
                'lingkar_kepala',
                'lila',
                'z_score_bbu',
                'z_score_tbu',
                'z_score_bbtb',
            ]);
        });
    }
};