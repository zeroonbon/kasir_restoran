<?php
include '../../config/connaction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = intval($_POST['id_user']);
    $id_order = intval($_POST['id_order']);
    $tanggal = $_POST['tanggal'];
    $total_harga = floatval($_POST['total_harga']);
    $status_transaksi = $_POST['status_transaksi'];

    $query = "INSERT INTO transaksi (id_user, id_order, tanggal, total_harga, status_transaksi) 
              VALUES ('$id_user', '$id_order', '$tanggal', '$total_harga', '$status_transaksi')";

    if (mysqli_query($connect, $query)) {
        header("Location: ../../pages/transaksi/index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($connect);
    }
} else {
    echo "Invalid request.";
}
?>
