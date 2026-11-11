# PerpusKita — Aplikasi Perpustakaan Sekolah Digital

Aplikasi latihan UKK RPL berbasis Laravel 11, berjalan lokal melalui `php artisan serve`.

## Fitur sesuai dokumen UKK
- Login dan daftar akun siswa; role admin dan siswa.
- Admin: dashboard, CRUD data buku, CRUD anggota, melihat transaksi.
- Siswa: melihat/mencari buku, melakukan peminjaman dan pengembalian.
- Admin dapat mencatat pengembalian transaksi.
- Pencarian buku dan transaksi.
- Stok berkurang saat peminjaman dan bertambah saat pengembalian.
- Database MySQL lokal (XAMPP).

## Persiapan
PHP 8.2+, Composer, XAMPP/MySQL, ekstensi PHP `pdo_mysql`, `mbstring`, `openssl`, `fileinfo`, `tokenizer`, `xml`, `ctype`, `json`.

## Cara menjalankan
1. Ekstrak ZIP ke `C:\xampp\htdocs\perpustakaan-digital`.
2. Buka folder tersebut di VS Code.
3. Buka terminal di folder project:
   ```bash
   composer install
   ```
4. Salin `.env.example` menjadi `.env`.
   ```powershell
   Copy-Item .env.example .env
   ```
5. Buat database bernama `perpustakaan` melalui phpMyAdmin.
6. Buat APP_KEY:
   ```bash
   php artisan key:generate
   ```
7. Jalankan migration dan data contoh:
   ```bash
   php artisan migrate --seed
   ```
8. Jalankan server:
   ```bash
   php artisan serve
   ```
9. Buka `http://127.0.0.1:8000`.

## Akun demo
- Admin: `admin@perpus.test` / `admin12345`
- Siswa: `siswa@perpus.test` / `siswa12345`

## Database SQL
Folder `database/sql/` berisi skema SQL MySQL sebagai dokumentasi. Cara utama membuat tabel adalah `php artisan migrate --seed`.

## Catatan
- Folder `vendor` tidak disertakan di ZIP; Composer membuatnya saat `composer install`.
- Aplikasi inti berjalan lokal. Font Google pada halaman dapat memakai font sistem jika komputer tidak terhubung internet.
- Akun yang mendaftar sendiri otomatis berperan sebagai siswa. Pembuatan admin tambahan dilakukan melalui seeder atau database.
