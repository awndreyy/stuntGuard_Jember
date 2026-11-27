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
        Schema::table('tm_mpasis', function(Blueprint $table){
            $table->decimal('kalori',6,2)->default(0)->change();
            $table->decimal('karbohidrat',5,2)->default(0)->change();
            $table->decimal('lemak',5,2)->default(0)->change();
            $table->decimal('protein',5,2)->default(0)->change();
            $table->decimal('zat_besi',5,2)->default(0)->change();
            $table->decimal('seng',5,2)->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tm_mpasis', function(Blueprint $table){
            $table->unsignedSmallInteger('kalori')->default(0)->change();
            $table->unsignedSmallInteger('karbohidrat')->default(0)->change();
            $table->unsignedSmallInteger('lemak')->default(0)->change();
            $table->unsignedSmallInteger('protein')->default(0)->change();
            $table->unsignedSmallInteger('zat_besi')->default(0)->change();
            $table->unsignedSmallInteger('seng')->default(0)->change();
        });
    }
};
