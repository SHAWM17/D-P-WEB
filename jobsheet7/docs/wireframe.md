# Wireframe & User Flow — SIMPUS-Mini

Dokumen ini berisi rancangan Antarmuka Pengguna (*Wireframe*) dan Pengalaman Pengguna (*User Flow*) untuk aplikasi **SIMPUS-Mini** (Sistem Informasi Perpustakaan Mini).

---

## 1. Definisi Aktor & Otorisasi

| Aktor | Peran & Hak Akses | Fitur yang Bisa Diakses |
| :--- | :--- | :--- |
| **Tamu** | Pengunjung tanpa login | Melihat katalog buku (`Beranda`, `Daftar Buku`). |
| **Petugas** | Pengelola sistem (butuh login) | Akses halaman-halaman CRUD (Beranda, Buku, Anggota), transaksi Peminjaman & Pengembalian Buku. |

---

## 2. User Flow Diagram

### 2.1 User Flow Peminjaman Buku

```text
[Petugas Login] 
       │
       ▼
[Dashboard] ──> [Pilih Menu "Peminjaman Baru"]
                       │
                       ▼
            [Pilih Anggota & Buku]
                       │
                       ▼
              { Stok Buku > 0? }
               /              \
             Ya                Tidak ──> [Tampilkan Peringatan "Stok Habis"]
             │
             ▼
      [Klik "Simpan"]
             │
             ▼
    [Stok Buku Berkurang -1]
             │
             ▼
  [Kembali ke Dashboard]

### 2.2 User Flow Pengembalian Buku

```text
[Petugas Login] 
       │
       ▼
[Dashboard] ──> [Pilih Menu "Pengembalian"]
                       │
                       ▼
            [Cari Transaksi Aktif]
                       │
                       ▼
         [Klik "Tandai Dikembalikan"]
                       │
                       ▼
    [Stok Buku Bertambah +1]
                       │
                       ▼
  [Kembali ke Dashboard]

---

## 3. Wireframe Halaman

### 3.1 Wireframe Halaman Login (Petugas)

+--------------------------------------+
| SIMPUS-Mini                          |
|--------------------------------------|
|                                      |
|  Login Petugas                       |
|                                      |
|  Username                            |
|  [______________________________]    |
|                                      |
|  Password                            |
|  [______________________________]    |
|                                      |
|  [ Masuk ]                           |
|                                      |
|  Belum punya akun? Daftar            |
|                                      |
+--------------------------------------+

### 3.2 Wireframe Dashboard (Petugas)

+-----------------------------------------------------+
| SIMPUS-Mini  | Beranda | Buku | Anggota | Logout    |
|-----------------------------------------------------|
| Dashboard                                           |
| Selamat datang, (Nama Petugas)                      |
|                                                     |
| +------------------+  +------------------+          |
| | Total Buku       |  | Total Anggota    |          |
| | 120              |  | 45               |          |
| +------------------+  +------------------+          |
|                                                     |
| +------------------+  +------------------+          |
| | Sedang Dipinjam  |  | Transaksi Terbaru|          |
| | 8                |  | 10               |          |
| +------------------+  +------------------+          |
|                                                     |
| Aksi Cepat:                                         |
| [ + Tambah Buku ]  [ + Tambah Anggota ]              |
| [ Peminjaman Baru ] [ Pengembalian ]                |
|                                                     |
| Status Sistem:                                      |
| - 2 buku stok habis                                 |
| - 1 anggota bertunggakan                            |
+-----------------------------------------------------+

### 3.3 Wireframe Form Peminjaman Buku

+-----------------------------------------------------+
| SIMPUS-Mini  | Beranda | Buku | Anggota | Logout    |
|-----------------------------------------------------|
| Transaksi > Peminjaman Buku Baru                    |
|                                                     |
| Form Peminjaman                                     |
|                                                     |
| Anggota : [ pilih anggota (dropdown)         v ]    |
| Buku    : [ pilih buku (dropdown, hanya stok > 0) v ]|
| Tgl Pinjam : [ auto: hari ini                    ]  |
|                                                     |
| [ Simpan Peminjaman ]   [ Batal ]                   |
+-----------------------------------------------------+

### 3.4 Wireframe Form / Tabel Pengembalian Buku

+-----------------------------------------------------+
| SIMPUS-Mini  | Beranda | Buku | Anggota | Logout    |
|-----------------------------------------------------|
| Transaksi > Pengembalian Buku                       |
|                                                     |
| Cari : [ nama anggota / judul buku ______ ] [ Cari ]|
|                                                     |
| Riwayat Peminjaman Aktif:                           |
| +-------------------------------------------------+ |
| | Anggota     | Buku          | Tgl Pinjam | Aksi | |
| |-------------|---------------|------------|------| |
| | Laskar      | Bumi Manusia  | 01/07      | [Kembali] |
| | Siti Aminah | Pelangi       | 10/07      | [Kembali] |
| +-------------------------------------------------+ |
|                                                     |
| Status Transaksi:                                   |
| - Selesai / Dipinjam                                |
+-----------------------------------------------------+