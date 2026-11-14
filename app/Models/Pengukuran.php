<?php

namespace App\Models;

use App\Models\Concerns\HasCustomId;
use App\Services\CustomIdService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengukuran extends Model
{
    use HasCustomId;

    protected $table = 'tt_pengukurans';

    protected $fillable = [
        'balita_id',
        'tanggal_pengukuran',
        'berat_badan',
        'tinggi_badan',
        'umur_bulan',
        'lingkar_kepala',
        'lila',
        'z_score_bbu',
        'z_score_tbu',
        'z_score_bbtb',
        'hasil',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_pengukuran' => 'date',
            'hasil' => 'array',
        ];
    }

    public function balita(): BelongsTo
    {
        return $this->belongsTo(Balita::class, 'balita_id', 'id_balita');
    }

    protected function makeCustomId(): string
    {
        return app(CustomIdService::class)->generatePengukuran();
    }
}
