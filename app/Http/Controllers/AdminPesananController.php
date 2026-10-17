<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPesananController extends Controller
{
    /**
     * Tampilkan semua pesanan dari seluruh pelanggan.
     */
    public function index(Request $request): View
    {
        $query = Pesanan::with(['user', 'layanan'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $query->whereHas('user', fn ($q) => $q->where('name', 'like', '%'.$request->search.'%'));
        }

        $pesanans = $query->get();
        $totalPesanan = Pesanan::count();
        $menunggu = Pesanan::where('status', 'menunggu')->count();
        $diproses = Pesanan::where('status', 'diproses')->count();
        $selesai = Pesanan::where('status', 'selesai')->count();

        return view('admin.pesanan.index', [
            'title' => 'Kelola Pesanan',
            'pesanans' => $pesanans,
            'totalPesanan' => $totalPesanan,
            'menunggu' => $menunggu,
            'diproses' => $diproses,
            'selesai' => $selesai,
            'daftarStatus' => Pesanan::daftarStatus(),
        ]);
    }

    /**
     * Update status pesanan oleh admin.
     */
    public function updateStatus(Request $request, Pesanan $pesanan): RedirectResponse
    {
        $data = $request->validate([
            'status' => 'required|in:menunggu,diproses,selesai,diambil',
        ], [
            'status.required' => 'Status wajib dipilih.',
            'status.in' => 'Status tidak valid.',
        ]);

        $pesanan->update(['status' => $data['status']]);

        return redirect()->route('admin.pesanan.index')
            ->with('success', "Status pesanan #{$pesanan->id} berhasil diubah menjadi \"{$pesanan->labelStatus()}\".");
    }
}
