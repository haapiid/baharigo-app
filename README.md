# Aplikasi Pemesanan Travel (Laravel 12)

Aplikasi pemesanan tiket travel berbasis web yang dibangun menggunakan **Laravel 12** (Fullstack Blade). Aplikasi ini mencakup fitur lengkap untuk Admin (Manajemen Jadwal & Laporan) dan Penumpang (Booking & Pembayaran).

## 🚀 Fitur Utama

### 1. Admin
- **Manajemen Jadwal:** CRUD (Create, Read, Update, Delete) jadwal travel.
- **Laporan Penumpang:** Melihat statistik jumlah penumpang per jadwal.
- **Detail Penumpang:** Melihat daftar nama penumpang dalam satu keberangkatan.
- **Dashboard Statistik:** Ringkasan data operasional.

### 2. Penumpang
- **Pencarian Tiket:** Melihat daftar jadwal travel yang tersedia (Real-time kuota).
- **Validasi Kuota Atomic:** Sistem otomatis mencegah *over-booking* menggunakan `lockForUpdate` (Database Transaction).
- **Booking & Pembayaran:** Upload bukti transfer untuk verifikasi.
- **Cetak Tiket:** Download Invoice/E-Ticket dalam bentuk PDF.

### 3. Keamanan & Teknis
- **Core Framework:** Laravel 12.x
- **Autentikasi:** Laravel Breeze (Session Based untuk Web, Sanctum Ready untuk API).
- **Database:** PostgreSQL 16+
- **Frontend:** Blade Templates + Tailwind CSS.
- **API:** RESTful Endpoint tersedia di `/api/schedules` (Support Mobile App Integration).

---

## 🛠️ Cara Instalasi

Ikuti langkah ini untuk menjalankan aplikasi di komputer lokal Anda:

### Prasyarat
- PHP >= 8.2 (Direkomendasikan PHP 8.3)
- Composer
- PostgreSQL

### Langkah-langkah

1. **Clone Repository**
   ```bash
   git clone <link-repo-anda>
   cd travel-app
2. **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
3. **Setup Enviroment**
    - Copy file .env.example menjadi .env.
    - Atur koneksi database PostgreSQL di .env:
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=travel_laravel
    DB_USERNAME=postgres
    DB_PASSWORD=root
4. **Generate Key & Migrasi Database**
    ```bash
    php artisan key:generate
    php artisan migrate:fresh --seed
    (Perintah --seed akan otomatis membuat akun Admin dan Penumpang dummy).
5. **Jalankan Server**
    ```bash
    php artisan serve

👤 Akun Testing (Default)
Gunakan akun ini untuk mencoba aplikasi:
Role,Email,Password
Admin,admin@travel.com,password
Penumpang,user@travel.com,password

Highlight Teknis
-   Concurrency Control: Menggunakan DB::transaction dan lockForUpdate() pada proses booking untuk mencegah kuota minus saat dipesan bersamaan oleh banyak user (Race Condition Handling).
-   Clean Architecture: Pemisahan logic yang jelas antara Controller, Model, dan View, serta penggunaan Middleware IsAdmin untuk proteksi Route.
-   PDF Generation: Integrasi barryvdh/laravel-dompdf untuk mencetak tiket.