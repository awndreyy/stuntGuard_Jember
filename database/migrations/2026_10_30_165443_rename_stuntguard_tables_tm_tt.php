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
        Schema::rename('users', 'tm_users');
        Schema::rename('balitas', 'tm_balitas');
        Schema::rename('pengukurans', 'tt_pengukurans');
        Schema::rename('mpasis', 'tm_mpasis');
        Schema::rename('informasis', 'tm_informasis');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('tm_informasis', 'informasis');
        Schema::rename('tm_mpasis', 'mpasis');
        Schema::rename('tt_pengukurans', 'pengukurans');
        Schema::rename('tm_balitas', 'balitas');
        Schema::rename('tm_users', 'users');
    }
};
