@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-10">

        {{-- Header Navigation --}}
        <div class="d-flex align-items-center mb-4 gap-3">
            <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-sm btn-light border rounded-pill px-3 py-2 text-dark">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
            <div>
                <h3 class="fw-bold text-dark mb-0">Edit Pesanan Laundry</h3>
                <p class="text-muted small mb-0">Ubah paket layanan atau perkiraan berat cucian Anda sebelum diproses.</p>
            </div>
        </div>

        <form action="{{ route('pelanggan.pesanan.update', $pesanan) }}" method="POST" id="formPesanan">
            @csrf
            @method('PUT')

            <div class="row g-4">
                {{-- Form Input Kolom Kiri --}}
                <div class="col-lg-7">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-bold text-dark mb-0">
                                <i class="bi bi-pencil-square text-success me-2"></i>Perbarui Data
                            </h5>
                            <span class="badge bg-light border text-dark fw-bold rounded-pill px-3 py-1">
                                {{ $pesanan->kode_pesanan }}
                            </span>
                        </div>

                        {{-- Pilih Layanan --}}
                        <div class="mb-4">
                            <label for="layanan_id" class="form-label fw-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">
                                1. Pilih Paket Layanan <span class="text-danger">*</span>
                            </label>

                            <select name="layanan_id" id="layanan_id"
                                    class="form-select @error('layanan_id') is-invalid @enderror"
                                    required>
                                <option value="">-- Pilih Layanan Cuciin --</option>
                                @foreach ($layanans as $layanan)
                                    <option value="{{ $layanan->id }}"
                                            data-nama="{{ $layanan->nama_layanan }}"
                                            data-harga="{{ $layanan->harga }}"
                                            data-desc="{{ $layanan->deskripsi }}"
                                            {{ (old('layanan_id', $pesanan->layanan_id) == $layanan->id) ? 'selected' : '' }}>
                                        {{ $layanan->nama_layanan }} — Rp {{ number_format($layanan->harga, 0, ',', '.') }}/kg
                                    </option>
                                @endforeach
                            </select>
                            @error('layanan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            <div class="mt-2 p-3 bg-light rounded-3 d-none" id="serviceDetailBox">
                                <div class="fw-bold small text-success" id="serviceDetailTitle"></div>
                                <div class="text-muted small" id="serviceDetailDesc"></div>
                            </div>
                        </div>

                        {{-- Input Berat Cucian --}}
                        <div class="mb-4">
                            <label for="berat" class="form-label fw-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">
                                2. Perkiraan Berat Cucian (kg) <span class="text-danger">*</span>
                            </label>
                            
                            <div class="input-group">
                                <input type="number" name="berat" id="berat"
                                       class="form-control @error('berat') is-invalid @enderror"
                                       value="{{ old('berat', $pesanan->berat) }}"
                                       min="0.1" max="100" step="0.1"
                                       placeholder="Contoh: 3.5"
                                       required>
                                <span class="input-group-text bg-light fw-bold text-muted">Kilogram (kg)</span>
                            </div>
                            @error('berat')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Catatan Khusus --}}
                        <div class="mb-3">
                            <label for="catatan" class="form-label fw-bold text-dark small text-uppercase" style="letter-spacing: 0.5px;">
                                3. Catatan Khusus (Opsional)
                            </label>
                            <textarea name="catatan" id="catatan"
                                      class="form-control @error('catatan') is-invalid @enderror"
                                      rows="3"
                                      placeholder="Contoh: Pisahkan pakaian putih, ada kemeja sutra jangan diperas kuat..."
                                      maxlength="500">{{ old('catatan', $pesanan->catatan) }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Live Digital Receipt Preview Kolom Kanan --}}
                <div class="col-lg-5">
                    <div class="receipt-card shadow-sm p-4 position-sticky" style="top: 90px;">
                        <div class="d-flex align-items-center justify-content-between pb-3 border-bottom mb-3">
                            <div>
                                <div class="badge bg-success bg-opacity-10 text-success fw-bold px-2 py-1 rounded-pill small">
                                    <i class="bi bi-receipt"></i> Estimasi Nota
                                </div>
                                <h5 class="fw-bold text-dark mt-2 mb-0">Ringkasan Biaya</h5>
                            </div>
                            <div class="avatar-green" style="width:36px; height:36px;">
                                <i class="bi bi-droplet-half"></i>
                            </div>
                        </div>

                        {{-- Receipt Details --}}
                        <div class="d-flex flex-column gap-2 mb-3">
                            <div class="d-flex justify-content-between text-muted small">
                                <span>Paket Dipilih:</span>
                                <span class="fw-bold text-dark text-end" id="receiptLayananName">Pilih Layanan</span>
                            </div>

                            <div class="d-flex justify-content-between text-muted small">
                                <span>Tarif per Kg:</span>
                                <span class="fw-bold text-dark" id="receiptTarif">Rp 0</span>
                            </div>

                            <div class="d-flex justify-content-between text-muted small">
                                <span>Estimasi Berat:</span>
                                <span class="fw-bold text-dark" id="receiptBerat">0 kg</span>
                            </div>

                            <div class="d-flex justify-content-between text-muted small">
                                <span>Biaya Penanganan:</span>
                                <span class="fw-bold text-success">GRATIS</span>
                            </div>
                        </div>

                        {{-- Perforated tear line --}}
                        <div class="receipt-perforated-line my-3"></div>

                        {{-- Total Pembayaran --}}
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <div class="text-muted small text-uppercase fw-bold" style="letter-spacing: 0.5px;">Total Perkiraan</div>
                                <div class="text-muted" style="font-size:0.7rem">Sudah termasuk PPN</div>
                            </div>
                            <div class="fs-3 fw-extrabold text-success" id="receiptTotal">
                                Rp 0
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" class="btn btn-primary w-100 py-3 rounded-pill fw-bold shadow-sm mb-2">
                            <i class="bi bi-check2-circle me-1 fs-5"></i> Simpan Perubahan
                        </button>

                        <a href="{{ route('pelanggan.pesanan.index') }}" class="btn btn-light border w-100 rounded-pill py-2 text-muted small">
                            Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>

<style>
    .receipt-card {
        background: #ffffff;
        border-radius: 24px;
        border: 1px solid rgba(16, 185, 129, 0.18);
        position: relative;
    }

    .receipt-perforated-line {
        border-top: 2px dashed #cbd5e1;
        position: relative;
    }
</style>

@push('scripts')
<script>
    function formatRupiah(angka) {
        return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    function hitungTotal() {
        const select = document.getElementById('layanan_id');
        const selectedOpt = select.options[select.selectedIndex];
        
        const harga = parseFloat(selectedOpt?.dataset.harga || 0);
        const nama = selectedOpt?.dataset.nama || 'Belum dipilih';
        const desc = selectedOpt?.dataset.desc || '';
        const berat = parseFloat(document.getElementById('berat').value || 0);

        const total = harga * berat;

        // Update box info
        const detailBox = document.getElementById('serviceDetailBox');
        if (harga > 0) {
            detailBox.classList.remove('d-none');
            document.getElementById('serviceDetailTitle').textContent = nama + ' (Rp ' + Number(harga).toLocaleString('id-ID') + '/kg)';
            document.getElementById('serviceDetailDesc').textContent = desc || 'Layanan pembersihan standar Cuciin.';
        } else {
            detailBox.classList.add('d-none');
        }

        // Update receipt
        document.getElementById('receiptLayananName').textContent = nama;
        document.getElementById('receiptTarif').textContent = formatRupiah(harga) + '/kg';
        document.getElementById('receiptBerat').textContent = berat + ' kg';
        document.getElementById('receiptTotal').textContent = formatRupiah(total);
    }

    document.getElementById('layanan_id').addEventListener('change', hitungTotal);
    document.getElementById('berat').addEventListener('input', hitungTotal);

    // Jalankan kalkulasi saat page load
    hitungTotal();
</script>
@endpush

@endsection
