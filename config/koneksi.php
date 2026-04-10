<?php
// File koneksi database
// Dibuat oleh: Siswa SMK

global $koneksi;

$host = "localhost";
$user = "root";
$password = "";
$database = "aduh";

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>