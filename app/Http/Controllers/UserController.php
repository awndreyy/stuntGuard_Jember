<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->get();
        $balita = Balita::with('orangTua')->latest()->get();

        return view('admin.kelolaUser', compact('users', 'balita'));
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
            'name' => 'required|string|max:30',
            'nik' => 'required|string|size:16|unique:users,nik',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:Orang Tua,Admin',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'User Berhasil Ditambahkan');
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
        // Gunakan findOrFail biar kalau ID nggak ketemu, langsung dialihkan ke halaman 404 (lebih aman)
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email,'.$id,
        ]);

        $user->name = $request->name;

        $user->nik = $request->nik;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Data User berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        // cari data user dengan id
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
