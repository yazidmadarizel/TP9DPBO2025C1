# TP9DPBO2025C1

Saya Yazid Madarizel dengan NIM 2305328 mengerjakan soal TP 9 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

# Sistem Manajemen Mahasiswa PHP MVP

Aplikasi manajemen mahasiswa ringan yang dibangun menggunakan pola arsitektur Model-View-Presenter.

## Gambaran Arsitektur

Aplikasi ini mengikuti pemisahan yang jelas pada berbagai komponen melalui MVP:

### Layer Model
Menangani operasi data dan logika bisnis:
- `DB.class.php` - Pengelola koneksi database inti
- `Mahasiswa.class.php` - Representasi entitas mahasiswa
- `TabelMahasiswa.class.php` - Operasi database untuk catatan mahasiswa

### Layer View
Mengelola tampilan antarmuka pengguna:
- `KontrakView.php` - Kontrak interface untuk view
- `TampilMahasiswa.php` - Implementasi untuk menampilkan data mahasiswa
- Template HTML (`skin.html`, `skin_form.html`)

### Layer Presenter
Mengkoordinasikan antara Model dan View:
- `KontrakPresenter.php` - Kontrak interface untuk presenter
- `ProsesMahasiswa.php` - Implementasi untuk pemrosesan data mahasiswa

## Struktur Database

**Tabel MySQL: `mahasiswa`**
- `id` - Kunci utama (auto increment)
- `nim` - Nomor Induk Mahasiswa
- `nama` - Nama Mahasiswa
- `tempat` - Tempat lahir
- `tl` - Tanggal lahir
- `gender` - Jenis kelamin
- `email` - Alamat email
- `telp` - Nomor telepon

## Alur Aplikasi

### Halaman Utama
1. Pengguna mengakses `index.php`
2. Sistem menampilkan daftar mahasiswa dalam format tabel
3. Aksi tersedia per baris: Detail, Edit, Hapus
4. Tombol "Tambah Mahasiswa" tersedia di atas tabel

### Operasi CRUD

#### Tambah Data (Create)
- Path: `index.php?action=add`
- Pengguna mengisi dan mengirim formulir
- Data divalidasi oleh Presenter
- Data baru dimasukkan ke database

#### Lihat Detail (Read)
- Path: `index.php?action=detail&id=X`
- Sistem menampilkan informasi detail mahasiswa

#### Ubah Data (Update)
- Path: `index.php?action=edit&id=X`
- Formulir telah diisi dengan data yang ada
- Pengguna memodifikasi dan mengirim perubahan
- Catatan database diperbarui

#### Hapus Data (Delete)
- Path: `index.php?action=delete&id=X`
- Dialog konfirmasi JavaScript
- Catatan dihapus dari database jika dikonfirmasi

## Dokumentasi

https://github.com/user-attachments/assets/ab7731a2-6058-4010-b0fe-b2dc7acb291e



