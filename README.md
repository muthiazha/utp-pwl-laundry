<p align="center">
  <div align="center">
    <h1 align="center">🫧 Cuciin — Laundry & Care Management System</h1>
    <p align="center">
      <em>"I Wish You Wash Here ✨" — Layanan Laundry Bersih, Cepat, Higienis, dan Terpercaya</em>
    </p>
    <p align="center">
      <strong>Ujian Tengah Praktikum (UTP) Pemrograman Web Lanjut</strong><br>
      Program Studi Ilmu Komputer
    </p>
  </div>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11%2F12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3%2B-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/PostgreSQL-5432-4169E1?style=for-the-badge&logo=postgresql&logoColor=white" alt="PostgreSQL">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5">
  <img src="https://img.shields.io/badge/License-MIT-green?style=for-the-badge" alt="License">
</p>

---

## 📌 Tentang Proyek

**Cuciin** adalah aplikasi web manajemen laundry modern yang dibangun dengan framework **Laravel**. Aplikasi ini dirancang untuk mendigitalisasi operasional laundry harian secara *end-to-end*, menghubungkan pelanggan dengan pihak pengelola laundry secara efisien dan transparan.

Pelanggan dapat melakukan estimasi biaya, memesan layanan, melacak progres cucian secara *real-time* melalui visual stepper tracking, mencetak struk/nota digital, dan mengarsipkan riwayat cucian. Di sisi lain, Admin dapat mengelola master data layanan, memantau omzet dan statistik cucian harian, serta memperbarui tahapan status cucian secara instan.

---

## 👥 Pembagian Peran & Anggota Kelompok

Proyek ini dikembangkan secara kolaboratif menggunakan *Git & GitHub Pull Request* dengan pembagian tugas sebagai berikut:

| Peran | Anggota | Fokus Tugas & Kontribusi |
| :--- | :--- | :--- |
| **Orang 1** | **Muthia Zhafira (2467051025)** | **Autentikasi, Role, & Halaman Error**<br>• Registrasi & login multi-role (Admin & Pelanggan)<br>• Middleware proteksi hak akses (`role:admin`, `role:pelanggan`)<br>• Dashboard awal Admin & template layout dasar<br>• Desain halaman error kustom (403, 404, 419, 500) |
| **Orang 2** | **Kharisma Jaka Harum (2417051068)** | **CRUD Master Data Layanan Laundry**<br>• Manajemen data paket layanan (Cuci Komplit, Express, Setrika, Bed Cover)<br>• Form tambah, edit, dan hapus layanan beserta penetapan tarif per kg<br>• Validasi input data layanan dan integrasi database |
| **Orang 3** | **Rheal Iftiqar Rozak (2417051029)** | **Fitur Pemesanan Cucian Pelanggan**<br>• Fitur tambah pesanan laundry oleh pelanggan dengan kalkulasi biaya otomatis<br>• Form input berat cucian (kg), pemilihan layanan, dan catatan khusus<br>• Validasi batas minimal/maksimal berat dan error handling form |
| **Orang 4** | **Alyssa Putri Hermawan (2417051051)** | **Status Laundry, Detail Transaksi, UI, & Integrasi**<br>• Fitur live visual stepper tracking status cucian (4 tahapan progres)<br>• Halaman Detail Transaksi & Struk/Nota digital print-ready (`window.print`)<br>• Halaman Riwayat Transaksi Selesai & arsip pengeluaran pelanggan<br>• Penyeragaman UI (desain bertema *Eco-Fresh Mint*, topbar navigasi, hero banner)<br>• Integrasi antarmuka dashboard pelanggan, pengujian, dan error handling |

---

## 🚀 Fitur Utama Aplikasi

### 👤 1. Sisi Pelanggan (Customer Portal)
- **Interactive Modern Dashboard**:
  - Hero banner menyambut pelanggan dengan tema *"I Wish You Wash Here"*.
  - Ringkasan statistik cucian (Total Pesanan, Dalam Proses, Cucian Selesai, Total Pengeluaran).
  - Widget **Live Tracking Pesanan Aktif** langsung di halaman beranda.
  - Katalog kartu pilihan layanan laundry dengan tombol pemesanan instan.
- **Pemesanan Cucian**:
  - Pelanggan memilih jenis layanan laundry dan memasukkan estimasi berat (kg).
  - Sistem menghitung total tagihan biaya secara otomatis (`harga_layanan * berat`).
  - Kolom catatan instruksi khusus (misal: pakaian warna dipisah, setrika licin, dll).
  - Edit & Batalkan pesanan khusus jika status masih *Menunggu*.
- **Pelacakan Status Cucian Real-time (Live Stepper Tracker)**:
  - Indikator progres visual dengan 4 tahapan status:
    1. 🕒 **Menunggu Konfirmasi**: Pesanan masuk dan menunggu verifikasi tim outlet.
    2. 🧺 **Sedang Dicuci & Diproses**: Pakaian sedang dicuci, dikeringkan, atau disetrika.
    3. ✨ **Selesai & Siap Diambil**: Pakaian bersih, wangi, rapi, dan siap diambil.
    4. 📦 **Sudah Diambil**: Pakaian telah diambil oleh pelanggan (transaksi tuntas).
- **Struk / Digital Invoice & Cetak Nota**:
  - Halaman nota pesanan resmi lengkap dengan kode transaksi `#ORD-...`, info pelanggan, tanggal, rincian biaya per kg, subtotal, dan total bayar.
  - Fitur **Cetak Struk** (`window.print`) yang dioptimasi khusus dengan CSS `@media print` sehingga sidebar dan navigasi otomatis tersembunyi saat dicetak ke printer atau disimpan sebagai PDF.
- **Halaman Riwayat Transaksi**:
  - Arsip khusus pesanan yang telah berstatus *Selesai* atau *Diambil*.
  - Menampilkan total akumulasi pengeluaran biaya laundry pelanggan.

---

### 🛡️ 2. Sisi Administrator (Admin Workspace)
- **Executive Admin Dashboard**:
  - Metrik kartu statistik (Total Pelanggan, Total Layanan, Total Pesanan, dan Total Omzet Penjualan).
  - Ringkasan status pesanan berbasis pill-badge.
  - Tabel transaksi terbaru yang masuk.
- **Kelola Pesanan & Pembaruan Status**:
  - Tabel pemantauan seluruh pesanan pelanggan.
  - Filter pesanan berdasarkan status (*Menunggu, Diproses, Selesai, Diambil*) dan pencarian nama pelanggan.
  - Kontrol ubah status pesanan secara instan (melalui dropdown tabel maupun panel kontrol di halaman detail).
- **Master Data Layanan**:
  - Tambah jenis layanan baru, ubah tarif per kg, perbarui deskripsi, dan hapus layanan.
- **Master Data Pelanggan**:
  - Melihat daftar seluruh akun pelanggan yang terdaftar.
  - Halaman detail riwayat pemesanan per pelanggan beserta total transaksi yang pernah dilakukan.

---

### 🔒 3. Keamanan & Pengalaman Pengguna (Security & UX)
- **Role-Based Access Control (RBAC)**: Pengalihan otomatis saat login; pelanggan dilarang mengakses prefix `/admin` dan admin dilarang mengakses prefix `/pelanggan`.
- **Ownership Authorization**: Proteksi kepemilikan pesanan; Pelanggan A dicegah membuka atau mengubah pesanan milik Pelanggan B (mengembalikan kode HTTP **403 Forbidden**).
- **Status Guard**: Pesanan yang sudah masuk tahap *Diproses* ke atas dikunci dari tindakan edit atau hapus pelanggan untuk menjaga integritas operasional.
- **Modern Responsive Design**: Responsif diakses dari perangkat mobile/tablet maupun desktop dengan font Google *Plus Jakarta Sans*, micro-animations, dan palet warna segar *Emerald Mint*.

---

## 🛠️ Tech Stack & Library

- **Backend Framework**: [Laravel](https://laravel.com/) (PHP 8.3 / 8.4)
- **Database Engine**: [PostgreSQL](https://www.postgresql.org/) (didukung juga untuk MySQL & SQLite)
- **Frontend & Styling**: 
  - HTML5 & Blade Templating Engine
  - [Bootstrap 5.3](https://getbootstrap.com/)
  - [Bootstrap Icons 1.11](https://icons.getbootstrap.com/)
  - Google Fonts (*Plus Jakarta Sans*)
- **Code Formatter & Linter**: [Laravel Pint](https://laravel.com/docs/pint)
- **Testing Suite**: [PHPUnit](https://phpunit.de/)

---

## 💻 Panduan Instalasi Lokal (Setup Guide)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di komputer lokal:

### 1. Clone Repositori
```bash
git clone https://github.com/muthiazha/utp-pwl-laundry.git
cd utp-pwl-laundry
```

### 2. Install Dependensi PHP (Composer)
```bash
composer install
```

### 3. Salin Environment File
```bash
# Untuk Windows Command Prompt:
copy .env.example .env

# Untuk Git Bash / Linux / macOS:
cp .env.example .env
```

### 4. Konfigurasi Database di `.env`
Buka file `.env` dan sesuaikan koneksi database. Proyek ini menggunakan **PostgreSQL** (port default `5432`):

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laundry_db
DB_USERNAME=postgres
DB_PASSWORD=
```
*(Pastikan database `laundry_db` sudah dibuat di PostgreSQL / HeidiSQL Anda).*

> **Alternatif MySQL:** Jika menggunakan MySQL bawaan Laragon/XAMPP, sesuaikan menjadi:
> ```env
> DB_CONNECTION=mysql
> DB_HOST=127.0.0.1
> DB_PORT=3306
> DB_DATABASE=laundry_db
> DB_USERNAME=root
> DB_PASSWORD=
> ```

### 5. Generate Application Key
```bash
php artisan key:generate
```

### 6. Jalankan Migrasi & Seeder Data Awal
Perintah ini akan membuat semua struktur tabel dan mengisi data awal (akun demo, jenis layanan, dan sampel pesanan):
```bash
php artisan migrate:fresh --seed
```

### 7. Jalankan Server Lokal
```bash
php artisan serve
```
Akses aplikasi melalui browser di: **`http://127.0.0.1:8000`**

---

## 🔑 Akun Uji Coba Default (Demo Credentials)

Gunakan akun berikut untuk menguji sistem:

| Peran Akun | Email Login | Password | Akses Halaman |
| :--- | :--- | :--- | :--- |
| **Administrator** | `admin@laundry.test` | `password` | `/admin/dashboard` |
| **Pelanggan** | `pelanggan@laundry.test` | `password` | `/pelanggan/dashboard` |

*(Anda juga dapat mendaftarkan akun pelanggan baru secara mandiri melalui menu **Daftar / Register**).*

---

## 🧪 Menjalankan Pengujian Otomatis (Testing)

Untuk memvalidasi integritas kode, logika bisnis transaksi, dan hak akses otorisasi:
```bash
php artisan test
```

---

<p align="center">
  Dibuat oleh Kelompok 1 UTP Pemrograman Web Lanjut.<br>
  <strong>Cuciin Laundry & Care © 2026</strong>
</p>
