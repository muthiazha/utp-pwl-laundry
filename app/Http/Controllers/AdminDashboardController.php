<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalPelanggan = User::where('role', 'pelanggan')->count();
        $totalLayanan = Layanan::count();
        $totalPesanan = Pesanan::count();
        $totalOmzet = Pesanan::where('status', '!=', 'menunggu')->sum('total_biaya');

        $pesananTerbaru = Pesanan::with(['user', 'layanan'])
            ->latest()
            ->take(5)
            ->get();

        $statusRingkasan = [
            'menunggu' => Pesanan::where('status', 'menunggu')->count(),
            'diproses' => Pesanan::where('status', 'diproses')->count(),
            'selesai' => Pesanan::where('status', 'selesai')->count(),
            'diambil' => Pesanan::where('status', 'diambil')->count(),
        ];

        return view('admin.dashboard', [
            'title' => 'Dashboard Admin',
            'totalPelanggan' => $totalPelanggan,
            'totalLayanan' => $totalLayanan,
            'totalPesanan' => $totalPesanan,
            'totalOmzet' => $totalOmzet,
            'pesananTerbaru' => $pesananTerbaru,
            'statusRingkasan' => $statusRingkasan,
        ]);
    }
}
