<?php

namespace Database\Seeders;

use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@laundry.test'],
            [
                'name' => 'Admin Laundry',
                'password' => 'password',
                'role' => 'admin',
            ]
        );

        $pelanggan = User::firstOrCreate(
            ['email' => 'pelanggan@laundry.test'],
            [
                'name' => 'Budi Santoso',
                'password' => 'password',
                'role' => 'pelanggan',
            ]
        );

        $layanan1 = Layanan::firstOrCreate(
            ['nama_layanan' => 'Cuci Komplit Reguler'],
            [
                'harga' => 7000,
                'deskripsi' => 'Pencucian bersih, pewangi premium, pengeringan, dan setrika rapi. Estimasi 2 hari.',
            ]
        );

        $layanan2 = Layanan::firstOrCreate(
            ['nama_layanan' => 'Cuci Kering Express'],
            [
                'harga' => 12000,
                'deskripsi' => 'Pencucian super cepat dengan pengering higienis selesai dalam 6-8 jam.',
            ]
        );

        $layanan3 = Layanan::firstOrCreate(
            ['nama_layanan' => 'Setrika Uap Premium'],
            [
                'harga' => 5000,
                'deskripsi' => 'Khusus pakaian yang sudah dicuci sendiri, disetrika uap hingga licin dan wangi.',
            ]
        );

        $layanan4 = Layanan::firstOrCreate(
            ['nama_layanan' => 'Bed Cover & Selimut'],
            [
                'harga' => 15000,
                'deskripsi' => 'Pencucian menyeluruh untuk sprei besar, bed cover tebal, dan selimut bulu.',
            ]
        );

        // Tambah contoh pesanan dengan berbagai status jika belum ada
        if (Pesanan::count() === 0) {
            Pesanan::create([
                'user_id' => $pelanggan->id,
                'layanan_id' => $layanan1->id,
                'berat' => 3.5,
                'total_biaya' => Pesanan::hitungTotalBiaya($layanan1, 3.5),
                'status' => 'diproses',
                'catatan' => 'Tolong pisahkan pakaian warna putih dengan yang luntur ya mas.',
            ]);

            Pesanan::create([
                'user_id' => $pelanggan->id,
                'layanan_id' => $layanan2->id,
                'berat' => 2.0,
                'total_biaya' => Pesanan::hitungTotalBiaya($layanan2, 2.0),
                'status' => 'menunggu',
                'catatan' => 'Perlu dipakai besok pagi untuk kuliah.',
            ]);

            Pesanan::create([
                'user_id' => $pelanggan->id,
                'layanan_id' => $layanan4->id,
                'berat' => 4.0,
                'total_biaya' => Pesanan::hitungTotalBiaya($layanan4, 4.0),
                'status' => 'selesai',
                'catatan' => 'Sprei king size warna biru.',
            ]);

            Pesanan::create([
                'user_id' => $pelanggan->id,
                'layanan_id' => $layanan3->id,
                'berat' => 5.0,
                'total_biaya' => Pesanan::hitungTotalBiaya($layanan3, 5.0),
                'status' => 'diambil',
                'catatan' => 'Kemeja kerja 10 pcs.',
            ]);
        }
    }
}
