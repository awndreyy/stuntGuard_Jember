<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Balita;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BalitaController extends Controller
{
    // lihat riwayat pengukuran balita
    public function riwayat(Balita $balita)
    {
        $balita->load('orangTua');
        $user = $balita->orangTua;
        $riwayat = $balita->pengukurans()
            ->orderByDesc('tanggal_pengukuran')
            ->orderByDesc('id')
            ->paginate(10);

        return view('admin.riwayatBalita', [
            'user' => $user,
            'balita' => $balita,
            'riwayat' => $riwayat,
            'backUrl' => route('kelolaUser') . '#tab-anak',
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('kelolaUser');
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
            'user_id' => ['required', Rule::exists(User::class, 'id')],
            'nama_balita' => ['required', 'string', 'min:3', 'max:60'],
            'nik' => ['nullable', 'digits:16', Rule::unique(Balita::class, 'nik')],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
        ], [
            'user_id.required' => 'Orang tua wajib dipilih',
            'user_id.exists' => 'Data orang tua tidak valid',
            'nama_balita.required' => 'Nama Balita wajib diisi',
            'nama_balita.min' => 'Nama Balita minimal 3 karakter',
            'nama_balita.max' => 'Nama Balita maksimal 30 karakter',
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
            'user_id' => ['required', Rule::exists(User::class, 'id')],
            'nama_balita' => ['required', 'string','min:3', 'max:60'],
            'nik' => ['nullable', 'digits:16', Rule::unique(Balita::class, 'nik')->ignore($balita->id_balita, 'id_balita')],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
        ], [
            'user_id.required' => 'Orang tua wajib dipilih',
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
