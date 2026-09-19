<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PengukuranController;

Route::get('/', function () {
    return view('admin.dashboardAdmin');
});

Route::get('/kelolaUser', function () {
    return view('admin.kelolaUser');
});

Route::post('/simpan-pengukuran', [PengukuranController::class, 'store']);
