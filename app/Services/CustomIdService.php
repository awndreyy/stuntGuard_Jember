<?php

namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CustomIdService
{
    // Karakter tidak ambigu: tanpa 0, 1, I, dan O.
    private const CHARACTERS = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';

    /** Buat nomor urut per tahun dan per tabel; tidak bergantung pada MAX(id). */
    public function generate(string $scope, string $prefix, string $category): string
    {
        $now = Carbon::now('Asia/Jakarta');
        $year = (int) $now->format('Y');

        $number = DB::transaction(function () use ($scope, $year): int {
            DB::table('id_sequences')->insertOrIgnore([
                'scope' => $scope,
                'year' => $year,
                'last_number' => 0,
            ]);

            $sequence = DB::table('id_sequences')
                ->where('scope', $scope)
                ->where('year', $year)
                ->lockForUpdate()
                ->first();

            if ($sequence === null || $sequence->last_number >= 99999) {
                throw new RuntimeException('Nomor registrasi tahun ini sudah habis.');
            }

            $next = $sequence->last_number + 1;

            DB::table('id_sequences')
                ->where('scope', $scope)
                ->where('year', $year)
                ->update(['last_number' => $next]);

            return $next;
        }, 5);

        return sprintf('%s-%s%s-%05d-%s',
            $prefix,
            $now->format('y'),
            $category,
            $number,
            $this->randomCode(4)
        );
    }

    public function generatePengukuran(): string
    {
        return 'PGK-' . implode('-', str_split($this->randomCode(12), 4));
    }

    private function randomCode(int $length): string
    {
        $result = '';
        $lastIndex = strlen(self::CHARACTERS) - 1;

        for ($i = 0; $i < $length; $i++) {
            $result .= self::CHARACTERS[random_int(0, $lastIndex)];
        }

        return $result;
    }
}
