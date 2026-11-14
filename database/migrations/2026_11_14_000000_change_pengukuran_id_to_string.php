<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (in_array(Schema::getColumnType('tt_pengukurans', 'id'), ['string', 'varchar'], true)) {
            return;
        }

        Schema::table('tt_pengukurans', function (Blueprint $table): void {
            $table->string('id', 24)->change();
        });
    }

    public function down(): void
    {
        throw new RuntimeException(
            'Pengukuran yang sudah dibuat dapat memakai ID teks dan tidak aman dikonversi kembali ke integer.'
        );
    }
};
