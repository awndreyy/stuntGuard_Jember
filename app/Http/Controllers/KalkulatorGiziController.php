<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Services\WhoGrowthService;
use App\Models\Pengukuran;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Carbon;

class KalkulatorGiziController extends Controller
{
    public function index(): View
    {
        $balitas = Balita::with('orangTua')->orderBy('nama_balita')->get();
        return view('admin.kalkulatorGizi', compact('balitas'));
    }

    public function calculate(Request $request, WhoGrowthService $who): View
    {
        $v = $request->validate([
            'balita_id' => ['nullable', 'integer', 'exists:balitas,id_balita'],
            'nama' => ['required', 'string', 'max:30'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'usia_bulan' => ['required', 'integer', 'between:0,60'],
            'berat' => ['required', 'numeric', 'between:1,50'],
            'tinggi' => ['required', 'numeric', 'between:20,150'],
            'posisi_badan' => ['required', 'in:terlentang,berdiri'],
            'lingkar_kepala' => ['nullable', 'numeric', 'between:20,70'],
            'lila' => ['nullable', 'numeric', 'between:5,40'],
        ]);
        $age = (int) $v['usia_bulan'];
        $sex = $v['jenis_kelamin'];
        $height = (float) $v['tinggi'];
        $weight = (float) $v['berat'];
        $isLength = $age < 24;
        $position = $v['posisi_badan'];
        $corrected = $height;
        if ($isLength && $position === 'berdiri') $corrected += 0.7;
        if (!$isLength && $position === 'terlentang') $corrected -= 0.7;
        $lengthIndicator = $isLength ? 'lfa' : 'hfa';
        $weightLengthIndicator = $isLength ? 'wfl' : 'wfh';
        $head = isset($v['lingkar_kepala']) ? (float) $v['lingkar_kepala'] : null;
        $arm = isset($v['lila']) ? (float) $v['lila'] : null;
        $zHeight = $who->zScore($lengthIndicator, $sex, $age, $corrected);
        $zWfa = $who->zScore('wfa', $sex, $age, $weight);
        $zWfh = $who->zScore($weightLengthIndicator, $sex, $corrected, $weight);
        $zHead = $head !== null ? $who->zScore('hcfa', $sex, $age, $head) : null;
        $zArm = $arm !== null && $age >= 3 ? $who->zScore('acfa', $sex, $age, $arm) : null;
        $stunting = match (true) {
            $zHeight === null => 'Tidak dapat dihitung: data di luar rentang referensi',
            $zHeight < -3 => 'Sangat Pendek',
            $zHeight < -2 => 'Pendek (Stunted)',
            $zHeight <= 3 => 'Normal',
            default => 'Tinggi',
        };
        $hasil = [
            'nama' => $v['nama'], 'jenis_kelamin' => $sex === 'L' ? 'Laki-laki' : 'Perempuan',
            'usia_bulan' => $age, 'berat' => $weight, 'tinggi' => $height,
            'tinggi_koreksi' => round($corrected, 2), 'posisi_badan' => $position,
            'lingkar_kepala' => $head, 'lila' => $arm,
            'z_score' => $zHeight !== null ? round($zHeight, 2) : null,
            'status_stunting' => $stunting,
            'badge_color' => $zHeight === null || $zHeight < -3 ? 'rose' : ($zHeight < -2 ? 'amber' : ($zHeight <= 3 ? 'emerald' : 'teal')),
            'indikator_tinggi' => $isLength ? 'PB/U' : 'TB/U',
            'indikator_berat_tinggi' => $isLength ? 'BB/PB' : 'BB/TB',
            'z_bbu' => $zWfa === null ? null : round($zWfa, 2),
            'z_bb_tb' => $zWfh === null ? null : round($zWfh, 2),
            'z_lku' => $zHead === null ? null : round($zHead, 2),
            'z_lilau' => $zArm === null ? null : round($zArm, 2),
            'skrining_lila' => $who->lilaScreening($arm, $age),
        ];
   
        $balita = !empty($v['balita_id'])
            ? Balita::findOrFail($v['balita_id'])
            : null;

        if ($balita) {
            $v['nama'] = $balita->nama_balita;

            $v['jenis_kelamin'] =
                $balita->jenis_kelamin === 'Laki-laki'
                    ? 'L'
                    : 'P';

            $v['usia_bulan'] = (int) Carbon::parse(
                $balita->tanggal_lahir
            )->diffInMonths(now());
        }

        if ($balita) {
            Pengukuran::create([
                'balita_id' => $balita->id_balita,
                'tanggal_pengukuran' => now()->toDateString(),
        
                'nama_balita' => $balita->nama_balita,
                'nik' => $balita->nik,
                'jenis_kelamin' => $balita->jenis_kelamin,
        
                'berat_badan' => $weight,
                'tinggi_badan' => $height,
                'umur_bulan' => $age,
        
                'lingkar_kepala' => $head,
                'lila' => $arm,
        
                'z_score_bbu' => $zWfa === null ? null : round($zWfa, 2),
                'z_score_tbu' => $zHeight === null ? null : round($zHeight, 2),
                'z_score_bbtb' => $zWfh === null ? null : round($zWfh, 2),
            ]);
        }

        $balitas = Balita::with('orangTua')->orderBy('nama_balita')->get();
        return view('admin.kalkulatorGizi', compact('hasil', 'balitas'));

    }
}
