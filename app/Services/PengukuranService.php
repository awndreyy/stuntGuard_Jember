<?php

namespace App\Services;

use App\Models\Balita;
use App\Models\Pengukuran;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;

/**
 * Satu sumber perhitungan antropometri dan pencatatan pengukuran.
 * WhoGrowthService tetap bertanggung jawab atas tabel LMS WHO.
 */
class PengukuranService
{
    public function __construct(private readonly WhoGrowthService $who) {}

    /**
     * Hitung tanpa menyimpan (untuk simulasi balita yang belum terdaftar).
     *
     * @return array<string, mixed>
     */
    public function calculate(
        string $nama,
        string $sex,
        int $age,
        float $weight,
        float $height,
        string $position,
        ?float $head = null,
        ?float $arm = null,
    ): array {
        $isLength = $age < 24;
        $corrected = $height;

        // Standar WHO: PB berbaring untuk <24 bulan, TB berdiri untuk >=24 bulan.
        if ($isLength && $position === 'berdiri') {
            $corrected += 0.7;
        } elseif (! $isLength && $position === 'terlentang') {
            $corrected -= 0.7;
        }

        $lengthIndicator = $isLength ? 'lfa' : 'hfa';
        $weightLengthIndicator = $isLength ? 'wfl' : 'wfh';

        $zHeight = $this->who->zScore($lengthIndicator, $sex, $age, $corrected);
        $zWfa = $this->who->zScore('wfa', $sex, $age, $weight);
        $zWfh = $this->who->zScore($weightLengthIndicator, $sex, $corrected, $weight);
        $zHead = $head !== null ? $this->who->zScore('hcfa', $sex, $age, $head) : null;
        $zArm = $arm !== null && $age >= 3
            ? $this->who->zScore('acfa', $sex, $age, $arm)
            : null;

        $status = match (true) {
            $zHeight === null => 'Tidak dapat dihitung: data di luar rentang referensi',
            $zHeight < -3 => 'Sangat Pendek',
            $zHeight < -2 => 'Pendek (Stunted)',
            $zHeight <= 3 => 'Normal',
            default => 'Tinggi',
        };

        return [
            'nama' => $nama,
            'jenis_kelamin' => $sex === 'L' ? 'Laki-laki' : 'Perempuan',
            'usia_bulan' => $age,
            'berat' => $weight,
            'tinggi' => $height,
            'tinggi_koreksi' => round($corrected, 2),
            'posisi_badan' => $position,
            'lingkar_kepala' => $head,
            'lila' => $arm,
            'z_score' => $this->roundedZScore($zHeight),
            'status_stunting' => $status,
            'badge_color' => $zHeight === null || $zHeight < -3
                ? 'rose'
                : ($zHeight < -2 ? 'amber' : ($zHeight <= 3 ? 'emerald' : 'teal')),
            'indikator_tinggi' => $isLength ? 'PB/U' : 'TB/U',
            'indikator_berat_tinggi' => $isLength ? 'BB/PB' : 'BB/TB',
            'z_bbu' => $this->roundedZScore($zWfa),
            'z_bb_tb' => $this->roundedZScore($zWfh),
            'z_lku' => $this->roundedZScore($zHead),
            'z_lilau' => $this->roundedZScore($zArm),
            'skrining_lila' => $this->who->lilaScreening($arm, $age),
        ];
    }

    /**
     * Untuk balita terdaftar, identitas, jenis kelamin, dan usia SELALU berasal
     * dari data balita, bukan dari hidden input / input yang bisa diedit.
     *
     * @param  array<string, float|string|null>  $measurements
     * @return array<string, mixed>
     */
    public function calculateForBalita(
        Balita $balita,
        string $measurementDate,
        array $measurements,
        string $errorField = 'tanggal_pengukuran',
    ): array {
        $age = $this->ageInMonths($balita, $measurementDate, $errorField);

        $sex = match ($balita->jenis_kelamin) {
            'Laki-laki' => 'L',
            'Perempuan' => 'P',
            default => throw ValidationException::withMessages([
                'balita_id' => 'Jenis kelamin balita tidak valid pada database.',
            ]),
        };

        return $this->calculate(
            $balita->nama_balita,
            $sex,
            $age,
            (float) $measurements['berat'],
            (float) $measurements['tinggi'],
            (string) $measurements['posisi_badan'],
            isset($measurements['lingkar_kepala']) ? (float) $measurements['lingkar_kepala'] : null,
            isset($measurements['lila']) ? (float) $measurements['lila'] : null,
        );
    }

    /**
     * Hitung dan simpan melalui SATU jalur untuk kedua endpoint.
     *
     * @param  array<string, float|string|null>  $measurements
     * @return array{hasil: array<string, mixed>, pengukuran: Pengukuran}
     */
    public function recordForBalita(
        Balita $balita,
        string $measurementDate,
        array $measurements,
        string $errorField = 'tanggal_pengukuran',
    ): array {
        $hasil = $this->calculateForBalita($balita, $measurementDate, $measurements, $errorField);

        $pengukuran = Pengukuran::create([
            'balita_id' => $balita->id_balita,
            'tanggal_pengukuran' => $measurementDate,
            'berat_badan' => $hasil['berat'],
            'tinggi_badan' => $hasil['tinggi'],
            'umur_bulan' => $hasil['usia_bulan'],
            'lingkar_kepala' => $hasil['lingkar_kepala'],
            'lila' => $hasil['lila'],
            'z_score_bbu' => $hasil['z_bbu'],
            'z_score_tbu' => $hasil['z_score'],
            'z_score_bbtb' => $hasil['z_bb_tb'],
            'hasil' => $hasil,
        ]);

        return compact('hasil', 'pengukuran');
    }

    /**
     * Rebuild the available result for records created before result snapshots
     * were persisted.
     *
     * @return array<string, mixed>
     */
    public function historyResultForBalita(Balita $balita, Pengukuran $record): array
    {
        $age = (int) $record->umur_bulan;
        $sex = $balita->jenis_kelamin === 'Laki-laki' ? 'L' : 'P';
        $isLength = $age < 24;
        $heightScore = $record->z_score_tbu === null
            ? null
            : (float) $record->z_score_tbu;
        $weightAgeScore = $record->z_score_bbu === null
            ? null
            : (float) $record->z_score_bbu;
        $weightHeightScore = $record->z_score_bbtb === null
            ? null
            : (float) $record->z_score_bbtb;
        $head = $record->lingkar_kepala === null
            ? null
            : (float) $record->lingkar_kepala;
        $arm = $record->lila === null ? null : (float) $record->lila;

        $status = match (true) {
            $heightScore === null => 'Tidak dapat dihitung: data di luar rentang referensi',
            $heightScore < -3 => 'Sangat Pendek',
            $heightScore < -2 => 'Pendek (Stunted)',
            $heightScore <= 3 => 'Normal',
            default => 'Tinggi',
        };

        return [
            'nama' => $balita->nama_balita,
            'jenis_kelamin' => $balita->jenis_kelamin,
            'usia_bulan' => $age,
            'berat' => (float) $record->berat_badan,
            'tinggi' => (float) $record->tinggi_badan,
            'posisi_badan' => 'Tidak tersimpan',
            'z_score' => $this->roundedZScore($heightScore),
            'status_stunting' => $status,
            'indikator_tinggi' => $isLength ? 'PB/U' : 'TB/U',
            'indikator_berat_tinggi' => $isLength ? 'BB/PB' : 'BB/TB',
            'z_bbu' => $this->roundedZScore($weightAgeScore),
            'z_bb_tb' => $this->roundedZScore($weightHeightScore),
            'z_lku' => $head === null
                ? null
                : $this->roundedZScore($this->who->zScore('hcfa', $sex, $age, $head)),
            'z_lilau' => $arm === null || $age < 3
                ? null
                : $this->roundedZScore($this->who->zScore('acfa', $sex, $age, $arm)),
            'skrining_lila' => $this->who->lilaScreening($arm, $age),
            'catatan' => 'Sebagian detail posisi ukur tidak tersimpan pada catatan pengukuran lama.',
        ];
    }

    private function ageInMonths(Balita $balita, string $measurementDate, string $errorField): int
    {
        $birth = Carbon::parse($balita->tanggal_lahir)->startOfDay();
        $date = Carbon::parse($measurementDate)->startOfDay();

        if ($date->greaterThan(today())) {
            throw ValidationException::withMessages([
                $errorField => 'Tanggal pengukuran tidak boleh di masa depan.',
            ]);
        }

        if ($date->lessThan($birth)) {
            throw ValidationException::withMessages([
                $errorField => 'Pengukuran tidak boleh sebelum tanggal lahir.',
            ]);
        }

        // Bulan kalender penuh, konsisten untuk tanggal lahir di akhir bulan.
        $age = ($date->year - $birth->year) * 12 + ($date->month - $birth->month);
        if ($date->day < $birth->day) {
            $age--;
        }

        if ($age > 60) {
            throw ValidationException::withMessages([
                $errorField => 'Pengukuran WHO ini hanya untuk usia 0 sampai 60 bulan.',
            ]);
        }

        return $age;
    }

    private function roundedZScore(?float $score): ?float
    {
        return $score === null ? null : round($score, 2);
    }
}
