<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Login
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'Admin') {
                return redirect()
                    ->intended('/dashboardAdmin')
                    ->with('success', 'Selamat datang '.$user->name);
            }

            if ($user->role === 'Orang Tua') {
                return redirect()
                    ->intended('/dashboardUser')
                    ->with('success', 'Selamat datang '.$user->name);
            }

            Auth::logout();

            return back()
                ->withErrors([
                    'email' => 'Role pengguna tidak dikenali.',
                ])
                ->withInput();
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput();
    }

    // Daftar
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:30'],
            'nik' => ['required', 'string', 'size:16', 'unique:users,nik'],
            'email' => ['required', 'email', 'max:30', 'unique:users,email'],
            'password' => ['required', 'min:6'],
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

        return redirect()->intended('/dashboardUser')->with('success', 'Registrasi berhasil! Selamat datang, '.$user->name);
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
