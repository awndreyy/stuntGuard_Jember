<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengukurans', function (Blueprint $table): void {
            // Kolom lama float(2,1) tidak memuat BB >=10 kg dan PB/TB normal.
            $table->decimal('berat_badan', 5, 2)->change();
            $table->decimal('tinggi_badan', 5, 2)->change();

            // NIK balita boleh kosong pada tabel balitas.
            // Snapshot pengukuran harus mengizinkan kondisi yang sama.
            $table->char('nik', 16)->nullable()->change();
        });
    }

    public function down(): void
    {
        // Kolom versi lama tidak mampu menyimpan tinggi badan pada rentang
        // normal; jangan memperkecilnya bila riwayat sudah berisi data.
        if (DB::table('pengukurans')->exists()) {
            throw new RuntimeException(
                'Tidak dapat rollback migrasi pengukuran saat riwayat masih berisi data. Backup dan migrasikan data terlebih dahulu.'
            );
        }

        Schema::table('pengukurans', function (Blueprint $table): void {
            $table->float('berat_badan', 2, 1)->change();
            $table->float('tinggi_badan', 2, 1)->change();
            $table->char('nik', 16)->nullable(false)->change();
        });
    }
};
