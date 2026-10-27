@extends('layouts.admin')

@section('title', 'Balita Milik Orang Tua')

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <a href="{{ route('kelolaUser') }}" class="inline-flex items-center gap-1 text-xs text-rose-700 hover:text-rose-900 mb-2">
                <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali
            </a>
            <h1 class="text-lg sm:text-xl font-bold text-stone-900">Daftar Balita</h1>
            <p class="text-xs text-stone-500 mt-1">Orang Tua: <span class="font-semibold text-stone-800">{{ $user->name }}</span> ({{ $user->email }})</p>
        </div>
        <span class="self-start rounded-lg bg-rose-50 px-3 py-2 text-xs font-semibold text-rose-700">{{ $balitas->total() }} balita terdaftar</span>
    </div>

    <section class="bg-white border border-stone-200 rounded-2xl overflow-hidden ">
        <div class="px-4 py-3 border-b border-stone-100 flex items-center gap-2">
            <i data-lucide="baby" class="w-4 h-4 text-rose-700"></i>
            <h2 class="font-bold text-sm">Balita milik {{ $user->name }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full min-w-[650px] text-left text-xs">
                <thead class="bg-stone-50 text-[10px] uppercase text-stone-500">
                    <tr>
                        <th class="px-4 py-3">Nama Balita</th>
                        <th class="px-4 py-3">NIK</th>
                        <th class="px-4 py-3">Tanggal Lahir</th>
                        <th class="px-4 py-3">Jenis Kelamin</th>
                        <th class="px-4 py-3">Pengukuran</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    @forelse($balitas as $anak)
                        <tr class="hover:bg-rose-50/40">
                            <td class="px-4 py-3 font-semibold text-stone-800">{{ $anak->nama_balita }}</td>
                            <td class="px-4 py-3 text-stone-600">{{ $anak->nik ?: '-' }}</td>
                            <td class="px-4 py-3 text-stone-600">{{ $anak->tanggal_lahir ? \Carbon\Carbon::parse($anak->tanggal_lahir)->translatedFormat('d M Y') : '-' }}</td>
                            <td class="px-4 py-3 text-stone-600">{{ $anak->jenis_kelamin }}</td>
                            <td class="px-4 py-3 text-stone-600">{{ $anak->pengukurans_count }} riwayat</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('users.balitas.riwayat', [$user, $anak]) }}" class="inline-flex items-center gap-1 rounded-lg border border-rose-200 px-3 py-2 text-[11px] font-semibold text-rose-700 hover:bg-rose-50">
                                    <i data-lucide="history" class="w-3.5 h-3.5"></i> Lihat Riwayat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="py-12 text-center text-stone-500">Orang tua ini belum memiliki data balita.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($balitas->hasPages())
            <div class="p-4 border-t border-stone-100">{{ $balitas->links() }}</div>
        @endif
    </section>
@endsection
