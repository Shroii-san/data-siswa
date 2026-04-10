<?php
$keyword = "";
if (isset($_GET['cari']) && $_GET['cari'] != "") {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['cari']);
    $query = "SELECT * FROM siswa WHERE nama LIKE '%$keyword%' OR nis LIKE '%$keyword%' OR kelas LIKE '%$keyword%' OR
jurusan LIKE '%$keyword%' ORDER BY id DESC";
} else {
    $query = "SELECT * FROM siswa ORDER BY id DESC";
}

?>