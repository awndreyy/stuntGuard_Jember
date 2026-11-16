<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tt_pengukurans', function (Blueprint $table): void {
            $table->double('z_score_bbu')->nullable()->change();
            $table->double('z_score_tbu')->nullable()->change();
            $table->double('z_score_bbtb')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Deliberately retain precision: narrowing these columns can change classifications.
    }
};
