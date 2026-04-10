<?php
include 'config/koneksi.php';
include 'includes/proses_search.php';
$data = mysqli_query($koneksi, $query);
$jumlah = mysqli_num_rows($data);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa - SMK Nusantara</title>
    <link rel="stylesheet" href="public/assets/css/output.css">
</head>

<body class="bg-gray-100 min-h-screen">

    <!-- Navbar -->
    <nav class="bg-blue-700 text-white px-6 py-4 shadow-md">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div>
                    <h1 class="text-xl font-bold">SMK Nusantara</h1>
                    <p class="text-xs text-blue-200">Sistem Data Siswa</p>
                </div>
            </div>
            <div class="text-sm text-blue-200">
                <?php echo date('d/m/Y'); ?>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-6 max-w-5xl">

        <!-- Alert pesan -->
        <?php
        $pesan_map = [
            'hapus_berhasil' => ['color' => 'red', 'text' => 'Data berhasil dihapus!'],
            'tambah_berhasil' => ['color' => 'green', 'text' => 'Data berhasil ditambahkan!'],
            'edit_berhasil' => ['color' => 'yellow', 'text' => 'Data berhasil diubah!']
        ];

        $pesan = $_GET['pesan'] ?? null;
        if (isset($pesanesan_map[$pesan])):
            $config = $pesan_map[$pesan];
            ?>
            <div id="alertMsg"
                class="bg-<?= $config['color'] ?>-100 border border-<?= $config['color'] ?>-400 text-<?= $config['color'] ?>-700 px-4 py-3 rounded mb-4 flex justify-between items-center">
                <span><?= $config['text'] ?></span>
                <button onclick="this.parentElement.remove()" class="font-bold">✕</button>
            </div>
        <?php endif; ?>

        <!-- Judul + tombol tambah -->
        <div class="bg-white rounded-lg shadow p-5 mb-4">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Data Siswa</h2>
                    <p class="text-gray-500 text-sm">Total: <span
                            class="font-semibold text-blue-600"><?php echo $jumlah; ?> siswa</span>
                        <?php if ($keyword != ""): ?>
                            &nbsp;| Hasil pencarian: "<span
                                class="font-semibold"><?php echo htmlspecialchars($keyword); ?></span>"
                        <?php endif; ?>
                    </p>
                </div>
                <a href="views/tambah.php"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold flex items-center gap-1 w-fit transition">Tambah
                    Siswa
                </a>
            </div>

            <!-- Form Search -->
            <form method="GET" action="index.php" class="mt-4 flex gap-2">
                <input type="text" name="cari" value="<?php echo htmlspecialchars($keyword); ?>"
                    placeholder="Cari nama, NIS, kelas, jurusan..."
                    class="border border-gray-300 rounded-lg px-3 py-2 w-full focus:outline-none focus:ring-2 focus:ring-blue-400"
                    id="inputCari">
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold transition">
                    Cari
                </button>
                <?php if ($keyword != ""): ?>
                    <a href="index.php"
                        class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg font-semibold transition">
                        Reset
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">No</th>
                            <th class="px-4 py-3 text-left">NIS</th>
                            <th class="px-4 py-3 text-left">Nama Siswa</th>
                            <th class="px-4 py-3 text-left">Kelas</th>
                            <th class="px-4 py-3 text-left">Jurusan</th>
                            <th class="px-4 py-3 text-left">No. HP</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($jumlah > 0): ?>
                            <?php $no = 1;
                            while ($row = mysqli_fetch_assoc($data)): ?>
                                <tr class="border-b hover:bg-blue-50 transition" id="row-<?php echo $row['id']; ?>">
                                    <td class="px-4 py-3 text-gray-500"><?php echo $no++; ?></td>
                                    <td class="px-4 py-3 font-mono text-gray-700"><?php echo htmlspecialchars($row['nis']); ?>
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-gray-800">
                                        <?php echo htmlspecialchars($row['nama']); ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">
                                            <?php echo htmlspecialchars($row['kelas']); ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-700"><?php echo htmlspecialchars($row['jurusan']); ?></td>
                                    <td class="px-4 py-3 text-gray-600"><?php echo htmlspecialchars($row['no_hp']); ?></td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex justify-center gap-2">
                                            <!-- Tombol Detail -->
                                            <button
                                                onclick="lihatDetail(<?php echo $row['id']; ?>, '<?php echo addslashes($row['nis']); ?>', '<?php echo addslashes($row['nama']); ?>', '<?php echo addslashes($row['kelas']); ?>', '<?php echo addslashes($row['jurusan']); ?>', '<?php echo addslashes($row['alamat']); ?>', '<?php echo addslashes($row['no_hp']); ?>')"
                                                class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded text-xs transition"
                                                title="Detail">detail</button>

                                            <!-- Tombol Edit -->
                                            <a href="views/edit.php?id=<?php echo $row['id']; ?>"
                                                class="bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded text-xs transition"
                                                title="Edit">edit</a>

                                            <!-- Tombol Hapus -->
                                            <button
                                                onclick="konfirmasiHapus(<?php echo $row['id']; ?>, '<?php echo addslashes($row['nama']); ?>')"
                                                class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded text-xs transition"
                                                title="Hapus">hapus</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-10 text-gray-400">
                                    <p>Tidak ada data yang ditemukan</p>
                                    <?php if ($keyword != ""): ?>
                                        <p class="text-sm mt-1">Coba kata kunci lain</p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <p class="text-center text-gray-400 text-xs mt-6">© 2024 SMK Nusantara - Latihan Pemrograman Web</p>
    </div>

    <!-- Modal Detail Siswa -->
    <div id="modalDetail" class="fixed inset-0 bg-white hidden z-50 flex items-center justify-center">

        <div class="bg-white rounded-xl shadow-2xl w-full max-w-md mx-4 p-6 relative">
            <button onclick="tutupModal()"
                class="absolute top-3 right-4 text-gray-400 hover:text-gray-700 text-2xl font-bold">✕</button>
            <h3 class="text-lg font-bold text-blue-700 mb-4 border-b pb-2">Detail Siswa</h3>
            <div class="space-y-3 text-sm">
                <div class="flex gap-2">
                    <span class="text-gray-500 w-24 shrink-0">NIS</span>
                    <span class="font-semibold">: <span id="dNis"></span></span>
                </div>
                <div class="flex gap-2">
                    <span class="text-gray-500 w-24 shrink-0">Nama</span>
                    <span class="font-semibold">: <span id="dNama"></span></span>
                </div>
                <div class="flex gap-2">
                    <span class="text-gray-500 w-24 shrink-0">Kelas</span>
                    <span class="font-semibold">: <span id="dKelas"></span></span>
                </div>
                <div class="flex gap-2">
                    <span class="text-gray-500 w-24 shrink-0">Jurusan</span>
                    <span class="font-semibold">: <span id="dJurusan"></span></span>
                </div>
                <div class="flex gap-2">
                    <span class="text-gray-500 w-24 shrink-0">Alamat</span>
                    <span class="font-semibold">: <span id="dAlamat"></span></span>
                </div>
                <div class="flex gap-2">
                    <span class="text-gray-500 w-24 shrink-0">No. HP</span>
                    <span class="font-semibold">: <span id="dHp"></span></span>
                </div>
            </div>
            <button onclick="tutupModal()"
                class="mt-5 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg w-full transition">Tutup</button>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="modalHapus" class="fixed inset-0 bg-white hidden z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-4 p-6 text-center">
            <h3 class="text-lg font-bold text-gray-800 mb-1">Yakin mau hapus?</h3>
            <p class="text-gray-500 text-sm mb-1">Data siswa:</p>
            <p id="namaHapus" class="font-bold text-red-600 text-lg mb-4"></p>
            <p class="text-gray-400 text-xs mb-5">Data yang dihapus tidak bisa dikembalikan lagi!</p>
            <div class="flex gap-3">
                <button onclick="tutupModalHapus()"
                    class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 py-2 rounded-lg font-semibold transition">Batal</button>
                <a id="linkHapus" href="#"
                    class="flex-1 bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg font-semibold transition">Ya,
                    Hapus!</a>
            </div>
        </div>
    </div>

    <script src="public/assets/js/app.js"></script>

</body>

</html>