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
            $table->string('name', 60)->change();
            $table->string('email', 100)->change();
        });
    
        Schema::table('tm_balitas', function (Blueprint $table) {
            $table->string('nama_balita', 60)->change();
        });
    
        Schema::table('tm_mpasis', function (Blueprint $table) {
            $table->string('nama_resep', 50)->change();
        });

        Schema::table('tm_informasis', function(Blueprint $table){
            $table->string('judul', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_users', function (Blueprint $table) {
            $table->string('name', 30)->change();
            $table->string('email', 30)->change();
        });

        Schema::table('tm_balitas', function(Blueprint $table){
            $table->string('nama_balita', 30)->change();
        });

        Schema::table('tm_mpasis', function(Blueprint $table){
            $table->string('nama_resep', 20)->change();
        });

        Schema::table('tm_informasis', function(Blueprint $table){
            $table->string('judul', 255)->change();
        });
    }
};
