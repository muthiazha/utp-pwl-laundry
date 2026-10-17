@extends('layouts.app')

@section('content')

{{-- Header Halaman --}}
<div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
    <div>
        <div class="d-inline-flex align-items-center gap-1 text-success fw-bold small text-uppercase mb-1" style="letter-spacing: 0.5px;">
            <i class="bi bi-bag-check-fill"></i> Manajemen Pesanan
        </div>
        <h3 class="fw-bold text-dark mb-1">Pesanan Saya</h3>
        <p class="text-muted small mb-0">Pantau progres cucian Anda dari proses pencucian hingga siap diambil.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-circle-fill me-1"></i> Buat Pesanan Baru
        </a>
    </div>
</div>

@if ($pesanans->isEmpty())
    {{-- Empty State --}}
    <div class="card border-0 shadow-sm text-center py-5 px-3">
        <div class="card-body">
            <div class="mx-auto mb-3" style="width: 80px; height: 80px; background: #ecfdf5; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="bi bi-basket3 display-5 text-success"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2">Belum Ada Pesanan</h4>
            <p class="text-muted small mb-4" style="max-width: 420px; margin: 0 auto;">
                Pakaian kotor mulai menumpuk? Percayakan cucian Anda kepada Cuciin, wangi tahan lama dan higienis!
            </p>
            <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
                <i class="bi bi-plus-circle me-1"></i> Mulai Pesan Sekarang
            </a>
        </div>
    </div>
@else
    {{-- Filter Status Tabs (Client-side interactive) --}}
    <div class="d-flex gap-2 mb-3 overflow-x-auto pb-2" id="orderFilterTabs">
        <button type="button" class="btn btn-sm btn-filter-tab active rounded-pill px-3" data-status="all">
            Semua ({{ $pesanans->count() }})
        </button>
        <button type="button" class="btn btn-sm btn-filter-tab rounded-pill px-3" data-status="menunggu">
            Menunggu ({{ $pesanans->where('status', 'menunggu')->count() }})
        </button>
        <button type="button" class="btn btn-sm btn-filter-tab rounded-pill px-3" data-status="diproses">
            Diproses ({{ $pesanans->where('status', 'diproses')->count() }})
        </button>
        <button type="button" class="btn btn-sm btn-filter-tab rounded-pill px-3" data-status="selesai">
            Selesai ({{ $pesanans->where('status', 'selesai')->count() }})
        </button>
        <button type="button" class="btn btn-sm btn-filter-tab rounded-pill px-3" data-status="diambil">
            Diambil ({{ $pesanans->where('status', 'diambil')->count() }})
        </button>
    </div>

    {{-- Orders Card List / Table --}}
    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="ordersTable">
                    <thead style="background: #f8fafc; border-bottom: 1.5px solid #e2e8f0;">
                        <tr>
                            <th class="ps-4 py-3 small text-uppercase text-muted fw-bold">Kode Pesanan</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Layanan</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold text-center">Berat</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Total Biaya</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Status</th>
                            <th class="py-3 small text-uppercase text-muted fw-bold">Waktu Pesan</th>
                            <th class="text-end pe-4 py-3 small text-uppercase text-muted fw-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanans as $pesanan)
                            <tr class="order-row" data-status="{{ $pesanan->status }}">
                                <td class="ps-4">
                                    <div class="fw-bold text-dark">{{ $pesanan->kode_pesanan }}</div>
                                    @if ($pesanan->catatan)
                                        <div class="text-muted small text-truncate" style="max-width: 180px;" title="{{ $pesanan->catatan }}">
                                            <i class="bi bi-chat-left-text me-1"></i> {{ $pesanan->catatan }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $pesanan->layanan->nama_layanan }}</div>
                                    <div class="text-muted small">Rp {{ number_format($pesanan->layanan->harga, 0, ',', '.') }}/kg</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark border px-2 py-1 rounded-pill fw-semibold">
                                        {{ $pesanan->berat }} kg
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-extrabold text-success fs-6">
                                        Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-pill-status badge-status-{{ $pesanan->status }}">
                                        @if($pesanan->status === 'menunggu')
                                            <i class="bi bi-clock-history"></i>
                                        @elseif($pesanan->status === 'diproses')
                                            <i class="bi bi-arrow-repeat"></i>
                                        @elseif($pesanan->status === 'selesai')
                                            <i class="bi bi-check2-circle"></i>
                                        @else
                                            <i class="bi bi-bag-check-fill"></i>
                                        @endif
                                        {{ $pesanan->labelStatus() }}
                                    </span>
                                </td>
                                <td>
                                    <div class="small text-dark">{{ $pesanan->created_at->format('d M Y') }}</div>
                                    <div class="text-muted" style="font-size:0.75rem">{{ $pesanan->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex gap-1 align-items-center">
                                        <a href="{{ route('pelanggan.pesanan.show', $pesanan) }}"
                                           class="btn btn-sm btn-outline-success rounded-pill px-3"
                                           title="Lacak & Detail">
                                            <i class="bi bi-eye me-1"></i> Lacak
                                        </a>

                                        @if ($pesanan->status === 'menunggu')
                                            <a href="{{ route('pelanggan.pesanan.edit', $pesanan) }}"
                                               class="btn btn-sm btn-light border rounded-pill px-2"
                                               title="Edit Pesanan">
                                                <i class="bi bi-pencil text-muted"></i>
                                            </a>

                                            <form action="{{ route('pelanggan.pesanan.destroy', $pesanan) }}"
                                                  method="POST" class="d-inline"
                                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan {{ $pesanan->kode_pesanan }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light border text-danger rounded-pill px-2" title="Batalkan">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

<style>
    .btn-filter-tab {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #475569;
        font-weight: 600;
        transition: all 0.2s ease;
    }
    .btn-filter-tab:hover {
        background: #f1f5f9;
        color: #059669;
    }
    .btn-filter-tab.active {
        background: var(--brand-gradient);
        color: #ffffff;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }
</style>

@push('scripts')
<script>
    document.querySelectorAll('.btn-filter-tab').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.btn-filter-tab').forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const status = this.dataset.status;
            const rows = document.querySelectorAll('.order-row');

            rows.forEach(row => {
                if (status === 'all' || row.dataset.status === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush

@endsection
