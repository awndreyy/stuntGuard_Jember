<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use Illuminate\Http\Request;

class BalitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_balita' => 'required|string|max:30',
            'nik' => 'nullable|string|size:16|unique:balitas,nik',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ], [
            'user_id.required' => 'Orang tua / wali wajib dipilih',
            'user_id.exists' => 'Data orang tua tidak valid',
            'nama_balita.required' => 'Nama Balita wajib diisi',
            'nik.unique' => 'NIK Balita sudah terdaftar',
            'nik.size' => 'NIK Balita harus tepat 16 digit',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi',
        ]);

        Balita::create([
            'user_id' => $request->user_id,
            'nama_balita' => $request->nama_balita,
            'nik' => $request->nik ?: null,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->back()->with('success', 'Data Balita berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $balita = Balita::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nama_balita' => 'required|string|max:30',
            'nik' => 'nullable|string|size:16|unique:balitas,nik,'.$balita->id_balita.',id_balita',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ], [
            'user_id.required' => 'Orang tua / wali wajib dipilih',
            'nama_balita.required' => 'Nama Balita wajib diisi',
            'nik.unique' => 'NIK Balita sudah terdaftar',
            'nik.size' => 'NIK Balita harus tepat 16 digit',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi',
        ]);

        $balita->update([
            'user_id' => $request->user_id,
            'nama_balita' => $request->nama_balita,
            'nik' => $request->nik ?: null,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
        ]);

        return redirect()->back()->with('success', 'Data Balita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $balita = Balita::findOrFail($id);
        $balita->delete();

        return redirect()->back()->with('success', 'Data Balita berhasil dihapus');
    }
}
