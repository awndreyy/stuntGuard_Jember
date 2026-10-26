<?php

namespace App\Http\Controllers;

use App\Services\PengukuranService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use RuntimeException;

class GuestKalkulatorController extends Controller
{
    public function calculate(Request $request, PengukuranService $measurements): JsonResponse
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
        try {
            $hasil = $measurements->calculate(
                $namaAnak !== '' ? $namaAnak : 'Anak Guest',
                $data['jenis_kelamin'],
                (int) $data['usia_bulan'],
                (float) $data['berat'],
                (float) $data['tinggi'],
                $data['posisi_badan'],
            );
        } catch (RuntimeException $e) {
            report($e);
            return response()->json(['message' => 'Referensi WHO belum dapat dibaca. Hubungi pengelola aplikasi.'], 503);
        }

        $statusTinggi = $hasil['status_stunting'];
        $bbu = $hasil['z_bbu'];
        $pbu = $hasil['z_score'];
        $bbpb = $hasil['z_bb_tb'];
        $statusBerat = match (true) {
            $bbu === null => 'Di luar rentang referensi WHO',
            $bbu < -3 => 'Berat badan sangat kurang',
            $bbu < -2 => 'Berat badan kurang',
            $bbu <= 1 => 'Berat badan normal',
            default => 'Risiko berat badan lebih',
        };
        $statusProporsi = match (true) {
            $bbpb === null => 'Di luar rentang referensi WHO',
            $bbpb < -3 => 'Gizi buruk',
            $bbpb < -2 => 'Gizi kurang',
            $bbpb <= 1 => 'Gizi baik',
            $bbpb <= 2 => 'Berisiko gizi lebih',
            $bbpb <= 3 => 'Gizi lebih',
            default => 'Obesitas',
        };

        return response()->json([
            'nama_anak' => $hasil['nama'],
            'jenis_kelamin' => $data['jenis_kelamin'],
            'jenis_kelamin_label' => $data['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan',
            'usia_bulan' => (int) $data['usia_bulan'],
            'berat' => (float) $data['berat'],
            'tinggi_input' => (float) $data['tinggi'],
            'posisi_badan' => $data['posisi_badan'],
            'posisi_badan_label' => $data['posisi_badan'] === 'terlentang' ? 'Terlentang' : 'Berdiri',
            'indikator_tinggi' => $hasil['indikator_tinggi'],
            'indikator_proporsi' => $hasil['indikator_berat_tinggi'],
            'panjang_tinggi_terkoreksi' => round($hasil['tinggi_koreksi'], 1),
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
