<?php
include '../../config/connaction.php';

// Ambil data dari form
$nama_masakan     = $_POST['nama_masakan'];
$harga            = $_POST['harga'];
$status_masakan   = $_POST['status_masakan'];
$deskripsi_makanan = $_POST['deskripsi_makanan'];

// Upload gambar jika ada
$gambar_masakan = null;
if (isset($_FILES['gambar_masakan']) && $_FILES['gambar_masakan']['error'] === UPLOAD_ERR_OK) {
    $ext = pathinfo($_FILES['gambar_masakan']['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . "." . $ext;
    $upload_path = "../../../storages/menu_makanan/" . $filename;

    if (move_uploaded_file($_FILES['gambar_masakan']['tmp_name'], $upload_path)) {
        $gambar_masakan = $filename;
    }
}

// Query insert
$query = "INSERT INTO masakan (nama_masakan, harga, status_masakan, gambar_masakan, deskripsi_makanan) 
          VALUES ('$nama_masakan', '$harga', '$status_masakan', '$gambar_masakan', '$deskripsi_makanan')";

if (mysqli_query($connect, $query)) {
    header("Location: ../../pages/menu_makanan/index.php?success=1");
    exit;
} else {
    die("Query Error: " . mysqli_error($connect));
}
?>
