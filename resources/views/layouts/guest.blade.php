<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="StuntGuard Jember: edukasi tumbuh kembang anak, informasi kesehatan, dan resep MPASI.">
    <title>@yield('title', 'StuntGuard Jember - Pemantauan Gizi Balita')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="sg-guest bg-brand-canvas font-sans text-stone-800 min-h-screen flex flex-col antialiased selection:bg-pink-200 selection:text-pink-900">
    <a class="sg-skip" href="#guest-content">Lewati navigasi</a>
    <x-guest.navbar />
    <main tabindex="-1" class="w-full flex-1 pt-20" id="beranda">
      <div id="guest-content">@yield('content')</div>
    </main>
    <x-guest.footer />
    @stack('scripts')
</body>
</html>
