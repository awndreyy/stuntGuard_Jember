<?php

namespace App\Services;

class GrowthStatusService
{
    public static function height(?float $score, string $unavailable = 'Tidak dihitung'): string
    {
        return match (true) {
            $score === null => $unavailable,
            $score < -3 => 'Sangat Pendek',
            $score < -2 => 'Pendek (Stunted)',
            $score <= 3 => 'Normal',
            default => 'Tinggi',
        };
    }

    public static function weight(?float $score, string $unavailable = 'Tidak dihitung'): string
    {
        return match (true) {
            $score === null => $unavailable,
            $score < -3 => 'Berat badan sangat kurang',
            $score < -2 => 'Berat badan kurang',
            $score <= 1 => 'Berat badan normal',
            default => 'Risiko berat badan lebih',
        };
    }

    public static function proportion(?float $score, string $unavailable = 'Tidak dihitung'): string
    {
        return match (true) {
            $score === null => $unavailable,
            $score < -3 => 'Gizi buruk',
            $score < -2 => 'Gizi kurang',
            $score <= 1 => 'Gizi baik',
            $score <= 2 => 'Berisiko gizi lebih',
            $score <= 3 => 'Gizi lebih',
            default => 'Obesitas',
        };
    }

    public static function badge(?float $score): string
    {
        return match (true) {
            $score === null || $score < -3 => 'rose',
            $score < -2 => 'amber',
            $score <= 3 => 'emerald',
            default => 'teal',
        };
    }
}
