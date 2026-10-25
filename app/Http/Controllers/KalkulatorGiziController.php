<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Services\PengukuranService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KalkulatorGiziController extends Controller
{
    public function index(): View
    {
        $balitas = Balita::with('orangTua')->orderBy('nama_balita')->get();

        return view('admin.kalkulatorGizi', compact('balitas'));
    }

    public function calculate(Request $request, PengukuranService $measurements): View
    {
        $data = $request->validate([
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

        $selectedBalitaId = $data['balita_id'] ?? null;

        if ($selectedBalitaId !== null) {
            $balita = Balita::findOrFail($selectedBalitaId);

            // Controller kalkulator HANYA menghitung; tidak menulis riwayat.
            // Data identitas, usia, dan jenis kelamin berasal dari database.
            $hasil = $measurements->calculateForBalita(
                $balita,
                today()->toDateString(),
                $data,
                'balita_id',
            );
        } else {
            // Input nama manual = simulasi saja, tanpa menyimpan pengukuran.
            $hasil = $measurements->calculate(
                $data['nama'],
                $data['jenis_kelamin'],
                (int) $data['usia_bulan'],
                (float) $data['berat'],
                (float) $data['tinggi'],
                $data['posisi_badan'],
                isset($data['lingkar_kepala']) ? (float) $data['lingkar_kepala'] : null,
                isset($data['lila']) ? (float) $data['lila'] : null,
            );
        }

        $balitas = Balita::with('orangTua')->orderBy('nama_balita')->get();

        return view('admin.kalkulatorGizi', compact('hasil', 'balitas', 'selectedBalitaId'));
    }
}
