<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Services\PengukuranService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PengukuranController extends Controller
{
    public function storeForBalita(
        Request $request,
        string $balita,
        PengukuranService $measurements,
    ): JsonResponse {
        $anak = $request->user()->balitas()->whereKey($balita)->firstOrFail();
        $data = $request->validate([
            'tanggal_pengukuran' => ['required', 'date', 'before_or_equal:today'],
            'weight' => ['required', 'numeric', 'between:1,50'],
            'height' => ['required', 'numeric', 'between:20,150'],
            'posisi_badan' => ['required', 'in:terlentang,berdiri'],
            'lingkar_kepala' => ['nullable', 'numeric', 'between:20,70'],
            'lila' => ['nullable', 'numeric', 'between:5,40'],
        ]);

        $data['berat'] = $data['weight'];
        $data['tinggi'] = $data['height'];
        $record = $measurements->recordForBalita(
            $anak,
            $data['tanggal_pengukuran'],
            $data,
        );

        return response()->json([
            'message' => 'Pengukuran berhasil disimpan.',
            'hasil' => $record['hasil'],
            'data' => $record['pengukuran'],
        ], 201);
    }

    public function historyForBalita(Request $request, string $balita): JsonResponse
    {
        $anak = $request->user()->balitas()->whereKey($balita)->firstOrFail();

        return response()->json([
            'data' => $anak->pengukurans()
                ->orderByDesc('tanggal_pengukuran')
                ->orderByDesc('created_at')
                ->orderByDesc('id')
                ->get(),
        ]);
    }

    public function store(Request $request, PengukuranService $measurements): JsonResponse|RedirectResponse
    {
        $data = $request->validate([
            'balita_id' => ['required', 'string', Rule::exists(Balita::class, 'id_balita')],
            'tanggal_pengukuran' => ['required', 'date', 'before_or_equal:today'],
            'weight' => ['required', 'numeric', 'between:1,50'],
            'height' => ['required', 'numeric', 'between:20,150'],
            'posisi_badan' => ['required', 'in:terlentang,berdiri'],
            'lingkar_kepala' => ['nullable', 'numeric', 'between:20,70'],
            'lila' => ['nullable', 'numeric', 'between:5,40'],
        ]);

        $balita = Balita::findOrFail($data['balita_id']);

        // Kontrak endpoint JSON lama memakai weight / height.
        $data['berat'] = $data['weight'];
        $data['tinggi'] = $data['height'];

        $record = $measurements->recordForBalita($balita, $data['tanggal_pengukuran'], $data);

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Pengukuran berhasil disimpan.',
                'id' => $record['pengukuran']->id,
            ], 201);
        }

        // Fallback untuk form HTML tanpa JavaScript.
        return redirect()->route('kalkulatorGizi')
            ->with('success', 'Pengukuran berhasil disimpan.');
    }

    public function history(Balita $balita): JsonResponse
    {
        return response()->json($balita->pengukurans()
            ->orderByDesc('tanggal_pengukuran')
            ->orderByDesc('created_at')->orderByDesc('id')
            ->paginate(20));
    }
}
