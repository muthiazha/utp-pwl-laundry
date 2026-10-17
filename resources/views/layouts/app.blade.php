<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Cuciin' }} – Cuciin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 240px;
            --brand-gradient: linear-gradient(135deg, #1a6fc4, #38b2e0);
        }

        body {
            background-color: #f0f4f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--brand-gradient);
            z-index: 1030;
            display: flex;
            flex-direction: column;
            box-shadow: 4px 0 15px rgba(0,0,0,.15);
        }

        .sidebar-brand {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }

        .sidebar-brand a {
            color: #fff;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: .75rem 0;
        }

        .sidebar-section {
            padding: .4rem 1.25rem .2rem;
            font-size: .7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,.55);
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: .65rem;
            padding: .55rem 1.5rem;
            color: rgba(255,255,255,.85);
            text-decoration: none;
            font-size: .9rem;
            transition: background .18s, color .18s;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover {
            background: rgba(255,255,255,.12);
            color: #fff;
        }

        .sidebar-link.active {
            background: rgba(255,255,255,.2);
            color: #fff;
            border-left-color: #fff;
            font-weight: 600;
        }

        .sidebar-link i {
            font-size: 1.05rem;
            width: 20px;
            text-align: center;
        }

        .sidebar-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid rgba(255,255,255,.15);
        }

        /* ── Topbar ── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-width);
            right: 0;
            height: 60px;
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1.75rem;
            z-index: 1020;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        .topbar-title {
            font-weight: 600;
            font-size: 1rem;
            color: #334155;
        }

        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--brand-gradient);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .85rem;
        }

        /* ── Main content ── */
        .page-wrapper {
            margin-left: var(--sidebar-width);
            padding-top: 60px;
            min-height: 100vh;
        }

        .page-content {
            padding: 1.75rem 2rem;
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform .25s ease;
            }
            .sidebar.show { transform: translateX(0); }
            .page-wrapper { margin-left: 0; }
            .topbar { left: 0; }
            .hamburger-btn { display: flex !important; }
        }
    </style>
</head>
<body>

@auth

{{-- ──────── SIDEBAR ──────── --}}
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}">
            <i class="bi bi-droplet-half me-1"></i> Cuciin
        </a>
    </div>

    <nav class="sidebar-nav">
        @if(auth()->user()->role === 'admin')
            <div class="sidebar-section mt-1">Menu Utama</div>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('admin.pesanan.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}">
                <i class="bi bi-bag-check"></i> Kelola Pesanan
            </a>

            <div class="sidebar-section mt-2">Master Data</div>

            <a href="{{ route('admin.layanan.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                <i class="bi bi-list-ul"></i> Data Layanan
            </a>

            <a href="{{ route('admin.pelanggan.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i> Data Pelanggan
            </a>

        @else
            <div class="sidebar-section mt-1">Menu</div>

            <a href="{{ route('pelanggan.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('pelanggan.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i> Dashboard
            </a>

            <a href="{{ route('pelanggan.pesanan.index') }}"
               class="sidebar-link {{ request()->routeIs('pelanggan.pesanan.index') ? 'active' : '' }}">
                <i class="bi bi-bag-check"></i> Pesanan Saya
            </a>

            <a href="{{ route('pelanggan.pesanan.create') }}"
               class="sidebar-link {{ request()->routeIs('pelanggan.pesanan.create') ? 'active' : '' }}">
                <i class="bi bi-plus-circle"></i> Buat Pesanan
            </a>
        @endif
    </nav>

    <div class="sidebar-footer">
        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit"
                    class="btn btn-sm w-100"
                    style="background:rgba(255,255,255,.15); color:#fff; border:1px solid rgba(255,255,255,.3);">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </form>
    </div>
</aside>

{{-- ──────── TOPBAR ──────── --}}
<header class="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm btn-light hamburger-btn"
                style="display:none"
                onclick="document.getElementById('sidebar').classList.toggle('show')">
            <i class="bi bi-list fs-5"></i>
        </button>
        <span class="topbar-title">{{ $title ?? 'Cuciin' }}</span>
    </div>
    <div class="d-flex align-items-center gap-2">
        <div class="text-end d-none d-sm-block">
            <div class="fw-semibold small text-dark lh-1">{{ auth()->user()->name }}</div>
            <div class="text-capitalize text-muted" style="font-size:.72rem">{{ auth()->user()->role }}</div>
        </div>
        <div class="avatar-circle">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
    </div>
</header>

@endauth

{{-- ──────── PAGE CONTENT ──────── --}}
<div class="{{ auth()->check() ? 'page-wrapper' : '' }}">
    <div class="{{ auth()->check() ? 'page-content' : 'container py-5' }}">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>