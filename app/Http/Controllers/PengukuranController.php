<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pengukuran;

class PengukuranController extends Controller
{
    public function store(Request $request)
    {
        // Simpan data dari form ke database
        $pengukuran = Pengukuran::create([
            'nama_balita' => $request->name,
            'nik'=> $request->nik,
            'jenis_kelamin' => $request->gender,
            'berat_badan' => $request->weight,
            'tinggi_badan' => $request->height,
            'umur_bulan' => $request->age,
            'posisi_badan' => $request->position,
            'lingkar_kepala' => $request->head_circ,
            'lingkar_lengan' => $request->lila,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pengukuran balita berhasil disimpan!'
        ]);
    }
}
