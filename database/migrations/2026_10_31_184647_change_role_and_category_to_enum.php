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
        Schema::table('tm_users', function (Blueprint $table) {
            $table->enum('role', [
                'Admin',
                'Orang Tua'
            ])->default('Orang Tua')->change();
        });

        Schema::table('tm_informasis', function (Blueprint $table) {
            $table->enum('category', [
                'Trimester 1',
                'Trimester 2',
                'Trimester 3',
                'Edukasi Gizi',
                'Pencegahan Stunting'
            ])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_users', function (Blueprint $table) {
            $table->string('role', 15)
                ->default('Orang Tua')
                ->change();
        });
    
        Schema::table('tm_informasis', function (Blueprint $table) {
            $table->string('category', 255)->change();
        });
    }
};
