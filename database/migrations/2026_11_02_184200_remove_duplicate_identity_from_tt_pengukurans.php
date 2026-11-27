
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pastikan semua riwayat masih terhubung ke balita.
        $orphanCount = DB::table('tt_pengukurans as p')
            ->leftJoin(
                'tm_balitas as b',
                'p.balita_id',
                '=',
                'b.id_balita'
            )
            ->whereNull('b.id_balita')
            ->count();

        if ($orphanCount > 0) {
            throw new RuntimeException(
                "Normalisasi dibatalkan: {$orphanCount} riwayat pengukuran tidak terhubung ke balita."
            );
        }

        Schema::table('tt_pengukurans', function (Blueprint $table) {
            $table->dropColumn([
                'nama_balita',
                'nik',
                'jenis_kelamin',
            ]);
        });
    }

    public function down(): void
    {
        // Hanya mengembalikan struktur kolom,
        // bukan data identitas yang sebelumnya dihapus.
        Schema::table('tt_pengukurans', function (Blueprint $table) {
            $table->string('nama_balita', 100)->nullable();
            $table->char('nik', 16)->nullable();
            $table->string('jenis_kelamin', 15)->nullable();
        });
    }
};
