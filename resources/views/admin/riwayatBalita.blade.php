@extends('layouts.admin')

@section('title', 'Riwayat Pengukuran Balita')

@section('content')
<div class="space-y-5">
    <div>
        <a href="{{ ($backUrl ?? route('detailBalita', $user)) }}" class="mb-2 inline-flex items-center gap-1 text-xs text-rose-700 hover:text-rose-900">
            <i data-lucide="arrow-left" class="h-3.5 w-3.5"></i>
            Kembali
        </a>
        <h1 class="text-lg font-bold text-stone-900 sm:text-xl">Riwayat Pengukuran</h1>
        <p class="mt-1 text-xs text-stone-500">Balita: <span class="font-semibold text-stone-800">{{ $balita->nama_balita }}</span> · Orang Tua: {{ $user->name }}</p>
    </div>

    <section class="overflow-hidden rounded-2xl border border-stone-200 bg-white">
        <div class="flex items-center justify-between border-b border-stone-100 px-4 py-3">
            <div class="flex items-center gap-2">
                <i data-lucide="clipboard-list" class="h-4 w-4 text-rose-700"></i>
                <h2 class="text-sm font-bold text-stone-900">Daftar Riwayat Pengukuran</h2>
            </div>
            <span class="rounded-lg bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-700">{{ $riwayat->total() }} pengukuran</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1000px] text-left text-xs">
                <thead class="bg-stone-50 text-[10px] uppercase text-stone-500">
                    <tr>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Jenis Kelamin</th>
                        <th class="px-4 py-3">Umur</th>
                        <th class="px-4 py-3">Tanggal Pengukuran</th>
                        <th class="px-4 py-3">Hasil Pengukuran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse ($riwayat as $ukur)
                        @php
                            $zTinggi = $ukur->z_score_tbu;
                            $status = is_null($zTinggi) ? 'Tidak tersedia' : ($zTinggi < -3 ? 'Sangat Pendek' : ($zTinggi < -2 ? 'Pendek' : ($zTinggi <= 3 ? 'Normal' : 'Tinggi')));
                        @endphp
                        <tr class="align-top hover:bg-rose-50/40">
                            <td class="px-4 py-3 font-semibold text-stone-800">{{ $ukur->nama_balita ?: $balita->nama_balita }}</td>
                            <td class="px-4 py-3 text-stone-600">{{ $ukur->jenis_kelamin ?: $balita->jenis_kelamin }}</td>
                            <td class="px-4 py-3 text-stone-600">{{ $ukur->umur_bulan }} bulan</td>
                            <td class="px-4 py-3 text-stone-600">{{ $ukur->tanggal_pengukuran?->translatedFormat('d M Y') ?? '-' }}</td>
                            <td class="px-4 py-3 text-stone-700">
                                <div class="space-y-1">
                                    <p>BB: <span class="font-semibold">{{ number_format((float) $ukur->berat_badan, 2, ',', '.') }} kg</span> · PB/TB: <span class="font-semibold">{{ number_format((float) $ukur->tinggi_badan, 2, ',', '.') }} cm</span></p>
                                    <p>Z-score BB/U: {{ $ukur->z_score_bbu === null ? '-' : number_format((float) $ukur->z_score_bbu, 2, ',', '.') }} SD · PB/TB/U: {{ $zTinggi === null ? '-' : number_format((float) $zTinggi, 2, ',', '.') }} SD</p>
                                    <p>Z-score BB/PB atau BB/TB: {{ $ukur->z_score_bbtb === null ? '-' : number_format((float) $ukur->z_score_bbtb, 2, ',', '.') }} SD</p>
                                    <p>Status PB/TB/U: <span class="font-semibold">{{ $status }}</span></p>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="py-12 text-center text-stone-500">Belum ada riwayat pengukuran untuk balita ini.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($riwayat->hasPages())
            <div class="border-t border-stone-100 p-4">{{ $riwayat->links() }}</div>
        @endif
    </section>
</div>
@endsection
