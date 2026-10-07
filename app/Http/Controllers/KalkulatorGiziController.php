<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KalkulatorGiziController extends Controller
{
    /**
     * Tampilkan halaman form kalkulator gizi.
     */
    public function index(): View
    {
        $balitas = Balita::with('orangTua')->orderBy('nama_balita', 'asc')->get();

        return view('admin.kalkulatorGizi', compact('balitas'));
    }

    /**
     * Hitung status gizi dan indikator stunting berdasarkan standar WHO.
     */
    public function calculate(Request $request): View
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:30'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'usia_bulan' => ['required', 'numeric', 'min:1', 'max:60'],
            'berat' => ['required', 'numeric', 'min:1', 'max:30'],
            'tinggi' => ['required', 'numeric', 'min:20', 'max:150'],
            'posisi_badan' => ['nullable', 'in:terlentang,berdiri'],
            'lingkar_kepala' => ['nullable', 'numeric', 'min:20', 'max:70'],
            'lila' => ['nullable', 'numeric', 'min:5', 'max:40'],
        ], [
            'nama.required' => 'Nama lengkap wajib diisi',
            'nama.max' => 'Nama maksimal 30 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'usia_bulan.required' => 'Usia wajib diisi',
            'usia_bulan.max' => 'Usia maksimal 60 bulan',
            'berat.required' => 'Berat badan wajib diisi',
            'berat.max' => 'Berat badan maksimal 30 kg',
            'tinggi.required' => 'Tinggi badan wajib diisi',
            'tinggi.max' => 'Tinggi badan maksimal 150 cm',
            'usia_bulan.min' => 'Usia minimal 1 bulan',
            'berat.min' => 'Berat badan minimal 1 kg',
            'tinggi.min' => 'Tinggi badan minimal 20 cm',
            'lingkar_kepala.min' => 'Lingkar kepala minimal 20 cm',
            'lingkar_kepala.max' => 'Lingkar kepala maksimal 70 cm',
            'lila.min' => 'LiLA minimal 5 cm',
            'lila.max' => 'LiLA maksimal 40 cm',
        ]);

        $usia = (int) $validated['usia_bulan'];
        $tinggi = (float) $validated['tinggi'];
        $berat = (float) $validated['berat'];
        $jk = $validated['jenis_kelamin'];

        // Standar Median dan SD WHO Panjang/Tinggi Badan menurut Umur (TB/U) 0-60 Bulan
        [$median, $sd] = $this->getWhoTbuStandard($jk, $usia);

        $zScore = ($tinggi - $median) / ($sd > 0 ? $sd : 1);

        if ($zScore < -3) {
            $statusStunting = 'Sangat Pendek (Severely Stunted)';
            $badgeColor = 'rose';
        } elseif ($zScore < -2) {
            $statusStunting = 'Pendek (Stunted)';
            $badgeColor = 'amber';
        } elseif ($zScore <= 3) {
            $statusStunting = 'Normal';
            $badgeColor = 'emerald';
        } else {
            $statusStunting = 'Tinggi';
            $badgeColor = 'teal';
        }

        $hasil = [
            'nama' => $validated['nama'],
            'jenis_kelamin' => $jk === 'L' ? 'Laki-laki' : 'Perempuan',
            'usia_bulan' => $usia,
            'berat' => $berat,
            'tinggi' => $tinggi,
            'posisi_badan' => $request->input('posisi_badan', 'terlentang'),
            'lingkar_kepala' => $request->filled('lingkar_kepala') ? (float) $request->lingkar_kepala : null,
            'lila' => $request->filled('lila') ? (float) $request->lila : null,
            'z_score' => round($zScore, 2),
            'status_stunting' => $statusStunting,
            'badge_color' => $badgeColor,
        ];

        $balitas = Balita::with('orangTua')->orderBy('nama_balita', 'asc')->get();

        return view('admin.kalkulatorGizi', compact('hasil', 'balitas'));
    }

    /**
     * Mendapatkan median dan standar deviasi WHO (TB/U) berdasarkan gender dan usia (bulan).
     *
     * @return array{0: float, 1: float}
     */
    private function getWhoTbuStandard(string $jk, int $usia): array
    {
        // WHO Child Growth Standards (Median & Approx SD per bulan 0-60)
        // Data acuan WHO TB/U (Length/Height for Age)
        $standardsLaki = [
            0 => [49.9, 1.89], 1 => [54.7, 1.94], 2 => [58.4, 2.00], 3 => [61.4, 2.07],
            4 => [63.9, 2.14], 5 => [65.9, 2.21], 6 => [67.6, 2.27], 7 => [69.2, 2.34],
            8 => [70.6, 2.40], 9 => [72.0, 2.46], 10 => [73.3, 2.52], 11 => [74.5, 2.58],
            12 => [75.7, 2.64], 13 => [76.9, 2.70], 14 => [78.0, 2.76], 15 => [79.1, 2.82],
            16 => [80.2, 2.88], 17 => [81.2, 2.94], 18 => [82.3, 3.00], 19 => [83.2, 3.06],
            20 => [84.2, 3.12], 21 => [85.1, 3.18], 22 => [86.0, 3.24], 23 => [86.9, 3.30],
            24 => [87.8, 3.36], 25 => [88.6, 3.42], 26 => [89.4, 3.48], 27 => [90.2, 3.53],
            28 => [90.9, 3.59], 29 => [91.7, 3.65], 30 => [92.4, 3.70], 31 => [93.1, 3.76],
            32 => [93.8, 3.82], 33 => [94.5, 3.87], 34 => [95.2, 3.93], 35 => [95.8, 3.98],
            36 => [96.5, 4.04], 37 => [97.1, 4.09], 38 => [97.7, 4.14], 39 => [98.3, 4.20],
            40 => [98.9, 4.25], 41 => [99.5, 4.30], 42 => [100.1, 4.35], 43 => [100.7, 4.40],
            44 => [101.2, 4.45], 45 => [101.8, 4.50], 46 => [102.3, 4.55], 47 => [102.8, 4.60],
            48 => [103.3, 4.65], 49 => [103.8, 4.70], 50 => [104.3, 4.75], 51 => [104.8, 4.80],
            52 => [105.3, 4.84], 53 => [105.8, 4.89], 54 => [106.3, 4.94], 55 => [106.7, 4.98],
            56 => [107.2, 5.03], 57 => [107.7, 5.07], 58 => [108.1, 5.12], 59 => [108.6, 5.16],
            60 => [109.0, 5.21],
        ];

        $standardsPerempuan = [
            0 => [49.1, 1.86], 1 => [53.7, 1.91], 2 => [57.1, 1.98], 3 => [59.8, 2.05],
            4 => [62.1, 2.12], 5 => [64.0, 2.19], 6 => [65.7, 2.26], 7 => [67.3, 2.33],
            8 => [68.7, 2.40], 9 => [70.1, 2.46], 10 => [71.5, 2.53], 11 => [72.8, 2.59],
            12 => [74.0, 2.66], 13 => [75.2, 2.72], 14 => [76.4, 2.78], 15 => [77.5, 2.85],
            16 => [78.6, 2.91], 17 => [79.7, 2.97], 18 => [80.7, 3.03], 19 => [81.7, 3.09],
            20 => [82.7, 3.16], 21 => [83.7, 3.22], 22 => [84.6, 3.28], 23 => [85.5, 3.34],
            24 => [86.4, 3.40], 25 => [87.2, 3.46], 26 => [88.0, 3.52], 27 => [88.8, 3.58],
            28 => [89.6, 3.64], 29 => [90.3, 3.70], 30 => [91.1, 3.76], 31 => [91.8, 3.82],
            32 => [92.5, 3.87], 33 => [93.2, 3.93], 34 => [93.9, 3.99], 35 => [94.5, 4.04],
            36 => [95.1, 4.10], 37 => [95.7, 4.15], 38 => [96.4, 4.21], 39 => [97.0, 4.26],
            40 => [97.6, 4.32], 41 => [98.1, 4.37], 42 => [98.7, 4.42], 43 => [99.3, 4.48],
            44 => [99.8, 4.53], 45 => [100.3, 4.58], 46 => [100.9, 4.63], 47 => [101.4, 4.68],
            48 => [101.9, 4.73], 49 => [102.4, 4.78], 50 => [102.9, 4.83], 51 => [103.4, 4.88],
            52 => [103.9, 4.93], 53 => [104.4, 4.97], 54 => [104.9, 5.02], 55 => [105.3, 5.07],
            56 => [105.8, 5.12], 57 => [106.3, 5.16], 58 => [106.7, 5.21], 59 => [107.2, 5.25],
            60 => [107.6, 5.30],
        ];

        $standards = $jk === 'L' ? $standardsLaki : $standardsPerempuan;
        $clampedUsia = max(0, min(60, $usia));

        return $standards[$clampedUsia] ?? [50.0, 2.0];
    }
}
