@extends('layouts.app')

@section('content')

{{-- ═════════════════ HERO BANNER: "I WISH YOU WASH HERE" ═════════════════ --}}
<div class="hero-banner-wrapper mb-4">
    <div class="row align-items-center g-4 p-4 p-md-5">
        <div class="col-lg-7 text-white">
            <div class="d-inline-flex align-items-center gap-2 px-3 py-1 rounded-pill hero-badge mb-3">
                <span class="badge-sparkle">✨</span>
                <span class="fw-bold small text-uppercase" style="letter-spacing: 1px;">Eco-Fresh Laundry Studio</span>
            </div>

            <h1 class="hero-title mb-3">
                I Wish You <span class="highlight-wash">Wash Here</span>
            </h1>

            <p class="hero-subtitle mb-4">
                Pakaian bersih, wangi semerbak, dan higienis tanpa repot. Tinggal pesan dari rumah, kami jemput atau antarkan cucian Anda dalam kondisi fresh dan siap pakai!
            </p>

            <div class="d-flex flex-wrap gap-3 align-items-center">
                <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-hero-cta">
                    <i class="bi bi-plus-circle-fill me-2 fs-5"></i> Buat Pesanan Baru
                </a>
                <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-hero-secondary">
                    <i class="bi bi-search me-2"></i> Cek Status Pesanan
                </a>
            </div>

            {{-- Value props micro badges --}}
            <div class="d-flex flex-wrap gap-3 mt-4 pt-2 border-top border-white-15">
                <div class="d-flex align-items-center gap-2 small text-white-90">
                    <i class="bi bi-shield-check text-warning fs-5"></i>
                    <span>100% Higienis</span>
                </div>
                <div class="d-flex align-items-center gap-2 small text-white-90">
                    <i class="bi bi-clock-history text-warning fs-5"></i>
                    <span>Tepat Waktu</span>
                </div>
                <div class="d-flex align-items-center gap-2 small text-white-90">
                    <i class="bi bi-flower1 text-warning fs-5"></i>
                    <span>Wangi Tahan 7 Hari</span>
                </div>
            </div>
        </div>

        <div class="col-lg-5 text-center">
            <div class="hero-image-container position-relative d-inline-block">
                <img src="{{ asset('images/laundry-hero.jpg') }}"
                     alt="I Wish You Wash Here - Cuciin Laundry"
                     class="img-fluid rounded-4 shadow-lg hero-img"
                     style="max-height: 310px; object-fit: cover;">

                {{-- Floating Pill Floating Tag --}}
                <div class="floating-chip top-left-chip shadow-sm">
                    <div class="chip-icon bg-emerald text-white">
                        <i class="bi bi-droplet-half"></i>
                    </div>
                    <div class="text-start">
                        <div class="fw-bold small text-dark">Eco Detergent</div>
                        <div class="text-muted" style="font-size:0.7rem">100% Ramah Serat</div>
                    </div>
                </div>

                <div class="floating-chip bottom-right-chip shadow-sm">
                    <div class="chip-icon bg-orange text-white">
                        <i class="bi bi-lightning-charge-fill"></i>
                    </div>
                    <div class="text-start">
                        <div class="fw-bold small text-dark">Express Service</div>
                        <div class="text-muted" style="font-size:0.7rem">Selesai 6-8 Jam</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═════════════════ STATS OVERVIEW CARDS ═════════════════ --}}
<div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="card stat-card h-100">
            <div class="card-body p-3 p-md-4 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper bg-emerald-tint">
                    <i class="bi bi-basket3-fill text-emerald"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Total Pesanan</div>
                    <div class="fw-extrabold fs-4 text-dark">{{ $totalPesanan }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="card stat-card h-100">
            <div class="card-body p-3 p-md-4 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper bg-sky-tint">
                    <i class="bi bi-arrow-repeat text-sky"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Dalam Proses</div>
                    <div class="fw-extrabold fs-4 text-dark d-flex align-items-center gap-2">
                        {{ $totalAktif }}
                        @if($totalAktif > 0)
                            <span class="badge bg-primary bg-opacity-10 text-primary small" style="font-size:0.7rem">Aktif</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="card stat-card h-100">
            <div class="card-body p-3 p-md-4 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper bg-green-tint">
                    <i class="bi bi-check-circle-fill text-green"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Cucian Selesai</div>
                    <div class="fw-extrabold fs-4 text-dark">{{ $totalSelesai }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="card stat-card h-100">
            <div class="card-body p-3 p-md-4 d-flex align-items-center gap-3">
                <div class="stat-icon-wrapper bg-amber-tint">
                    <i class="bi bi-wallet2 text-amber"></i>
                </div>
                <div>
                    <div class="text-muted small fw-semibold">Total Transaksi</div>
                    <div class="fw-extrabold fs-5 text-dark">
                        Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═════════════════ PESANAN AKTIF LIVE TRACKER (JIKA ADA) ═════════════════ --}}
@if($pesanansAktif->isNotEmpty())
<div class="card border-0 shadow-sm mb-4 active-tracker-card overflow-hidden">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
        <div class="d-flex align-items-center gap-2">
            <span class="active-pulse-indicator"></span>
            <h6 class="fw-bold mb-0 text-dark">Pesanan Sedang Berjalan (Live Tracking)</h6>
        </div>
        <a href="{{ route('pelanggan.pesanan.index') }}" class="small fw-bold text-success text-decoration-none">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="card-body p-4">
        <div class="row g-3">
            @foreach($pesanansAktif as $aktif)
                <div class="col-md-6">
                    <div class="p-3 rounded-4 border bg-light-subtle d-flex flex-column justify-content-between h-100">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <span class="fw-bold text-dark">{{ $aktif->kode_pesanan }}</span>
                                <div class="text-muted small">{{ $aktif->layanan->nama_layanan }} • {{ $aktif->berat }} kg</div>
                            </div>
                            <span class="badge-pill-status badge-status-{{ $aktif->status }}">
                                <i class="bi bi-arrow-repeat"></i> {{ $aktif->labelStatus() }}
                            </span>
                        </div>

                        <div class="mt-2 pt-2 border-top d-flex justify-content-between align-items-center">
                            <div class="fw-bold text-success">
                                Rp {{ number_format($aktif->total_biaya, 0, ',', '.') }}
                            </div>
                            <a href="{{ route('pelanggan.pesanan.show', $aktif) }}" class="btn btn-sm btn-outline-success rounded-pill px-3">
                                <i class="bi bi-geo-alt-fill me-1"></i> Lacak Progres
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

{{-- ═════════════════ SERVICE CATALOG (INSPIRED BY REFERENCE IMAGE 1) ═════════════════ --}}
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-end mb-3 flex-wrap gap-2">
        <div>
            <h4 class="fw-bold text-dark mb-1">
                Pilihan Layanan Laundry
            </h4>
            <p class="text-muted small mb-0">Pilih jenis layanan yang Anda butuhkan dan dapatkan hasil cuci terbaik.</p>
        </div>
        <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
            <i class="bi bi-plus-lg me-1"></i> Pesan Custom
        </a>
    </div>

    <div class="row g-3">
        @php
            $icons = [
                'bi-water',
                'bi-lightning-charge-fill',
                'bi-fire',
                'bi-grid-3x3-gap-fill',
            ];
            $iconColors = [
                ['bg' => '#ecfdf5', 'color' => '#059669'],
                ['bg' => '#eff6ff', 'color' => '#2563eb'],
                ['bg' => '#fff7ed', 'color' => '#ea580c'],
                ['bg' => '#f5f3ff', 'color' => '#7c3aed'],
            ];
        @endphp

        @forelse($layanans as $idx => $layanan)
            @php
                $style = $iconColors[$idx % count($iconColors)];
                $icon = $icons[$idx % count($icons)];
            @endphp
            <div class="col-sm-6 col-lg-3">
                <div class="card service-box-card h-100 text-center p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="service-icon-bubble mx-auto mb-3" style="background: {{ $style['bg'] }}; color: {{ $style['color'] }};">
                            <i class="bi {{ $icon }} fs-2"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-1 fs-6">{{ $layanan->nama_layanan }}</h5>
                        <p class="text-muted small mb-3 text-truncate-2" style="font-size:0.8rem; min-height: 38px;">
                            {{ $layanan->deskripsi ?: 'Pencucian higienis dan wangi terbaik untuk pakaian kesayangan.' }}
                        </p>
                    </div>

                    <div>
                        <div class="price-tag mb-3">
                            <span class="fs-5 fw-extrabold text-success">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                            <span class="text-muted small">/ kg</span>
                        </div>

                        <a href="{{ route('pelanggan.pesanan.create', ['layanan_id' => $layanan->id]) }}"
                           class="btn btn-select-service w-100 rounded-pill">
                            Pesan Layanan <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light text-center py-4">Belum ada daftar layanan yang tersedia.</div>
            </div>
        @endforelse
    </div>
</div>

{{-- ═════════════════ RECENT ORDERS & QUICK GUIDE ═════════════════ --}}
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-clock-history text-success me-2"></i>Pesanan Terakhir
                </h6>
                <a href="{{ route('pelanggan.pesanan.index') }}" class="small fw-semibold text-success text-decoration-none">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                @if($pesananTerbaru->isEmpty())
                    <div class="text-center py-5 px-3">
                        <i class="bi bi-inbox display-4 text-muted opacity-50"></i>
                        <h6 class="fw-bold mt-3 text-dark">Belum Ada Pesanan</h6>
                        <p class="text-muted small mb-3">Yuk buat pesanan pertamamu sekarang juga!</p>
                        <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-sm btn-primary rounded-pill px-4">
                            Mulai Pesan
                        </a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light small">
                                <tr>
                                    <th class="ps-4">Kode</th>
                                    <th>Layanan</th>
                                    <th>Berat</th>
                                    <th>Total Biaya</th>
                                    <th>Status</th>
                                    <th class="text-end pe-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pesananTerbaru as $order)
                                    <tr>
                                        <td class="ps-4 fw-bold text-dark small">{{ $order->kode_pesanan }}</td>
                                        <td class="small">{{ $order->layanan->nama_layanan }}</td>
                                        <td class="small">{{ $order->berat }} kg</td>
                                        <td class="fw-bold text-success small">Rp {{ number_format($order->total_biaya, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge-pill-status badge-status-{{ $order->status }}">
                                                {{ $order->labelStatus() }}
                                            </span>
                                        </td>
                                        <td class="text-end pe-4">
                                            <a href="{{ route('pelanggan.pesanan.show', $order) }}" class="btn btn-sm btn-light border rounded-pill px-2 py-1" title="Detail">
                                                <i class="bi bi-eye text-success"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card h-100 bg-emerald-subtle border-0" style="background: linear-gradient(145deg, #ecfdf5 0%, #d1fae5 100%);">
            <div class="card-body p-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="badge bg-success rounded-pill px-3 py-1 fw-bold">Tips Laundry</div>
                    <span class="small text-muted fw-semibold">Proses Cepat & Praktis</span>
                </div>

                <h5 class="fw-bold text-dark mb-3">4 Langkah Mudah Cuciin</h5>

                <div class="d-flex flex-column gap-3">
                    <div class="d-flex align-items-start gap-3">
                        <div class="step-num-pill">1</div>
                        <div>
                            <div class="fw-bold text-dark small">Pilih Layanan & Buat Pesanan</div>
                            <div class="text-muted small">Tentukan paket reguler atau express sesuai kebutuhan.</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3">
                        <div class="step-num-pill">2</div>
                        <div>
                            <div class="fw-bold text-dark small">Antar / Konfirmasi Pakaian</div>
                            <div class="text-muted small">Staf kami mencatat dan menimbang pakaian secara akurat.</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3">
                        <div class="step-num-pill">3</div>
                        <div>
                            <div class="fw-bold text-dark small">Pencucian Higienis & Setrika Uap</div>
                            <div class="text-muted small">Pakaian dicuci dengan teknologi eco-clean dan parfum tahan lama.</div>
                        </div>
                    </div>

                    <div class="d-flex align-items-start gap-3">
                        <div class="step-num-pill">4</div>
                        <div>
                            <div class="fw-bold text-dark small">Ambil & Nikmati Kesegarannya</div>
                            <div class="text-muted small">Pakaian selesai, rapi terlipat, siap untuk dipakai kembali!</div>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-3 border-top border-success-subtle text-center">
                    <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm">
                        <i class="bi bi-sparkles me-1"></i> Mulai Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ═════════════════ COMPONENT SPECIFIC STYLES ═════════════════ --}}
<style>
    /* Hero Banner Styling */
    .hero-banner-wrapper {
        background: linear-gradient(135deg, #064e3b 0%, #065f46 25%, #059669 65%, #10b981 100%);
        border-radius: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 16px 36px -8px rgba(5, 150, 105, 0.35);
    }

    .hero-banner-wrapper::before {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 320px;
        height: 320px;
        background: radial-gradient(circle, rgba(52, 211, 153, 0.25) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .hero-badge {
        background: rgba(255, 255, 255, 0.16);
        border: 1px solid rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(8px);
        width: fit-content;
    }

    .badge-sparkle {
        font-size: 0.9rem;
    }

    .hero-title {
        font-size: 2.6rem;
        font-weight: 800;
        letter-spacing: -1px;
        line-height: 1.15;
    }

    .highlight-wash {
        background: linear-gradient(120deg, #a7f3d0 0%, #ffffff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        display: inline-block;
        font-style: italic;
    }

    .hero-subtitle {
        font-size: 1rem;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
        max-width: 580px;
    }

    .btn-hero-cta {
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        color: #ffffff;
        font-weight: 700;
        padding: 12px 28px;
        border-radius: 9999px;
        border: none;
        box-shadow: 0 8px 24px rgba(234, 88, 12, 0.4);
        transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .btn-hero-cta:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 12px 28px rgba(234, 88, 12, 0.5);
        color: #fff;
    }

    .btn-hero-secondary {
        background: rgba(255, 255, 255, 0.15);
        border: 1.5px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        font-weight: 600;
        padding: 12px 24px;
        border-radius: 9999px;
        backdrop-filter: blur(8px);
        transition: all 0.2s ease;
    }

    .btn-hero-secondary:hover {
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
        transform: translateY(-1px);
    }

    .hero-img {
        border: 4px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        transition: transform 0.4s ease;
    }

    .hero-img:hover {
        transform: scale(1.02);
    }

    .floating-chip {
        position: absolute;
        background: #ffffff;
        padding: 8px 14px;
        border-radius: 9999px;
        display: flex;
        align-items: center;
        gap: 10px;
        border: 1px solid rgba(16, 185, 129, 0.15);
    }

    .top-left-chip {
        top: -12px;
        left: -15px;
    }

    .bottom-right-chip {
        bottom: -15px;
        right: -10px;
    }

    .chip-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
    }

    .bg-emerald { background: #10b981; }
    .bg-orange { background: #f97316; }

    /* Stat Cards */
    .stat-card {
        border-radius: 20px;
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stat-card:hover {
        transform: translateY(-4px);
    }

    .stat-icon-wrapper {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        flex-shrink: 0;
    }

    .bg-emerald-tint { background: #d1fae5; }
    .text-emerald { color: #059669; }

    .bg-sky-tint { background: #e0f2fe; }
    .text-sky { color: #0284c7; }

    .bg-green-tint { background: #dcfce7; }
    .text-green { color: #16a34a; }

    .bg-amber-tint { background: #fef3c7; }
    .text-amber { color: #d97706; }

    /* Service Cards */
    .service-box-card {
        border-radius: 24px;
        background: #ffffff;
        border: 1.5px solid rgba(16, 185, 129, 0.14);
        transition: all 0.28s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .service-box-card:hover {
        transform: translateY(-6px);
        border-color: #10b981;
        box-shadow: 0 16px 32px -6px rgba(16, 185, 129, 0.2);
    }

    .service-icon-bubble {
        width: 64px;
        height: 64px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease;
    }

    .service-box-card:hover .service-icon-bubble {
        transform: scale(1.1);
    }

    .btn-select-service {
        background: #f0fdf4;
        color: #059669;
        font-weight: 700;
        font-size: 0.85rem;
        border: 1px solid rgba(16, 185, 129, 0.25);
        padding: 8px 16px;
        transition: all 0.2s ease;
    }

    .btn-select-service:hover {
        background: var(--brand-gradient);
        color: #ffffff;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .active-pulse-indicator {
        width: 10px;
        height: 10px;
        background: #10b981;
        border-radius: 50%;
        display: inline-block;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.3);
        animation: pulse-ring 1.6s infinite;
    }

    @keyframes pulse-ring {
        0% { transform: scale(0.9); box-shadow: 0 0 0 1px rgba(16, 185, 129, 0.6); }
        50% { transform: scale(1.1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.9); box-shadow: 0 0 0 1px rgba(16, 185, 129, 0.6); }
    }

    .step-num-pill {
        width: 32px;
        height: 32px;
        background: #059669;
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.85rem;
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(5, 150, 105, 0.25);
    }

    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        .top-left-chip, .bottom-right-chip {
            display: none;
        }
    }
</style>

@endsection