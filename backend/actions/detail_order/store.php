<?php
include '../../config/connaction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_order = mysqli_real_escape_string($connect, $_POST['id_order']);
    $id_masakan = mysqli_real_escape_string($connect, $_POST['id_masakan']);
    $keterangan = mysqli_real_escape_string($connect, $_POST['keterangan']);
    $status_detail_order = mysqli_real_escape_string($connect, $_POST['status_detail_order']);

    $query = "INSERT INTO detail_order (id_order, id_masakan, keterangan, status_detail_order) 
              VALUES ('$id_order', '$id_masakan', '$keterangan', '$status_detail_order')";

    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: ../../pages/detail_order/index.php?status=success");
        exit();
    } else {
        die("Insert Error: " . mysqli_error($connect));
    }
} else {
    header("Location: ../../pages/detail_order/index.php?status=invalid");
    exit();
}
