<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::latest()->get();

        return view('admin.layanan.index', [
            'title' => 'Data Layanan Laundry',
            'layanans' => $layanans,
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
        $data = $request->validate([
            'nama_layanan' => 'required|string|max:100|unique:layanans,nama_layanan',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ], [
            'nama_layanan.required' => 'Nama layanan wajib diisi.',
            'nama_layanan.unique' => 'Nama layanan sudah tersedia.',
            'nama_layanan.max' => 'Nama layanan maksimal 100 karakter.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ]);

        Layanan::create($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', [
            'title' => 'Edit Layanan',
            'layanan' => $layanan,
        ]);
    }

    public function update(Request $request, Layanan $layanan)
    {
        $data = $request->validate([
            'nama_layanan' => [
                'required',
                'string',
                'max:100',
                Rule::unique('layanans', 'nama_layanan')->ignore($layanan->id),
            ],
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ], [
            'nama_layanan.required' => 'Nama layanan wajib diisi.',
            'nama_layanan.unique' => 'Nama layanan sudah digunakan.',
            'nama_layanan.max' => 'Nama layanan maksimal 100 karakter.',
            'harga.required' => 'Harga wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ]);

        $layanan->update($data);

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}