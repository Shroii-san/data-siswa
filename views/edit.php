<?php

include '../config/koneksi.php';
include '../includes/proses_edit.php'

    ?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa - SMK Nusantara</title>
    <link rel="stylesheet" href="../public/assets/css/output.css">
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-700 text-white px-6 py-4 shadow-md">
        <div class="flex items-center gap-2">
            <div>
                <h1 class="text-xl font-bold">SMK Nusantara</h1>
                <p class="text-xs text-blue-200">Sistem Data Siswa</p>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-6 max-w-xl">

        <!-- Breadcrumb -->
        <div class="text-sm text-gray-500 mb-4">
            <a href="../index.php" class="text-blue-600 hover:underline">Beranda</a>
            <span class="mx-1">/</span>
            <span>Edit Siswa</span>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-1">Edit Data Siswa</h2>
            <p class="text-gray-400 text-sm mb-5">Edit data siswa dengan NIS: <span
                    class="font-semibold text-blue-600"><?php echo htmlspecialchars($siswa['nis']); ?></span></p>

            <!-- Tampilkan Error -->
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <p class="font-bold mb-1">Ada kesalahan:</p>
                    <ul class="list-disc list-inside text-sm">
                        <?php foreach ($error as $e): ?>
                            <li><?php echo $e; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form Edit -->
            <form method="POST" action="../views/edit.php?id=<?= $id ?>" id="formEdit">

                <!-- ID -->
                <input type="hidden" name="id" value="<?= $id ?>">

                <!-- NIS -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        NIS <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nis" id="nis" value="<?php echo htmlspecialchars($siswa['nis']); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm"
                        maxlength="20">
                    <p id="errorNis" class="text-red-500 text-xs mt-1 hidden">NIS tidak boleh kosong!</p>
                </div>

                <!-- Nama -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">
                        Nama Lengkap <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($siswa['nama']); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm"
                        maxlength="100">
                    <p id="errorNama" class="text-red-500 text-xs mt-1 hidden">Nama tidak boleh kosong!</p>
                </div>

                <!-- Kelas & Jurusan -->
                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Kelas <span class="text-red-500">*</span>
                        </label>
                        <select name="kelas" id="kelas"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm bg-white">
                            <option value="">-- Pilih --</option>
                            <option value="X" <?php echo $siswa['kelas'] == 'X' ? 'selected' : ''; ?>>Kelas X</option>
                            <option value="XI" <?php echo $siswa['kelas'] == 'XI' ? 'selected' : ''; ?>>Kelas XI</option>
                            <option value="XII" <?php echo $siswa['kelas'] == 'XII' ? 'selected' : ''; ?>>Kelas XII
                            </option>
                        </select>
                        <p id="errorKelas" class="text-red-500 text-xs mt-1 hidden">Kelas wajib dipilih!</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Jurusan <span class="text-red-500">*</span>
                        </label>
                        <select name="jurusan" id="jurusan"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm bg-white">
                            <option value="">-- Pilih --</option>
                            <option value="RPL" <?php echo $siswa['jurusan'] == 'RPL' ? 'selected' : ''; ?>>RPL</option>
                            <option value="TKJ" <?php echo $siswa['jurusan'] == 'TKJ' ? 'selected' : ''; ?>>TKJ</option>
                            <option value="MM" <?php echo $siswa['jurusan'] == 'MM' ? 'selected' : ''; ?>>MM</option>
                            <option value="AKL" <?php echo $siswa['jurusan'] == 'AKL' ? 'selected' : ''; ?>>AKL</option>
                            <option value="OTKP" <?php echo $siswa['jurusan'] == 'OTKP' ? 'selected' : ''; ?>>OTKP
                            </option>
                        </select>
                        <p id="errorJurusan" class="text-red-500 text-xs mt-1 hidden">Jurusan wajib dipilih!</p>
                    </div>
                </div>

                <!-- No HP -->
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">No. HP</label>
                    <input type="text" name="no_hp" id="no_hp" value="<?php echo htmlspecialchars($siswa['no_hp']); ?>"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm"
                        maxlength="15">
                </div>

                <!-- Alamat -->
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="3"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-yellow-400 text-sm resize-none"><?php echo htmlspecialchars($siswa['alamat']); ?></textarea>
                </div>

                <!-- Tombol -->
                <div class="flex gap-3">
                    <a href="../index.php"
                        class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg font-semibold transition text-sm">
                        ← Batal
                    </a>
                    <button type="submit" name="update" id="btnUpdate"
                        class="flex-1 bg-yellow-400 hover:bg-yellow-500 text-white py-2 rounded-lg font-semibold transition text-sm">
                        Update Data
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center text-gray-400 text-xs mt-6">© 2024 SMK Nusantara - Latihan Pemrograman Web</p>
    </div>

    <script src="../public/assets/js/app.js"></script>

</body>

</html>