<?php

namespace App\Http\Controllers;

use App\Models\Mpasi;
use App\Models\Pengukuran;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->query('kategori', 'semua');
        if (! in_array($kategori, ['semua', '6-8', '9-11', '12-23'], true)) {
            $kategori = 'semua';
        }

        $resepList = Mpasi::query()
            ->when($kategori !== 'semua', fn ($q) => $q->where('kategori_usia', $kategori))
            ->latest('id_resep')
            ->limit(10)
            ->get();

        // Hanya riwayat balita terdaftar, bukan simulasi kalkulator tamu.
        $latestMeasurements = Pengukuran::query()
            ->whereNotNull('balita_id')
            ->whereNotExists(function ($query) {
                $query->selectRaw('1')
                    ->from('pengukurans as lebih_baru')
                    ->whereColumn('lebih_baru.balita_id', 'pengukurans.balita_id')
                    ->where(function ($q) {
                        $q->whereColumn('lebih_baru.tanggal_pengukuran', '>', 'pengukurans.tanggal_pengukuran')
                            ->orWhere(function ($sameDay) {
                                $sameDay->whereColumn('lebih_baru.tanggal_pengukuran', '=', 'pengukurans.tanggal_pengukuran')
                                    ->whereColumn('lebih_baru.id', '>', 'pengukurans.id');
                            });
                    });
            });

        return view('admin.dashboardAdmin', [
            'totalUsers' => User::where('role', 'Orang Tua')->count(),
            'totalStunting' => (clone $latestMeasurements)->where('z_score_tbu', '<', -2)->count(),
            'totalResep' => Mpasi::count(),
            'resepList' => $resepList,
            'kategori' => $kategori,
            'logGiziList' => Pengukuran::query()
                ->with('balita')
                ->whereNotNull('balita_id')
                ->orderByDesc('tanggal_pengukuran')
                ->orderByDesc('id')
                ->limit(10)
                ->get(),
        ]);
    }
}
