@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center min-vh-75 py-4">
    <div class="col-md-7 col-lg-5 col-xl-4">
        
        <div class="text-center mb-4">
            <div class="brand-logo-badge mx-auto mb-2" style="width: 54px; height: 54px; font-size: 1.6rem;">
                <i class="bi bi-droplet-half"></i>
            </div>
            <h3 class="fw-extrabold text-dark mb-1">Selamat Datang Kembali</h3>
            <p class="text-success fw-bold small mb-0">I Wish You Wash Here ✨</p>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-4 p-sm-5">
                <div class="text-center mb-4">
                    <h5 class="fw-bold text-dark mb-1">Masuk ke Akun Anda</h5>
                    <p class="text-muted small">Kelola pesanan cucian dengan mudah dan cepat</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3">
                        @foreach ($errors->all() as $error)
                            <div><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="form-control border-start-0 ps-0"
                                   placeholder="nama@email.com" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password" id="password" name="password"
                                   class="form-control border-start-0 ps-0"
                                   placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" id="remember" name="remember" class="form-check-input" checked>
                            <label for="remember" class="form-check-label small text-muted">Ingat saya</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm mb-3">
                        Masuk Sekarang <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </form>

                <div class="text-center pt-3 border-top">
                    <p class="small text-muted mb-0">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-success fw-bold text-decoration-none">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection