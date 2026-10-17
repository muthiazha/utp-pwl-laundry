<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
use Illuminate\View\View;

class PelangganDashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard pelanggan dengan data ringkasan pesanan & layanan.
     */
    public function index(): View
    {
        $user = auth()->user();

        $layanans = Layanan::orderBy('harga', 'asc')->get();

        $pesanansAktif = Pesanan::with('layanan')
            ->where('user_id', $user->id)
            ->whereIn('status', ['menunggu', 'diproses'])
            ->latest()
            ->get();

        $pesananTerbaru = Pesanan::with('layanan')
            ->where('user_id', $user->id)
            ->latest()
            ->take(4)
            ->get();

        $totalPesanan = Pesanan::where('user_id', $user->id)->count();
        $totalAktif = $pesanansAktif->count();
        $totalSelesai = Pesanan::where('user_id', $user->id)
            ->whereIn('status', ['selesai', 'diambil'])
            ->count();
        $totalPengeluaran = (float) Pesanan::where('user_id', $user->id)
            ->whereIn('status', ['selesai', 'diambil'])
            ->sum('total_biaya');

        return view('pelanggan.dashboard', [
            'title' => 'Dashboard Pelanggan',
            'layanans' => $layanans,
            'pesanansAktif' => $pesanansAktif,
            'pesananTerbaru' => $pesananTerbaru,
            'totalPesanan' => $totalPesanan,
            'totalAktif' => $totalAktif,
            'totalSelesai' => $totalSelesai,
            'totalPengeluaran' => $totalPengeluaran,
        ]);
    }
}
