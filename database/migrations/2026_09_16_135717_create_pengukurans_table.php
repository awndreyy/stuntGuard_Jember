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
        $table->string('nik');
        $table->string('jenis_kelamin');
        $table->float('berat_badan');
        $table->float('tinggi_badan');
        $table->integer('umur_bulan');
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
