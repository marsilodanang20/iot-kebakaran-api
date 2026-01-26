<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SensorLog extends Model
{
    use HasFactory;

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
}
