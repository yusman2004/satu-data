# Sistem Informasi Satu Data

## 📌 Tentang Project

**Sistem Informasi Satu Data** adalah aplikasi berbasis web yang dikembangkan menggunakan **Laravel** untuk mengelola, menyimpan, dan menyajikan data secara terpusat.

Aplikasi ini dibuat untuk membantu proses pengelolaan data agar lebih terstruktur, mudah diakses, dan dapat digunakan oleh pengguna sesuai dengan hak akses masing-masing.

## 🛠️ Teknologi yang Digunakan

* Laravel
* PHP 8.x
* MySQL / MariaDB
* Bootstrap / CSS
* JavaScript
* XAMPP
* Composer

## 📋 Persyaratan Sistem

Sebelum menjalankan project, pastikan komputer sudah memiliki:

* PHP 8.x
* Composer
* XAMPP
* MySQL atau MariaDB
* Git
* Web Browser

## 🚀 Instalasi Project

### 1. Clone Repository

```bash
git clone [URL_REPOSITORY]
```

Masuk ke folder project:

```bash
cd SatuData-Laravel9-PHP8.0.30-XAMPP
```

### 2. Install Dependency

Jalankan:

```bash
composer install
```

### 3. Membuat File Environment

Salin file `.env.example` menjadi `.env`.

Windows:

```cmd
copy .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Buka file `.env`, kemudian sesuaikan konfigurasi database.

Contoh:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=satudata
DB_USERNAME=root
DB_PASSWORD=
```

Buat database dengan nama:

```text
satudata
```

melalui phpMyAdmin.

### 6. Menjalankan Migration

Jalankan:

```bash
php artisan migrate
```

Jika project memiliki seeder:

```bash
php artisan db:seed
```

atau:

```bash
php artisan migrate --seed
```

### 7. Menjalankan Project

Jalankan:

```bash
php artisan serve
```

Kemudian buka browser:

```text
http://127.0.0.1:8000
```

## 👤 Akun Administrator

Jika menggunakan akun administrator bawaan dari seeder:

```text
Email    : admin@satudata.test
Password : password
```

Password tersebut disimpan menggunakan hashing Laravel.

## 🔐 Fitur Utama

* Login dan autentikasi pengguna
* Manajemen pengguna
* Manajemen data
* Tambah data
* Edit data
* Hapus data
* Pencarian data
* Dashboard administrator
* Pengelolaan data secara terpusat
* Sistem hak akses pengguna

## 📁 Struktur Project

Struktur utama project Laravel:

```text
SatuData-Laravel9-PHP8.0.30-XAMPP/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/
│   └── Providers/
├── bootstrap/
├── config/
├── database/
│   ├── migrations/
│   └── seeders/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   └── web.php
├── storage/
├── tests/
├── .env.example
├── artisan
├── composer.json
└── README.md
```

## 🗄️ Database

Database digunakan untuk menyimpan seluruh data aplikasi, termasuk data pengguna dan data utama Sistem Informasi Satu Data.

Migration Laravel berada di:

```text
database/migrations/
```

Seeder berada di:

```text
database/seeders/
```

## ⚙️ Perintah Laravel yang Sering Digunakan

Menjalankan server:

```bash
php artisan serve
```

Membersihkan cache:

```bash
php artisan optimize:clear
```

Membuat model:

```bash
php artisan make:model NamaModel
```

Membuat controller:

```bash
php artisan make:controller NamaController
```

Membuat migration:

```bash
php artisan make:migration create_nama_table
```

Melihat daftar route:

```bash
php artisan route:list
```

Menjalankan migration:

```bash
php artisan migrate
```

Menjalankan seeder:

```bash
php artisan db:seed
```

## 🧹 Troubleshooting

Jika terjadi masalah setelah perubahan konfigurasi atau kode, jalankan:

```bash
composer dump-autoload
php artisan optimize:clear
```

Kemudian jalankan kembali:

```bash
php artisan serve
```

Jika terjadi masalah koneksi database, periksa konfigurasi berikut pada `.env`:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=satudata
DB_USERNAME=root
DB_PASSWORD=
```

## 👨‍💻 Pengembang

**YUSMAN TELAUMBANUA**

Project ini dikembangkan sebagai bagian dari pengembangan aplikasi Sistem Informasi Satu Data berbasis Laravel.

## 📄 Lisensi

Project ini dibuat untuk keperluan pembelajaran dan pengembangan aplikasi.
