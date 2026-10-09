<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $table = 'informasis';

    protected $primaryKey = 'id_informasi';

    protected $fillable = [
        'judul',
        'category',
        'summary',
        'content',
        'thumbnail',
    ];
}
