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
}
