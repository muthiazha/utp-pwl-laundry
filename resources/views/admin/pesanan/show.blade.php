@extends('layouts.app')

@section('content')

{{-- Navigasi Kembali & Aksi --}}
<div class="d-flex justify-content-between align-items-center mb-4 d-print-none flex-wrap gap-2">
    <div>
        <a href="{{ route('admin.pesanan.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali ke Kelola Pesanan
        </a>
    </div>
    <div class="d-flex gap-2">
        <button type="button" onclick="window.print()" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-printer me-1"></i> Cetak Struk
        </button>
    </div>
</div>

<div class="row g-4">
    {{-- Kolom Kiri: Detail & Tracking --}}
    <div class="col-lg-8">
        {{-- Stepper Tracking --}}
        <div class="card border-0 shadow-sm mb-4 d-print-none">
            <div class="card-header bg-white border-0 pt-3 px-4 pb-0">
                <h6 class="fw-bold mb-1 text-primary">
                    <i class="bi bi-geo-alt-fill me-1"></i> Pelacakan Tahapan Pesanan
                </h6>
            </div>
            <div class="card-body px-4 py-4">
                <div class="stepper-wrapper">
                    @php $langkah = $pesanan->getLangkahStatus(); @endphp
                    @foreach ($langkah as $step)
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

        {{-- Invoice Card --}}
        <div class="card border-0 shadow-sm invoice-card">
            <div class="card-body p-4 p-md-5">
                <div class="row align-items-center mb-4 border-bottom pb-4">
                    <div class="col-sm-7 mb-3 mb-sm-0">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="bg-primary text-white rounded-3 p-2 d-inline-flex align-items-center justify-content-center" style="width:40px;height:40px">
                                <i class="bi bi-droplet-half fs-4"></i>
                            </div>
                            <h4 class="fw-bold mb-0 text-primary">Cuciin Laundry</h4>
                        </div>
                        <div class="text-muted small">Nota Transaksi Pesanan Pelanggan</div>
                    </div>
                    <div class="col-sm-5 text-sm-end">
                        <div class="text-muted small text-uppercase fw-semibold">Kode Transaksi</div>
                        <div class="fs-4 fw-bold text-dark">{{ $pesanan->kode_pesanan }}</div>
                        <div class="text-muted small mt-1">{{ $pesanan->created_at->format('d F Y, H:i') }} WIB</div>
                    </div>
                </div>

                <div class="row g-3 mb-4 bg-light rounded-3 p-3">
                    <div class="col-md-6">
                        <div class="text-muted small fw-semibold text-uppercase mb-1">Pelanggan</div>
                        <div class="fw-bold text-dark">{{ $pesanan->user->name }}</div>
                        <div class="text-muted small">{{ $pesanan->user->email }}</div>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="text-muted small fw-semibold text-uppercase mb-1">Status Saat Ini</div>
                        <span class="badge bg-{{ $pesanan->badgeColor() }} px-3 py-1 fs-6">
                            {{ $pesanan->labelStatus() }}
                        </span>
                    </div>
                </div>

                <div class="table-responsive mb-4">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3 ps-3">Layanan</th>
                                <th class="py-3 text-center">Tarif per Kg</th>
                                <th class="py-3 text-center">Berat (Kg)</th>
                                <th class="py-3 text-end pe-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="ps-3 fw-bold">{{ $pesanan->layanan->nama_layanan }}</td>
                                <td class="text-center">Rp {{ number_format($pesanan->layanan->harga, 0, ',', '.') }}</td>
                                <td class="text-center fw-semibold">{{ $pesanan->berat }} kg</td>
                                <td class="text-end pe-3 fw-bold text-dark">
                                    Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-bold py-3 fs-5">Total Biaya</td>
                                <td class="text-end pe-3 fw-bold text-success py-3 fs-4">
                                    Rp {{ number_format($pesanan->total_biaya, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                @if ($pesanan->catatan)
                    <div class="card bg-light border-0 mb-3">
                        <div class="card-body py-3">
                            <div class="fw-semibold text-dark small mb-1">
                                <i class="bi bi-sticky me-1 text-primary"></i> Catatan Pelanggan:
                            </div>
                            <div class="text-muted small">{{ $pesanan->catatan }}</div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Kolom Kanan: Panel Kontrol Admin (Ubah Status Cepat) --}}
    <div class="col-lg-4 d-print-none">
        <div class="card border-0 shadow-sm sticky-top" style="top: 80px;">
            <div class="card-header bg-white border-0 pt-3 px-4 pb-0">
                <h6 class="fw-bold mb-1 text-dark">
                    <i class="bi bi-sliders me-1 text-primary"></i> Kontrol Status Pesanan
                </h6>
                <p class="text-muted small mb-0">Ubah progres cucian pelanggan secara instan.</p>
            </div>
            <div class="card-body px-4 py-3">
                <form action="{{ route('admin.pesanan.updateStatus', $pesanan) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Pilih Status Baru</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            @foreach ($daftarStatus as $val => $label)
                                <option value="{{ $val }}" {{ $pesanan->status === $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="bi bi-check-circle me-1"></i> Simpan Pembaruan Status
                    </button>
                </form>

                <div class="border-top mt-4 pt-3">
                    <div class="small fw-semibold text-muted mb-2">Panduan Alur Status:</div>
                    <ul class="list-unstyled small text-muted mb-0">
                        <li class="mb-1"><span class="badge bg-warning text-dark me-1">Menunggu</span> Baru masuk dari pelanggan</li>
                        <li class="mb-1"><span class="badge bg-info text-dark me-1">Diproses</span> Sedang dicuci / disetrika</li>
                        <li class="mb-1"><span class="badge bg-success me-1">Selesai</span> Sudah bersih & siap diambil</li>
                        <li><span class="badge bg-secondary me-1">Diambil</span> Sudah diserahkan ke pelanggan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Stepper & Print CSS --}}
<style>
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
    .stepper-item:first-child::before { content: none; }
    .step-counter {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #fff;
        border: 3px solid #e2e8f0;
        color: #94a3b8;
    }
    .step-name { font-size: .88rem; color: #64748b; }
    .step-desc { font-size: .75rem; line-height: 1.3; }
    .stepper-item.completed .step-counter { background-color: #10b981; border-color: #10b981; color: #fff; }
    .stepper-item.completed::before { border-bottom-color: #10b981; }
    .stepper-item.completed .step-name { color: #059669; }
    .stepper-item.current .step-counter {
        background: linear-gradient(135deg, #1a6fc4, #38b2e0);
        border-color: #1a6fc4;
        color: #fff;
        box-shadow: 0 0 0 5px rgba(26,111,196,.2) !important;
    }
    .stepper-item.current::before { border-bottom-color: #10b981; }
    .stepper-item.current .step-name { color: #1a6fc4; }

    @media (max-width: 768px) {
        .stepper-wrapper { flex-direction: column; gap: 1.5rem; align-items: flex-start; padding-left: 1rem; }
        .stepper-item { flex-direction: row; text-align: left; align-items: flex-start; gap: 1rem; }
        .stepper-item::before { border-left: 3px solid #e2e8f0; border-bottom: none; height: 100%; width: 0; top: 25px; left: 24px; }
    }
    @media print {
        .sidebar, .topbar, .hamburger-btn, .d-print-none { display: none !important; }
        .page-wrapper { margin-left: 0 !important; padding-top: 0 !important; }
        .page-content { padding: 0 !important; }
        .invoice-card { box-shadow: none !important; border: 1px solid #ddd !important; }
    }
</style>

@endsection
