# Aplikasi Pemesanan Kendaraan Tambang Nikel

Aplikasi web untuk memonitoring dan mengelola pemesanan kendaraan di perusahaan tambang nikel.

## Daftar Username & Password

| Role                 | Username (Email)     | Password |
| :------------------- | :------------------- | :------- |
| Admin                | `admin@example.com`  | `password` |
| Pihak Penyetuju (Lvl 1)| `approver1@example.com` | `password` |
| Pihak Penyetuju (Lvl 2)| `approver2@example.com` | `password` |
| Pegawai (User Biasa) | `user@example.com`   | `password` |
| Pegawai lainnya      | `factory generated users` (lihat database) | `password` |

## Versi Teknologi

* **Database Version:** MySQL 8.0+ (atau sesuai versi yang Anda gunakan)
* **PHP Version:** 8.2 (disarankan, kompatibel dengan Laravel 10)
* **Framework:** Laravel 10

## Panduan Penggunaan Aplikasi

### Prasyarat

Pastikan Anda telah menginstal:

* PHP (8.1+)
* Composer
* Node.js & NPM/Yarn
* MySQL Server (atau database lain yang didukung Laravel)
* Web Server (Apache/Nginx, biasanya termasuk dalam XAMPP/WAMP/Laragon)

### Instalasi dan Setup

1.  **Clone Repositori:**
    ```bash
    git clone <URL_REPO_ANDA> nama-aplikasi-kendaraan
    cd nama-aplikasi-kendaraan
    ```
    *Jika Anda membuat dari awal seperti panduan ini, lewati langkah ini dan lanjutkan dari langkah 2.*

2.  **Instal Dependensi Composer:**
    ```bash
    composer install
    ```

3.  **Salin File Environment:**
    ```bash
    cp .env.example .env
    ```

4.  **Buat App Key:**
    ```bash
    php artisan key:generate
    ```

5.  **Konfigurasi Database:**
    Buka file `.env` dan sesuaikan koneksi database Anda:
    ```dotenv
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_anda
    DB_USERNAME=root
    DB_PASSWORD=
    ```
    Pastikan Anda telah membuat database dengan nama yang sama di server MySQL Anda.

6.  **Jalankan Migrasi Database:**
    ```bash
    php artisan migrate
    ```

7.  **Jalankan Seeder (Data Dummy):**
    ```bash
    php artisan db:seed
    ```
    Ini akan mengisi database dengan user (admin, approver, user biasa) dan beberapa data kendaraan dummy.

8.  **Instal Dependensi NPM dan Kompilasi Aset Frontend:**
    ```bash
    npm install
    npm run dev
    ```
    *Gunakan `npm run build` untuk produksi.*

9.  **Jalankan Aplikasi:**
    ```bash
    php artisan serve
    ```
    Aplikasi akan tersedia di `http://localhost:8000`.

### Fitur Utama

* **Pemesanan Kendaraan:**
    * Login sebagai `user@example.com` (atau user biasa lainnya).
    * Akses `/bookings/create` untuk membuat pemesanan baru.
    * Lihat riwayat pemesanan Anda di `/my-bookings`.
* **Persetujuan Berjenjang:**
    * Login sebagai `approver1@example.com` untuk menyetujui di Level 1 (akses `/approvals/level1`).
    * Login sebagai `approver2@example.com` untuk menyetujui di Level 2 (akses `/approvals/level2`).
    * Pemesanan harus disetujui Level 1 terlebih dahulu sebelum muncul di Level 2.
* **Dashboard Admin:**
    * Login sebagai `admin@example.com`.
    * Akses `/dashboard` untuk melihat ringkasan.
    * Kelola kendaraan di `/admin/vehicles`.
    * Kelola pengguna dan role mereka di `/admin/users`.
    * Lihat dan tentukan driver/kendaraan untuk pemesanan di `/admin/bookings`.
* **Laporan Periodik (Excel):**
    * Login sebagai `admin@example.com`.
    * Akses `/reports/bookings` untuk melihat laporan.
    * Klik tombol "Export to Excel" untuk mengunduh laporan.
