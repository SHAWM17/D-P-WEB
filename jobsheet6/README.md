# Jobsheet 6 - Fetch API & JSON (SIMPUS-Mini)

Proyek ini merupakan kelanjutan dari **Jobsheet 5 (JavaScript DOM & Event)** pada pengembangan aplikasi **SIMPUS-Mini**. Pada jobsheet ini, komunikasi asinkron diterapkan menggunakan **Fetch API** dan **JSON** untuk menggantikan rendering tabel statis di HTML menjadi rendering dinamis[cite: 1, 2].

---

## 🚀 Perubahan Utama di Jobsheet 6

1. **Sumber Data JSON:**
   - Menambahkan `data/buku.json` (10 objek data buku)[cite: 1, 8].
   - Menambahkan `data/anggota.json` (4 objek data anggota)[cite: 1, 8].
2. **Rendering Tabel Dinamis:**
   - Elemen `<tbody>` pada `buku/list.html` dan `anggota/list.html` dikosongkan[cite: 1, 2, 6].
   - Data di-fetch dan di-render secara asinkron menggunakan `assets/js/buku.js` dan `assets/js/anggota.js`[cite: 1, 2].
3. **Loading Indicator & Penanganan Error:**
   - Indikator `#loading-indicator` tampil selama proses fetch (dengan simulasi delay 600ms)[cite: 1, 2, 10, 15].
   - Blok `try/catch/finally` digunakan untuk menangani kegagalan fetch dan menampilkan pesan error ramah di dalam tabel[cite: 1, 2, 11, 14, 16].
4. **Event Delegation:**
   - Penanganan konfirmasi hapus (`initHapusConfirm`) pada `assets/js/app.js` diubah menggunakan pola **Event Delegation** pada elemen `document` agar dapat mendeteksi tombol `.btn-hapus` yang dibuat secara dinamis[cite: 1, 2, 18, 19].

---

## 📁 Struktur Folder

```text
jobsheet-06/
├── index.html
├── README.md
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       ├── app.js       # Event delegation pada .btn-hapus
│       ├── buku.js      # Fetch & render data/buku.json
│       └── anggota.js   # Fetch & render data/anggota.json
├── data/
│   ├── buku.json        # Source data buku (JSON)
│   └── anggota.json     # Source data anggota (JSON)
├── buku/
│   ├── list.html        # <tbody> kosong + loading-indicator
│   └── tambah.html
└── anggota/
    ├── list.html        # <tbody> kosong + loading-indicator
    └── tambah.html