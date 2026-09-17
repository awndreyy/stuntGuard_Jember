<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pengukuran;

class PengukuranController extends Controller
{
    public function store(Request $request)
{
    // 1. Proses Validasi Dulu
    $request->validate([
        // unique:pengukurans,nik berarti mengecek ke tabel pengukurans kolom nik
        'nik' => 'nullable|string|size:16|unique:pengukurans,nik',
        'name' => 'required|string',
        'weight' => 'required|numeric',
        'height' => 'required|numeric',
        'age' => 'required|integer',
    ], [
        // 2. Pesan error custom jika NIK sudah ada
        'nik.unique' => 'Gagal! Data balita dengan NIK ini sudah pernah didaftarkan sebelumnya.',
        'nik.size' => 'NIK harus berjumlah tepat 16 karakter.'
    ]);

    // 3. Jika validasi lolos, baru proses simpan ke database berjalan
    try {
        $pengukuran = Pengukuran::create([
            'nama_balita'   => $request->name,
            'nik'           => $request->nik,
            'jenis_kelamin' => $request->gender,
            'berat_badan'   => $request->weight,
            'tinggi_badan'  => $request->height,
            'umur_bulan'    => $request->age,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data pengukuran balita berhasil disimpan!'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
}
}
