<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;

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
        $data = $request->validate(
            [
                'balita_id' => ['nullable', 'string', Rule::exists(Balita::class, 'id_balita')],
                'nama' => ['required', 'string', 'max:30'],
                'jenis_kelamin' => ['required', 'in:L,P'],
                'usia_bulan' => ['required', 'integer', 'between:0,60'],
                'berat' => ['required', 'numeric', 'between:1,50'],
                'tinggi' => ['required', 'numeric', 'between:20,150'],
                'posisi_badan' => ['required', 'in:terlentang,berdiri'],
                'lingkar_kepala' => ['nullable', 'numeric', 'between:20,70'],
                'lila' => ['nullable', 'numeric', 'between:5,40'],
            ],
            [
                'balita_id.string' => 'ID balita harus berupa teks.',
                'balita_id.exists' => 'Data balita yang dipilih tidak ditemukan.',

                'nama.required' => 'Nama balita wajib diisi.',
                'nama.string' => 'Nama balita harus berupa teks.',
                'nama.max' => 'Nama balita maksimal 30 karakter.',

                'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
                'jenis_kelamin.in' => 'Jenis kelamin yang dipilih tidak valid.',

                'usia_bulan.required' => 'Usia balita wajib diisi.',
                'usia_bulan.integer' => 'Usia balita harus berupa bilangan bulat.',
                'usia_bulan.between' => 'Usia balita harus antara 0 sampai 60 bulan.',

                'berat.required' => 'Berat badan wajib diisi.',
                'berat.numeric' => 'Berat badan harus berupa angka.',
                'berat.between' => 'Berat badan harus antara 1 sampai 50 kg.',

                'tinggi.required' => 'Panjang atau tinggi badan wajib diisi.',
                'tinggi.numeric' => 'Panjang atau tinggi badan harus berupa angka.',
                'tinggi.between' => 'Panjang atau tinggi badan harus antara 20 sampai 150 cm.',

                'posisi_badan.required' => 'Posisi pengukuran badan wajib dipilih.',
                'posisi_badan.in' => 'Posisi badan harus terlentang atau berdiri.',

                'lingkar_kepala.numeric' => 'Lingkar kepala harus berupa angka.',
                'lingkar_kepala.between' => 'Lingkar kepala harus antara 20 sampai 70 cm.',

                'lila.numeric' => 'Lingkar lengan atas (LiLA) harus berupa angka.',
                'lila.between' => 'Lingkar lengan atas (LiLA) harus antara 5 sampai 40 cm.',
            ]
        );

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
