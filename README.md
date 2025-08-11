<h1 align="center">JimpitanApp</h1>
<p align="center">
  Sistem Informasi Jimpitan Berbasis Laravel untuk Efisiensi Administrasi RT
</p>

<p align="center">
  <a href="https://github.com/kampusriset/23g_laravel_ekas_jimpitan/stargazers">
    <img src="https://img.shields.io/github/stars/kampusriset/23g_laravel_ekas_jimpitan?style=flat-square" alt="Stars">
  </a>
  <a href="https://github.com/kampusriset/23g_laravel_ekas_jimpitan/issues">
    <img src="https://img.shields.io/github/issues/kampusriset/23g_laravel_ekas_jimpitan?style=flat-square" alt="Issues">
  </a>
  <a href="https://github.com/laravel/laravel">
    <img src="https://img.shields.io/badge/Laravel-Framework-red?style=flat-square&logo=laravel" alt="Laravel">
  </a>
  <a href="#">
    <img src="https://img.shields.io/badge/PHP-8.3-blue?style=flat-square&logo=php" alt="PHP">
  </a>
</p>

---



## Tentang projek

**JimpitanApp** adalah aplikasi berbasis web yang dibangun menggunakan Laravel untuk membantu pengelolaan iuran jimpitan di tingkat RT/RW.  
Aplikasi ini memudahkan pencatatan, pelaporan, dan transparansi keuangan warga secara digital.

---

## Fitur Utama

- 📋 **Manajemen Warga** — Tambah, edit, dan hapus data warga.
- 💰 **Pencatatan Iuran Jimpitan** — Otomatis menghitung total pemasukan.
- 📊 **Laporan Keuangan** — Grafik pemasukan bulanan dan tahunan.
- 🔔 **Notifikasi Pembayaran** — Memberi pengingat untuk iuran yang belum dibayar.
- 🔐 **Autentikasi & Hak Akses** — Admin & user memiliki peran berbeda.

---

## 🛠️ Teknologi yang Digunakan

- **Laravel 10** — Framework PHP modern.
- **PHP 8.2** — Bahasa pemrograman backend.
- **MySQL** — Database relasional.
- **Bootstrap 5** — Tampilan responsif & modern.
- **Chart.js** — Visualisasi data.
- **SweetAlert2** — Popup interaktif.
  
## Nama Kelompok

- **Andrean** Taufik Hidayatullah (2313010570).
- **Aksyal** Fiqih ikhtiar (2313010578).
- **Fatih** Muhammad basrowi (2313010579).
- **Ganang** Setya Putra (2313010576).
- **Shady** Hulian Wibowo (2313010573).


## 📥 Instalasi

1. Clone repositori ini:
   ```bash
   git clone https://github.com/kampusriset/23g_laravel_ekas_jimpitan.git
2. masuk ke folder projek
   ```bash
   cd 23g_laravel_ekas_jimpitan
3. Install dependency:
   ```bash
   composer install
   npm install && npm run dev
4. Salin file .env:
   ```bash
   cp .env.example .env
5. Generate key aplikasi:
   ```bash
    php artisan key:generate
6. Jalankan migrasi
   ```bash
   hp artisan migrate --seed
7. Jalankan server
   ```bash
   php artisan serve

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
