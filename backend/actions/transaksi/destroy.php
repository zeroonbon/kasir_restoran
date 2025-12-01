<?php
include '../../config/connaction.php';

if (isset($_GET['id'])) {
    $id_transaksi = intval($_GET['id']);

    $query = "DELETE FROM transaksi WHERE id_transaksi='$id_transaksi'";
    if (mysqli_query($connect, $query)) {
        header("Location: ../../pages/transaksi/index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($connect);
    }
} else {
    echo "ID transaksi tidak ditemukan.";
}
?>
