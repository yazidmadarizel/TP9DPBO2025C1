# TP9DPBO2025C1

Saya Yazid Madarizel dengan NIM 2305328 mengerjakan soal TP 9 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Desain Program
![image](https://github.com/user-attachments/assets/d409f07b-ae39-4eb4-9b30-86a4c4975775)

## Arsitektur Program (MVP)

Program ini menggunakan pola arsitektur Model-View-Presenter (MVP) yang membagi aplikasi menjadi tiga komponen utama:

### 1. Model
- Menangani logika data dan interaksi dengan database
- Komponennya:
  - `DB.class.php` - Kelas dasar untuk koneksi database
  - `Mahasiswa.class.php` - Representasi objek mahasiswa
  - `TabelMahasiswa.class.php` - Operasi database untuk tabel mahasiswa

### 2. View
- Menampilkan data kepada pengguna
- Komponennya:
  - `KontrakView.php` - Interface untuk view
  - `TampilMahasiswa.php` - Implementasi view untuk menampilkan data mahasiswa
  - Template HTML (skin.html, skin_form.html)

### 3. Presenter
- Mediator antara Model dan View
- Komponennya:
  - `KontrakPresenter.php` - Interface untuk presenter
  - `ProsesMahasiswa.php` - Implementasi presenter untuk memproses data mahasiswa

## Diagram Alur Program

```
┌───────────────┐     ┌───────────────┐     ┌───────────────┐
│     Model     │     │   Presenter   │     │     View      │
│ (Data Layer)  │◄────┤  (Mediator)   │◄────┤  (UI Layer)   │
└───────┬───────┘     └───────┬───────┘     └───────┬───────┘
        │                     │                     │
        │                     │                     │
┌───────▼───────┐     ┌───────▼───────┐     ┌───────▼───────┐
│ DB.class.php  │     │   Kontrak     │     │   Kontrak     │
│ Mahasiswa.php │     │   Presenter   │     │     View      │
│ TabelMhs.php  │     └───────┬───────┘     └───────┬───────┘
└───────────────┘             │                     │
                      ┌───────▼───────┐     ┌───────▼───────┐
                      │    Proses     │     │    Tampil     │
                      │   Mahasiswa   │     │   Mahasiswa   │
                      └───────────────┘     └───────────────┘
```

## Struktur Database

Database `mvp_php` memiliki satu tabel utama:

**Tabel mahasiswa**
- `id` (PK, Auto Increment)
- `nim` (Nomor Induk Mahasiswa)
- `nama` (Nama Mahasiswa)
- `tempat` (Tempat Lahir)
- `tl` (Tanggal Lahir)
- `gender` (Jenis Kelamin)
- `email` (Email)
- `telp` (Nomor Telepon)

## Alur Program 

### 1. Inisialisasi Aplikasi

1. User mengakses `index.php`
2. `index.php` memuat `TampilMahasiswa.php`
3. `TampilMahasiswa` membuat instance `ProsesMahasiswa`
4. `TampilMahasiswa` memanggil `tampil()` untuk memulai aplikasi

### 2. Tampilan Utama (Index)

1. `ProsesMahasiswa` memanggil `prosesDataMahasiswa()` untuk mengambil data dari database
2. Data diproses menjadi array objek `Mahasiswa`
3. `TampilMahasiswa` menampilkan data dalam bentuk tabel menggunakan template `skin.html`
4. Tabel menampilkan data mahasiswa dengan tombol Detail, Edit, dan Hapus untuk setiap baris
5. Tombol "Tambah Data" ditampilkan di atas tabel

### 3. Operasi CRUD (Create, Read, Update, Delete)

#### a. Tambah Data Mahasiswa (Create)
1. User klik tombol "Tambah Data"
2. Browser diarahkan ke `index.php?action=add`
3. `TampilMahasiswa` menampilkan form tambah data dengan template `skin_form.html`
4. User mengisi form dan submit
5. Data form diproses oleh `ProsesMahasiswa` melalui method `tambahMahasiswa()`
6. Database diupdate dan user diarahkan kembali ke halaman utama

#### b. Lihat Detail Mahasiswa (Read)
1. User klik tombol "Detail" pada baris data
2. Browser diarahkan ke `index.php?action=detail&id=X`
3. `TampilMahasiswa` mengambil data mahasiswa berdasarkan ID melalui `ProsesMahasiswa`
4. Data ditampilkan dalam format detail menggunakan template `skin_form.html`

#### c. Edit Data Mahasiswa (Update)
1. User klik tombol "Edit" pada baris data
2. Browser diarahkan ke `index.php?action=edit&id=X`
3. `TampilMahasiswa` menampilkan form edit dengan data yang sudah terisi
4. User mengubah data dan submit
5. Data form diproses oleh `ProsesMahasiswa` melalui method `editMahasiswa()`
6. Database diupdate dan user diarahkan kembali ke halaman utama

#### d. Hapus Data Mahasiswa (Delete)
1. User klik tombol "Hapus" pada baris data
2. Konfirmasi diberikan melalui dialog JavaScript
3. Jika user mengkonfirmasi, browser diarahkan ke `index.php?action=delete&id=X`
4. `ProsesMahasiswa` menghapus data melalui method `hapusMahasiswa()`
5. User diarahkan kembali ke halaman utama

## Dokumentasi

https://github.com/user-attachments/assets/ab7731a2-6058-4010-b0fe-b2dc7acb291e



