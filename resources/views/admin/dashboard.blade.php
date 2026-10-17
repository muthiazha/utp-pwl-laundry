@extends('layouts.app')

@section('content')

{{-- Stats Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3" style="background:rgba(26,111,196,.1)">
                    <i class="bi bi-people fs-3" style="color:#1a6fc4"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Pelanggan</div>
                    <div class="fw-bold fs-4">{{ $totalPelanggan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3" style="background:rgba(56,178,224,.1)">
                    <i class="bi bi-list-ul fs-3" style="color:#38b2e0"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Layanan</div>
                    <div class="fw-bold fs-4">{{ $totalLayanan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3" style="background:rgba(34,197,94,.1)">
                    <i class="bi bi-bag-check fs-3 text-success"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Pesanan</div>
                    <div class="fw-bold fs-4">{{ $totalPesanan }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3" style="background:rgba(245,158,11,.1)">
                    <i class="bi bi-currency-dollar fs-3" style="color:#d97706"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Omzet</div>
                    <div class="fw-bold fs-5">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Status Summary + Recent Orders --}}
<div class="row g-3">
    {{-- Status Ringkasan --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pb-0 pt-3 px-4">
                <h6 class="fw-bold mb-0"><i class="bi bi-bar-chart-fill me-2 text-primary"></i>Ringkasan Status</h6>
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
                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi {{ $cfg['icon'] }} text-{{ $cfg['color'] }}"></i>
                            <span class="small">{{ $cfg['label'] }}</span>
                        </div>
                        <span class="badge bg-{{ $cfg['color'] }} rounded-pill">{{ $statusRingkasan[$key] }}</span>
                    </div>
                @endforeach

                <div class="mt-3">
                    <a href="{{ route('admin.pesanan.index') }}" class="btn btn-sm btn-outline-primary w-100">
                        <i class="bi bi-arrow-right-circle me-1"></i> Lihat Semua Pesanan
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Pesanan Terbaru --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 pb-0 pt-3 px-4 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>Pesanan Terbaru</h6>
                <a href="{{ route('admin.pesanan.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Pelanggan</th>
                                <th>Layanan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th class="pe-4">Tanggal</th>
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
                                    <td class="ps-4 fw-semibold">{{ $p->user->name }}</td>
                                    <td class="text-muted small">{{ $p->layanan->nama_layanan }}</td>
                                    <td class="text-success fw-semibold">Rp {{ number_format($p->total_biaya, 0, ',', '.') }}</td>
                                    <td><span class="badge bg-{{ $badgeColor }}">{{ $p->labelStatus() }}</span></td>
                                    <td class="pe-4 text-muted small">{{ $p->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">Belum ada pesanan.</td>
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