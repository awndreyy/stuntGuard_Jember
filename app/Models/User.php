<?php

namespace App\Models;

use App\Models\Concerns\HasCustomId;
use App\Services\CustomIdService;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'nik', 'email', 'role', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    use HasCustomId;

    protected $table = 'tm_users';

    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', ];
    }

    public function balitas(): HasMany
    {
        return $this->hasMany(Balita::class, 'user_id', 'id');
    }

    protected function makeCustomId(): string
    {
        [$prefix, $roleCode] = match ($this->role) {
            'Admin' => ['AMN', '46'],
            'Orang Tua' => ['ORT', '32'],
            default => throw new \InvalidArgumentException('Role pengguna tidak valid.'),
        };

        return app(CustomIdService::class)->generate($this->getTable(), $prefix, $roleCode);
    }
}
