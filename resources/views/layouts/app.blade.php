<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cuciin' }} – Cuciin Laundry & Care</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --bs-primary: #059669;
            --bs-primary-rgb: 5, 150, 105;
            --brand-primary: #10b981;
            --brand-primary-dark: #059669;
            --brand-primary-deep: #064e3b;
            --brand-primary-light: #d1fae5;
            --brand-mint-bg: #f2f9f5;
            --brand-accent-orange: #f97316;
            --brand-accent-lime: #84cc16;
            --brand-gradient: linear-gradient(135deg, #059669 0%, #10b981 50%, #34d399 100%);
            --brand-gradient-subtle: linear-gradient(135deg, #ecfdf5 0%, #f0fdf4 100%);
            --sidebar-width: 250px;
            --topbar-height: 72px;
            --font-family-base: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
        }

        .text-primary {
            color: #059669 !important;
        }
        .bg-primary {
            background-color: #059669 !important;
        }
        .border-primary {
            border-color: #10b981 !important;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background-color: var(--brand-mint-bg);
            font-family: var(--font-family-base);
            color: #1e293b;
            min-height: 100vh;
            background-image: 
                radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.08) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(52, 211, 153, 0.06) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(16, 185, 129, 0.05) 0px, transparent 50%);
            background-attachment: fixed;
        }

        /* ── Modern Scrollbar ── */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* ── CUSTOMER TOPBAR (Top Center Navigation) ── */
        .customer-topbar {
            position: sticky;
            top: 0;
            z-index: 1030;
            height: var(--topbar-height);
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(16, 185, 129, 0.14);
            box-shadow: 0 4px 20px -2px rgba(16, 185, 129, 0.07);
        }

        .brand-logo-badge {
            width: 42px;
            height: 42px;
            border-radius: 14px;
            background: var(--brand-gradient);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 6px 14px rgba(16, 185, 129, 0.35);
            font-size: 1.3rem;
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .brand-logo-badge:hover {
            transform: scale(1.05) rotate(-3deg);
        }

        .brand-text-title {
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            color: #064e3b;
            line-height: 1.1;
        }

        .brand-text-sub {
            font-size: 0.72rem;
            font-weight: 600;
            color: #10b981;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }

        /* Center Pill Navigation Container */
        .customer-nav-center {
            display: flex;
            align-items: center;
            background: #f0fdf4;
            padding: 5px 6px;
            border-radius: 9999px;
            border: 1px solid rgba(16, 185, 129, 0.22);
            box-shadow: inset 0 2px 4px rgba(16, 185, 129, 0.04);
            gap: 4px;
        }

        .customer-nav-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            font-size: 0.88rem;
            font-weight: 600;
            color: #334155;
            text-decoration: none;
            border-radius: 9999px;
            transition: all 0.22s ease;
            position: relative;
        }

        .customer-nav-link i {
            font-size: 1rem;
            color: #059669;
            transition: transform 0.2s ease;
        }

        .customer-nav-link:hover {
            color: #064e3b;
            background: rgba(255, 255, 255, 0.85);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.12);
        }

        .customer-nav-link:hover i {
            transform: translateY(-1px);
        }

        .customer-nav-link.active {
            background: var(--brand-gradient);
            color: #ffffff !important;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.38);
        }

        .customer-nav-link.active i {
            color: #ffffff !important;
        }

        .customer-nav-link.btn-cta-nav {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
            padding: 8px 20px;
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
        }

        .customer-nav-link.btn-cta-nav i {
            color: #fff;
        }

        .customer-nav-link.btn-cta-nav:hover {
            box-shadow: 0 6px 18px rgba(16, 185, 129, 0.45);
            transform: translateY(-1px);
            color: #fff;
        }

        .active-dot {
            width: 7px;
            height: 7px;
            background-color: #f97316;
            border-radius: 50%;
            display: inline-block;
            box-shadow: 0 0 0 2px rgba(255,255,255,0.8);
            animation: pulse-dot 1.8s infinite;
        }

        @keyframes pulse-dot {
            0% { transform: scale(0.95); opacity: 0.9; }
            50% { transform: scale(1.3); opacity: 1; }
            100% { transform: scale(0.95); opacity: 0.9; }
        }

        /* User Profile Pill */
        .user-profile-chip {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 5px 12px 5px 6px;
            background: #ffffff;
            border: 1px solid rgba(16, 185, 129, 0.2);
            border-radius: 9999px;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.08);
            transition: all 0.2s ease;
        }

        .user-profile-chip:hover {
            border-color: rgba(16, 185, 129, 0.4);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
        }

        .avatar-green {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--brand-gradient);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.88rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }

        /* ── ADMIN SIDEBAR & TOPBAR ── */
        .admin-sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: linear-gradient(180deg, #064e3b 0%, #065f46 65%, #059669 100%);
            z-index: 1040;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 20px rgba(6, 78, 59, 0.2);
            color: #fff;
        }

        .admin-sidebar-brand {
            padding: 1.5rem 1.4rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        }

        .admin-nav {
            flex: 1;
            overflow-y: auto;
            padding: 1rem 0.8rem;
        }

        .admin-section-title {
            padding: 0.6rem 0.8rem 0.3rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.5);
        }

        .admin-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 14px;
            color: rgba(255, 255, 255, 0.82);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            border-radius: 12px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
        }

        .admin-link:hover {
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            transform: translateX(3px);
        }

        .admin-link.active {
            background: #ffffff;
            color: #065f46;
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .admin-link.active i {
            color: #059669;
        }

        .admin-topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: var(--topbar-height);
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(16, 185, 129, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            z-index: 1020;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.04);
        }

        .admin-page-wrapper {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            min-height: 100vh;
        }

        /* ── GUEST TOPBAR ── */
        .guest-topbar {
            height: var(--topbar-height);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(14px);
            border-bottom: 1px solid rgba(16, 185, 129, 0.15);
        }

        /* ── GLOBAL CARD & BUTTON STYLES ── */
        .card {
            border-radius: 20px;
            border: 1px solid rgba(16, 185, 129, 0.12);
            background: #ffffff;
            box-shadow: 0 8px 24px -4px rgba(16, 185, 129, 0.07), 0 2px 6px -1px rgba(0, 0, 0, 0.02);
            transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card:hover {
            box-shadow: 0 14px 30px -4px rgba(16, 185, 129, 0.12), 0 4px 10px -1px rgba(0, 0, 0, 0.03);
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(16, 185, 129, 0.1);
        }

        /* Buttons */
        .btn {
            border-radius: 12px;
            font-weight: 600;
            padding: 8px 18px;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: var(--brand-gradient);
            border: none;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.35);
        }

        .btn-primary:hover, .btn-primary:focus {
            background: linear-gradient(135deg, #047857 0%, #059669 50%, #10b981 100%);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.45);
            transform: translateY(-1px);
            color: #ffffff;
        }

        .btn-outline-primary {
            color: #059669;
            border-color: #10b981;
            background: transparent;
        }

        .btn-outline-primary:hover {
            background: var(--brand-gradient);
            border-color: transparent;
            color: #ffffff;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.25);
            transform: translateY(-1px);
        }

        .btn-accent-orange {
            background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            color: #fff;
            border: none;
            box-shadow: 0 4px 14px rgba(249, 115, 22, 0.35);
        }

        .btn-accent-orange:hover {
            background: linear-gradient(135deg, #ea580c 0%, #c2410c 100%);
            color: #fff;
            box-shadow: 0 6px 20px rgba(249, 115, 22, 0.45);
            transform: translateY(-1px);
        }

        .badge-pill-status {
            padding: 6px 14px;
            border-radius: 9999px;
            font-weight: 700;
            font-size: 0.78rem;
            letter-spacing: 0.3px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .badge-status-menunggu {
            background-color: #fef3c7;
            color: #b45309;
            border: 1px solid #fde68a;
        }

        .badge-status-diproses {
            background-color: #e0f2fe;
            color: #0369a1;
            border: 1px solid #bae6fd;
        }

        .badge-status-selesai {
            background-color: #d1fae5;
            color: #047857;
            border: 1px solid #a7f3d0;
        }

        .badge-status-diambil {
            background-color: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }

        /* Form elements */
        .form-control, .form-select {
            border-radius: 12px;
            padding: 10px 16px;
            border: 1.5px solid #e2e8f0;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.15);
        }

        /* Stat Icon Wrapper Global */
        .stat-icon-wrapper {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
            line-height: 1;
        }

        .stat-icon-wrapper i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            font-style: normal;
        }

        /* ── RESPONSIVE RULES ── */
        @media (max-width: 992px) {
            .customer-nav-center {
                display: none;
            }
            .mobile-menu-btn {
                display: flex !important;
            }
        }

        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.28s ease;
            }
            .admin-sidebar.show {
                transform: translateX(0);
            }
            .admin-page-wrapper {
                margin-left: 0;
            }
            .admin-topbar {
                left: 0;
            }
        }
    </style>
</head>
<body>

@auth
    @if(auth()->user()->role === 'admin')
        {{-- ═════════════════ ADMIN LAYOUT ═════════════════ --}}
        <aside class="admin-sidebar" id="sidebar">
            <div class="admin-sidebar-brand d-flex align-items-center gap-2">
                <div class="brand-logo-badge" style="background:#ffffff; color:#059669;">
                    <i class="bi bi-droplet-half"></i>
                </div>
                <div>
                    <div class="brand-text-title text-white">Cuciin</div>
                    <div class="brand-text-sub text-white-50">Admin Workspace</div>
                </div>
            </div>

            <nav class="admin-nav">
                <div class="admin-section-title">Menu Utama</div>

                <a href="{{ route('admin.dashboard') }}"
                   class="admin-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>

                <a href="{{ route('admin.pesanan.index') }}"
                   class="admin-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                    <i class="bi bi-bag-check"></i> Kelola Pesanan
                </a>

                <div class="admin-section-title mt-3">Master Data</div>

                <a href="{{ route('admin.layanan.index') }}"
                   class="admin-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                    <i class="bi bi-list-ul"></i> Data Layanan
                </a>

                <a href="{{ route('admin.pelanggan.index') }}"
                   class="admin-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Data Pelanggan
                </a>
            </nav>

            <div class="p-3 border-top border-white-10">
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit"
                            class="btn btn-sm w-100 text-white"
                            style="background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25);">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Admin Topbar --}}
        <header class="admin-topbar">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-sm btn-light d-md-none"
                        onclick="document.getElementById('sidebar').classList.toggle('show')">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <div class="fw-bold fs-5 text-dark">{{ $title ?? 'Admin Dashboard' }}</div>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="text-end d-none d-sm-block">
                    <div class="fw-bold small text-dark lh-1">{{ auth()->user()->name }}</div>
                    <div class="badge bg-success bg-opacity-25 text-success text-capitalize" style="font-size:.7rem">Admin Master</div>
                </div>
                <div class="avatar-green">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            </div>
        </header>

        <div class="admin-page-wrapper">
            <div class="container-fluid p-4">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background:#d1fae5; color:#065f46; border-radius:14px;">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:14px;">
                        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>

    @else
        {{-- ═════════════════ CUSTOMER LAYOUT (TOP CENTER MENU) ═════════════════ --}}
        <header class="customer-topbar">
            <div class="container-xl h-100 d-flex align-items-center justify-content-between position-relative">
                
                {{-- Left: Brand Logo & Slogan badge --}}
                <a href="{{ route('pelanggan.dashboard') }}" class="d-flex align-items-center gap-2 text-decoration-none">
                    <div class="brand-logo-badge">
                        <i class="bi bi-droplet-half"></i>
                    </div>
                    <div>
                        <div class="brand-text-title">Cuciin</div>
                        <div class="brand-text-sub">Laundry & Care</div>
                    </div>
                </a>

                {{-- Center: TOP CENTER PILL MENU (HIGHLIGHTED REQUIREMENT) --}}
                <nav class="customer-nav-center d-none d-lg-flex position-absolute start-50 translate-middle-x">
                    <a href="{{ route('pelanggan.dashboard') }}"
                       class="customer-nav-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('pelanggan.pesanan.index') }}"
                       class="customer-nav-link {{ request()->routeIs('pelanggan.pesanan.index') || request()->routeIs('pelanggan.pesanan.show') || request()->routeIs('pelanggan.pesanan.edit') ? 'active' : '' }}">
                        <i class="bi bi-bag-check-fill"></i>
                        <span>Pesanan Saya</span>
                        @php
                            $activeCount = auth()->user()->pesanans()->whereIn('status', ['menunggu', 'diproses'])->count();
                        @endphp
                        @if ($activeCount > 0)
                            <span class="active-dot" title="{{ $activeCount }} pesanan aktif"></span>
                        @endif
                    </a>

                    <a href="{{ route('pelanggan.pesanan.riwayat') }}"
                       class="customer-nav-link {{ request()->routeIs('pelanggan.pesanan.riwayat') ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i>
                        <span>Riwayat</span>
                    </a>

                    <a href="{{ route('pelanggan.pesanan.create') }}"
                       class="customer-nav-link btn-cta-nav {{ request()->routeIs('pelanggan.pesanan.create') ? 'active' : '' }}">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>Buat Pesanan</span>
                    </a>
                </nav>

                {{-- Right: User Profile & Actions --}}
                <div class="d-flex align-items-center gap-2">
                    <div class="user-profile-chip d-none d-sm-flex">
                        <div class="avatar-green">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <div class="lh-1 pe-1">
                            <div class="fw-bold small text-dark">{{ auth()->user()->name }}</div>
                            <span class="badge bg-success bg-opacity-10 text-success p-0 mt-1" style="font-size:0.68rem; font-weight:700;">Pelanggan</span>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST" class="d-inline m-0">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-light border text-danger d-flex align-items-center gap-1 rounded-pill px-3" title="Keluar Akun">
                            <i class="bi bi-box-arrow-right"></i>
                            <span class="d-none d-md-inline small fw-semibold">Keluar</span>
                        </button>
                    </form>

                    {{-- Mobile Hamburger Trigger --}}
                    <button class="btn btn-sm btn-light border d-lg-none rounded-pill p-2 mobile-menu-btn"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#mobileMenuOffcanvas">
                        <i class="bi bi-list fs-4 text-success"></i>
                    </button>
                </div>
            </div>
        </header>

        {{-- Mobile Offcanvas Menu --}}
        <div class="offcanvas offcanvas-end" tabindex="-1" id="mobileMenuOffcanvas" style="border-radius: 20px 0 0 20px;">
            <div class="offcanvas-header border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <div class="brand-logo-badge">
                        <i class="bi bi-droplet-half"></i>
                    </div>
                    <div>
                        <div class="brand-text-title">Cuciin</div>
                        <div class="brand-text-sub">Laundry & Care</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body d-flex flex-column justify-content-between p-4">
                <div class="d-flex flex-column gap-2">
                    <div class="p-3 bg-light rounded-4 d-flex align-items-center gap-3 mb-2">
                        <div class="avatar-green">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        <div>
                            <div class="fw-bold">{{ auth()->user()->name }}</div>
                            <div class="text-muted small">{{ auth()->user()->email }}</div>
                        </div>
                    </div>

                    <a href="{{ route('pelanggan.dashboard') }}"
                       class="customer-nav-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }} p-3">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('pelanggan.pesanan.index') }}"
                       class="customer-nav-link {{ request()->routeIs('pelanggan.pesanan.index') || request()->routeIs('pelanggan.pesanan.show') ? 'active' : '' }} p-3">
                        <i class="bi bi-bag-check-fill"></i>
                        <span>Pesanan Saya</span>
                    </a>

                    <a href="{{ route('pelanggan.pesanan.riwayat') }}"
                       class="customer-nav-link {{ request()->routeIs('pelanggan.pesanan.riwayat') ? 'active' : '' }} p-3">
                        <i class="bi bi-clock-history"></i>
                        <span>Riwayat Transaksi</span>
                    </a>

                    <a href="{{ route('pelanggan.pesanan.create') }}"
                       class="customer-nav-link btn-cta-nav p-3 text-center justify-content-center mt-2">
                        <i class="bi bi-plus-circle-fill"></i>
                        <span>+ Buat Pesanan Baru</span>
                    </a>
                </div>

                <div class="pt-3 border-top">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger w-100 py-2 rounded-pill">
                            <i class="bi bi-box-arrow-right me-1"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Main Page Content for Customer --}}
        <main class="py-4 py-md-5">
            <div class="container-xl">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="background:#d1fae5; color:#065f46; border-radius:16px;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-check-circle-fill fs-5 text-success"></i>
                            <div>{{ session('success') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert" style="border-radius:16px;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-exclamation-triangle-fill fs-5"></i>
                            <div>{{ session('error') }}</div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    @endif

@else
    {{-- ═════════════════ GUEST LAYOUT (LOGIN / REGISTER - TANPA TOPBAR) ═════════════════ --}}
    <main class="min-vh-100 d-flex align-items-center justify-content-center py-4">
        <div class="container-xl">
            @yield('content')
        </div>
    </main>
@endauth

<!-- Bootstrap 5.3 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>