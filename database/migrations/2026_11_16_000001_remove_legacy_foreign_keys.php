<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach ([
            ['tm_balitas', 'user_id', 'fk_balita_user'],
            ['tt_pengukurans', 'balita_id', 'fk_pengukuran_balita'],
        ] as [$tableName, $column, $canonical]) {
            if (Schema::getConnection()->getDriverName() === 'sqlite') {
                Schema::table($tableName, function (Blueprint $table) use ($column, $canonical): void {
                    $table->dropForeign([$column]);
                    $table->foreign($column, $canonical)
                        ->references($column === 'user_id' ? 'id' : 'id_balita')
                        ->on($column === 'user_id' ? 'tm_users' : 'tm_balitas')
                        ->restrictOnDelete();
                });
                continue;
            }

            $foreignKeys = Schema::getForeignKeys($tableName);
            $legacy = array_filter($foreignKeys, fn (array $key): bool => $key['columns'] === [$column] && $key['name'] !== $canonical);
            Schema::table($tableName, function (Blueprint $table) use ($legacy): void {
                foreach ($legacy as $key) {
                    $table->dropForeign($key['name']);
                }
            });
        }
    }

    public function down(): void
    {
        // Restore the previous schema; the RESTRICT constraints remain in place.
        Schema::table('tm_balitas', function (Blueprint $table): void {
            $table->foreign('user_id', 'balitas_user_id_foreign')->references('id')->on('tm_users')->cascadeOnDelete();
        });
        Schema::table('tt_pengukurans', function (Blueprint $table): void {
            $table->foreign('balita_id', 'pengukurans_balita_id_foreign')->references('id_balita')->on('tm_balitas')->nullOnDelete();
        });
    }
};
