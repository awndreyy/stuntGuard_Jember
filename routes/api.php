<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BalitaController;
use App\Http\Controllers\Api\InformasiController;
use App\Http\Controllers\Api\MpasiController;
use App\Http\Controllers\PengukuranController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

Route::get('/informasi', [InformasiController::class, 'index']);
Route::get('/informasi/{informasi}', [InformasiController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/mpasi', [MpasiController::class, 'index'])->name('api.mpasi.index');
    Route::get('/mpasi/{mpasi}', [MpasiController::class, 'show'])->name('api.mpasi.show');
    Route::middleware('role:Orang Tua')->group(function () {
        Route::get('/balita', [BalitaController::class, 'index']);
        Route::post('/balita', [BalitaController::class, 'store']);
        Route::put('/balita/{balita}', [BalitaController::class, 'update']);
        Route::delete('/balita/{balita}', [BalitaController::class, 'destroy']);
        Route::get('/balita/{balita}/pengukuran', [PengukuranController::class, 'historyForBalita']);
        Route::post('/balita/{balita}/pengukuran', [PengukuranController::class, 'storeForBalita']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
