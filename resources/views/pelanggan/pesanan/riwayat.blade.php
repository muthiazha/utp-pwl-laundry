@extends('layouts.app')

@section('content')

{{-- Header Halaman --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <div class="d-inline-flex align-items-center gap-1 text-success fw-bold small text-uppercase mb-1" style="letter-spacing: 0.5px;">
            <i class="bi bi-clock-history"></i> Arsip Transaksi
        </div>
        <h3 class="fw-bold text-dark mb-1">Riwayat Transaksi</h3>
        <p class="text-muted small mb-0">Daftar cucian Anda yang telah berhasil diselesaikan atau telah diambil di outlet.</p>
    </div>
    <div>
        <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-circle-fill me-1"></i> Buat Pesanan Baru
        </a>
    </div>
</div>

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper d-inline-flex align-items-center justify-content-center" style="background:#d1fae5; color:#059669; width:54px; height:54px; border-radius:18px; flex-shrink:0;">
                    <i class="bi bi-check2-circle fs-2" style="line-height:1;"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Cucian Selesai & Diambil</div>
                    <div class="fw-extrabold fs-3 text-dark">{{ $totalSelesai }} <span class="fs-6 text-muted fw-normal">transaksi</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper d-inline-flex align-items-center justify-content-center" style="background:#ecfdf5; color:#10b981; width:54px; height:54px; border-radius:18px; flex-shrink:0;">
                    <i class="bi bi-wallet2 fs-2" style="line-height:1;"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Total Pengeluaran Laundry</div>
                    <div class="fw-extrabold fs-3 text-success">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Riwayat --}}
@if ($pesanans->isEmpty())
    <div class="card border-0 shadow-sm">
        <div class="card-body text-center py-5">
            <div class="mx-auto mb-3" style="width: 80px; height: 80px; background: #f0fdf4; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-receipt display-5 text-muted opacity-50"></i>
            </div>
            <h5 class="fw-bold text-dark">Belum Ada Riwayat Transaksi Selesai</h5>
            <p class="text-muted small mb-4" style="max-width: 420px; margin: 0 auto;">
                Transaksi yang sudah selesai atau diambil oleh Anda akan otomatis tercatat dan tersimpan rapi di halaman ini.
            </p>
            <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-outline-success rounded-pill px-4">
                <i class="bi bi-bag-check me-1"></i> Cek Pesanan Aktif
            </a>
        </div>
    </div>
@else
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-header bg-white border-0 py-3 px-4">
            <h6 class="fw-bold mb-0 text-dark">
                <i class="bi bi-list-check me-2 text-success"></i>Daftar Riwayat Transaksi
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background: #f8fafc; border-bottom: 1.5px solid #e2e8f0;">
                        <tr>
                            <th class="ps-4 py-3 small text-uppercase text-muted fw-bold">No.</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Kode Transaksi</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Layanan</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold text-center">Berat</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Total Biaya</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Status</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Tanggal</th>
                            <th class="text-center pe-4 py-3 small text-uppercase text-muted fw-bold">Struk</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanans as $index => $pesanan)
                            <tr>
                                <td class="ps-4 text-muted small">{{ $index + 1 }}</td>
                                <td class="fw-bold text-dark">{{ $pesanan->kode_pesanan }}</td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $pesanan->layanan->nama_layanan }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill fw-semibold">
                                        {{ $pesanan->berat }} kg
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-success">
                                        Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-pill-status badge-status-{{ $pesanan->status }}">
                                        @if($pesanan->status === 'selesai')
                                            <i class="bi bi-check2-circle"></i>
                                        @else
                                            <i class="bi bi-bag-check-fill"></i>
                                        @endif
                                        {{ $pesanan->labelStatus() }}
                                    </span>
                                </td>
                                <td class="text-muted small">{{ $pesanan->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center pe-4">
                                    <a href="{{ route('pelanggan.pesanan.show', $pesanan) }}"
                                       class="btn btn-sm btn-outline-success rounded-pill px-3"
                                       title="Lihat Struk / Detail">
                                        <i class="bi bi-receipt me-1"></i> Lihat Struk
                                    </a>
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
