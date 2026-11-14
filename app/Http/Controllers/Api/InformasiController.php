<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\JsonResponse;

class InformasiController extends Controller
{
    public function index(): JsonResponse
    {
        $articles = Informasi::query()
            ->orderByDesc('created_at')
            ->orderByDesc('id_informasi')
            ->get()
            ->map(fn (Informasi $article): array => $this->articleData($article));

        return response()->json(['data' => $articles]);
    }

    public function show(Informasi $informasi): JsonResponse
    {
        return response()->json([
            'data' => $this->articleData($informasi, true),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function articleData(Informasi $article, bool $withContent = false): array
    {
        return [
            'id_informasi' => $article->id_informasi,
            'judul' => $article->judul,
            'category' => $article->category,
            'summary' => $article->summary,
            'thumbnail_url' => $article->thumbnail,
            'created_at' => $article->created_at?->toIso8601String(),
            'updated_at' => $article->updated_at?->toIso8601String(),
            ...($withContent ? ['content' => $article->content] : []),
        ];
    }
}
