@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">

        <div class="d-flex align-items-center mb-4 gap-2">
            <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left"></i>
            </a>
            <h3 class="fw-bold text-primary mb-0">
                <i class="bi bi-pencil-square"></i> Edit Pesanan
            </h3>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('pelanggan.pesanan.update', $pesanan) }}" method="POST" id="formPesanan">
                    @csrf
                    @method('PUT')

                    {{-- Pilih Layanan --}}
                    <div class="mb-3">
                        <label for="layanan_id" class="form-label fw-semibold">
                            <i class="bi bi-list-check text-primary"></i> Pilih Layanan
                        </label>
                        <select name="layanan_id" id="layanan_id"
                                class="form-select @error('layanan_id') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih Layanan --</option>
                            @foreach ($layanans as $layanan)
                                <option value="{{ $layanan->id }}"
                                        data-harga="{{ $layanan->harga }}"
                                        {{ (old('layanan_id', $pesanan->layanan_id) == $layanan->id) ? 'selected' : '' }}>
                                    {{ $layanan->nama_layanan }}
                                    (Rp {{ number_format($layanan->harga, 0, ',', '.') }}/kg)
                                </option>
                            @endforeach
                        </select>
                        @error('layanan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Berat Cucian --}}
                    <div class="mb-3">
                        <label for="berat" class="form-label fw-semibold">
                            <i class="bi bi-speedometer2 text-primary"></i> Berat Cucian (kg)
                        </label>
                        <input type="number" name="berat" id="berat"
                               class="form-control @error('berat') is-invalid @enderror"
                               value="{{ old('berat', $pesanan->berat) }}"
                               min="0.1" max="100" step="0.1"
                               placeholder="Contoh: 3.5"
                               required>
                        @error('berat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Preview Total Biaya --}}
                    <div class="mb-3">
                        <div class="alert alert-info d-flex align-items-center gap-2 py-2" id="previewBiaya">
                            <i class="bi bi-calculator"></i>
                            <span>
                                Total Biaya: <strong id="totalBiayaText">Rp 0</strong>
                            </span>
                        </div>
                    </div>

                    {{-- Catatan --}}
                    <div class="mb-4">
                        <label for="catatan" class="form-label fw-semibold">
                            <i class="bi bi-chat-left-text text-primary"></i> Catatan (opsional)
                        </label>
                        <textarea name="catatan" id="catatan"
                                  class="form-control @error('catatan') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Contoh: pakaian putih pisah, ada baju sutra..."
                                  maxlength="500">{{ old('catatan', $pesanan->catatan) }}</textarea>
                        @error('catatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-outline-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    function formatRupiah(angka) {
        return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    function hitungTotal() {
        const select = document.getElementById('layanan_id');
        const harga  = parseFloat(select.options[select.selectedIndex]?.dataset.harga || 0);
        const berat  = parseFloat(document.getElementById('berat').value || 0);
        const total  = harga * berat;

        document.getElementById('totalBiayaText').textContent = formatRupiah(total);
    }

    document.getElementById('layanan_id').addEventListener('change', hitungTotal);
    document.getElementById('berat').addEventListener('input', hitungTotal);

    // Hitung saat halaman load
    hitungTotal();
</script>
@endpush
