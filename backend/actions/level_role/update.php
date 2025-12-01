<?php
include '../../config/connaction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_level = intval($_POST['id_level']);
    $nama_level = mysqli_real_escape_string($connect, $_POST['nama_level']);
    $deskripsi_level = mysqli_real_escape_string($connect, $_POST['deskripsi_level']);

    $query = "UPDATE level SET nama_level='$nama_level', deskripsi_level='$deskripsi_level' WHERE id_level='$id_level'";

    if (mysqli_query($connect, $query)) {
        header("Location: ../../pages/level_role/index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($connect);
    }
} else {
    echo "Invalid request.";
}
?>
