# CRUDS Data Siswa - SMK Nusantara

**Latihan Pemrograman Web | Kelas XI RPL**

---

## Deskripsi

Aplikasi CRUDS (Create, Read, Update, Delete, Search) sederhana untuk mengelola data siswa SMK menggunakan PHP Native, Tailwind CSS, dan JavaScript.

---

## Teknologi yang Digunakan

- **PHP** (Native / tanpa framework)
- **MySQL** (Database)
- **Tailwind CSS** (CSS Framework, Styling halaman)
- **JavaScript** (Vanilla, untuk validasi & modal interaktif)

---

## Struktur File

````
data-siswa/
├── config/
│   └── koneksi.php          # Konfigurasi Koneksi Database
├── database/
│   └── database.sql         # File Database berisi Script SQL
├── includes/
│   ├── proses_tambah.php    # Proses edit Data
│   ├── proses_edit.php      # Proses Hapus Data
│   ├── proses_hapus.php     # Proses Cari Data
│   └── proses_search.php    # Proses Tambah Data
├── public/
│   └── assets/
│       ├── css/
│       │   ├── input.css    # File CSS sumber
│       │   └── output.css   # CSS Hasil Build
│       └── js/
│           └── app.js       # Script Modal & Event Handling
├── views/
│   ├── tambah.php           # Halaman Tambah Data
│   └── edit.php             # Halaman Edit Data
├── index.php                # Halaman Utama
├── package.lock.json
├── package.json
└── README.md                # Dokumentasi Project

---

## Cara Install & Menjalankan

### 1. Persiapan

Pastikan sudah install:

- **XAMPP** (atau Laragon)
- Browser (Chrome/Firefox)
- [Node.js](https://nodejs.org/) versi 18 atau lebih baru

### 2. Setup Database

1. Buka **phpMyAdmin** di browser: `http://localhost/phpmyadmin`
2. Klik **"SQL"** di menu atas
3. Copy-paste isi file `database.sql` ke dalam kotak SQL
4. Klik **"Go"** / **"Jalankan"**
5. Database `db_siswa` dan tabel `siswa` otomatis terbuat

### 3. Clone atau download project

```bash
git clone https://github.com/Shroii-san/data-siswa.git
````

Copy folder `cruds-siswa` ke:

```

C:\xampp\htdocs\cruds-siswa\

```

### 4. Install Tailwind CSS v4

```bash
npm install tailwindcss @tailwindcss/cli
```

### 5. Build CSS

```bash
npx @tailwindcss/cli -i ./public/assets/css/input.css -o ./public/assets/css/output.css --watch
```

### 6. Jalankan Aplikasi

Buka browser dan ketik:

```

http://localhost/cruds-siswa/index.php

```

---

## Struktur Tabel Database

**Nama Tabel:** `siswa`

| Kolom   | Tipe         | Keterangan          |
| ------- | ------------ | ------------------- |
| id      | INT (AI, PK) | ID otomatis         |
| nis     | VARCHAR(20)  | Nomor Induk Siswa   |
| nama    | VARCHAR(100) | Nama lengkap siswa  |
| kelas   | VARCHAR(10)  | Kelas (X/XI/XII)    |
| jurusan | VARCHAR(50)  | Jurusan             |
| alamat  | TEXT         | Alamat (opsional)   |
| no_hp   | VARCHAR(15)  | Nomor HP (opsional) |

---

## Fitur Aplikasi

| Fitur  | Keterangan                                      |
| ------ | ----------------------------------------------- |
| Create | Tambah data siswa baru dengan validasi form     |
| Read   | Tampilkan semua data dalam tabel                |
| Detail | Lihat detail data lewat modal popup             |
| Update | Edit data siswa yang sudah ada                  |
| Delete | Hapus data dengan konfirmasi modal              |
| Search | Cari data berdasarkan nama, NIS, kelas, jurusan |

---

## Catatan

- Koneksi database ada di file `koneksi.php`, sesuaikan `$user` dan `$password` kalau perlu
- Default username MySQL di XAMPP: `root`, password: _(kosong)_

---

_Dibuat untuk Latihan Pemrograman Web_

```

```
