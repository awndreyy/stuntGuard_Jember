<?php

namespace App\Http\Controllers;

use App\Services\WhoGrowthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class GuestKalkulatorController extends Controller
{
    public function calculate(Request $request, WhoGrowthService $who): JsonResponse
    {
        $data = $request->validate([
            'nama_anak' => ['nullable', 'string', 'max:100'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'usia_bulan' => ['required', 'integer', 'between:0,60'],
            'berat' => ['required', 'numeric', 'between:1,50'],
            'tinggi' => ['required', 'numeric', 'between:30,130'],
            'posisi_badan' => ['required', 'in:terlentang,berdiri'],
        ]);

        $namaAnak = trim((string) ($data['nama_anak'] ?? ''));
        $usia = (int) $data['usia_bulan'];
        $berat = round((float) $data['berat'], 1);
        $tinggiInput = round((float) $data['tinggi'], 1);
        $sex = $data['jenis_kelamin'];
        $panjang = $usia < 24;
        $tinggiTerkoreksi = $tinggiInput;

        if ($panjang && $data['posisi_badan'] === 'berdiri') {
            $tinggiTerkoreksi += 0.7;
        } elseif (! $panjang && $data['posisi_badan'] === 'terlentang') {
            $tinggiTerkoreksi -= 0.7;
        }

        try {
            $bbu = $who->zScore('wfa', $sex, $usia, $berat);
            $pbu = $who->zScore($panjang ? 'lfa' : 'hfa', $sex, $usia, $tinggiTerkoreksi);
            $bbpb = $who->zScore($panjang ? 'wfl' : 'wfh', $sex, $tinggiTerkoreksi, $berat);
        } catch (RuntimeException $e) {
            report($e);

            return response()->json([
                'message' => 'Referensi WHO belum dapat dibaca. Hubungi pengelola aplikasi.',
            ], 503);
        }

        $statusTinggi = match (true) {
            $pbu === null => 'Tidak tersedia / di luar rentang',
            $pbu < -3 => 'Sangat Pendek',
            $pbu < -2 => 'Pendek',
            $pbu <= 3 => 'Normal',
            default => 'Tinggi',
        };

        $statusBerat = match (true) {
            $bbu === null => 'Tidak tersedia / di luar rentang',
            $bbu < -3 => 'Berat badan sangat kurang',
            $bbu < -2 => 'Berat badan kurang',
            $bbu <= 1 => 'Berat badan normal',
            default => 'Risiko berat badan lebih',
        };

        $statusProporsi = match (true) {
            $bbpb === null => 'Tidak tersedia / di luar rentang',
            $bbpb < -3 => 'Gizi buruk',
            $bbpb < -2 => 'Gizi kurang',
            $bbpb <= 1 => 'Gizi baik',
            $bbpb <= 2 => 'Berisiko gizi lebih',
            $bbpb <= 3 => 'Gizi lebih',
            default => 'Obesitas',
        };

        return response()->json([
            'nama_anak' => $namaAnak !== '' ? $namaAnak : 'Anak Guest',
            'jenis_kelamin' => $sex,
            'jenis_kelamin_label' => $sex === 'L' ? 'Laki-laki' : 'Perempuan',
            'usia_bulan' => $usia,
            'berat' => $berat,
            'tinggi_input' => $tinggiInput,
            'posisi_badan' => $data['posisi_badan'],
            'posisi_badan_label' => $data['posisi_badan'] === 'terlentang' ? 'Terlentang' : 'Berdiri',
            'indikator_tinggi' => $panjang ? 'PB/U' : 'TB/U',
            'indikator_proporsi' => $panjang ? 'BB/PB' : 'BB/TB',
            'panjang_tinggi_terkoreksi' => round($tinggiTerkoreksi, 1),
            'bbu' => [
                'z_score' => $bbu === null ? null : round($bbu, 2),
                'status' => $statusBerat,
            ],
            'pbu' => [
                'z_score' => $pbu === null ? null : round($pbu, 2),
                'status' => $statusTinggi,
            ],
            'bbpb' => [
                'z_score' => $bbpb === null ? null : round($bbpb, 2),
                'status' => $statusProporsi,
            ],
            'lku' => [
                'z_score' => null,
                'status' => 'Tidak tersedia / di luar rentang',
            ],
            'lilau' => [
                'z_score' => null,
                'status' => 'Tidak tersedia / di luar rentang',
            ],
            'ringkasan' => $statusTinggi,
            'catatan' => 'Hasil merupakan skrining pertumbuhan, bukan diagnosis klinis. LiLA/U dan LK/U tidak digunakan sebagai diagnosis stunting.',
            'riwayat' => 'Hasil belum disimpan ke riwayat balita.',
        ]);
    }
}
