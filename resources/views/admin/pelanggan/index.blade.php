@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1"><i class="bi bi-people me-2 text-primary"></i>Data Pelanggan</h4>
        <p class="text-muted mb-0 small">Daftar seluruh pelanggan dan ringkasan aktivitas pesanan mereka.</p>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th class="text-center">Total Pesanan</th>
                        <th class="text-end">Total Transaksi</th>
                        <th>Terdaftar</th>
                        <th class="pe-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelangganList as $index => $pelanggan)
                        <tr>
                            <td class="ps-4 text-muted small">{{ $index + 1 }}</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-circle-sm">
                                        {{ strtoupper(substr($pelanggan->name, 0, 1)) }}
                                    </div>
                                    <span class="fw-semibold">{{ $pelanggan->name }}</span>
                                </div>
                            </td>
                            <td class="text-muted small">{{ $pelanggan->email }}</td>
                            <td class="text-center">
                                <span class="badge bg-primary rounded-pill">{{ $pelanggan->pesanans_count }}</span>
                            </td>
                            <td class="text-end fw-semibold text-success small">
                                Rp {{ number_format($pelanggan->pesanans_sum_total_biaya ?? 0, 0, ',', '.') }}
                            </td>
                            <td class="text-muted small">{{ $pelanggan->created_at->format('d/m/Y') }}</td>
                            <td class="pe-4 text-center">
                                <a href="{{ route('admin.pelanggan.riwayat', $pelanggan) }}"
                                   class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-clock-history me-1"></i> Riwayat
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-5">
                                <i class="bi bi-people display-5 d-block mb-2"></i>
                                Belum ada pelanggan terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .avatar-circle-sm {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background: linear-gradient(135deg, #1a6fc4, #38b2e0);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: .75rem;
        flex-shrink: 0;
    }
</style>

@endsection
