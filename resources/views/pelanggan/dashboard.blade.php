@extends('layouts.app')

@section('content')
<h3 class="fw-bold text-primary mb-4">
    <i class="bi bi-house-door"></i> Dashboard Pelanggan
</h3>

<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                    <i class="bi bi-person-circle fs-2 text-primary"></i>
                </div>
                <div>
                    <div class="text-muted small">Selamat datang,</div>
                    <div class="fw-bold fs-5">{{ auth()->user()->name }}</div>
                    <span class="badge bg-primary text-capitalize">{{ auth()->user()->role }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="bg-success bg-opacity-10 rounded-3 p-3">
                    <i class="bi bi-bag-check fs-2 text-success"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Pesanan</div>
                    <div class="fw-bold fs-5">{{ auth()->user()->pesanans()->count() }} pesanan</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Menu Utama</h5>
        <div class="row g-3">
            <div class="col-md-6">
                <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-outline-primary w-100 py-3">
                    <i class="bi bi-bag-check fs-4 d-block mb-1"></i>
                    Lihat Pesanan Saya
                </a>
            </div>
            <div class="col-md-6">
                <a href="{{ route('pelanggan.pesanan.create') }}" class="btn btn-primary w-100 py-3">
                    <i class="bi bi-plus-circle fs-4 d-block mb-1"></i>
                    Buat Pesanan Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection