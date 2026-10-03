<?php

namespace App\Http\Controllers;

use App\Models\Mpasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MpasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mpasis = Mpasi::latest('id_resep')->get();

        $totalResep = $mpasis->count();
        $total68 = $mpasis->where('kategori_usia', '6-8')->count();
        $total911 = $mpasis->where('kategori_usia', '9-11')->count();
        $total1223 = $mpasis->where('kategori_usia', '12-23')->count();

        return view('admin.kelolaMpasi', compact(
            'mpasis',
            'totalResep',
            'total68',
            'total911',
            'total1223'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_resep' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/', 'unique:mpasis,nama_resep'],
            'kategori_usia' => ['required', 'string', 'in:6-8,9-11,12-23'],
            'waktu_memasak' => ['required', 'integer', 'min:1', 'max:100'],
            'porsi' => ['required', 'integer', 'min:1', 'max:10'],
            'kalori' => ['nullable', 'integer', 'min:0'],
            'karbohidrat' => ['nullable', 'integer', 'min:0'],
            'lemak' => ['nullable', 'integer', 'min:0'],
            'protein' => ['nullable', 'integer', 'min:0'],
            'zat_besi' => ['nullable', 'integer', 'min:0'],
            'seng' => ['nullable', 'integer', 'min:0'],
            'bahan' => ['required', 'array', 'min:1'],
            'bahan.*' => ['nullable', 'string', 'regex:/^[a-zA-Z\s,\.]/'],
            'cara_pembuatan' => ['required', 'array', 'min:1'],
            'cara_pembuatan.*' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:3072'],
            'foto' => ['nullable', 'string', 'max:500'],
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
            'kalori.integer' => 'Nilai kalori harus berupa angka bulat (tanpa koma).',
            'kalori.min' => 'Nilai kalori tidak boleh kurang dari 0.',
            'karbohidrat.integer' => 'Nilai karbohidrat harus berupa angka bulat (tanpa koma).',
            'karbohidrat.min' => 'Nilai karbohidrat tidak boleh kurang dari 0.',
            'lemak.integer' => 'Nilai lemak harus berupa angka bulat (tanpa koma).',
            'lemak.min' => 'Nilai lemak tidak boleh kurang dari 0.',
            'protein.integer' => 'Nilai protein harus berupa angka bulat (tanpa koma).',
            'protein.min' => 'Nilai protein tidak boleh kurang dari 0.',
            'zat_besi.integer' => 'Nilai zat besi harus berupa angka bulat (tanpa koma).',
            'zat_besi.min' => 'Nilai zat besi tidak boleh kurang dari 0.',
            'seng.integer' => 'Nilai seng harus berupa angka bulat (tanpa koma).',
            'seng.min' => 'Nilai seng tidak boleh kurang dari 0.',
            'bahan.required' => 'Minimal 1 bahan wajib diisi.',
            'bahan.*.regex' => 'Bahan hanya boleh berisi huruf dan spasi (tidak boleh angka atau simbol).',
            'cara_pembuatan.required' => 'Minimal 1 langkah pembuatan wajib diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau gif.',
            'gambar.max' => 'Ukuran gambar maksimal 3MB.',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('mpasi', 'public');
            $gambarPath = '/storage/'.$path;
        } elseif ($request->filled('foto')) {
            $gambarPath = $request->foto;
        }

        $bahanCleaned = array_values(array_filter((array) $request->bahan, fn ($b) => trim((string) $b) !== ''));
        $langkahCleaned = array_values(array_filter((array) $request->cara_pembuatan, fn ($c) => trim((string) $c) !== ''));

        if (empty($bahanCleaned)) {
            return redirect()->back()->withErrors(['bahan' => 'Minimal 1 bahan harus diisi.'])->withInput();
        }

        if (empty($langkahCleaned)) {
            return redirect()->back()->withErrors(['cara_pembuatan' => 'Minimal 1 langkah pembuatan harus diisi.'])->withInput();
        }

        Mpasi::create([
            'nama_resep' => $request->nama_resep,
            'kategori_usia' => $request->kategori_usia,
            'waktu_memasak' => $request->waktu_memasak,
            'porsi' => $request->porsi,
            'kalori' => $request->filled('kalori') ? $request->kalori : 0,
            'karbohidrat' => $request->filled('karbohidrat') ? $request->karbohidrat : 0,
            'lemak' => $request->filled('lemak') ? $request->lemak : 0,
            'protein' => $request->filled('protein') ? $request->protein : 0,
            'zat_besi' => $request->filled('zat_besi') ? $request->zat_besi : 0,
            'seng' => $request->filled('seng') ? $request->seng : 0,
            'bahan' => $bahanCleaned,
            'cara_pembuatan' => $langkahCleaned,
            'gambar' => $gambarPath,
        ]);

        return redirect()->route('kelolaMpasi')->with('success', 'Resep MPASI berhasil ditambahkan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mpasi = Mpasi::findOrFail($id);

        $request->validate([
            'nama_resep' => ['required', 'string', 'max:50', 'regex:/^[a-zA-Z\s]+$/', 'unique:mpasis,nama_resep,'.$id.',id_resep'],
            'kategori_usia' => ['required', 'string', 'in:6-8,9-11,12-23'],
            'waktu_memasak' => ['required', 'integer', 'min:1', 'max:100'],
            'porsi' => ['required', 'integer', 'min:1', 'max:10'],
            'kalori' => ['nullable', 'integer', 'min:0'],
            'karbohidrat' => ['nullable', 'integer', 'min:0'],
            'lemak' => ['nullable', 'integer', 'min:0'],
            'protein' => ['nullable', 'integer', 'min:0'],
            'zat_besi' => ['nullable', 'integer', 'min:0'],
            'seng' => ['nullable', 'integer', 'min:0'],
            'bahan' => ['required', 'array', 'min:1'],
            'bahan.*' => ['nullable', 'string'],
            'cara_pembuatan' => ['required', 'array', 'min:1'],
            'cara_pembuatan.*' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:3072'],
            'foto' => ['nullable', 'string', 'max:500'],
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
            'kalori.integer' => 'Nilai kalori harus berupa angka bulat (tanpa koma).',
            'kalori.min' => 'Nilai kalori tidak boleh kurang dari 0.',
            'karbohidrat.integer' => 'Nilai karbohidrat harus berupa angka bulat (tanpa koma).',
            'karbohidrat.min' => 'Nilai karbohidrat tidak boleh kurang dari 0.',
            'lemak.integer' => 'Nilai lemak harus berupa angka bulat (tanpa koma).',
            'lemak.min' => 'Nilai lemak tidak boleh kurang dari 0.',
            'protein.integer' => 'Nilai protein harus berupa angka bulat (tanpa koma).',
            'protein.min' => 'Nilai protein tidak boleh kurang dari 0.',
            'zat_besi.integer' => 'Nilai zat besi harus berupa angka bulat (tanpa koma).',
            'zat_besi.min' => 'Nilai zat besi tidak boleh kurang dari 0.',
            'seng.integer' => 'Nilai seng harus berupa angka bulat (tanpa koma).',
            'seng.min' => 'Nilai seng tidak boleh kurang dari 0.',
            'bahan.required' => 'Minimal 1 bahan wajib diisi.',
            'cara_pembuatan.required' => 'Minimal 1 langkah pembuatan wajib diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, webp, atau gif.',
            'gambar.max' => 'Ukuran gambar maksimal 3MB.',
        ]);

        if ($request->hasFile('gambar')) {
            if ($mpasi->gambar && str_starts_with($mpasi->gambar, '/storage/')) {
                $relative = str_replace('/storage/', '', $mpasi->gambar);
                Storage::disk('public')->delete($relative);
            }
            $path = $request->file('gambar')->store('mpasi', 'public');
            $mpasi->gambar = '/storage/'.$path;
        } elseif ($request->filled('foto')) {
            $mpasi->gambar = $request->foto;
        }

        $bahanCleaned = array_values(array_filter((array) $request->bahan, fn ($b) => trim((string) $b) !== ''));
        $langkahCleaned = array_values(array_filter((array) $request->cara_pembuatan, fn ($c) => trim((string) $c) !== ''));

        if (empty($bahanCleaned)) {
            return redirect()->back()->withErrors(['bahan' => 'Minimal 1 bahan harus diisi.'])->withInput();
        }

        if (empty($langkahCleaned)) {
            return redirect()->back()->withErrors(['cara_pembuatan' => 'Minimal 1 langkah pembuatan harus diisi.'])->withInput();
        }

        $mpasi->nama_resep = $request->nama_resep;
        $mpasi->kategori_usia = $request->kategori_usia;
        $mpasi->waktu_memasak = $request->waktu_memasak;
        $mpasi->porsi = $request->porsi;
        $mpasi->kalori = $request->filled('kalori') ? $request->kalori : 0;
        $mpasi->karbohidrat = $request->filled('karbohidrat') ? $request->karbohidrat : 0;
        $mpasi->lemak = $request->filled('lemak') ? $request->lemak : 0;
        $mpasi->protein = $request->filled('protein') ? $request->protein : 0;
        $mpasi->zat_besi = $request->filled('zat_besi') ? $request->zat_besi : 0;
        $mpasi->seng = $request->filled('seng') ? $request->seng : 0;
        $mpasi->bahan = $bahanCleaned;
        $mpasi->cara_pembuatan = $langkahCleaned;
        $mpasi->save();

        return redirect()->route('kelolaMpasi')->with('success', 'Resep MPASI berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mpasi = Mpasi::findOrFail($id);

        if ($mpasi->gambar && str_starts_with($mpasi->gambar, '/storage/')) {
            $relative = str_replace('/storage/', '', $mpasi->gambar);
            Storage::disk('public')->delete($relative);
        }

        $mpasi->delete();

        return redirect()->route('kelolaMpasi')->with('success', 'Resep MPASI berhasil dihapus!');
    }
}
