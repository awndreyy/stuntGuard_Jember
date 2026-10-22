<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengukuran extends Model
{
    protected $fillable = [
        'balita_id', 'tanggal_pengukuran', 'nama_balita', 'nik', 'jenis_kelamin',
        'berat_badan', 'tinggi_badan', 'umur_bulan', 'lingkar_kepala', 'lila',
        'z_score_bbu', 'z_score_tbu', 'z_score_bbtb',
    ];

    protected function casts(): array
    {
        return ['tanggal_pengukuran' => 'date'];
    }

    public function balita(): BelongsTo
    {
        return $this->belongsTo(Balita::class, 'balita_id', 'id_balita');
    }
}
