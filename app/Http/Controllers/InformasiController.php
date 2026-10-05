<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformasiController extends Controller
{
    public function index()
    {
        $informations = Informasi::latest()->get();

        return view('admin.kelolainformasi', compact('informations'));
    }

    public function edit($id)
    {
        $informations = Informasi::latest()->get();
        $editInformation = Informasi::findOrFail($id);

        return view('admin.kelolainformasi', compact('informations', 'editInformation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'summary' => 'required|string',
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('informasi', 'public');
        }

        Informasi::create([
            'title' => $request->title,
            'category' => $request->category,
            'summary' => $request->summary,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'is_published' => $request->has('is_published') ? 1 : 0,
        ]);

        return redirect()->route('kelolaInformasi')->with('success', 'Informasi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $info = Informasi::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'summary' => 'required|string',
            'content' => 'nullable|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($info->thumbnail) {
                Storage::disk('public')->delete($info->thumbnail);
            }
            $info->thumbnail = $request->file('thumbnail')->store('informasi', 'public');
        }

        $info->update([
            'title' => $request->title,
            'category' => $request->category,
            'summary' => $request->summary,
            'content' => $request->content,
            'is_published' => $request->has('is_published') ? 1 : 0,
            'thumbnail' => $info->thumbnail,
        ]);

        return redirect()->route('kelolaInformasi')->with('success', 'Informasi berhasil diperbarui');
    }

    public function destroy($id)
    {
        $info = Informasi::findOrFail($id);

        if ($info->thumbnail) {
            Storage::disk('public')->delete($info->thumbnail);
        }

        $info->delete();

        return redirect()->route('kelolaInformasi')->with('success', 'Informasi berhasil dihapus');
    }
}
