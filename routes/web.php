<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BalitaController;
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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard-admin', function () {
        return view('admin.dashboardAdmin');
    })->name('dashboardAdmin');
    Route::get('/dashboard-user', function () {
        return view('user.dashboardUser');
    })->name('dashboardUser');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/kelolaUser', [UserController::class, 'index'])->name('users.index');

    Route::resource('users', UserController::class)->except(['index', 'create', 'show', 'edit']);
    Route::resource('balita', BalitaController::class)->except(['create', 'show', 'edit']);
});

Route::post('/simpan-pengukuran', [PengukuranController::class, 'store']);
