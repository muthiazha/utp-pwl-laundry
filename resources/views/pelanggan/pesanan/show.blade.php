@extends('layouts.app')

@section('content')

{{-- Tombol Navigasi Kembali & Aksi Cetak --}}
<div class="d-flex justify-content-between align-items-center mb-4 d-print-none flex-wrap gap-2">
    <div>
        <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-light border btn-sm rounded-pill px-3 py-2 text-dark">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Pesanan Saya
        </a>
    </div>
    <div class="d-flex gap-2">
        <button type="button" onclick="window.print()" class="btn btn-outline-success btn-sm rounded-pill px-3 py-2">
            <i class="bi bi-printer me-1"></i> Cetak Struk
        </button>
        @if ($pesanan->status === 'menunggu')
            <a href="{{ route('pelanggan.pesanan.edit', $pesanan) }}" class="btn btn-warning btn-sm text-dark rounded-pill px-3 py-2 fw-semibold">
                <i class="bi bi-pencil me-1"></i> Edit Pesanan
            </a>
        @endif
    </div>
</div>

{{-- ═════════════════ CARD STATUS TRACKER ═════════════════ --}}
<div class="card border-0 shadow-sm mb-4 d-print-none">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
            <div>
                <div class="d-inline-flex align-items-center gap-1 text-success fw-bold small text-uppercase mb-1" style="letter-spacing: 0.5px;">
                    <i class="bi bi-geo-alt-fill"></i> Live Tracking
                </div>
                <h5 class="fw-bold mb-1 text-dark">
                    Pelacakan Status Cucian Real-time
                </h5>
                <p class="text-muted small mb-0">Pantau tahapan pengerjaan pakaian Anda secara langsung.</p>
            </div>
            <div>
                <span class="badge-pill-status badge-status-{{ $pesanan->status }} fs-6 px-3 py-2">
                    <i class="bi bi-clock-history"></i> {{ $pesanan->labelStatus() }}
                </span>
            </div>
        </div>
    </div>
    <div class="card-body px-4 py-4">
        {{-- Stepper Timeline --}}
        <div class="stepper-wrapper">
            @php $langkah = $pesanan->getLangkahStatus(); @endphp
            @foreach ($langkah as $index => $step)
                <div class="stepper-item {{ $step['state'] }}">
                    <div class="step-counter shadow-sm">
                        @if ($step['state'] === 'completed')
                            <i class="bi bi-check-lg fs-5"></i>
                        @else
                            <i class="bi {{ $step['icon'] }} fs-5"></i>
                        @endif
                    </div>
                    <div class="step-name fw-bold mt-2">{{ $step['label'] }}</div>
                    <div class="step-desc text-muted small px-2">{{ $step['desc'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ═════════════════ STRUK / DIGITAL INVOICE ═════════════════ --}}
<div class="card border-0 shadow-sm invoice-card mx-auto" style="max-width: 860px;">
    <div class="card-body p-4 p-md-5">
        {{-- Header Struk --}}
        <div class="row align-items-center mb-4 border-bottom pb-4">
            <div class="col-sm-7 mb-3 mb-sm-0">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="brand-logo-badge" style="width:44px; height:44px;">
                        <i class="bi bi-droplet-half"></i>
                    </div>
                    <div>
                        <h4 class="fw-extrabold mb-0 text-dark">Cuciin Laundry</h4>
                        <div class="text-success fw-bold" style="font-size:0.75rem">I Wish You Wash Here ✨</div>
                    </div>
                </div>
                <div class="text-muted small">
                    <div>Layanan Laundry Bersih, Cepat, dan Higienis</div>
                    <div>Email: support@cuciin.test | WhatsApp: +62 812-3456-7890</div>
                </div>
            </div>
            <div class="col-sm-5 text-sm-end">
                <div class="text-muted small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Kode Transaksi</div>
                <div class="fs-4 fw-extrabold text-success">{{ $pesanan->kode_pesanan }}</div>
                <div class="text-muted small mt-1">
                    <i class="bi bi-calendar3 me-1"></i> {{ $pesanan->created_at->format('d F Y, H:i') }} WIB
                </div>
            </div>
        </div>

        {{-- Info Pelanggan & Status --}}
        <div class="row g-3 mb-4 rounded-4 p-3" style="background: #f0fdf4; border: 1px solid rgba(16, 185, 129, 0.15);">
            <div class="col-md-6">
                <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size:0.7rem; letter-spacing:0.5px;">Informasi Pelanggan</div>
                <div class="fw-bold fs-6 text-dark">{{ $pesanan->user->name }}</div>
                <div class="text-muted small">{{ $pesanan->user->email }}</div>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="text-muted small fw-bold text-uppercase mb-1" style="font-size:0.7rem; letter-spacing:0.5px;">Status Pengerjaan</div>
                <div>
                    <span class="badge-pill-status badge-status-{{ $pesanan->status }}">
                        {{ $pesanan->labelStatus() }}
                    </span>
                </div>
                <div class="text-muted small mt-1">
                    Diperbarui: {{ $pesanan->updated_at->diffForHumans() }}
                </div>
            </div>
        </div>

        {{-- Tabel Rincian Biaya --}}
        <div class="table-responsive mb-4">
            <table class="table table-bordered align-middle mb-0" style="border-color: #e2e8f0;">
                <thead style="background: #f8fafc;">
                    <tr>
                        <th class="py-3 ps-3 text-muted small text-uppercase fw-bold">Layanan</th>
                        <th class="py-3 text-center text-muted small text-uppercase fw-bold">Tarif per Kg</th>
                        <th class="py-3 text-center text-muted small text-uppercase fw-bold">Berat</th>
                        <th class="py-3 text-end pe-3 text-muted small text-uppercase fw-bold">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ps-3">
                            <div class="fw-bold text-dark">{{ $pesanan->layanan->nama_layanan }}</div>
                            @if (!empty($pesanan->layanan->deskripsi))
                                <div class="text-muted small">{{ $pesanan->layanan->deskripsi }}</div>
                            @endif
                        </td>
                        <td class="text-center small">Rp {{ number_format($pesanan->layanan->harga, 0, ',', '.') }}</td>
                        <td class="text-center fw-bold">{{ $pesanan->berat }} kg</td>
                        <td class="text-end pe-3 fw-bold text-dark">
                            Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
                <tfoot style="background: #f8fafc;">
                    <tr>
                        <td colspan="3" class="text-end fw-bold py-3 fs-6">Total Pembayaran</td>
                        <td class="text-end pe-3 fw-extrabold text-success py-3 fs-4">
                            Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Catatan Khusus --}}
        @if ($pesanan->catatan)
            <div class="card bg-light border-0 mb-4 rounded-3">
                <div class="card-body py-3">
                    <div class="fw-bold text-dark small mb-1">
                        <i class="bi bi-sticky me-1 text-success"></i> Catatan Khusus dari Pelanggan:
                    </div>
                    <div class="text-muted small">{{ $pesanan->catatan }}</div>
                </div>
            </div>
        @endif

        {{-- Footer Struk --}}
        <div class="border-top pt-4 text-center text-muted small">
            <div class="fw-bold text-dark">Terima kasih telah mempercayakan pakaian Anda di Cuciin Laundry!</div>
            <div class="mt-1">Harap simpan bukti nota ini untuk verifikasi pengambilan pakaian di outlet kami.</div>
        </div>
    </div>
</div>

{{-- ═════════════════ STYLE STEPPER & PRINT ═════════════════ --}}
<style>
    /* Stepper Styling */
    .stepper-wrapper {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-top: 10px;
    }

    .stepper-item {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex: 1;
        text-align: center;
    }

    .stepper-item::before {
        position: absolute;
        content: "";
        border-bottom: 3px solid #e2e8f0;
        width: 100%;
        top: 25px;
        left: -50%;
        z-index: 1;
    }

    .stepper-item:first-child::before {
        content: none;
    }

    .step-counter {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 52px;
        height: 52px;
        border-radius: 50%;
        background: #fff;
        border: 3px solid #e2e8f0;
        color: #94a3b8;
        transition: all .25s ease;
    }

    .step-name {
        font-size: .88rem;
        color: #475569;
    }

    .step-desc {
        font-size: .75rem;
        line-height: 1.3;
    }

    /* Completed state */
    .stepper-item.completed .step-counter {
        background-color: #10b981;
        border-color: #10b981;
        color: #fff;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .stepper-item.completed::before {
        border-bottom-color: #10b981;
    }

    .stepper-item.completed .step-name {
        color: #059669;
    }

    /* Current active state */
    .stepper-item.current .step-counter {
        background: linear-gradient(135deg, #059669, #10b981);
        border-color: #059669;
        color: #fff;
        box-shadow: 0 0 0 6px rgba(16, 185, 129, 0.25) !important;
        animation: pulse-active 2s infinite;
    }

    .stepper-item.current::before {
        border-bottom-color: #10b981;
    }

    .stepper-item.current .step-name {
        color: #059669;
        font-weight: 800;
        font-size: .92rem;
    }

    @keyframes pulse-active {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, .5); }
        70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    /* Responsive Stepper */
    @media (max-width: 768px) {
        .stepper-wrapper {
            flex-direction: column;
            gap: 1.5rem;
            align-items: flex-start;
            padding-left: 1rem;
        }
        .stepper-item {
            flex-direction: row;
            text-align: left;
            align-items: flex-start;
            gap: 1rem;
        }
        .stepper-item::before {
            border-left: 3px solid #e2e8f0;
            border-bottom: none;
            height: 100%;
            width: 0;
            top: 25px;
            left: 25px;
        }
        .step-desc {
            padding-left: 0 !important;
        }
    }

    /* Print Styling */
    @media print {
        body {
            background-color: #fff !important;
        }
        .customer-topbar, .d-print-none {
            display: none !important;
        }
        .invoice-card {
            box-shadow: none !important;
            border: 1px solid #ddd !important;
        }
    }
</style>

@endsection
