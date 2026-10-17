<?php

namespace Tests\Feature;

use App\Models\Layanan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PesananDanStatusTest extends TestCase
{
    use RefreshDatabase;

    private User $pelanggan;

    private User $pelangganLain;

    private User $admin;

    private Layanan $layanan;

    protected function setUp(): void
    {
        parent::setUp();

        $this->pelanggan = User::create([
            'name' => 'Pelanggan Uji',
            'email' => 'pelanggan.uji@laundry.test',
            'password' => 'password',
            'role' => 'pelanggan',
        ]);

        $this->pelangganLain = User::create([
            'name' => 'Pelanggan Lain',
            'email' => 'pelanggan.lain@laundry.test',
            'password' => 'password',
            'role' => 'pelanggan',
        ]);

        $this->admin = User::create([
            'name' => 'Admin Uji',
            'email' => 'admin.uji@laundry.test',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $this->layanan = Layanan::create([
            'nama_layanan' => 'Cuci Komplit Reguler',
            'harga' => 8000,
            'deskripsi' => 'Layanan cuci bersih dan setrika wangi.',
        ]);
    }

    /**
     * Pengunjung yang belum login (guest) diarahkan ke form login.
     */
    public function test_guest_di_redirect_ke_halaman_login(): void
    {
        $response = $this->get('/pelanggan/pesanan');

        $response->assertRedirect('/login');
    }

    /**
     * Pelanggan dapat melihat halaman daftar pesanan dan riwayat transaksi.
     */
    public function test_pelanggan_dapat_melihat_daftar_pesanan_dan_riwayat(): void
    {
        $response = $this->actingAs($this->pelanggan)->get('/pelanggan/pesanan');
        $response->assertStatus(200);
        $response->assertSee('Pesanan Saya');

        $responseRiwayat = $this->actingAs($this->pelanggan)->get('/pelanggan/riwayat');
        $responseRiwayat->assertStatus(200);
        $responseRiwayat->assertSee('Riwayat Transaksi');
    }

    /**
     * Pelanggan dapat membuat pesanan baru dan kalkulasi biaya otomatis.
     */
    public function test_pelanggan_dapat_membuat_pesanan_baru(): void
    {
        $response = $this->actingAs($this->pelanggan)->post('/pelanggan/pesanan', [
            'layanan_id' => $this->layanan->id,
            'berat' => 3.5,
            'catatan' => 'Jangan pakai pewangi mawar.',
        ]);

        $response->assertRedirect('/pelanggan/pesanan');
        $this->assertDatabaseHas('pesanans', [
            'user_id' => $this->pelanggan->id,
            'layanan_id' => $this->layanan->id,
            'berat' => 3.5,
            'total_biaya' => 28000,
            'status' => 'menunggu',
        ]);
    }

    /**
     * Pelanggan dapat melihat detail transaksi, struk, dan stepper tracking.
     */
    public function test_pelanggan_dapat_melihat_detail_pesanan_miliknya(): void
    {
        $pesanan = Pesanan::create([
            'user_id' => $this->pelanggan->id,
            'layanan_id' => $this->layanan->id,
            'berat' => 2.0,
            'total_biaya' => 16000,
            'status' => 'diproses',
        ]);

        $response = $this->actingAs($this->pelanggan)->get("/pelanggan/pesanan/{$pesanan->id}");

        $response->assertStatus(200);
        $response->assertSee($pesanan->kode_pesanan);
        $response->assertSee('Pelacakan Status Cucian');
        $response->assertSee('Cuciin Laundry');
    }

    /**
     * Keamanan Otorisasi: Pelanggan A tidak boleh melihat detail pesanan Pelanggan B (403 Forbidden).
     */
    public function test_pelanggan_tidak_dapat_melihat_pesanan_pelanggan_lain(): void
    {
        $pesananPelangganLain = Pesanan::create([
            'user_id' => $this->pelangganLain->id,
            'layanan_id' => $this->layanan->id,
            'berat' => 2.0,
            'total_biaya' => 16000,
            'status' => 'menunggu',
        ]);

        $response = $this->actingAs($this->pelanggan)->get("/pelanggan/pesanan/{$pesananPelangganLain->id}");

        $response->assertStatus(403);
    }

    /**
     * Pelanggan tidak dapat mengedit pesanan yang sudah diproses atau selesai.
     */
    public function test_pelanggan_tidak_dapat_mengedit_pesanan_yang_sudah_diproses(): void
    {
        $pesananDiproses = Pesanan::create([
            'user_id' => $this->pelanggan->id,
            'layanan_id' => $this->layanan->id,
            'berat' => 2.0,
            'total_biaya' => 16000,
            'status' => 'diproses',
        ]);

        $response = $this->actingAs($this->pelanggan)->get("/pelanggan/pesanan/{$pesananDiproses->id}/edit");

        $response->assertRedirect('/pelanggan/pesanan');
        $response->assertSessionHas('error');
    }

    /**
     * Admin dapat melihat detail pesanan dan memperbarui status cucian.
     */
    public function test_admin_dapat_memperbarui_status_pesanan(): void
    {
        $pesanan = Pesanan::create([
            'user_id' => $this->pelanggan->id,
            'layanan_id' => $this->layanan->id,
            'berat' => 4.0,
            'total_biaya' => 32000,
            'status' => 'menunggu',
        ]);

        // Admin lihat detail
        $responseDetail = $this->actingAs($this->admin)->get("/admin/pesanan/{$pesanan->id}");
        $responseDetail->assertStatus(200);

        // Admin update status ke 'diproses'
        $responseUpdate = $this->actingAs($this->admin)->patch("/admin/pesanan/{$pesanan->id}/status", [
            'status' => 'diproses',
        ]);

        $responseUpdate->assertSessionHas('success');
        $this->assertDatabaseHas('pesanans', [
            'id' => $pesanan->id,
            'status' => 'diproses',
        ]);
    }
}
