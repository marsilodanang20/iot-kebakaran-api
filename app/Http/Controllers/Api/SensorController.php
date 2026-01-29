<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\SensorLog;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class SensorController extends Controller
{
    /**
     * GET /api/sensor
     * Informasi endpoint sensor
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'message' => 'Endpoint Sensor Ready. Gunakan method POST untuk mengirim data.',
            'guide'   => 'Kirim data JSON dengan format yang sesuai ke endpoint ini menggunakan method POST.'
        ]);
    }

    /**
     * POST /api/sensor
     * Menerima data dari ESP8266/ESP32
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string',
            'api'    => 'required|boolean',
            'waktu'  => 'required|date_format:Y-m-d H:i:s',
            'suhu'   => 'nullable|integer',
            'lokasi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi Gagal',
                'errors'  => $validator->errors()
            ], 422);
        }

        try {
            $log = SensorLog::create($request->all());

            // Cleanup log lama jika melebihi batas (500 data)
            $deletedCount = SensorLog::cleanupOldLogs();

            return response()->json([
                'success' => true,
                'message' => 'Data sensor berhasil disimpan',
                'data'    => $log,
                'cleanup' => $deletedCount > 0 ? "{$deletedCount} log lama dihapus" : null
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data ke database',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * GET /api/sensor/latest
     * Data terakhir untuk Ionic App
     */
    public function latest()
    {
        $latest = SensorLog::latest()->first();

        return response()->json([
            'success' => true,
            'message' => 'Data sensor terbaru',
            'data'    => $latest
        ]);
    }

    /**
     * GET /api/sensor/logs
     * Riwayat data sensor (Paginated)
     */
    public function logs()
    {
        $logs = SensorLog::orderBy('waktu', 'desc')->paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'Riwayat data sensor',
            'data'    => $logs
        ]);
    }

    /**
     * GET /api/health
     * Cek status API
     */
    public function health()
    {
        return response()->json([
            'success' => true,
            'message' => 'API IoT Kebakaran is Online',
            'server_time' => Carbon::now()->toDateTimeString()
        ]);
    }
}
