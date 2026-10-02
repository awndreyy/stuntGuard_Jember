<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Balita extends Model
{
    protected $primaryKey = 'id_balita';

    protected $fillable = ['user_id', 'nama_balita', 'nik', 'tanggal_lahir', 'jenis_kelamin'];

    public function orangTua(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
