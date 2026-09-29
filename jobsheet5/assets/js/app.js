
// 1. Hamburger Menu (JS-driven, menggantikan Checkbox Hack)
function initNavToggle() {
  const toggleBtn = document.getElementById("nav-toggle-btn");
  const nav = document.querySelector("header nav");

  // Guard Clause: Batalkan jika elemen tidak ditemukan di halaman
  if (!toggleBtn || !nav) return;

  toggleBtn.addEventListener("click", function () {
    nav.classList.toggle("nav-open");
  });
}

// 2. Konfirmasi Hapus Baris Tabel
function initHapusConfirm() {
  const hapusButtons = document.querySelectorAll(".btn-hapus");

  hapusButtons.forEach(function (btn) {
    btn.addEventListener("click", function () {
      const row = btn.closest("tr");
      // Mengambil teks dari sel <td> pertama (Judul/Nama) jika ada
      const nama = row ? row.querySelector("td")?.textContent : "data ini";

      const yakin = confirm('Yakin ingin menghapus "' + nama + '"?');
      if (yakin && row) {
        row.remove(); // Menghapus baris dari tampilan DOM (front-end saja)
      }
    });
  });
}

// 3. Filter / Pencarian Tabel Real-Time
function initTableFilter() {
  const input = document.getElementById("search-input");
  const table = document.querySelector(".table-responsive table");

  // Guard Clause
  if (!input || !table) return;

  input.addEventListener("keyup", function () {
    const keyword = input.value.toLowerCase();
    const rows = table.querySelectorAll("tbody tr");

    rows.forEach(function (row) {
      const teks = row.textContent.toLowerCase();
      // Sembunyikan baris jika tidak cocok, tampilkan jika cocok
      row.style.display = teks.includes(keyword) ? "" : "none";
    });
  });
}

// 4. Validasi Form Client-Side
// Helper 4.1: Menampilkan pesan error di bawah input
function tampilkanError(input, pesan) {
  hapusError(input); // Bersihkan error lama jika ada

  const span = document.createElement("span");
  span.className = "error";
  span.textContent = pesan;

  // Sisipkan pesan tepat di bawah elemen input
  input.insertAdjacentElement("afterend", span);
}

// Helper 4.2: Menghapus pesan error
function hapusError(input) {
  const next = input.nextElementSibling;
  if (next && next.classList.contains("error")) {
    next.remove();
  }
}

// Fungsi Utama Validasi Form
function initValidasiForm() {
  const form = document.getElementById("form-tambah");

  // Guard Clause
  if (!form) return;

  form.addEventListener("submit", function (e) {
    let valid = true;

    // A. Validasi Field Judul Buku ATAU Nama Anggota (Mandatori/Wajib diisi)
    const judul = form.querySelector("[name='judul'], [name='nama']");
    if (judul && judul.value.trim() === "") {
      tampilkanError(judul, "Field ini wajib diisi.");
      valid = false;
    } else if (judul) {
      hapusError(judul);
    }

    // B. Validasi Pengarang / Tempat Lahir (Wajib diisi jika field ada)
    const pengarang = form.querySelector("[name='pengarang']");
    if (pengarang && pengarang.value.trim() === "") {
      tampilkanError(pengarang, "Field ini wajib diisi.");
      valid = false;
    } else if (pengarang) {
      hapusError(pengarang);
    }

    // C. Validasi Rentang Tahun (Antara 1900 - 2026)
    const tahun = form.querySelector("[name='tahun']");
    if (tahun) {
      const nilai = parseInt(tahun.value, 10);
      if (isNaN(nilai) || nilai < 1900 || nilai > 2026) {
        tampilkanError(tahun, "Tahun harus di antara 1900-2026.");
        valid = false;
      } else {
        hapusError(tahun);
      }
    }

    // D. Validasi Stok (Non-negatif)
    const stok = form.querySelector("[name='stok']");
    if (stok) {
      const nilaiStok = parseInt(stok.value, 10);
      if (isNaN(nilaiStok) || nilaiStok < 0) {
        tampilkanError(stok, "Stok tidak boleh negatif.");
        valid = false;
      } else {
        hapusError(stok);
      }
    }

    // Batalkan proses submit jika ada data yang belum valid
    if (!valid) {
      e.preventDefault();
    }
  });
}

// ===== Entry Point (Inisialisasi Setelah DOM Selesai Dimuat) =====
document.addEventListener("DOMContentLoaded", function () {
  initNavToggle();
  initHapusConfirm();
  initTableFilter();
  initValidasiForm();
});