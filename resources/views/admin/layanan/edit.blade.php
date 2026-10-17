@extends('layouts.app')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.layanan.index') }}" class="text-decoration-none">
        <i class="bi bi-arrow-left"></i> Kembali ke daftar layanan
    </a>
    <h3 class="fw-bold text-primary mt-3">Edit Layanan</h3>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.layanan.update', $layanan['id']) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama_layanan" class="form-label">Nama Layanan</label>
                <input type="text"
                       name="nama_layanan"
                       id="nama_layanan"
                       class="form-control @error('nama_layanan') is-invalid @enderror"
                       value="{{ old('nama_layanan', $layanan['nama_layanan']) }}"
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
                          rows="3">{{ old('deskripsi', $layanan['deskripsi']) }}</textarea>
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
                       value="{{ old('harga', $layanan['harga']) }}"
                       min="0"
                       step="0.01"
                       required>
                @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
            <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary">
                Batal
            </a>
        </form>
    </div>
</div>
@endsection