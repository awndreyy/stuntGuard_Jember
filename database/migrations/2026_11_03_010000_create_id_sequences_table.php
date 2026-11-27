<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('id_sequences', function (Blueprint $table): void {
            $table->string('scope', 30);
            $table->unsignedSmallInteger('year');
            $table->unsignedInteger('last_number')->default(0);
            $table->primary(['scope', 'year']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('id_sequences');
    }
};
