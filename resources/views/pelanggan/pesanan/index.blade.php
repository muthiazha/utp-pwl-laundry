@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="fw-bold text-primary mb-0">
        <i class="bi bi-bag-check"></i> Pesanan Saya
    </h3>
    <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Buat Pesanan Baru
    </a>
</div>

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($pesanans->isEmpty())
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <i class="bi bi-inbox display-4 text-muted"></i>
            <p class="mt-3 text-muted">Belum ada pesanan. Yuk buat pesanan pertama Anda!</p>
            <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Buat Pesanan
            </a>
        </div>
    </div>
@else
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">#</th>
                            <th>Layanan</th>
                            <th>Berat (kg)</th>
                            <th>Total Biaya</th>
                            <th>Status</th>
                            <th>Catatan</th>
                            <th>Tanggal</th>
                            <th class="text-center pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanans as $index => $pesanan)
                            <tr>
                                <td class="ps-3">{{ $index + 1 }}</td>
                                <td class="fw-semibold">{{ $pesanan->layanan->nama_layanan }}</td>
                                <td>{{ $pesanan->berat }} kg</td>
                                <td class="fw-bold text-success">
                                    Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                                </td>
                                <td>
                                    @php
                                        $badgeColor = match($pesanan->status) {
                                            'menunggu' => 'warning',
                                            'diproses' => 'info',
                                            'selesai'  => 'success',
                                            'diambil'  => 'secondary',
                                            default    => 'dark',
                                        };
                                    @endphp
                                    <span class="badge bg-{{ $badgeColor }}">
                                        {{ $pesanan->labelStatus() }}
                                    </span>
                                </td>
                                <td>{{ $pesanan->catatan ?? '-' }}</td>
                                <td>{{ $pesanan->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center pe-3">
                                    @if ($pesanan->status === 'menunggu')
                                        <a href="{{ route('pelanggan.pesanan.edit', $pesanan) }}"
                                           class="btn btn-sm btn-outline-primary me-1"
                                           title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('pelanggan.pesanan.destroy', $pesanan) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif
@endsection
