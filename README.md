# 📦 Sistem Manajemen Inventaris Barang (CRUD Web)

Aplikasi web sederhana berbasis PHP dan MySQL untuk mengelola data barang masuk di sistem inventaris. Dibuat sebagai bagian dari Uji Kompetensi Keahlian (UKK) jurusan PPLG di SMKN 2 Padang.

## 🚀 Fitur Utama

- ✅ CRUD Data Barang (Create, Read, Update, Delete)
- 🔍 Pencarian berdasarkan nama barang
- 🗂️ Filter berdasarkan kategori barang
- 🛡️ Validasi input (nama, stok, dan harga)
- 📋 Manajemen kategori barang (CRUD kategori di halaman terpisah)
- 🔽 Dropdown kategori saat tambah barang
- 🎨 Antarmuka responsif menggunakan Bootstrap 5
- 📄 Pagination daftar barang
- 🔔 Notifikasi berhasil setelah aksi CRUD
- 📁 Export data ke Excel/PDF (opsional)

## 🛠️ Teknologi yang Digunakan

- PHP (Native)
- MySQL / MariaDB
- Bootstrap 5
- HTML & CSS
- JavaScript (minimal)
- XAMPP (untuk pengujian lokal)

## 🗂️ Struktur Folder

├── barang/ │ ├── index.php │ ├── tambah.php │ ├── edit.php │ └── hapus.php ├── kategori/ │ ├── index.php │ ├── tambah.php │ ├── edit.php │ └── hapus.php ├── config/ │ └── db.php ├── assets/ │ └── css/ │ └── bootstrap.min.css ├── navbar.php


## 🧭 Alur Program

1. Halaman `barang/index.php` menampilkan data barang.
2. User dapat mencari berdasarkan nama dan memfilter berdasarkan kategori.
3. Tambah/Edit Barang tersedia dengan validasi input.
4. CRUD kategori dikelola pada folder `kategori/`.
5. Antarmuka menggunakan Bootstrap.
6. Setiap aksi CRUD menampilkan notifikasi berhasil.
7. Fitur bonus seperti pagination dan export Excel/PDF (jika diaktifkan).

## 📂 Database

**Tabel `barang`:**
- id (INT, PRIMARY KEY)
- nama_barang (VARCHAR)
- kategori_id (INT, FOREIGN KEY)
- stok (INT)
- harga (INT)
- tanggal_masuk (DATE)

**Tabel `kategori`:**
- id (INT, PRIMARY KEY)
- nama_kategori (VARCHAR)

## 📄 Lisensi

Proyek ini bebas digunakan untuk kebutuhan pembelajaran. Silakan modifikasi sesuai kebutuhan Anda.

---

📌 **Dikembangkan oleh siswa SMKN 2 Padang – PPLG 2025**
