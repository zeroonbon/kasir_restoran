<?php
include '../../config/connaction.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $query = "DELETE FROM detail_order WHERE id_detail_order = $id";
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: ../../pages/detail_order/index.php?status=deleted");
        exit();
    } else {
        die("Delete Error: " . mysqli_error($connect));
    }
} else {
    header("Location: ../../pages/detail_order/index.php?status=error");
    exit();
}
