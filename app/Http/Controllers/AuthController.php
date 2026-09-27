<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ], [
            'email.required' => 'Email atau NIK wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $loginInput = $request->input('email') ?? $request->input('login');
        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'nik';

        $attemptData = [
            $fieldType => $loginInput,
            'password' => $request->password,
        ];

        if (Auth::attempt($attemptData)) {
            $request->session()->regenerate();

            $user = Auth::user();
            if ($user->role === 'Admin' || $user->role === 'Orang Tua') {
                return redirect()->intended('/dashboard-admin')->with('success', 'Selamat datang '.$user->name);
            }
        }   

        return back()->withErrors([
            'email' => 'Email/NIK atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Daftar
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:30',
            'nik' => 'required|string|size:16|unique:users,nik',
            'email' => 'required|email|max:30|unique:users,email',
            'password' => 'required|min:6',
        ], [
            'nik.unique' => 'NIK ini sudah terdaftar dalam sistem.',
            'nik.size' => 'NIK harus berjumlah tepat 16 digit.',
            'email.unique' => 'Email ini sudah terdaftar.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'role' => 'Orang Tua',
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('login')->with('success', 'Proses register berhasil, silahkan login!');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('success', 'Logout berhasil');
    }
}
