<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalitaController;
use App\Http\Controllers\GuestKalkulatorController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KalkulatorGiziController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MpasiController;
use App\Http\Controllers\PengukuranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Halaman publik: hanya mengambil data yang boleh dilihat pengunjung.
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::post('/kalkulator-guest/hitung', [GuestKalkulatorController::class, 'calculate'])
    ->middleware('throttle:30,1')->name('public.kalkulator.calculate');
Route::get('/informasi', [LandingController::class, 'informasi'])->name('public.informasi.index');
Route::get('/informasi/{informasi}', [LandingController::class, 'detailInformasi'])->name('public.informasi.show');
Route::get('/resep', [LandingController::class, 'resep'])->name('public.resep.index');
Route::get('/resep/{mpasi}', [LandingController::class, 'detailResep'])->name('public.resep.show');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login.perform');
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

    Route::get('/kelolaInformasi', [InformasiController::class, 'index'])->name('kelolaInformasi');
    Route::resource('kelolaInformasi', InformasiController::class)->names('kelolaInformasi')->except(['index', 'create', 'show', 'edit']);

    Route::get('/kelolaMpasi', [MpasiController::class, 'index'])->name('kelolaMpasi');
    Route::resource('mpasi', MpasiController::class)->except(['index', 'show']);

    Route::get('/kalkulatorGizi', [KalkulatorGiziController::class, 'index'])->name('kalkulatorGizi');
    Route::post('/kalkulatorGizi', [KalkulatorGiziController::class, 'calculate'])->name('kalkulator.calculate');
    Route::post('/simpan-pengukuran', [PengukuranController::class, 'store'])->name('pengukuran.store');
    Route::get('/balita/{balita}/riwayat', [PengukuranController::class, 'history'])->name('pengukuran.history');
});

Route::middleware(['auth', 'role:Orang Tua'])->group(function () {
    Route::get('/dashboardUser', function () {
        return view('user.dashboardUser');
    })->name('dashboardUser');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
