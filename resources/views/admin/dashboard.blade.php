@extends('layouts.app')

@section('content')

{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="rounded-4 p-3" style="background:#ecfdf5; color:#059669;">
                    <i class="bi bi-people fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Total Pelanggan</div>
                    <div class="fw-extrabold fs-3 text-dark">{{ $totalPelanggan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="rounded-4 p-3" style="background:#f0fdf4; color:#10b981;">
                    <i class="bi bi-list-ul fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Total Layanan</div>
                    <div class="fw-extrabold fs-3 text-dark">{{ $totalLayanan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="rounded-4 p-3" style="background:#d1fae5; color:#047857;">
                    <i class="bi bi-bag-check fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Total Pesanan</div>
                    <div class="fw-extrabold fs-3 text-dark">{{ $totalPesanan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3 p-4">
                <div class="rounded-4 p-3" style="background:#fef3c7; color:#d97706;">
                    <i class="bi bi-currency-dollar fs-3"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Total Omzet</div>
                    <div class="fw-extrabold fs-4 text-dark">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Status Summary + Recent Orders --}}
<div class="row g-4">
    {{-- Status Ringkasan --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pb-0 pt-4 px-4">
                <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-pie-chart-fill me-2 text-success"></i>Ringkasan Status</h6>
            </div>
            <div class="card-body px-4">
                @php
                    $statusConfig = [
                        'menunggu' => ['label' => 'Menunggu', 'color' => 'warning', 'icon' => 'bi-hourglass-split'],
                        'diproses' => ['label' => 'Diproses', 'color' => 'info',    'icon' => 'bi-arrow-repeat'],
                        'selesai'  => ['label' => 'Selesai',  'color' => 'success', 'icon' => 'bi-check-circle'],
                        'diambil'  => ['label' => 'Diambil',  'color' => 'secondary','icon' => 'bi-box-arrow-up-right'],
                    ];
                @endphp
                @foreach($statusConfig as $key => $cfg)
                    <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi {{ $cfg['icon'] }} text-{{ $cfg['color'] }} fs-5"></i>
                            <span class="small fw-semibold text-dark">{{ $cfg['label'] }}</span>
                        </div>
                        <span class="badge bg-{{ $cfg['color'] }} rounded-pill px-3 py-1">{{ $statusRingkasan[$key] }}</span>
                    </div>
                @endforeach

                <div class="mt-4">
                    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-success w-100 rounded-pill py-2">
                        <i class="bi bi-arrow-right-circle me-1"></i> Kelola Semua Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Pesanan Terbaru --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pb-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark"><i class="bi bi-clock-history me-2 text-success"></i>Pesanan Terbaru Masuk</h6>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-sm btn-outline-success rounded-pill px-3">Lihat Semua</a>
            </div>
            <div class="card-body p-0 mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead style="background: #f8fafc; border-bottom: 1.5px solid #e2e8f0;">
                            <tr>
                                <th class="ps-4 py-3 small text-uppercase text-muted fw-bold">Pelanggan</th>
                                <th class="py-3 small text-uppercase text-muted fw-bold">Layanan</th>
                                <th class="py-3 small text-uppercase text-muted fw-bold">Total</th>
                                <th class="py-3 small text-uppercase text-muted fw-bold">Status</th>
                                <th class="pe-4 py-3 small text-uppercase text-muted fw-bold text-end">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesananTerbaru as $p)
                                @php
                                    $badgeColor = match($p->status) {
                                        'menunggu' => 'warning',
                                        'diproses' => 'info',
                                        'selesai'  => 'success',
                                        'diambil'  => 'secondary',
                                        default    => 'dark',
                                    };
                                @endphp
                                <tr>
                                    <td class="ps-4 fw-bold text-dark">{{ $p->user->name }}</td>
                                    <td class="text-muted small">{{ $p->layanan->nama_layanan }}</td>
                                    <td class="text-success fw-bold">Rp {{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                                    <td><span class="badge bg-{{ $badgeColor }} rounded-pill px-3 py-1">{{ $p->labelStatus() }}</span></td>
                                    <td class="pe-4 text-muted small text-end">{{ $p->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada pesanan masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection