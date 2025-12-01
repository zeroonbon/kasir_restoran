<?php
include '../../config/connaction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Pastikan id_transaksi dikirim
    if (!isset($_POST['id_transaksi'])) {
        die("ID transaksi tidak ditemukan.");
    }

    $id_transaksi = intval($_POST['id_transaksi']);
    $id_user = intval($_POST['id_user']);
    $id_order = intval($_POST['id_order']);
    $tanggal = $_POST['tanggal'];
    $total_harga = floatval($_POST['total_harga']);
    $status_transaksi = $_POST['status_transaksi'];

    // Validasi status transaksi
    $valid_status = ['pending', 'lunas', 'batal'];
    if (!in_array($status_transaksi, $valid_status)) {
        die("Status transaksi tidak valid!");
    }

    // Query update
    $query = "
        UPDATE transaksi 
        SET 
            id_user = $id_user,
            id_order = $id_order,
            tanggal = '$tanggal',
            total_harga = $total_harga,
            status_transaksi = '$status_transaksi'
        WHERE id_transaksi = $id_transaksi
    ";

    if (mysqli_query($connect, $query)) {
        header("Location: ../../pages/transaksi/index.php");
        exit;
    } else {
        die("Error: " . mysqli_error($connect));
    }

} else {
    die("Invalid request.");
}
?>
