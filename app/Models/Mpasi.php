<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_resep';

    protected $fillable = [
        'nama_resep',
        'kategori_usia',
        'waktu_memasak',
        'porsi',
        'kalori',
        'karbohidrat',
        'lemak',
        'protein',
        'zat_besi',
        'seng',
        'bahan',
        'cara_pembuatan',
        'gambar',
    ];

    protected $casts = [
        'bahan' => 'array',
        'cara_pembuatan' => 'array',
        'waktu_memasak' => 'integer',
        'porsi' => 'integer',
        'kalori' => 'integer',
        'karbohidrat' => 'integer',
        'lemak' => 'integer',
        'protein' => 'integer',
        'zat_besi' => 'integer',
        'seng' => 'integer',
    ];
}
