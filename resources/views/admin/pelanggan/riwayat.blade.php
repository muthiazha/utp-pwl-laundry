@extends('layouts.app')

@section('content')

{{-- Back + Header --}}
<div class="mb-4">
    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-sm btn-outline-secondary mb-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Pelanggan
    </a>

    <div class="card border-0 shadow-sm">
        <div class="card-body d-flex align-items-center gap-3 py-3">
            <div class="avatar-circle-lg">{{ strtoupper(substr($pelanggan->name, 0, 1)) }}</div>
            <div>
                <h5 class="fw-bold mb-1">{{ $pelanggan->name }}</h5>
                <div class="text-muted small">{{ $pelanggan->email }}</div>
                <span class="badge bg-primary mt-1">Pelanggan</span>
            </div>
            <div class="ms-auto text-end">
                <div class="text-muted small">Total Pesanan</div>
                <div class="fw-bold fs-4">{{ $pesanans->count() }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Riwayat --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-0 pt-3 px-4">
        <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Riwayat Pesanan</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Layanan</th>
                        <th>Berat</th>
                        <th>Total Biaya</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th class="pe-4">Tanggal</th>
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
                            <td class="fw-semibold">{{ $pesanan->layanan->nama_layanan }}</td>
                            <td class="small">{{ $pesanan->berat }} kg</td>
                            <td class="fw-semibold text-success small">
                                Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                            </td>
                            <td class="small text-muted">{{ $pesanan->catatan ?: '—' }}</td>
                            <td><span class="badge bg-{{ $badgeColor }}">{{ $pesanan->labelStatus() }}</span></td>
                            <td class="pe-4 small text-muted">{{ $pesanan->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-inbox display-5 d-block mb-2"></i>
                                Pelanggan ini belum memiliki pesanan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .avatar-circle-lg {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a6fc4, #38b2e0);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
</style>

@endsection
