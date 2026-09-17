<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengukuran extends Model
{
    protected $fillable = ['nama_balita', 'nik','jenis_kelamin', 'berat_badan', 'tinggi_badan', 'umur_bulan',];
}
