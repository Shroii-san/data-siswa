<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../config/koneksi.php';

$error = [];
$success = false;

if (isset($_POST['simpan'])) {
    $nis = trim(mysqli_real_escape_string($koneksi, $_POST['nis']));
    $nama = trim(mysqli_real_escape_string($koneksi, $_POST['nama']));
    $kelas = trim(mysqli_real_escape_string($koneksi, $_POST['kelas']));
    $jurusan = trim(mysqli_real_escape_string($koneksi, $_POST['jurusan']));
    $alamat = trim(mysqli_real_escape_string($koneksi, $_POST['alamat']));
    $no_hp = trim(mysqli_real_escape_string($koneksi, $_POST['no_hp']));

    // Validasi sederhana
    if ($nis == '')
        $error[] = "NIS tidak boleh kosong!";
    if ($nama == '')
        $error[] = "Nama tidak boleh kosong!";
    if ($kelas == '')
        $error[] = "Kelas tidak boleh kosong!";
    if ($jurusan == '')
        $error[] = "Jurusan tidak boleh dipilih!";

    // Cek NIS sudah ada belum
    $cekNis = mysqli_query($koneksi, "SELECT id FROM siswa WHERE nis='$nis'");
    if (mysqli_num_rows($cekNis) > 0) {
        $error[] = "NIS $nis sudah terdaftar!";
    }

    if (empty($error)) {
        $query = "INSERT INTO siswa (nis, nama, kelas, jurusan, alamat, no_hp)
                  VALUES ('$nis', '$nama', '$kelas', '$jurusan', '$alamat', '$no_hp')";
        $hasil = mysqli_query($koneksi, $query);

        if ($hasil) {
            header("Location: ../index.php?pesan=tambah_berhasil");
            exit();
        } else {
            $error[] = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>