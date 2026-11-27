<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BalitaController;
use App\Http\Controllers\Api\InformasiController;
use App\Http\Controllers\Api\MpasiController;
use App\Http\Controllers\Api\PengukuranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth endpoints (Publik)
Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');

// Semua fitur berikut WAJIB login (auth:sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/user', function (Request $request) {
        return response()->json($request->user());
    });

    // Resep MPASI (harus login)
    Route::get('/mpasi', [MpasiController::class, 'index'])->name('api.mpasi.index');
    Route::get('/mpasi/{mpasi}', [MpasiController::class, 'show'])->name('api.mpasi.show');

    // Informasi & Edukasi Stunting (sekarang harus login seperti MPASI)
    Route::get('/informasi/categories', [InformasiController::class, 'categories'])->name('api.informasi.categories');
    Route::get('/informasi', [InformasiController::class, 'index'])->name('api.informasi.index');
    Route::get('/informasi/{informasi}', [InformasiController::class, 'show'])->name('api.informasi.show');

    // Fitur Khusus Orang Tua
    Route::middleware('role:Orang Tua')->group(function () {
        // Kelola Data Balita milik Orang Tua
        Route::get('/balita', [BalitaController::class, 'index']);
        Route::post('/balita', [BalitaController::class, 'store']);
        Route::put('/balita/{balita}', [BalitaController::class, 'update']);
        Route::delete('/balita/{balita}', [BalitaController::class, 'destroy']);

        // Pengukuran / Hitung Status Gizi Balita (Menggunakan data balita milik akun yang login, TIDAK disimpan ke database)
        Route::post('/pengukuran', [PengukuranController::class, 'hitung'])->name('api.pengukuran.hitung');
        Route::post('/pengukuran/hitung', [PengukuranController::class, 'hitung']);

        // Riwayat Pengukuran (bila diperlukan)
        Route::get('/pengukuran', [PengukuranController::class, 'index'])->name('api.pengukuran.index');
        Route::get('/balita/{balita}/pengukuran', [PengukuranController::class, 'byBalita'])->name('api.balita.pengukuran.index');
        Route::get('/pengukuran/{pengukuran}', [PengukuranController::class, 'show'])->name('api.pengukuran.show');
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
