@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center min-vh-75 py-4">
    <div class="col-md-7 col-lg-5 col-xl-4">
        
        <div class="text-center mb-4">
            <div class="brand-logo-badge mx-auto mb-2" style="width: 54px; height: 54px; font-size: 1.6rem;">
                <i class="bi bi-droplet-half"></i>
            </div>
            <h3 class="fw-extrabold text-dark mb-1">Mulai Bersama Cuciin</h3>
            <p class="text-success fw-bold small mb-0">I Wish You Wash Here ✨</p>
        </div>

        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-4 p-sm-5">
                <div class="text-center mb-4">
                    <h5 class="fw-bold text-dark mb-1">Daftar Akun Pelanggan</h5>
                    <p class="text-muted small">Nikmati kemudahan mencuci pakaian dengan standar premium</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3">
                        @foreach ($errors->all() as $error)
                            <div><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('register.process') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                   class="form-control border-start-0 ps-0"
                                   placeholder="Contoh: Samantha Martin" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                   class="form-control border-start-0 ps-0"
                                   placeholder="nama@email.com" required>
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
                                   placeholder="Minimal 8 karakter" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 0.5px;">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="bi bi-shield-check"></i>
                            </span>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-control border-start-0 ps-0"
                                   placeholder="Ulangi password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm mb-3">
                        Buat Akun Sekarang <i class="bi bi-arrow-right ms-1"></i>
                    </button>
                </form>

                <div class="text-center pt-3 border-top">
                    <p class="small text-muted mb-0">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-success fw-bold text-decoration-none">
                            Masuk
                        </a>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection