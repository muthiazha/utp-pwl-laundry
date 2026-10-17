@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.layanan.index') }}" class="text-decoration-none">
        <i class="bi bi-arrow-left"></i> Kembali ke daftar layanan
    </a>
    <h3 class="fw-bold text-primary mt-3">Tambah Layanan</h3>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.layanan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama_layanan" class="form-label">Nama Layanan</label>
                <input type="text"
                       name="nama_layanan"
                       id="nama_layanan"
                       class="form-control @error('nama_layanan') is-invalid @enderror"
                       value="{{ old('nama_layanan') }}"
                       placeholder="Contoh: Cuci Kering"
                       required>
                @error('nama_layanan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          id="deskripsi"
                          class="form-control @error('deskripsi') is-invalid @enderror"
                          rows="3"
                          placeholder="Keterangan layanan (opsional)">{{ old('deskripsi') }}</textarea>
                @error('deskripsi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="harga" class="form-label">Harga (Rp)</label>
                <input type="number"
                       name="harga"
                       id="harga"
                       class="form-control @error('harga') is-invalid @enderror"
                       value="{{ old('harga') }}"
                       min="0"
                       step="0.01"
                       placeholder="Contoh: 7000"
                       required>
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan Layanan
            </button>
            <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">
                Batal
            </a>
        </form>
    </div>
</div>
@endsection