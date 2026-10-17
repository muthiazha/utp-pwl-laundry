@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5 col-lg-4">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h4 class="text-center fw-bold text-primary mb-1">Masuk</h4>
                <p class="text-center text-muted small mb-4">Sistem Manajemen Laundry</p>

                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" id="remember" name="remember" class="form-check-input">
                        <label for="remember" class="form-check-label">Ingat saya</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Masuk</button>
                </form>

                <p class="text-center small mt-3 mb-0">
                    Belum punya akun? <a href="{{ route('register') }}">Daftar</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection