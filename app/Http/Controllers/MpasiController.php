<?php

namespace App\Http\Controllers;

use App\Models\Mpasi;
use App\Services\PublicImageService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MpasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $filters = $request->validate([
            'kategori_usia' => ['nullable', Rule::in(['all', '6-8', '9-11', '12-23'])],
            'q' => ['nullable', 'string', 'max:100'],
        ]);
        $search = trim($filters['q'] ?? '');
        $mpasis = Mpasi::query()
            ->when(($filters['kategori_usia'] ?? 'all') !== 'all', fn ($query) => $query->where('kategori_usia', $filters['kategori_usia']))
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('nama_resep', 'like', '%'.$search.'%')
                        ->orWhere('bahan', 'like', '%'.$search.'%');
                });
            })
            ->latest('created_at')->orderByDesc('id_resep')
            ->paginate(6)->withQueryString();

        $totalResep = Mpasi::count();
        $total68 = Mpasi::where('kategori_usia', '6-8')->count();
        $total911 = Mpasi::where('kategori_usia', '9-11')->count();
        $total1223 = Mpasi::where('kategori_usia', '12-23')->count();

        return view('admin.kelolaMpasi', compact(
            'mpasis', 'totalResep', 'total68', 'total911', 'total1223'
        ));
    }

    /**
     * Show the page for creating an MPASI recipe.
     */
    public function create(): \Illuminate\View\View
    {
        return view('admin.formMpasi');
    }

    /**
     * Show the page for editing an existing MPASI recipe.
     */
    public function edit(string $id): \Illuminate\View\View
    {
        $mpasi = Mpasi::findOrFail($id);

        return view('admin.formMpasi', compact('mpasi'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PublicImageService $images): \Illuminate\Http\RedirectResponse
    {
        abort_unless($request->user()?->role === 'Admin', 403);

        $data = $request->validate([
            'nama_resep' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/', Rule::unique(Mpasi::class, 'nama_resep')],
            'kategori_usia' => ['required', 'string', 'in:6-8,9-11,12-23'],
            'waktu_memasak' => ['required', 'integer', 'min:1', 'max:100'],
            'porsi' => ['required', 'integer', 'min:1', 'max:10'],
            'kalori' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:2000'],
            'karbohidrat' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:300'],
            'lemak' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:50'],
            'protein' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:40'],
            'zat_besi' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:10'],
            'seng' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:8'],
            'bahan' => ['required', 'array', 'min:1'],
            'bahan.*' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s\/]+$/'], //regex hanya boleh huruf, angka, simbol /
            'cara_pembuatan' => ['required', 'array', 'min:1'],
            'cara_pembuatan.*' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'], //regex hanya boleh huruf dan angka
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:3072'],
        ], [
            'nama_resep.required' => 'Nama resep wajib diisi.',
            'nama_resep.max' => 'Nama resep maksimal 50 karakter.',
            'nama_resep.regex' => 'Judul resep hanya boleh berisi huruf dan spasi (tidak boleh angka atau simbol).',
            'nama_resep.unique' => 'Gagal! Resep dengan nama ini sudah terdaftar.',
            'kategori_usia.required' => 'Kategori usia wajib dipilih.',
            'waktu_memasak.required' => 'Waktu memasak wajib diisi.',
            'waktu_memasak.integer' => 'Waktu memasak harus berupa angka.',
            'waktu_memasak.min' => 'Waktu memasak minimal 1 menit.',
            'waktu_memasak.max' => 'Waktu memasak maksimal 100 menit.',
            'porsi.required' => 'Porsi wajib diisi.',
            'porsi.integer' => 'Porsi harus berupa angka.',
            'porsi.min' => 'Porsi minimal 1.',
            'porsi.max' => 'Porsi maksimal 10.',
            'kalori.numeric' => 'Nilai kalori harus berupa angka.',
            'kalori.decimal' => 'Nilai kalori maksimal 2 angka desimal.',
            'karbohidrat.numeric' => 'Nilai karbohirat harus berupa angka.',
            'karbohidrat.decimal' => 'Nilai karbohidrat maksimal 2 angka desimal.',
            'lemak.numeric' => 'Nilai lemak harus berupa angka.',
            'lemak.decimal' => 'Nilai lemak maksimal 2 angka desimal.',
            'protein.numeric' => 'Nilai protein harus berupa angka',
            'protein.decimal' => 'Nilai protein maksimal 2 angka desimal.',
            'zat_besi.numeric' => 'Nilai zat besi harus berupa angka.',
            'zat_besi.decimal' => 'Nilai zat besi maksimal 2 angka desimal.',
            'seng.numeric' => 'Nilai seng harus berupa angka.',
            'seng.decimal' => 'Nilai seng maksimal 2 angka desimal.',
            'bahan.required' => 'Minimal 1 bahan wajib diisi.',
            'bahan.*.required' => 'Setiap bahan wajib diisi.',
            'bahan.*.regex' => 'Bahan hanya boleh berisi huruf, angka, spasi, dan simbol garis miring (/).',
            'cara_pembuatan.required' => 'Minimal 1 langkah pembuatan wajib diisi.',
            'cara_pembuatan.*.required' => 'Setiap langkah pembuatan wajib diisi.',
            'cara_pembuatan.*.regex' => 'Langkah pembuatan hanya boleh berisi huruf dan angka (tidak boleh simbol).',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau gif.',
            'gambar.max' => 'Ukuran gambar maksimal 3MB.',
        ]);

        unset($data['gambar']);
        foreach (['kalori', 'karbohidrat', 'lemak', 'protein', 'zat_besi', 'seng'] as $field) {
            $data[$field] = $data[$field] ?? 0;
        }
        $images->save(new Mpasi, $data, $request->file('gambar'), 'mpasi', 'gambar');

        return redirect()->route('kelolaMpasi')->with('success', 'Resep MPASI berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, PublicImageService $images): \Illuminate\Http\RedirectResponse
    {
        $mpasi = Mpasi::findOrFail($id);

        abort_unless($request->user()?->role === 'Admin', 403);

        $data = $request->validate([
            'nama_resep' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/', Rule::unique(Mpasi::class, 'nama_resep')->ignore($mpasi->getKey(), 'id_resep')],
            'kategori_usia' => ['required', 'string', 'in:6-8,9-11,12-23'],
            'waktu_memasak' => ['required', 'integer', 'min:1', 'max:100'],
            'porsi' => ['required', 'integer', 'min:1', 'max:10'],
            'kalori' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:2000'],
            'karbohidrat' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:300'],
            'lemak' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:50'],
            'protein' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:40'],
            'zat_besi' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:10'],
            'seng' => ['nullable', 'numeric', 'decimal:0,2', 'min:0', 'max:8'],
            'bahan' => ['required', 'array', 'min:1'],
            'bahan.*' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s\/]+$/'], //regex hanya boleh huruf, angka, simbol /
            'cara_pembuatan' => ['required', 'array', 'min:1'],
            'cara_pembuatan.*' => ['required', 'string', 'regex:/^[a-zA-Z0-9\s]+$/'], //regex hanya boleh huruf dan angka
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:3072'],
        ], [
            'nama_resep.required' => 'Nama resep wajib diisi.',
            'nama_resep.max' => 'Nama resep maksimal 50 karakter.',
            'nama_resep.regex' => 'Judul resep hanya boleh berisi huruf dan spasi (tidak boleh angka atau simbol).',
            'nama_resep.unique' => 'Gagal! Resep dengan nama ini sudah terdaftar.',
            'kategori_usia.required' => 'Kategori usia wajib dipilih.',
            'waktu_memasak.required' => 'Waktu memasak wajib diisi.',
            'waktu_memasak.integer' => 'Waktu memasak harus berupa angka.',
            'waktu_memasak.min' => 'Waktu memasak minimal 1 menit.',
            'waktu_memasak.max' => 'Waktu memasak maksimal 100 menit.',
            'porsi.required' => 'Porsi wajib diisi.',
            'porsi.integer' => 'Porsi harus berupa angka.',
            'porsi.min' => 'Porsi minimal 1.',
            'porsi.max' => 'Porsi maksimal 10.',
            'kalori.numeric' => 'Nilai kalori harus berupa angka.',
            'kalori.decimal' => 'Nilai kalori maksimal 2 angka desimal.',
            'karbohidrat.numeric' => 'Nilai karbohirat harus berupa angka.',
            'karbohidrat.decimal' => 'Nilai karbohidrat maksimal 2 angka desimal.',
            'lemak.numeric' => 'Nilai lemak harus berupa angka.',
            'lemak.decimal' => 'Nilai lemak maksimal 2 angka desimal.',
            'protein.numeric' => 'Nilai protein harus berupa angka',
            'protein.decimal' => 'Nilai protein maksimal 2 angka desimal.',
            'zat_besi.numeric' => 'Nilai zat besi harus berupa angka.',
            'zat_besi.decimal' => 'Nilai zat besi maksimal 2 angka desimal.',
            'seng.numeric' => 'Nilai seng harus berupa angka.',
            'seng.decimal' => 'Nilai seng maksimal 2 angka desimal.',
            'bahan.required' => 'Minimal 1 bahan wajib diisi.',
            'bahan.*.required' => 'Setiap bahan wajib diisi.',
            'bahan.*.regex' => 'Bahan hanya boleh berisi huruf, angka, spasi, dan simbol garis miring (/).',
            'cara_pembuatan.required' => 'Minimal 1 langkah pembuatan wajib diisi.',
            'cara_pembuatan.*.required' => 'Setiap langkah pembuatan wajib diisi.',
            'cara_pembuatan.*.regex' => 'Langkah pembuatan hanya boleh berisi huruf dan angka (tidak boleh simbol).',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau gif.',
            'gambar.max' => 'Ukuran gambar maksimal 3MB.',
        ]);

        unset($data['gambar']);
        foreach (['kalori', 'karbohidrat', 'lemak', 'protein', 'zat_besi', 'seng'] as $field) {
            $data[$field] = $data[$field] ?? 0;
        }
        $images->save($mpasi, $data, $request->file('gambar'), 'mpasi', 'gambar');

        return redirect()->route('kelolaMpasi')->with('success', 'Resep MPASI berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, PublicImageService $images): \Illuminate\Http\RedirectResponse
    {
        $mpasi = Mpasi::findOrFail($id);

        $images->delete($mpasi, 'gambar');

        return redirect()->route('kelolaMpasi')->with('success', 'Resep MPASI berhasil dihapus!');
    }
}
