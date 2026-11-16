<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BalitaController extends Controller
{
    // lihat riwayat pengukuran balita
    public function riwayat(Balita $balita): \Illuminate\View\View
    {
        $balita->load('orangTua');
        $user = $balita->orangTua;
        $riwayat = $balita->pengukurans()
            ->orderByDesc('tanggal_pengukuran')
            ->orderByDesc('created_at')->orderByDesc('id')
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
    public function index(): \Illuminate\Http\RedirectResponse
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
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        abort_unless($request->user()?->role === 'Admin', 403);

        $data = $request->validate([
            'user_id' => ['required', Rule::exists(User::class, 'id')->where('role', 'Orang Tua')],
            'nama_balita' => ['required', 'string', 'min:3', 'max:60'],
            'nik' => ['nullable', 'digits:16', Rule::unique(Balita::class, 'nik')],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
        ], [
            'user_id.required' => 'Orang tua wajib dipilih',
            'user_id.exists' => 'Akun orang tua tidak valid atau bukan pengguna dengan role Orang Tua.',
            'nama_balita.required' => 'Nama Balita wajib diisi',
            'nama_balita.min' => 'Nama Balita minimal 3 karakter',
            'nama_balita.max' => 'Nama Balita maksimal 60 karakter',
            'nik.unique' => 'NIK Balita sudah terdaftar',
            'nik.digits' => 'NIK Balita harus tepat 16 digit',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi',
        ]);

        Balita::create($data);

        return redirect()->route('kelolaUser', ['tab' => 'anak'])->with('success', 'Data Balita berhasil ditambahkan');
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
    public function update(Request $request, string $id): \Illuminate\Http\RedirectResponse
    {
        $balita = Balita::findOrFail($id);

        abort_unless($request->user()?->role === 'Admin', 403);

        $data = $request->validate([
            'user_id' => ['required', Rule::exists(User::class, 'id')->where('role', 'Orang Tua')],
            'nama_balita' => ['required', 'string', 'min:3', 'max:60'],
            'nik' => ['nullable', 'digits:16', Rule::unique(Balita::class, 'nik')->ignore($balita->getKey(), 'id_balita')],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
        ], [
            'user_id.required' => 'Orang tua wajib dipilih',
            'user_id.exists' => 'Akun orang tua tidak valid atau bukan pengguna dengan role Orang Tua.',
            'nama_balita.required' => 'Nama Balita wajib diisi',
            'nama_balita.min' => 'Nama Balita minimal 3 karakter',
            'nama_balita.max' => 'Nama Balita maksimal 60 karakter',
            'nik.unique' => 'NIK Balita sudah terdaftar',
            'nik.digits' => 'NIK Balita harus tepat 16 digit',
            'tanggal_lahir.required' => 'Tanggal Lahir wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib diisi',
        ]);

        $balita->update($data);

        return redirect()->route('kelolaUser', ['tab' => 'anak'])->with('success', 'Data Balita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): \Illuminate\Http\RedirectResponse
    {
        $balita = Balita::findOrFail($id);
        if ($balita->pengukurans()->exists()) {
            return back()->with(
                'error',
                'Balita tidak dapat dihapus karena masih memiliki riwayat pengukuran.'
            );
        }

        $balita->delete();

        return redirect()-> route('kelolaUser', ['tab' => 'anak'])->with('success', 'Data balita berhasil dihapus.');
    }
}
