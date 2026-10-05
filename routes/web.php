<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\MpasiController;
use App\Http\Controllers\PengukuranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.dashboardGuest');
})->name('home');

Route::middleware(['guest'])->group(function () {
    // login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
    // Daftar
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.perform');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/dashboardAdmin', function () {
        return view('admin.dashboardAdmin');
    })->name('dashboardAdmin');

    Route::get('/kelolaUser', [UserController::class, 'index'])->name('kelolaUser');
    Route::resource('users', UserController::class)->except(['index', 'create', 'show', 'edit']);
    Route::resource('balita', BalitaController::class)->except(['create', 'show', 'edit']);

    Route::get('/kalkulatorGizi', function () {
        return view('admin.kalkulatorgizi');
    })->name('kalkulatorGizi');
    Route::post('/kalkulatorGizi', function () {
        return redirect()->route('kalkulatorGizi')->withInput();
    })->name('kalkulator.calculate');

    Route::get('/kelolaMpasi', [MpasiController::class, 'index'])->name('kelolaMpasi');
    Route::resource('mpasi', MpasiController::class)->except(['index', 'create', 'show', 'edit']);

    Route::get('/kelolaInformasi', [InformasiController::class, 'index'])->name('kelolaInformasi');
    Route::get('/kelolaInformasi/{id}/edit', [InformasiController::class, 'edit'])->name('kelolaInformasi.edit');
    Route::post('/kelolaInformasi', [InformasiController::class, 'store'])->name('kelolaInformasi.store');
    Route::put('/kelolaInformasi/{id}', [InformasiController::class, 'update'])->name('kelolaInformasi.update');
    Route::delete('/kelolaInformasi/{id}', [InformasiController::class, 'destroy'])->name('kelolaInformasi.destroy');
});

Route::middleware(['auth', 'role:Orang Tua'])->group(function () {
    Route::get('/dashboardUser', function () {
        return view('user.dashboardUser');
    })->name('dashboardUser');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::post('/simpan-pengukuran', [PengukuranController::class, 'store']);
