-- =============================================
-- Database: db_siswa
-- Jalankan query ini di phpMyAdmin dulu!
-- =============================================

CREATE DATABASE IF NOT EXISTS db_siswa;
USE db_siswa;

CREATE TABLE IF NOT EXISTS siswa (
    id       INT(11) AUTO_INCREMENT PRIMARY KEY,
    nis      VARCHAR(20) NOT NULL,
    nama     VARCHAR(100) NOT NULL,
    kelas    VARCHAR(10) NOT NULL,
    jurusan  VARCHAR(50) NOT NULL,
    alamat   TEXT,
    no_hp    VARCHAR(15)
);

-- Data contoh biar ga kosong
INSERT INTO siswa (nis, nama, kelas, jurusan, alamat, no_hp) VALUES
('2026001', 'Andi', 'XI', 'RPL', 'Jl. Merdeka No. 10', '081234567890'),
('2026002', 'Budi', 'XI', 'TKJ', 'Jl. Ir. H. Juanda No. 5', '082345678901'),
('2026003', 'Chelsy', 'XI', 'MP', 'Jl. Buah Batu No. 3', '083456789012'),
('2026004', 'Dewi', 'X', 'Mp', 'Jl. Gatot Subroto No. 7', '084567890123');
