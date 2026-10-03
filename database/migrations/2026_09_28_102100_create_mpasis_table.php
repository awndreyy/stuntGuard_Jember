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
        Schema::create('mpasis', function (Blueprint $table) {
            $table->id('id_resep');
            $table->string('nama_resep', 50)->unique();
            $table->enum('kategori_usia', ['6-8', '9-11', '12-23']);
            $table->unsignedSmallInteger('waktu_memasak');
            $table->unsignedTinyInteger('porsi');
            $table->unsignedSmallInteger('kalori')->default(0);
            $table->unsignedSmallInteger('karbohidrat')->default(0);
            $table->unsignedSmallInteger('lemak')->default(0);
            $table->unsignedSmallInteger('protein')->default(0);
            $table->unsignedSmallInteger('zat_besi')->default(0);
            $table->unsignedSmallInteger('seng')->default(0);
            $table->json('bahan');
            $table->json('cara_pembuatan');
            $table->string('gambar', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mpasis');
    }
};
