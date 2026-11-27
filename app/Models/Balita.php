<?php

namespace App\Models;

use App\Models\Concerns\HasCustomId;
use App\Services\CustomIdService;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Balita extends Model
{
    use HasCustomId;

    protected $table = 'tm_balitas';

    protected $primaryKey = 'id_balita';

    protected $fillable = ['user_id', 'nama_balita', 'nik', 'tanggal_lahir', 'jenis_kelamin'];

    public function pengukurans(): HasMany
    {
        return $this->hasMany(Pengukuran::class, 'balita_id', 'id_balita');
    }

    public function orangTua(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected function makeCustomId(): string
    {
        $category = match ($this->jenis_kelamin) {
            'Laki-laki' => '01',
            'Perempuan' => '02',
            default => throw new \InvalidArgumentException('Jenis kelamin tidak valid.'),
        };

        return app(CustomIdService::class)->generate($this->getTable(), 'BLTA', $category);
    }
}
