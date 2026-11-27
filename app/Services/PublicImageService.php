<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Throwable;

class PublicImageService
{
    /** @param array<string, mixed> $attributes */
    public function save(Model $model, array $attributes, ?UploadedFile $image, string $directory, string $column): void
    {
        $oldPath = $model->getAttribute($column);
        $newPath = null;

        try {
            if ($image !== null) {
                $stored = $image->store($directory, 'public');
                if ($stored === false) {
                    throw new RuntimeException('Gambar tidak dapat disimpan.');
                }
                $newPath = '/storage/'.$stored;
                $attributes[$column] = $newPath;
            }

            DB::transaction(function () use ($model, $attributes): void {
                $model->fill($attributes);
                if (! $model->saveOrFail()) {
                    throw new RuntimeException('Data tidak dapat disimpan.');
                }
            });
        } catch (Throwable $exception) {
            $this->deleteFile($newPath);
            throw $exception;
        }

        if ($newPath !== null && $oldPath !== $newPath) {
            $this->deleteFile($oldPath);
        }
    }

    public function delete(Model $model, string $column): void
    {
        $path = $model->getAttribute($column);
        DB::transaction(function () use ($model): void {
            if (! $model->delete()) {
                throw new RuntimeException('Data tidak dapat dihapus.');
            }
        });
        $this->deleteFile($path);
    }

    private function deleteFile(?string $path): void
    {
        if ($path === null || ! str_starts_with($path, '/storage/')) {
            return;
        }

        // Cleanup failure must not undo a successful database write.
        try {
            if (! Storage::disk('public')->delete(substr($path, strlen('/storage/')))) {
                report(new RuntimeException('Pembersihan gambar lama gagal.'));
            }
        } catch (Throwable $exception) {
            report($exception);
        }
    }
}
