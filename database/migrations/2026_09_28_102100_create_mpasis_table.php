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
            $table->string('waktu_memasak', 30);
            $table->unsignedTinyInteger('porsi');
            $table->decimal('kalori', 4, 2)->default(0);
            $table->decimal('karbohidrat', 4, 2)->default(0);
            $table->decimal('lemak', 4, 2)->default(0);
            $table->decimal('protein', 4, 2)->default(0);
            $table->decimal('zat_besi', 4, 2)->default(0);
            $table->decimal('seng', 4, 2)->default(0);
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
