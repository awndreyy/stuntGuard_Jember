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
            'berat_badan' => $request->weight,
            'tinggi_badan' => $request->height,
            'umur_bulan' => $request->age,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pengukuran balita berhasil disimpan!'
        ]);
    }
}
