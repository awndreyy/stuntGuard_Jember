<?php

namespace App\Http\Controllers;

use App\Models\Balita;
use App\Models\Informasi;
use App\Models\Mpasi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route(Auth::user()->role === 'Admin' ? 'dashboardAdmin' : 'dashboardUser');
        }

        return view('landing.dashboardGuest', [
            'jumlahBalita' => Balita::count(),
            'jumlahResep' => Mpasi::count(),
            'jumlahArtikel' => Informasi::count(),
            'resepTerbaru' => Mpasi::orderByDesc('created_at')->orderByDesc('id_resep')->limit(3)->get(),
            'artikelTerbaru' => Informasi::orderByDesc('created_at')->orderByDesc('id_informasi')->limit(4)->get(),
        ]);
    }

    public function informasi(): View
    {
        return view('landing.informasi.index', [
            'artikel' => Informasi::orderByDesc('created_at')->orderByDesc('id_informasi')->paginate(12),
        ]);
    }

    public function detailInformasi(Informasi $informasi): View
    {
        return view('landing.informasi.show', compact('informasi'));
    }

    public function resep(): View
    {
        return view('landing.resep.index', [
            'resep' => Mpasi::orderByDesc('created_at')->orderByDesc('id_resep')->paginate(9),
        ]);
    }

    public function detailResep(Mpasi $mpasi): View
    {
        return view('landing.resep.show', ['resep' => $mpasi]);
    }
}
