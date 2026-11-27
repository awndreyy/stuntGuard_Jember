<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InformasiController extends Controller
{
    /**
     * Kategori resmi informasi edukasi stunting.
     *
     * @var array<int, string>
     */
    public const CATEGORIES = [
        'Trimester 1',
        'Trimester 2',
        'Trimester 3',
        'Edukasi Gizi',
        'Pencegahan Stunting',
    ];

    /**
     * Menampilkan daftar artikel/informasi edukasi (support filter kategori & pencarian).
     */
    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'category' => ['nullable', 'string', Rule::in(self::CATEGORIES)],
            'q' => ['nullable', 'string', 'max:100'],
            'per_page' => ['nullable', 'integer', 'between:1,50'],
            'page' => ['sometimes', 'integer', 'min:1'],
        ]);

        $query = Informasi::query();

        if (! empty($validated['category'])) {
            $query->where('category', $validated['category']);
        }

        $search = trim((string) ($validated['q'] ?? ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search): void {
                $q->where('judul', 'like', '%'.$search.'%')
                    ->orWhere('summary', 'like', '%'.$search.'%');
            });
        }

        $perPage = (int) ($validated['per_page'] ?? 10);

        $articles = $query->orderByDesc('created_at')
            ->orderByDesc('id_informasi')
            ->paginate($perPage)
            ->withQueryString()
            ->through(fn (Informasi $informasi): array => $this->articleData($informasi, false));

        return response()->json($articles);
    }

    /**
     * Menampilkan detail satu artikel informasi edukasi.
     */
    public function show(Informasi $informasi): JsonResponse
    {
        return response()->json([
            'data' => $this->articleData($informasi, true),
        ]);
    }

    /**
     * Mendapatkan daftar opsi kategori edukasi untuk dropdown / chips di Flutter.
     */
    public function categories(): JsonResponse
    {
        return response()->json([
            'data' => self::CATEGORIES,
        ]);
    }

    /**
     * Format representasi data informasi untuk mobile Flutter.
     *
     * @return array<string, mixed>
     */
    private function articleData(Informasi $informasi, bool $withContent = false): array
    {
        $thumbnailUrl = null;
        if (! empty($informasi->thumbnail)) {
            $thumbnailUrl = asset(ltrim($informasi->thumbnail, '/'));
        }

        $data = [
            'id_informasi' => $informasi->id_informasi,
            'judul' => $informasi->judul,
            'category' => $informasi->category,
            'summary' => $informasi->summary,
            'thumbnail_url' => $thumbnailUrl,
            'created_at' => $informasi->created_at?->toIso8601String(),
            'updated_at' => $informasi->updated_at?->toIso8601String(),
        ];

        if ($withContent) {
            $data['content'] = $informasi->content;
        }

        return $data;
    }
}
