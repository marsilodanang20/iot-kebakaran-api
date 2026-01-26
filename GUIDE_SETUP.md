# Panduan Setup Backend & Database: Sistem IoT Sensor Kebakaran

Dokumen ini berisi langkah-langkah lengkap untuk mengonfigurasi database dan backend Laravel untuk sistem monitoring kebakaran berbasis IoT (ESP8266/ESP32) dan Mobile App (Ionic).

---

## 1. Persyaratan Sistem
- **PHP**: ^8.1
- **Composer** (untuk manajemen package)
- **Laragon/XAMPP** (untuk MySQL Server)
- **Database Name**: `iot_kebakaran` (sesuaikan di .env)

---

## 2. Langkah Konfigurasi Database

### A. Buat Database
Buka MySQL (melalui phpMyAdmin atau Terminal) dan jalankan:
```sql
CREATE DATABASE iot_kebakaran;
```

### B. Konfigurasi `.env`
Buka file `.env` di root folder dan sesuaikan bagian database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=iot_kebakaran
DB_USERNAME=root
DB_PASSWORD=

# Tambahkan API Key untuk keamanan
FIRE_SENSOR_API_KEY=IoT-Kebakaran-Secret-Key-2024
```

---

## 3. Langkah Instalasi & Database (Selesai dilakukan)

Semua kode (Model, Controller, Middleware, dan Routes) telah diimplementasikan secara otomatis. Anda hanya perlu memastikan database telah dibuat di MySQL dan menjalankan migrasi:

```bash
# Jalankan Migrasi Database
php artisan migrate
```

---

## 4. Implementasi Kode

Pastikan file berikut sudah diisi sesuai dengan kode yang diberikan sebelumnya:

1.  **Migration**: `database/migrations/xxxx_xx_xx_create_sensor_logs_table.php`
2.  **Model**: `app/Models/SensorLog.php`
3.  **Middleware**: `app/Http/Middleware/ApiKeyMiddleware.php`
4.  **Controller**: `app/Http/Controllers/Api/SensorController.php`
5.  **Kernel**: `app/Http/Kernel.php` (Daftarkan 'api.key')
6.  **Routes**: `routes/api.php`

---

## 5. Dokumentasi API (Endpoints)

| Method | Endpoint | Fungsi | Auth |
| :--- | :--- | :--- | :--- |
| `GET` | `/api/health` | Cek status server | No |
| `POST` | `/api/sensor` | Simpan data dari ESP | **Yes** (API Key) |
| `GET` | `/api/sensor/latest` | Ambil data terbaru (Ionic) | **Yes** (API Key) |
| `GET` | `/api/sensor/logs` | Riwayat data (Ionic) | **Yes** (API Key) |

---

## 6. Contoh Testing (Postman / ESP)

### POST `/api/sensor`
**Headers:**
- `X-API-KEY`: `IoT-Kebakaran-Secret-Key-2024`
- `Content-Type`: `application/json`

**Body (JSON):**
```json
{
  "status": "BAHAYA",
  "api": true,
  "suhu": 40,
  "lokasi": "Lab Komputer",
  "waktu": "2024-05-20 10:00:00"
}
```

---

## 7. Catatan Penting
- **Timezone**: Waktu diatur ke `Asia/Jakarta` di `.env` atau `config/app.php`.
- **Casting**: Data `api` akan otomatis menjadi `true/false` dan `waktu` menjadi objek Carbon di Laravel.
- **Pagination**: Endpoint `/api/sensor/logs` menggunakan pagination (20 data per halaman).
