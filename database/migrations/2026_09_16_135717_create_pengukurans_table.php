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
        $table->string('nama_balita');
        $table->float('berat_badan'); // Indikator Berat Badan (BB)[cite: 3]
        $table->float('tinggi_badan'); // Indikator Panjang/Tinggi Badan (PB/TB)[cite: 3]
        $table->integer('umur_bulan'); // Indikator umur balita dalam bulan[cite: 3]
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
