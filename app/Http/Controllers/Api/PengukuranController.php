<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Balita;
use App\Models\Pengukuran;
use App\Services\PengukuranService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PengukuranController extends Controller
{
    /**
     * Menghitung status gizi balita menggunakan data anak milik orang tua yang sedang login.
     * Hasil kalkulasi TIDAK disimpan ke database.
     */
    public function hitung(Request $request, PengukuranService $measurements): JsonResponse
    {
        $request->validate([
            'balita_id' => ['required', 'string'],
            'tanggal_pengukuran' => ['nullable', 'date', 'before_or_equal:today'],
            'posisi_badan' => ['required', Rule::in(['terlentang', 'berdiri'])],
            'berat_badan' => ['required_without_all:berat,weight', 'nullable', 'numeric', 'between:1,50'],
            'berat' => ['required_without_all:berat_badan,weight', 'nullable', 'numeric', 'between:1,50'],
            'weight' => ['required_without_all:berat_badan,berat', 'nullable', 'numeric', 'between:1,50'],
            'tinggi_badan' => ['required_without_all:tinggi,height', 'nullable', 'numeric', 'between:20,150'],
            'tinggi' => ['required_without_all:tinggi_badan,height', 'nullable', 'numeric', 'between:20,150'],
            'height' => ['required_without_all:tinggi_badan,tinggi', 'nullable', 'numeric', 'between:20,150'],
            'lingkar_kepala' => ['nullable', 'numeric', 'between:20,70'],
            'lila' => ['nullable', 'numeric', 'between:5,40'],
        ], [
            'balita_id.required' => 'Silakan pilih balita Anda.',
            'posisi_badan.required' => 'Posisi badan (terlentang atau berdiri) wajib dipilih.',
            'posisi_badan.in' => 'Posisi badan harus terlentang atau berdiri.',
            'tanggal_pengukuran.before_or_equal' => 'Tanggal pengukuran tidak boleh di masa depan.',
        ]);

        // Verifikasi kepemilikan balita oleh orang tua yang sedang login
        $balita = $this->ownedBalita($request, (string) $request->input('balita_id'));

        $tanggal = (string) $request->input('tanggal_pengukuran', today()->toDateString());
        $berat = (float) $request->input('berat_badan', $request->input('berat', $request->input('weight')));
        $tinggi = (float) $request->input('tinggi_badan', $request->input('tinggi', $request->input('height')));

        // Perhitungan antropometri WHO menggunakan data anak dari DB (tgl lahir, JK)
        $hasil = $measurements->calculateForBalita($balita, $tanggal, [
            'berat' => $berat,
            'tinggi' => $tinggi,
            'posisi_badan' => (string) $request->input('posisi_badan'),
            'lingkar_kepala' => $request->filled('lingkar_kepala') ? (float) $request->input('lingkar_kepala') : null,
            'lila' => $request->filled('lila') ? (float) $request->input('lila') : null,
        ]);

        $bbu = $hasil['z_bbu'];
        $statusBerat = match (true) {
            $bbu === null => 'Di luar rentang referensi WHO',
            $bbu < -3 => 'Berat badan sangat kurang',
            $bbu < -2 => 'Berat badan kurang',
            $bbu <= 1 => 'Berat badan normal',
            default => 'Risiko berat badan lebih',
        };

        $bbpb = $hasil['z_bb_tb'];
        $statusProporsi = match (true) {
            $bbpb === null => 'Di luar rentang referensi WHO',
            $bbpb < -3 => 'Gizi buruk',
            $bbpb < -2 => 'Gizi kurang',
            $bbpb <= 1 => 'Gizi baik',
            $bbpb <= 2 => 'Berisiko gizi lebih',
            $bbpb <= 3 => 'Gizi lebih',
            default => 'Obesitas',
        };

        // Mengembalikan hasil kalkulasi langsung tanpa menyimpan ke database
        return response()->json([
            'message' => 'Status gizi balita berhasil dihitung.',
            'disimpan' => false,
            'balita' => [
                'id_balita' => $balita->id_balita,
                'nama_balita' => $balita->nama_balita,
                'nik' => $balita->nik,
                'tanggal_lahir' => $balita->tanggal_lahir,
                'jenis_kelamin' => $balita->jenis_kelamin,
                'usia_bulan' => $hasil['usia_bulan'],
            ],
            'pengukuran' => [
                'tanggal_pengukuran' => $tanggal,
                'berat_badan' => $berat,
                'tinggi_badan' => $tinggi,
                'posisi_badan' => $request->input('posisi_badan'),
                'lingkar_kepala' => $hasil['lingkar_kepala'],
                'lila' => $hasil['lila'],
            ],
            'hasil' => [
                'status_stunting' => $hasil['status_stunting'],
                'badge_color' => $hasil['badge_color'],
                'indikator_tinggi' => $hasil['indikator_tinggi'],
                'z_score_tbu' => $hasil['z_score'],
                'status_berat_badan' => $statusBerat,
                'z_score_bbu' => $bbu,
                'status_gizi' => $statusProporsi,
                'indikator_berat_tinggi' => $hasil['indikator_berat_tinggi'],
                'z_score_bbtb' => $bbpb,
                'z_score_lku' => $hasil['z_lku'],
                'z_score_lilau' => $hasil['z_lilau'],
                'skrining_lila' => $hasil['skrining_lila'],
                'tinggi_koreksi' => $hasil['tinggi_koreksi'],
            ],
        ]);
    }

    /**
     * Menampilkan riwayat pengukuran dari database (jika ada data terdahulu).
     */
    public function index(Request $request): JsonResponse
    {
        $balitaIds = $request->user()->balitas()->pluck('id_balita');

        $query = Pengukuran::with('balita')->whereIn('balita_id', $balitaIds);

        if ($request->filled('balita_id')) {
            $balitaId = (string) $request->input('balita_id');
            if (! $balitaIds->contains($balitaId)) {
                return response()->json([
                    'message' => 'Data balita tidak ditemukan atau bukan milik akun Anda.',
                ], 404);
            }
            $query->where('balita_id', $balitaId);
        }

        $perPage = (int) $request->input('per_page', 15);

        $pengukurans = $query->orderByDesc('tanggal_pengukuran')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString()
            ->through(fn (Pengukuran $pengukuran): array => $this->formatPengukuran($pengukuran));

        return response()->json($pengukurans);
    }

    /**
     * Menampilkan riwayat pengukuran balita spesifik (jika ada data terdahulu).
     */
    public function byBalita(Request $request, string $balitaId): JsonResponse
    {
        $balita = $this->ownedBalita($request, $balitaId);

        $perPage = (int) $request->input('per_page', 20);

        $pengukurans = $balita->pengukurans()
            ->orderByDesc('tanggal_pengukuran')
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString()
            ->through(fn (Pengukuran $pengukuran): array => $this->formatPengukuran($pengukuran));

        return response()->json([
            'balita' => [
                'id_balita' => $balita->id_balita,
                'nama_balita' => $balita->nama_balita,
                'nik' => $balita->nik,
                'tanggal_lahir' => $balita->tanggal_lahir,
                'jenis_kelamin' => $balita->jenis_kelamin,
            ],
            'pengukurans' => $pengukurans,
        ]);
    }

    /**
     * Menampilkan detail satu data pengukuran dari database.
     */
    public function show(Request $request, string $id): JsonResponse
    {
        $userBalitaIds = $request->user()->balitas()->pluck('id_balita');

        $pengukuran = Pengukuran::with('balita')
            ->whereIn('balita_id', $userBalitaIds)
            ->where('id', $id)
            ->first();

        if (! $pengukuran) {
            return response()->json([
                'message' => 'Data pengukuran tidak ditemukan atau bukan milik akun Anda.',
            ], 404);
        }

        return response()->json([
            'data' => $this->formatPengukuran($pengukuran),
        ]);
    }

    /**
     * Verifikasi bahwa balita memang milik akun orang tua yang login.
     */
    private function ownedBalita(Request $request, string $balitaId): Balita
    {
        $balita = $request->user()->balitas()->whereKey($balitaId)->first();

        if (! $balita) {
            throw ValidationException::withMessages([
                'balita_id' => 'Data balita tidak ditemukan pada akun Anda.',
            ]);
        }

        return $balita;
    }

    /**
     * Format data pengukuran database untuk mobile Flutter.
     *
     * @return array<string, mixed>
     */
    private function formatPengukuran(Pengukuran $pengukuran): array
    {
        $tbu = $pengukuran->z_score_tbu !== null ? (float) $pengukuran->z_score_tbu : null;
        $bbu = $pengukuran->z_score_bbu !== null ? (float) $pengukuran->z_score_bbu : null;
        $bbtb = $pengukuran->z_score_bbtb !== null ? (float) $pengukuran->z_score_bbtb : null;

        $statusStunting = match (true) {
            $tbu === null => 'Tidak dihitung',
            $tbu < -3 => 'Sangat Pendek',
            $tbu < -2 => 'Pendek (Stunted)',
            $tbu <= 3 => 'Normal',
            default => 'Tinggi',
        };

        $badgeColor = match (true) {
            $tbu === null || $tbu < -3 => 'rose',
            $tbu < -2 => 'amber',
            $tbu <= 3 => 'emerald',
            default => 'teal',
        };

        $statusBeratBadan = match (true) {
            $bbu === null => 'Tidak dihitung',
            $bbu < -3 => 'Berat badan sangat kurang',
            $bbu < -2 => 'Berat badan kurang',
            $bbu <= 1 => 'Berat badan normal',
            default => 'Risiko berat badan lebih',
        };

        $statusGizi = match (true) {
            $bbtb === null => 'Tidak dihitung',
            $bbtb < -3 => 'Gizi buruk',
            $bbtb < -2 => 'Gizi kurang',
            $bbtb <= 1 => 'Gizi baik',
            $bbtb <= 2 => 'Berisiko gizi lebih',
            $bbtb <= 3 => 'Gizi lebih',
            default => 'Obesitas',
        };

        return [
            'id' => $pengukuran->id,
            'balita_id' => $pengukuran->balita_id,
            'nama_balita' => $pengukuran->balita?->nama_balita,
            'tanggal_pengukuran' => $pengukuran->tanggal_pengukuran?->format('Y-m-d'),
            'berat_badan' => (float) $pengukuran->berat_badan,
            'tinggi_badan' => (float) $pengukuran->tinggi_badan,
            'umur_bulan' => (int) $pengukuran->umur_bulan,
            'lingkar_kepala' => $pengukuran->lingkar_kepala !== null ? (float) $pengukuran->lingkar_kepala : null,
            'lila' => $pengukuran->lila !== null ? (float) $pengukuran->lila : null,
            'z_score_bbu' => $bbu,
            'z_score_tbu' => $tbu,
            'z_score_bbtb' => $bbtb,
            'status_stunting' => $statusStunting,
            'status_berat_badan' => $statusBeratBadan,
            'status_gizi' => $statusGizi,
            'badge_color' => $badgeColor,
            'created_at' => $pengukuran->created_at?->toIso8601String(),
        ];
    }
}
