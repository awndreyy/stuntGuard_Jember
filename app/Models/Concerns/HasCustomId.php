<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasCustomId
{
    public function initializeHasCustomId(): void
    {
        $this->incrementing = false;
        $this->keyType = 'string';
    }

    public static function bootHasCustomId(): void
    {
        static::creating(function (Model $model): void {
            if ($model->getKey() === null || $model->getKey() === '') {
                $model->setAttribute($model->getKeyName(), $model->makeCustomId());
            }
        });
    }

    abstract protected function makeCustomId(): string;
}
