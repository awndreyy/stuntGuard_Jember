<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mpasi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MpasiController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $data = $request->validate([
            'kategori_usia' => ['nullable', 'in:6-8,9-11,12-23'],
            'q' => ['nullable', 'string', 'max:100'],
            'page' => ['sometimes', 'integer', 'min:1'],
        ]);

        $query = Mpasi::query();

        if (! empty($data['kategori_usia'])) {
            $query->where('kategori_usia', $data['kategori_usia']);
        }

        $search = trim($data['q'] ?? '');
        if ($search !== '') {
            $query->where('nama_resep', 'like', '%'.$search.'%');
        }

        $recipes = $query->orderByDesc('created_at')
            ->orderByDesc('id_resep')
            ->paginate(12)
            ->withQueryString()
            ->through(fn (Mpasi $mpasi): array => $this->recipeData($mpasi));

        return response()->json($recipes);
    }

    public function show(Mpasi $mpasi): JsonResponse
    {
        return response()->json(['data' => $this->recipeData($mpasi)]);
    }

    private function recipeData(Mpasi $mpasi): array
    {
        return [
            'id_resep' => $mpasi->id_resep,
            'nama_resep' => $mpasi->nama_resep,
            'kategori_usia' => $mpasi->kategori_usia,
            'waktu_memasak' => $mpasi->waktu_memasak,
            'porsi' => $mpasi->porsi,
            'kalori' => (float) $mpasi->kalori,
            'karbohidrat' => (float) $mpasi->karbohidrat,
            'lemak' => (float) $mpasi->lemak,
            'protein' => (float) $mpasi->protein,
            'zat_besi' => (float) $mpasi->zat_besi,
            'seng' => (float) $mpasi->seng,
            'bahan' => $mpasi->bahan ?? [],
            'cara_pembuatan' => $mpasi->cara_pembuatan ?? [],
            'gambar_url' => $mpasi->gambar ? asset(ltrim($mpasi->gambar, '/')) : null,
        ];
    }
}
