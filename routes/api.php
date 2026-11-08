<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MpasiController;
use App\Http\Controllers\Api\BalitaController;

Route::post('/register', [AuthController::class, 'register'])
    ->middleware('throttle:5,1');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::get('/mpasi', [MpasiController::class, 'index'])->name('api.mpasi.index');
    Route::get('/mpasi/{mpasi}', [MpasiController::class, 'show'])->name('api.mpasi.show');
    Route::middleware('role:Orang Tua')->group(function () {
        Route::get('/balita', [BalitaController::class, 'index']);
        Route::post('/balita', [BalitaController::class, 'store']);
        Route::put('/balita/{balita}', [BalitaController::class, 'update']);
        Route::delete('/balita/{balita}', [BalitaController::class, 'destroy']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
