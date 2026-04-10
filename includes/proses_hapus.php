<?php

include '../config/koneksi.php';

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $hapus = mysqli_query($koneksi, "DELETE FROM siswa WHERE id='$id'");
    if ($hapus) {
        header("Location: ../index.php?pesan=hapus_berhasil");
        exit();
    }
}

?>