<?php

use App\Http\Controllers\PengukuranController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboardAdmin');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/kelolaUser', [UserController::class, 'index'])->name('users.index');

Route::resource('users', UserController::class);

Route::post('/simpan-pengukuran', [PengukuranController::class, 'store']);
