<?php
// Koneksi database
include '../../config/connaction.php';

// Pastikan request POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_order   = intval($_POST['id_order']);
    $no_meja    = mysqli_real_escape_string($connect, $_POST['no_meja']);
    $tanggal    = mysqli_real_escape_string($connect, $_POST['tanggal']);
    $id_user    = intval($_POST['id_user']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);
    $status     = mysqli_real_escape_string($connect, $_POST['status_order']);

    // Query update
    $query = "UPDATE `order` 
              SET no_meja = '$no_meja',
                  tanggal = '$tanggal',
                  id_user = '$id_user',
                  keterangan = '$keterangan',
                  status_order = '$status'
              WHERE id_order = $id_order";

    if (mysqli_query($connect, $query)) {
        // Jika berhasil
        header("Location: ../../pages/order/index.php?msg=updated");
        exit;
    } else {
        die("Gagal update data order: " . mysqli_error($connect));
    }
} else {
    die("Akses tidak valid.");
}
?>
