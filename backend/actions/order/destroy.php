<?php
// Koneksi database
include '../../config/connaction.php';

// Pastikan ada id_order di URL
if (!isset($_GET['id'])) {
    die("ID order tidak ditemukan.");
}

$id = intval($_GET['id']);

// Query hapus
$query = "DELETE FROM `order` WHERE id_order = $id";
$result = mysqli_query($connect, $query);

if ($result) {
    // Redirect balik ke index dengan pesan sukses
    header("Location: ../../pages/order/index.php?deleted=1");
    exit;
} else {
    die("Gagal menghapus data order: " . mysqli_error($connect));
}
