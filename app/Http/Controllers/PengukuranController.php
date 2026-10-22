<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Pengukuran;
use App\Services\WhoGrowthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class PengukuranController extends Controller
{
    public function store(Request $request, WhoGrowthService $who): JsonResponse
    {
        $data = $request->validate([
            'balita_id' => ['required', 'integer', 'exists:balitas,id_balita'],
            'tanggal_pengukuran' => ['required', 'date', 'before_or_equal:today'],
            'weight' => ['required', 'numeric', 'between:1,50'],
            'height' => ['required', 'numeric', 'between:20,150'],
            'posisi_badan' => ['required', 'in:terlentang,berdiri'],
            'lingkar_kepala' => ['nullable', 'numeric', 'between:20,70'],
            'lila' => ['nullable', 'numeric', 'between:5,40'],
        ]);

        $balita = Balita::findOrFail($data['balita_id']);
        $date = Carbon::parse($data['tanggal_pengukuran']);
        $birth = Carbon::parse($balita->tanggal_lahir);
        if ($date->lt($birth)) {
            throw ValidationException::withMessages(['tanggal_pengukuran' => 'Pengukuran tidak boleh sebelum tanggal lahir.']);
        }
        $age = (int) $birth->diffInMonths($date);
        if ($age > 60) {
            throw ValidationException::withMessages(['tanggal_pengukuran' => 'Usia maksimal pengukuran 60 bulan.']);
        }
        $sex = $balita->jenis_kelamin === 'Laki-laki' ? 'L' : 'P';
        $height = (float) $data['height'];
        $weight = (float) $data['weight'];
        $length = $age < 24;
        $corrected = $height + ($length && $data['posisi_badan'] === 'berdiri' ? 0.7 : 0)
            - (!$length && $data['posisi_badan'] === 'terlentang' ? 0.7 : 0);

        $zWfa = $who->zScore('wfa', $sex, $age, $weight);
        $zHeight = $who->zScore($length ? 'lfa' : 'hfa', $sex, $age, $corrected);
        $zWh = $who->zScore($length ? 'wfl' : 'wfh', $sex, $corrected, $weight);

        try {
            $pengukuran = Pengukuran::create([
                'balita_id' => $balita->id_balita,
                'tanggal_pengukuran' => $data['tanggal_pengukuran'],
                'nama_balita' => $balita->nama_balita,
                'nik' => $balita->nik,
                'jenis_kelamin' => $balita->jenis_kelamin,
                'berat_badan' => $weight,
                'tinggi_badan' => $height,
                'umur_bulan' => $age,
                'lingkar_kepala' => $data['lingkar_kepala'] ?? null,
                'lila' => $data['lila'] ?? null,
                'z_score_bbu' => $zWfa === null ? null : round($zWfa, 2),
                'z_score_tbu' => $zHeight === null ? null : round($zHeight, 2),
                'z_score_bbtb' => $zWh === null ? null : round($zWh, 2),
            ]);
        } catch (\Throwable $e) {
            Log::error('Gagal menyimpan pengukuran', ['exception' => $e]);
            return response()->json(['message' => 'Gagal menyimpan pengukuran.'], 500);
        }
        return response()->json(['message' => 'Pengukuran berhasil disimpan.', 'id' => $pengukuran->id], 201);
    }

    public function history(Balita $balita): JsonResponse
    {
        return response()->json($balita->pengukurans()
            ->orderByDesc('tanggal_pengukuran')->paginate(20));
    }
}
