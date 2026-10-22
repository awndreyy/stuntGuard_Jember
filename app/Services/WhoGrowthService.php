<?php

namespace App\Services;

use RuntimeException;

class WhoGrowthService
{
    private array $tables = [];

    private function table(string $indicator): array
    {
        if (!in_array($indicator, ['wfa', 'lfa', 'hfa', 'wfl', 'wfh', 'hcfa', 'acfa'], true)) {
            throw new RuntimeException('Indikator WHO tidak dikenal.');
        }
        if (isset($this->tables[$indicator])) {
            return $this->tables[$indicator];
        }
        $path = storage_path("app/who/{$indicator}.csv");
        if (!is_readable($path)) {
            throw new RuntimeException("Data WHO {$indicator} belum tersedia.");
        }
        $handle = fopen($path, 'r');
        if ($handle === false) {
            throw new RuntimeException('Gagal membuka data WHO.');
        }
        try {
            $header = fgetcsv($handle);
            if ($header !== ['sex', 'key', 'L', 'M', 'S']) {
                throw new RuntimeException('Format CSV WHO tidak sesuai.');
            }
            $table = ['L' => [], 'P' => []];
            while (($row = fgetcsv($handle)) !== false) {
                if (count($row) !== 5 || !in_array($row[0], ['L', 'P'], true)) {
                    throw new RuntimeException('Baris CSV WHO rusak.');
                }
                foreach (array_slice($row, 1) as $number) {
                    if (!is_numeric($number)) {
                        throw new RuntimeException('Parameter WHO bukan angka.');
                    }
                }
                $key = (float) $row[1];
                $params = array_map('floatval', array_slice($row, 2));
                if ($params[1] <= 0 || $params[2] <= 0) {
                    throw new RuntimeException('Parameter LMS tidak valid.');
                }
                $table[$row[0]][(string) $key] = $params;
            }
            foreach ($table as &$series) {
                ksort($series, SORT_NUMERIC);
            }
            unset($series);
            return $this->tables[$indicator] = $table;
        } finally {
            fclose($handle);
        }
    }

    public function zScore(string $indicator, string $sex, float $key, float $value): ?float
    {
        if ($value <= 0 || !in_array($sex, ['L', 'P'], true)) {
            throw new RuntimeException('Pengukuran atau jenis kelamin tidak valid.');
        }
        $series = $this->table($indicator)[$sex];
        if (!$series) {
            return null;
        }
        $keys = array_map('floatval', array_keys($series));
        if ($key < $keys[0] || $key > end($keys)) {
            return null; // Jangan ekstrapolasi di luar rentang tabel WHO.
        }
        $first = null;
        $second = null;
        foreach ($series as $coordinate => $lms) {
            $position = (float) $coordinate;
            if (abs($position - $key) < 0.000001) {
                return $this->calculateLms($value, ...$lms);
            }
            if ($position < $key) {
                $first = [$position, $lms];
            } elseif ($position > $key) {
                $second = [$position, $lms];
                break;
            }
        }
        if ($first === null || $second === null) {
            return null;
        }
        $ratio = ($key - $first[0]) / ($second[0] - $first[0]);
        $params = [];
        for ($i = 0; $i < 3; $i++) {
            $params[] = $first[1][$i] + $ratio * ($second[1][$i] - $first[1][$i]);
        }
        return $this->calculateLms($value, ...$params);
    }

    private function calculateLms(float $x, float $l, float $m, float $s): float
    {
        $raw = fn(float $v): float => abs($l) < 1e-10
            ? log($v / $m) / $s
            : (pow($v / $m, $l) - 1) / ($l * $s);
        $z = $raw($x);
        // WHO: gunakan simpangan baku pada titik +3/-3 untuk hasil ekstrem.
        if ($z > 3) {
            $p3 = abs($l) < 1e-10 ? $m * exp(3 * $s) : $m * pow(1 + 3 * $l * $s, 1 / $l);
            $p2 = abs($l) < 1e-10 ? $m * exp(2 * $s) : $m * pow(1 + 2 * $l * $s, 1 / $l);
            return 3 + ($x - $p3) / ($p3 - $p2);
        }
        if ($z < -3) {
            $n3 = abs($l) < 1e-10 ? $m * exp(-3 * $s) : $m * pow(1 - 3 * $l * $s, 1 / $l);
            $n2 = abs($l) < 1e-10 ? $m * exp(-2 * $s) : $m * pow(1 - 2 * $l * $s, 1 / $l);
            return -3 + ($x - $n3) / ($n2 - $n3);
        }
        return $z;
    }

    public function lilaScreening(?float $cm, int $age): ?string
    {
        if ($cm === null) return null;
        if ($age < 6) return 'Pengukuran dicatat; penilaian bayi <6 bulan memerlukan usia lebih rinci dan pemeriksaan klinis.';
        if ($age > 59) return 'Ambang skrining LiLA 6–59 bulan tidak berlaku pada usia 60 bulan.';
        if ($cm < 11.5) return 'LiLA <11,5 cm: indikasi gizi buruk akut; perlu pemeriksaan segera.';
        if ($cm < 12.5) return 'LiLA 11,5–<12,5 cm: indikasi gizi kurang akut; perlu pemeriksaan.';
        return 'LiLA ≥12,5 cm: tidak memenuhi ambang skrining LiLA gizi akut.';
    }
}
