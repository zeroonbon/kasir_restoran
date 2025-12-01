<?php
include '../../config/connaction.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_level = mysqli_real_escape_string($connect, $_POST['nama_level']);
    $deskripsi_level = mysqli_real_escape_string($connect, $_POST['deskripsi_level']);

    $query = "INSERT INTO level (nama_level, deskripsi_level) VALUES ('$nama_level', '$deskripsi_level')";

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
