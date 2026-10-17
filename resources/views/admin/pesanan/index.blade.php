@extends('layouts.app')

@section('content')

{{-- Header --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-bag-check me-2 text-primary"></i>Kelola Pesanan</h4>
        <p class="text-muted mb-0 small">Pantau dan ubah status pesanan dari seluruh pelanggan.</p>
    </div>
</div>

{{-- Stat Pills --}}
<div class="row g-2 mb-4">
    <div class="col-6 col-md-3">
        <div class="card border-0 shadow-sm text-center py-2">
            <div class="fw-bold fs-4">{{ $totalPesanan }}</div>
            <div class="text-muted small">Semua</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-warning shadow-sm text-center py-2">
            <div class="fw-bold fs-4 text-warning">{{ $menunggu }}</div>
            <div class="text-muted small">Menunggu</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-info shadow-sm text-center py-2">
            <div class="fw-bold fs-4 text-info">{{ $diproses }}</div>
            <div class="text-muted small">Diproses</div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-success shadow-sm text-center py-2">
            <div class="fw-bold fs-4 text-success">{{ $selesai }}</div>
            <div class="text-muted small">Selesai</div>
        </div>
    </div>
</div>

{{-- Filter --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('admin.pesanan.index') }}" class="row g-2 align-items-end">
            <div class="col-md-5">
                <label class="form-label small fw-semibold mb-1">Cari Pelanggan</label>
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" name="search" class="form-control border-start-0"
                           placeholder="Nama pelanggan..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-semibold mb-1">Filter Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua Status</option>
                    @foreach($daftarStatus as $val => $label)
                        <option value="{{ $val }}" {{ request('status') === $val ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2">
                <button type="submit" class="btn btn-primary flex-fill">
                    <i class="bi bi-funnel me-1"></i> Filter
                </button>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Tabel Pesanan --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Berat</th>
                        <th>Total Biaya</th>
                        <th>Catatan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th class="pe-4 text-center">Ubah Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesanans as $index => $pesanan)
                        @php
                            $badgeColor = match($pesanan->status) {
                                'menunggu' => 'warning',
                                'diproses' => 'info',
                                'selesai'  => 'success',
                                'diambil'  => 'secondary',
                                default    => 'dark',
                            };
                        @endphp
                        <tr>
                            <td class="ps-4 text-muted small">{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-semibold">{{ $pesanan->user->name }}</div>
                                <div class="text-muted" style="font-size:.75rem">{{ $pesanan->user->email }}</div>
                            </td>
                            <td class="small">{{ $pesanan->layanan->nama_layanan }}</td>
                            <td class="small">{{ $pesanan->berat }} kg</td>
                            <td class="fw-semibold text-success small">
                                Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                            </td>
                            <td class="small text-muted">{{ $pesanan->catatan ?: '—' }}</td>
                            <td class="small text-muted">{{ $pesanan->created_at->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge bg-{{ $badgeColor }}">{{ $pesanan->labelStatus() }}</span>
                            </td>
                            <td class="pe-4 text-center">
                                <form action="{{ route('admin.pesanan.updateStatus', $pesanan) }}"
                                      method="POST" class="d-flex gap-1 justify-content-center">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select form-select-sm"
                                            style="width:auto; min-width:115px">
                                        @foreach($daftarStatus as $val => $label)
                                            <option value="{{ $val }}"
                                                    {{ $pesanan->status === $val ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary" title="Simpan">
                                        <i class="bi bi-check-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">
                                <i class="bi bi-inbox display-5 d-block mb-2"></i>
                                Tidak ada pesanan yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
