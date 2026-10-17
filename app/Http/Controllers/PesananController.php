<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use App\Models\Pesanan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PesananController extends Controller
{
    /**
     * Tampilkan daftar pesanan milik pelanggan yang login.
     */
    public function index(): View
    {
        $pesanans = Pesanan::with('layanan')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pelanggan.pesanan.index', [
            'title' => 'Pesanan Saya',
            'pesanans' => $pesanans,
        ]);
    }

    /**
     * Tampilkan form tambah pesanan baru.
     */
    public function create(): View
    {
        $layanans = Layanan::orderBy('nama_layanan')->get();

        return view('pelanggan.pesanan.create', [
            'title' => 'Buat Pesanan Baru',
            'layanans' => $layanans,
        ]);
    }

    /**
     * Simpan pesanan baru ke database.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'layanan_id' => 'required|exists:layanans,id',
            'berat' => 'required|numeric|min:0.1|max:100',
            'catatan' => 'nullable|string|max:500',
        ], [
            'layanan_id.required' => 'Pilih layanan terlebih dahulu.',
            'layanan_id.exists' => 'Layanan tidak valid.',
            'berat.required' => 'Berat cucian wajib diisi.',
            'berat.numeric' => 'Berat harus berupa angka.',
            'berat.min' => 'Berat minimal 0.1 kg.',
            'berat.max' => 'Berat maksimal 100 kg.',
        ]);

        $layanan = Layanan::findOrFail($data['layanan_id']);
        $totalBiaya = Pesanan::hitungTotalBiaya($layanan, (float) $data['berat']);

        Pesanan::create([
            'user_id' => auth()->id(),
            'layanan_id' => $data['layanan_id'],
            'berat' => $data['berat'],
            'total_biaya' => $totalBiaya,
            'catatan' => $data['catatan'] ?? null,
            'status' => 'menunggu',
        ]);

        return redirect()->route('pelanggan.pesanan.index')
            ->with('success', 'Pesanan berhasil dibuat!');
    }

    /**
     * Tampilkan form edit pesanan.
     * Hanya pesanan dengan status "menunggu" yang boleh diedit.
     */
    public function edit(Pesanan $pesanan): View|RedirectResponse
    {
        $this->authorizeOwner($pesanan);

        if ($pesanan->status !== 'menunggu') {
            return redirect()->route('pelanggan.pesanan.index')
                ->with('error', 'Pesanan yang sudah diproses tidak dapat diedit.');
        }

        $layanans = Layanan::orderBy('nama_layanan')->get();

        return view('pelanggan.pesanan.edit', [
            'title' => 'Edit Pesanan',
            'pesanan' => $pesanan,
            'layanans' => $layanans,
        ]);
    }

    /**
     * Perbarui data pesanan.
     */
    public function update(Request $request, Pesanan $pesanan): RedirectResponse
    {
        $this->authorizeOwner($pesanan);

        if ($pesanan->status !== 'menunggu') {
            return redirect()->route('pelanggan.pesanan.index')
                ->with('error', 'Pesanan yang sudah diproses tidak dapat diedit.');
        }

        $data = $request->validate([
            'layanan_id' => 'required|exists:layanans,id',
            'berat' => 'required|numeric|min:0.1|max:100',
            'catatan' => 'nullable|string|max:500',
        ], [
            'layanan_id.required' => 'Pilih layanan terlebih dahulu.',
            'layanan_id.exists' => 'Layanan tidak valid.',
            'berat.required' => 'Berat cucian wajib diisi.',
            'berat.numeric' => 'Berat harus berupa angka.',
            'berat.min' => 'Berat minimal 0.1 kg.',
            'berat.max' => 'Berat maksimal 100 kg.',
        ]);

        $layanan = Layanan::findOrFail($data['layanan_id']);
        $totalBiaya = Pesanan::hitungTotalBiaya($layanan, (float) $data['berat']);

        $pesanan->update([
            'layanan_id' => $data['layanan_id'],
            'berat' => $data['berat'],
            'total_biaya' => $totalBiaya,
            'catatan' => $data['catatan'] ?? null,
        ]);

        return redirect()->route('pelanggan.pesanan.index')
            ->with('success', 'Pesanan berhasil diperbarui!');
    }

    /**
     * Hapus pesanan.
     * Hanya pesanan dengan status "menunggu" yang boleh dihapus.
     */
    public function destroy(Pesanan $pesanan): RedirectResponse
    {
        $this->authorizeOwner($pesanan);

        if ($pesanan->status !== 'menunggu') {
            return redirect()->route('pelanggan.pesanan.index')
                ->with('error', 'Pesanan yang sudah diproses tidak dapat dihapus.');
        }

        $pesanan->delete();

        return redirect()->route('pelanggan.pesanan.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    /**
     * Pastikan pesanan milik user yang sedang login.
     */
    private function authorizeOwner(Pesanan $pesanan): void
    {
        abort_if($pesanan->user_id !== auth()->id(), 403, 'Akses ditolak.');
    }
}
