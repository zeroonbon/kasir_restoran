<?php
include '../../config/connaction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_detail_order = intval($_POST['id_detail_order']);
    $id_order = mysqli_real_escape_string($connect, $_POST['id_order']);
    $id_masakan = mysqli_real_escape_string($connect, $_POST['id_masakan']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);
    $status_detail_order = mysqli_real_escape_string($connect, $_POST['status_detail_order']);

    $query = "UPDATE detail_order 
              SET id_order='$id_order', 
                  id_masakan='$id_masakan', 
                  keterangan='$keterangan', 
                  status_detail_order='$status_detail_order' 
              WHERE id_detail_order = $id_detail_order";

    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: ../../pages/detail_order/index.php?status=updated");
        exit();
    } else {
        die("Update Error: " . mysqli_error($connect));
    }
} else {
    header("Location: ../../pages/detail_order/index.php?status=invalid");
    exit();
}
