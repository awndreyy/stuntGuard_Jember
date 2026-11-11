@extends('layouts.admin')

@section('title', 'Kelola Informasi & Edukasi')

@section('content')
    @php
        $editInformation = $editInformation ?? null;
    @endphp


    @if (isset($errors) && $errors->any())
        <div class="space-y-1 rounded-xl border border-pink-200 bg-pink-50 p-4 text-xs text-pink-800">
            <p class="font-bold">Gagal menyimpan data:</p>
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="flex shrink-0 flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="flex items-center gap-2 text-lg font-bold tracking-tight text-stone-900 sm:text-xl">
                Kelola Informasi & Edukasi
            </h1>
            <p class="mt-0.5 text-xs text-stone-500">
                Artikel kesehatan, panduan trimester, dan materi pencegahan stunting.
            </p>
        </div>
        <button onclick="tambahInformasi()" type="button" class="inline-flex w-full cursor-pointer items-center justify-center gap-1.5 rounded-xl bg-brand px-4 py-2 text-xs font-semibold text-white shadow-sm transition-all hover:bg-brand-hover hover:shadow sm:w-auto">
            <i data-lucide="plus-circle" class="h-4 w-4"></i>
            <span>Tambah Informasi Baru</span>
        </button>
    </div>

    <div class="flex flex-col gap-3">
        <div class="overflow-hidden rounded-2xl border border-stone-200 bg-white">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[720px] border-collapse text-left">
                    <thead class="border-b border-stone-200 bg-stone-50/80 text-[11px] font-bold uppercase tracking-wider text-stone-400">
                        <tr>
                            <th class="p-4 pl-6">Judul Artikel</th>
                            <th class="p-4">Kategori</th>
                            <th class="p-4">Ringkasan</th>
                            <th class="p-4">Tanggal Buat</th>
                            <th class="p-4 pr-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 text-xs">
                        @forelse ($informations ?? [] as $item)
                            <tr class="pagination-informasi-row transition-colors hover:bg-stone-50/60">
                                <td class="max-w-xs truncate p-4 pl-6 font-semibold text-stone-800">
                                    {{ $item->title ?? $item->judul ?? '-' }}
                                </td>
                                <td class="p-4 text-stone-600">
                                    <span class="rounded-lg bg-pink-50 px-2.5 py-1 text-[11px] font-medium text-pink-700">
                                        {{ $item->category ?? $item->kategori ?? 'Edukasi' }}
                                    </span>
                                </td>
                                <td class="max-w-xs truncate p-4 text-stone-500">
                                    {{ $item->summary ?? $item->ringkasan ?? '-' }}
                                </td>
                                <td class="p-4 text-[11px] text-stone-400">
                                    {{ isset($item->created_at) ? $item->created_at->format('d M Y') : '-' }}
                                </td>
                                <td class="p-4 pr-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button" onclick="editInformasi({{ json_encode($item) }})" class="cursor-pointer rounded-lg p-2 text-stone-400 transition-colors hover:bg-pink-50 hover:text-pink-700" title="Edit informasi">
                                            <i data-lucide="pencil" class="h-4 w-4"></i>
                                        </button>
                                        <form action="{{ route('kelolaInformasi.destroy', $item->id_informasi ?? $item->id) }}" method="POST" data-confirm="delete" data-confirm-name="{{ $item->judul }}" data-confirm-kind="informasi" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cursor-pointer rounded-lg p-2 text-stone-400 transition-colors hover:bg-pink-50 hover:text-pink-600" title="Hapus informasi">
                                                <i data-lucide="trash-2" class="h-4 w-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-xs text-stone-400">
                                    Belum ada data informasi. Klik tombol <b>"Tambah Informasi Baru"</b> untuk menambahkan data.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @include('admin.partials.pagination', ['paginator' => $informations, 'label' => 'artikel'])
    </div>
    <x-admin.modalTambahInformasi :editInformation="$editInformation" />
@endsection

