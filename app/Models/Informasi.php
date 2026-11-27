<?php

namespace App\Models;

use App\Models\Concerns\HasCustomId;
use App\Services\CustomIdService;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasCustomId;

    use HasFactory;

    protected $table = 'tm_informasis';

    protected $primaryKey = 'id_informasi';

    protected $fillable = [
        'judul',
        'category',
        'summary',
        'content',
        'thumbnail',
    ];
    protected function makeCustomId(): string
    {
        $category = match ($this->category) {
            'Trimester 1' => '01',
            'Trimester 2' => '02',
            'Trimester 3' => '03',
            'Edukasi Gizi' => '04',
            'Pencegahan Stunting' => '05',
            default => throw new \InvalidArgumentException('Kategori artikel tidak valid.'),
        };

        return app(CustomIdService::class)->generate($this->getTable(), 'ATKL', $category);
    }
}
