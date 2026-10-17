<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LayananController extends Controller
{
    private function dataLayanan()
    {
        return [
            [
                'id' => 1,
                'nama_layanan' => 'Cuci Reguler',
                'deskripsi' => 'Layanan cuci pakaian reguler.',
                'harga' => 7000,
            ],
            [
                'id' => 2,
                'nama_layanan' => 'Cuci Express',
                'deskripsi' => 'Layanan cuci pakaian lebih cepat.',
                'harga' => 12000,
            ],
            [
                'id' => 3,
                'nama_layanan' => 'Setrika',
                'deskripsi' => 'Layanan menyetrika pakaian.',
                'harga' => 5000,
            ],
        ];
    }

    public function index()
    {
        return view('admin.layanan.index', [
            'title' => 'Data Layanan Laundry',
            'layanans' => $this->dataLayanan(),
        ]);
    }

    public function create()
    {
        return view('admin.layanan.create', [
            'title' => 'Tambah Layanan',
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Simulasi tambah layanan berhasil. Data belum disimpan.');
    }

    public function edit($id)
    {
        $layanan = collect($this->dataLayanan())->firstWhere('id', (int) $id);

        abort_if(!$layanan, 404);

        return view('admin.layanan.edit', [
            'title' => 'Edit Layanan',
            'layanan' => $layanan,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_layanan' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ]);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Simulasi edit layanan berhasil. Data belum disimpan.');
    }

    public function destroy($id)
    {
        return redirect()->route('admin.layanan.index')
            ->with('success', 'Simulasi hapus layanan berhasil. Data belum dihapus.');
    }
}