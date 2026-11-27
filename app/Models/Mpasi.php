<?php

namespace App\Models;

use App\Models\Concerns\HasCustomId;
use App\Services\CustomIdService;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpasi extends Model
{
    use HasCustomId;

    protected $table = 'tm_mpasis';

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

        'kalori' => 'decimal:2',
        'karbohidrat' => 'decimal:2',
        'lemak' => 'decimal:2',
        'protein' => 'decimal:2',
        'zat_besi' => 'decimal:2',
        'seng' => 'decimal:2',
    ];
    protected function makeCustomId(): string
    {
        $category = match ($this->kategori_usia) {
            '6-8' => '01',
            '9-11' => '02',
            '12-23' => '03',
            default => throw new \InvalidArgumentException('Kategori usia MPASI tidak valid.'),
        };

        return app(CustomIdService::class)->generate($this->getTable(), 'RSP', $category);
    }
}
