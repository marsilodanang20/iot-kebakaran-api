<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorLog extends Model
{
    use HasFactory;

    /**
     * Batas maksimal log yang disimpan
     */
    const MAX_LOGS = 500;

    protected $fillable = [
        'status',
        'api',
        'suhu',
        'lokasi',
        'waktu',
    ];

    /**
     * Casting tipe data agar sesuai standard JSON
     */
    protected $casts = [
        'api' => 'boolean',
        'suhu' => 'integer',
        'waktu' => 'datetime',
    ];

    /**
     * Hapus log lama jika melebihi batas maksimal
     * Menyisakan hanya MAX_LOGS data terbaru
     */
    public static function cleanupOldLogs(): int
    {
        $totalLogs = self::count();
        
        if ($totalLogs <= self::MAX_LOGS) {
            return 0; // Tidak perlu cleanup
        }

        // Hitung berapa yang harus dihapus
        $toDelete = $totalLogs - self::MAX_LOGS;

        // Ambil ID data yang harus dihapus (yang paling lama)
        $oldestIds = self::orderBy('id', 'asc')
            ->limit($toDelete)
            ->pluck('id');

        // Hapus data lama
        $deleted = self::whereIn('id', $oldestIds)->delete();

        return $deleted;
    }
}
