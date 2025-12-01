<?php
// Koneksi database
include '../../config/connaction.php';

// Pastikan method POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $no_meja      = mysqli_real_escape_string($connect, $_POST['no_meja']);
    $tanggal      = mysqli_real_escape_string($connect, $_POST['tanggal']);
    $id_user      = intval($_POST['id_user']);
    $keterangan   = mysqli_real_escape_string($connect, $_POST['keterangan']);
    $status_order = mysqli_real_escape_string($connect, $_POST['status_order']);

    // Query insert
    $query = "INSERT INTO `order` (no_meja, tanggal, id_user, keterangan, status_order) 
              VALUES ('$no_meja', '$tanggal', '$id_user', '$keterangan', '$status_order')";
    
    $result = mysqli_query($connect, $query);

    if ($result) {
        // Redirect ke index order setelah sukses
        header("Location: ../../pages/order/index.php?success=1");
        exit;
    } else {
        die("Gagal menyimpan data order: " . mysqli_error($connect));
    }
} else {
    die("Akses tidak valid.");
}
