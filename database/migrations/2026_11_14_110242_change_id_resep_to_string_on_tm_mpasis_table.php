<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tm_mpasis', function (Blueprint $table) {
            $table->string('id_resep', 24)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::table('tm_mpasis')
            ->whereRaw("id_resep NOT REGEXP '^[0-9]+$'")
            ->exists()) {
            throw new RuntimeException('Cannot revert id_resep to an integer while custom string IDs exist.');
        }

        Schema::table('tm_mpasis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_resep')->autoIncrement()->change();
        });
    }
};
