<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PengukuranController;

Route::get('/', function () {
    return view('stuntguard');
});

Route::post('/simpan-pengukuran', [PengukuranController::class, 'store']);
