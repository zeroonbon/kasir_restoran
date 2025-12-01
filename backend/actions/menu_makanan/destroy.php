<?php
// Koneksi database
include '../../config/connaction.php';

// Validasi id
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID Masakan tidak ditemukan.");
}

$id = intval($_GET['id']);

// Ambil data dulu (untuk cek gambar)
$query = "SELECT gambar_masakan FROM masakan WHERE id_masakan = $id";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Data tidak ditemukan.");
}

$data = mysqli_fetch_assoc($result);
$gambar = $data['gambar_masakan'];

// Hapus record dari database
$delete = "DELETE FROM masakan WHERE id_masakan = $id";
$exec = mysqli_query($connect, $delete);

if ($exec) {
    // Jika ada gambar, hapus juga dari folder
    if (!empty($gambar)) {
        $file_path = "../../../storages/menu_makanan/" . $gambar;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    // Redirect dengan pesan sukses
    header("Location: ../../pages/menu_makanan/index.php?success=deleted");
    exit;
} else {
    die("Gagal menghapus data: " . mysqli_error($connect));
}
