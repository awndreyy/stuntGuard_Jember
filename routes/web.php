<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PengukuranController;

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('admin.dashboardAdmin');
});

Route::get('/kelolaUser', [UserController::class, 'index'])->name('users.index');

Route::resource('users', UserController::class);

Route::post('/simpan-pengukuran', [PengukuranController::class, 'store']);
