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
<body class="bg-[#FFFBFC] font-sans text-stone-800 min-h-screen flex flex-col antialiased selection:bg-pink-200 selection:text-pink-900">
    <x-guest.navbar />
    <main class="w-full flex-1 pt-20" id="beranda">
      @yield('content')
    </main>
    <x-guest.footer />
    @stack('scripts')
</body>
</html>
