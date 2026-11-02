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
        Schema::table('tm_balitas', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_balita_user')
                ->references('id')
                ->on('tm_users')
                ->restrictOnDelete();
        });
    
        Schema::table('tt_pengukurans', function (Blueprint $table) {
            $table->foreign('balita_id', 'fk_pengukuran_balita')
                ->references('id_balita')
                ->on('tm_balitas')
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tt_pengukurans', function (Blueprint $table) {
            $table->dropForeign('fk_pengukuran_balita');
        });
    
        Schema::table('tm_balitas', function (Blueprint $table) {
            $table->dropForeign('fk_balita_user');
        });
    }
};
