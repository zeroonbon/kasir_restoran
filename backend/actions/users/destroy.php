<?php
include '../../config/connaction.php';

// Cek apakah ada parameter id
if (isset($_GET['id'])) {
    $id_user = intval($_GET['id']);

    // Hapus user dari database
    $query = "DELETE FROM user WHERE id_user = $id_user";

    if (mysqli_query($connect, $query)) {
        // Redirect ke halaman index setelah sukses
        header("Location: ../../pages/users/index.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($connect);
    }
} else {
    echo "ID user tidak ditemukan.";
}
?>
