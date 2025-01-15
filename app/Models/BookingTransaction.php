<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone_number',
        'booking_trx_id',
        'is_paid',
        'started_at',
        'total_amount',
        'duration',
        'ended_at',
        'office_space_id'
    ];

    // fungsi untuk generate id transaksi
    public static function generateUniqueTrxId()
    {
        $prefix = 'RO'; // Sebagai kode transaksi, contoh: RO1234
        do {
            $randomString = $prefix . mt_rand(1000, 9999); // Untuk generate string random dimana terdapat prefix dan angka random
        } while (self::where('booking_trx_id', $randomString)->exists()); // Kondisi untuk memeriksa apakah kode random yang dihasilkan sudah ada di dalam database

        return $randomString;
    }

    // 1 booking transaksi HANYA memiliki 1 office
    public function officeSpace(): BelongsTo
    {
        return $this->belongsTo(OfficeSpace::class, 'office_space_id');
    }
}
