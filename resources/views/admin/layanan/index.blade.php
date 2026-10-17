@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold text-primary mb-1">Layanan Laundry</h3>
        <p class="text-muted mb-0">Kelola daftar layanan dan harga laundry.</p>
    </div>

    <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Tambah Layanan
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No.</th>
                        <th>Nama Layanan</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($layanans as $layanan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="fw-semibold">{{ $layanan['nama_layanan'] }}</td>
                            <td>{{ $layanan['deskripsi'] ?: '-' }}</td>
                            <td>Rp {{ number_format($layanan['harga'], 0, ',', '.') }}</td>
                            <td class="text-center text-nowrap">
                                <a href="{{ route('admin.layanan.edit', $layanan['id']) }}"
                                   class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>

                                <form action="{{ route('admin.layanan.destroy', $layanan['id']) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Ini hanya simulasi. Lanjutkan?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada data layanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection