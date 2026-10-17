<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class AdminPelangganController extends Controller
{
    /**
     * Tampilkan daftar semua pelanggan beserta ringkasan pesanannya.
     */
    public function index(): View
    {
        $pelangganList = User::where('role', 'pelanggan')
            ->withCount('pesanans')
            ->withSum('pesanans', 'total_biaya')
            ->latest()
            ->get();

        return view('admin.pelanggan.index', [
            'title' => 'Data Pelanggan',
            'pelangganList' => $pelangganList,
        ]);
    }

    /**
     * Tampilkan riwayat pesanan milik satu pelanggan.
     */
    public function riwayat(User $pelanggan): View
    {
        abort_if($pelanggan->role !== 'pelanggan', 404);

        $pesanans = $pelanggan->pesanans()
            ->with('layanan')
            ->latest()
            ->get();

        return view('admin.pelanggan.riwayat', [
            'title' => "Riwayat Pesanan – {$pelanggan->name}",
            'pelanggan' => $pelanggan,
            'pesanans' => $pesanans,
        ]);
    }
}
