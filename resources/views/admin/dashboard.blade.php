@extends('layouts.app')

@section('content')
<h3 class="fw-bold text-primary mb-3">Dashboard Admin</h3>
<div class="card border-0 shadow-sm">
    <div class="card-body">
        Selamat datang, {{ auth()->user()->name }}.
    </div>
</div>
@endsection