<?php
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ../index.php");
    exit();
}

$id = (int) $_GET['id'];
$data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id=$id");

if (mysqli_num_rows($data) == 0) {
    header("Location: ../index.php");
    exit();
}

$siswa = mysqli_fetch_assoc($data);
$error = [];

if (isset($_POST['update'])) {
    $nis = trim(mysqli_real_escape_string($koneksi, $_POST['nis']));
    $nama = trim(mysqli_real_escape_string($koneksi, $_POST['nama']));
    $kelas = trim(mysqli_real_escape_string($koneksi, $_POST['kelas']));
    $jurusan = trim(mysqli_real_escape_string($koneksi, $_POST['jurusan']));
    $alamat = trim(mysqli_real_escape_string($koneksi, $_POST['alamat']));
    $no_hp = trim(mysqli_real_escape_string($koneksi, $_POST['no_hp']));

    // Validasi
    if ($nis == '')
        $error[] = "NIS tidak boleh kosong!";
    if ($nama == '')
        $error[] = "Nama tidak boleh kosong!";
    if ($kelas == '')
        $error[] = "Kelas harus dipilih!";
    if ($jurusan == '')
        $error[] = "Jurusan harus dipilih!";

    // Cek NIS duplikat (kecuali id sendiri)
    $cekNis = mysqli_query($koneksi, "SELECT id FROM siswa WHERE nis='$nis' AND id != $id");
    if (mysqli_num_rows($cekNis) > 0) {
        $error[] = "NIS $nis sudah dipakai siswa lain!";
    }

    if (empty($error)) {
        $query = "UPDATE siswa SET
                    nis='$nis', nama='$nama', kelas='$kelas',
                    jurusan='$jurusan', alamat='$alamat', no_hp='$no_hp'
                  WHERE id=$id";
        $hasil = mysqli_query($koneksi, $query);

        if ($hasil) {
            header("Location: ../index.php?pesan=edit_berhasil");
            exit();
        } else {
            $error[] = "Gagal mengupdate data!";
        }
    }

    // Update nilai $siswa supaya form tidak kembali ke nilai lama
    $siswa['nis'] = $_POST['nis'];
    $siswa['nama'] = $_POST['nama'];
    $siswa['kelas'] = $_POST['kelas'];
    $siswa['jurusan'] = $_POST['jurusan'];
    $siswa['alamat'] = $_POST['alamat'];
    $siswa['no_hp'] = $_POST['no_hp'];
}
?>