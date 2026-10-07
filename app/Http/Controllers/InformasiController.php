<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informations = Informasi::latest()->get();

        return view('admin.kelolaInformasi', compact('informations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'summary' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:3072'],
        ], [
            'title.required' => 'Judul informasi wajib diisi.',
            'title.max' => 'Judul informasi maksimal 255 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'summary.required' => 'Ringkasan singkat wajib diisi.',
            'thumbnail.image' => 'File thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau gif.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 3MB.',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('informasi', 'public');
            $thumbnailPath = '/storage/'.$path;
        }

        Informasi::create([
            'title' => $request->title,
            'category' => $request->category,
            'summary' => $request->summary,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'is_published' => $request->has('is_published'),
        ]);

        return redirect()->route('kelolaInformasi')->with('success', 'Informasi & edukasi berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $informations = Informasi::latest()->get();
        $editInformation = Informasi::findOrFail($id);

        return view('admin.kelolaInformasi', compact('informations', 'editInformation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $informasi = Informasi::findOrFail($id);

        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'summary' => ['required', 'string'],
            'content' => ['nullable', 'string'],
            'thumbnail' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:3072'],
        ], [
            'title.required' => 'Judul informasi wajib diisi.',
            'title.max' => 'Judul informasi maksimal 255 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'summary.required' => 'Ringkasan singkat wajib diisi.',
            'thumbnail.image' => 'File thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau gif.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 3MB.',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($informasi->thumbnail && str_starts_with($informasi->thumbnail, '/storage/')) {
                $relative = str_replace('/storage/', '', $informasi->thumbnail);
                Storage::disk('public')->delete($relative);
            }
            $path = $request->file('thumbnail')->store('informasi', 'public');
            $informasi->thumbnail = '/storage/'.$path;
        }

        $informasi->title = $request->title;
        $informasi->category = $request->category;
        $informasi->summary = $request->summary;
        $informasi->content = $request->content;
        $informasi->is_published = $request->has('is_published');
        $informasi->save();

        return redirect()->route('kelolaInformasi')->with('success', 'Informasi & edukasi berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $informasi = Informasi::findOrFail($id);

        if ($informasi->thumbnail && str_starts_with($informasi->thumbnail, '/storage/')) {
            $relative = str_replace('/storage/', '', $informasi->thumbnail);
            Storage::disk('public')->delete($relative);
        }

        $informasi->delete();

        return redirect()->route('kelolaInformasi')->with('success', 'Informasi & edukasi berhasil dihapus!');
    }
}
