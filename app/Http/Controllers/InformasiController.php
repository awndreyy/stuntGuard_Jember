<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use App\Services\PublicImageService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\View\View
    {
        $informations = Informasi::latest('created_at')->orderByDesc('id_informasi')->paginate(6)->withQueryString();

        return view('admin.kelolaInformasi', compact('informations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, PublicImageService $images): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'judul' => ['required_without:title', 'nullable', 'string', 'max:50'],
            'title' => ['required_without:judul', 'nullable', 'string', 'max:50'],
            'category' => ['required', Rule::in([
                'Trimester 1',
                'Trimester 2',
                'Trimester 3',
                'Edukasi Gizi',
                'Pencegahan Stunting',]),],
            'summary' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:3072'],
        ], [
            'judul.required_without' => 'Judul informasi wajib diisi.',
            'title.required_without' => 'Judul informasi wajib diisi.',
            'judul.max' => 'Judul informasi maksimal 50 karakter.',
            'title.max' => 'Judul informasi maksimal 50 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'summary.required' => 'Ringkasan singkat wajib diisi.',
            'thumbnail.image' => 'File thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau gif.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 3MB.',
        ]);

        $data['judul'] = $data['judul'] ?? $data['title'];
        unset($data['title'], $data['thumbnail']);
        $images->save(new Informasi, $data, $request->file('thumbnail'), 'informasi', 'thumbnail');

        return redirect()->route('kelolaInformasi')->with('success', 'Informasi & edukasi berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $informations = Informasi::latest('created_at')->get();
        $editInformation = Informasi::findOrFail($id);

        return view('admin.kelolaInformasi', compact('informations', 'editInformation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, PublicImageService $images): \Illuminate\Http\RedirectResponse
    {
        $informasi = Informasi::findOrFail($id);

        $data = $request->validate([
            'judul' => ['required_without:title', 'nullable', 'string', 'max:50'],
            'title' => ['required_without:judul', 'nullable', 'string', 'max:50'],
            'category' => ['required', Rule::in([
                'Trimester 1',
                'Trimester 2',
                'Trimester 3',
                'Edukasi Gizi',
                'Pencegahan Stunting',]),],
            'summary' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:3072'],
        ], [
            'judul.required_without' => 'Judul informasi wajib diisi.',
            'title.required_without' => 'Judul informasi wajib diisi.',
            'judul.max' => 'Judul informasi maksimal 50 karakter.',
            'title.max' => 'Judul informasi maksimal 50 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'summary.required' => 'Ringkasan singkat wajib diisi.',
            'thumbnail.image' => 'File thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau gif.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 3MB.',
        ]);

        $data['judul'] = $data['judul'] ?? $data['title'];
        unset($data['title'], $data['thumbnail']);
        $images->save($informasi, $data, $request->file('thumbnail'), 'informasi', 'thumbnail');

        return redirect()->route('kelolaInformasi')->with('success', 'Informasi & edukasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, PublicImageService $images): \Illuminate\Http\RedirectResponse
    {
        $informasi = Informasi::findOrFail($id);

        $images->delete($informasi, 'thumbnail');

        return redirect()->route('kelolaInformasi')->with('success', 'Informasi & edukasi berhasil dihapus!');
    }
}
