<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Balita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BalitaController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'data' => $request->user()->balitas()
                ->withCount('pengukurans')
                ->orderBy('nama_balita')
                ->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate($this->rules());
        $balita = $request->user()->balitas()->create($validated);

        return response()->json([
            'message' => 'Data anak berhasil ditambahkan.',
            'data' => $balita->loadCount('pengukurans'),
        ], 201);
    }

    public function update(Request $request, string $balita): JsonResponse
    {
        $anak = $this->ownedBalita($request, $balita);
        $validated = $request->validate($this->rules($anak));
        $anak->update($validated);

        return response()->json([
            'message' => 'Data anak berhasil diperbarui.',
            'data' => $anak->refresh()->loadCount('pengukurans'),
        ]);
    }

    public function destroy(Request $request, string $balita): JsonResponse
    {
        $anak = $this->ownedBalita($request, $balita);
        if ($anak->pengukurans()->exists()) {
            return response()->json([
                'message' => 'Anak tidak dapat dihapus karena memiliki riwayat pengukuran.',
            ], 409);
        }

        $anak->delete();
        return response()->json(['message' => 'Data anak berhasil dihapus.']);
    }

    private function ownedBalita(Request $request, string $id): Balita
    {
        return $request->user()->balitas()->whereKey($id)->firstOrFail();
    }

    private function rules(?Balita $balita = null): array
    {
        return [
            'nama_balita' => ['required', 'string', 'min:3', 'max:60'],
            'nik' => [
                'nullable', 'digits:16',
                Rule::unique(Balita::class, 'nik')->ignore($balita?->getKey(), 'id_balita'),
            ],
            'tanggal_lahir' => ['required', 'date', 'before_or_equal:today'],
            'jenis_kelamin' => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
        ];
    }
}
