# PeduliKita

PeduliKita adalah aplikasi donasi berbasis web yang dikembangkan menggunakan Laravel. Aplikasi ini bertujuan untuk mempermudah proses penggalangan dana dan penyaluran donasi secara transparan. Admin dapat mengelola program donasi, sedangkan pengguna dapat melihat program yang tersedia dan melakukan donasi melalui sistem yang telah disediakan.

## Fitur Utama

### Admin

* Login admin
* Dashboard statistik donasi
* Manajemen program donasi (CRUD)
* Verifikasi donasi
* Melihat riwayat donasi
* Mengelola data program donasi

### Pengguna

* Melihat daftar program donasi
* Melihat detail program donasi
* Melakukan donasi
* Upload bukti pembayaran
* Mengirim pesan melalui halaman kontak
* Mengisi preferensi donasi

## Teknologi yang Digunakan

* Laravel 11
* PHP 8.x
* MySQL
* Blade Template
* Bootstrap / CSS
* JavaScript

## Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/MuhammadAby/242410101090_Tugas_PWEB.git
cd PeduliKita
```

### 2. Install Dependency

```bash
composer install
```

### 3. Salin File Environment

```bash
cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Buka file `.env` kemudian sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pedulikita_db
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Jalankan Migration

```bash
php artisan migrate
```

### 7. Buat Storage Link

```bash
php artisan storage:link
```

### 8. Jalankan Server

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```text
Setelah menjalankan server lokal:

http://127.0.0.1:8000

Atau akses versi online (deployment):

Admin: https://242410101090tugaspweb-production-c336.up.railway.app/admin/dashboard 
User: https://242410101090tugaspweb-production-c336.up.railway.app/
```

## Struktur Database

### users

Menyimpan data pengguna dan admin.

* id
* name
* email
* password
* role
* created_at
* updated_at

### program_donasis

Menyimpan data program donasi.

* id
* nama
* kategori
* deskripsi
* target
* terkumpul
* gambar
* tanggal_mulai
* created_at
* updated_at

### donasis

Menyimpan data transaksi donasi.

* id
* nama
* email
* program_donasi_id
* nominal
* metode
* pesan
* bukti_transfer
* status
* created_at
* updated_at

## Relasi Database

### Program Donasi → Donasi

Satu program donasi dapat memiliki banyak donasi.

### Donasi → Program Donasi

Setiap donasi hanya terkait dengan satu program donasi.

## Akun Admin

Silakan menyesuaikan dengan data yang terdapat pada database.

Contoh:

```text
Email    : aby@gmail.com
Password : 12345678
```

## Pengembang

Proyek ini dikembangkan sebagai tugas mata kuliah Pemrograman Berbasis Web.

Universitas Jember
