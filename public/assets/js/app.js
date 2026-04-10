// -----------------
//   HALAMAN UTAMA
// -----------------

function lihatDetail(id, nis, nama, kelas, jurusan, alamat, hp) {
  document.getElementById("dNis").innerText = nis;
  document.getElementById("dNama").innerText = nama;
  document.getElementById("dKelas").innerText = kelas;
  document.getElementById("dJurusan").innerText = jurusan;
  document.getElementById("dAlamat").innerText = alamat || "-";
  document.getElementById("dHp").innerText = hp || "-";
  document.getElementById("modalDetail").classList.remove("hidden");
}

function tutupModal() {
  document.getElementById("modalDetail").classList.add("hidden");
}

function konfirmasiHapus(id, nama) {
  document.getElementById("namaHapus").innerText = nama;
  document.getElementById("linkHapus").href =
    "includes/proses_hapus.php?hapus=" + id;
  document.getElementById("modalHapus").classList.remove("hidden");
}

function tutupModalHapus() {
  document.getElementById("modalHapus").classList.add("hidden");
}

// Klik di luar modal = tutup
document.getElementById("modalDetail").addEventListener("click", (e) => {
  if (e.target === this) tutupModal();
});
document.getElementById("modalHapus").addEventListener("click", (e) => {
  if (e.target === this) tutupModalHapus();
});

// Auto hilang alert setelah 4 detik
setTimeout(() => {
  const alert = document.getElementById("alertMsg");
  if (alert) alert.style.display = "none";
}, 4000);

// -----------------
// UNTUK FORM TAMBAH
// -----------------

// Validasi form sebelum submit
document.getElementById("formTambah").addEventListener("submit", (e) => {
  const valid = true;

  // Reset semua error
  document.querySelectorAll('[id^="error"]').forEach((el) => {
    el.classList.add("hidden");
  });

  const nis = document.getElementById("nis").value.trim();
  const nama = document.getElementById("nama").value.trim();
  const kelas = document.getElementById("kelas").value;
  const jurusan = document.getElementById("jurusan").value;

  if (nis === "") {
    document.getElementById("errorNis").classList.remove("hidden");
    document.getElementById("nis").focus();
    valid = false;
  }
  if (nama === "") {
    document.getElementById("errorNama").classList.remove("hidden");
    if (valid) document.getElementById("nama").focus();
    valid = false;
  }
  if (kelas === "") {
    document.getElementById("errorKelas").classList.remove("hidden");
    valid = false;
  }
  if (jurusan === "") {
    document.getElementById("errorJurusan").classList.remove("hidden");
    valid = false;
  }

  if (!valid) {
    e.preventDefault();
    // Scroll ke atas biar liat error
    window.scrollTo({ top: 0, behavior: "smooth" });
  } else {
    // Loading state pada tombol
    document.getElementById("btnSimpan").innerText = "Menyimpan...";
    document.getElementById("btnSimpan").disabled = true;
  }
});

// Otomatis kapital huruf pertama nama
document.getElementById("nama").addEventListener("input", () => {
  const val = this.value;
  if (val.length === 1) {
    this.value = val.toUpperCase();
  }
});

// -----------------
// UNTUK FORM EDIT
// -----------------
document.getElementById("formEdit").addEventListener("submit", (e) => {
  document.querySelectorAll('[id^="error"]').forEach((el) => {
    el.classList.add("hidden");
  });
  const valid = true;

  if (document.getElementById("nis").value.trim() === "") {
    document.getElementById("errorNis").classList.remove("hidden");
    valid = false;
  }
  if (document.getElementById("nama").value.trim() === "") {
    document.getElementById("errorNama").classList.remove("hidden");
    valid = false;
  }
  if (document.getElementById("kelas").value === "") {
    document.getElementById("errorKelas").classList.remove("hidden");
    valid = false;
  }
  if (document.getElementById("jurusan").value === "") {
    document.getElementById("errorJurusan").classList.remove("hidden");
    valid = false;
  }

  if (!valid) {
    e.preventDefault();
  } else {
    document.getElementById("btnUpdate").innerText = "⏳ Menyimpan...";
    document.getElementById("btnUpdate").disabled = true;
  }
});

// ----------
//   GLOBAL
// ----------

document.getElementById("nis").addEventListener("keypress", (e) => {
  if (!/[0-9]/.test(e.key)) e.preventDefault();
});
document.getElementById("no_hp").addEventListener("keypress", (e) => {
  if (!/[0-9]/.test(e.key)) e.preventDefault();
});
