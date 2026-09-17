<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('pengukurans', function (Blueprint $table) {
    $table->id();
    $table->string('nama_balita', 100); // Maksimal 100 karakter
    $table->char('nik', 12)->unique();
    $table->string('jenis_kelamin', 15); // Maksimal 15 karakter (Cukup untuk "Laki-laki" / "Perempuan")
    $table->float('berat_badan', 2, 1);  // Contoh maksimal: 999.9
    $table->float('tinggi_badan', 2, 1); // Contoh maksimal: 999.9

    // 5. Membatasi Angka Bulat Kecil (Umur Bulan)
    $table->tinyInteger('umur_bulan'); // tinyInteger maksimal menampung angka 255

    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengukurans');
    }
};
