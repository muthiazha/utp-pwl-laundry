<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    protected $fillable = [
        'user_id',
        'layanan_id',
        'berat',
        'total_biaya',
        'status',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'berat' => 'decimal:2',
            'total_biaya' => 'decimal:2',
        ];
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return BelongsTo<Layanan, $this> */
    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    /**
     * Hitung total biaya berdasarkan harga layanan dan berat cucian.
     */
    public static function hitungTotalBiaya(Layanan $layanan, float $beratKg): float
    {
        return $layanan->harga * $beratKg;
    }

    /**
     * Label status pesanan dalam Bahasa Indonesia.
     *
     * @return array<string, string>
     */
    public static function daftarStatus(): array
    {
        return [
            'menunggu' => 'Menunggu',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'diambil' => 'Diambil',
        ];
    }

    public function labelStatus(): string
    {
        return self::daftarStatus()[$this->status] ?? $this->status;
    }

    public function badgeColor(): string
    {
        return match ($this->status) {
            'menunggu' => 'warning',
            'diproses' => 'info',
            'selesai' => 'success',
            'diambil' => 'secondary',
            default => 'dark',
        };
    }

    public function getKodePesananAttribute(): string
    {
        return '#ORD-'.str_pad((string) $this->id, 5, '0', STR_PAD_LEFT);
    }

    /**
     * Dapatkan detail tahapan status untuk tracking visual.
     *
     * @return array<int, array{key: string, label: string, icon: string, desc: string, state: string}>
     */
    public function getLangkahStatus(): array
    {
        $urutan = ['menunggu', 'diproses', 'selesai', 'diambil'];
        $posisiAktif = array_search($this->status, $urutan, true);
        if ($posisiAktif === false) {
            $posisiAktif = 0;
        }

        $definisi = [
            'menunggu' => [
                'label' => 'Menunggu Konfirmasi',
                'icon' => 'bi-clock-history',
                'desc' => 'Pesanan diterima, menunggu diproses oleh staf laundry.',
            ],
            'diproses' => [
                'label' => 'Sedang Dicuci & Diproses',
                'icon' => 'bi-droplet-half',
                'desc' => 'Pakaian sedang dalam tahap pencucian, pengeringan, atau setrika.',
            ],
            'selesai' => [
                'label' => 'Selesai & Siap Diambil',
                'icon' => 'bi-check2-circle',
                'desc' => 'Pakaian telah bersih, rapi, dan siap diambil di outlet.',
            ],
            'diambil' => [
                'label' => 'Sudah Diambil',
                'icon' => 'bi-bag-check-fill',
                'desc' => 'Pesanan telah diambil oleh pelanggan. Transaksi selesai.',
            ],
        ];

        $hasil = [];
        foreach ($urutan as $index => $key) {
            $state = 'upcoming';
            if ($index < $posisiAktif) {
                $state = 'completed';
            } elseif ($index === $posisiAktif) {
                $state = 'current';
            }

            $hasil[] = [
                'key' => $key,
                'label' => $definisi[$key]['label'],
                'icon' => $definisi[$key]['icon'],
                'desc' => $definisi[$key]['desc'],
                'state' => $state,
            ];
        }

        return $hasil;
    }
}
