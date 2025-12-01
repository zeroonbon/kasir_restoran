<?php
// Koneksi database
include '../../config/connaction.php';

// Pastikan form dikirim via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_masakan       = intval($_POST['id_masakan']);
    $nama_masakan     = mysqli_real_escape_string($connect, $_POST['nama_masakan']);
    $harga            = intval($_POST['harga']);
    $status_masakan   = mysqli_real_escape_string($connect, $_POST['status_masakan']);
    $deskripsi        = mysqli_real_escape_string($connect, $_POST['deskripsi_makanan']);

    // Ambil data lama untuk cek gambar
    $queryOld = "SELECT gambar_masakan FROM masakan WHERE id_masakan = $id_masakan";
    $resultOld = mysqli_query($connect, $queryOld);
    $oldData = mysqli_fetch_assoc($resultOld);
    $gambar_lama = $oldData['gambar_masakan'];

    $gambar_baru = $gambar_lama; // default pakai gambar lama

    // Jika user upload gambar baru
    if (!empty($_FILES['gambar_masakan']['name'])) {
        $targetDir = "../../../storages/menu_makanan/";
        $fileName = time() . "_" . basename($_FILES['gambar_masakan']['name']);
        $targetFilePath = $targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Validasi ekstensi file
        $allowedTypes = array("jpg", "jpeg", "png", "gif", "webp");
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['gambar_masakan']['tmp_name'], $targetFilePath)) {
                // Jika ada gambar lama, hapus
                if (!empty($gambar_lama) && file_exists($targetDir . $gambar_lama)) {
                    unlink($targetDir . $gambar_lama);
                }
                $gambar_baru = $fileName;
            } else {
                die("Gagal upload gambar baru.");
            }
        } else {
            die("Format file tidak diizinkan.");
        }
    }

    // Query update
    $queryUpdate = "UPDATE masakan 
                    SET nama_masakan = '$nama_masakan',
                        harga = $harga,
                        status_masakan = '$status_masakan',
                        gambar_masakan = '$gambar_baru',
                        deskripsi_makanan = '$deskripsi'
                    WHERE id_masakan = $id_masakan";

    if (mysqli_query($connect, $queryUpdate)) {
        header("Location: ../../pages/menu_makanan/index.php?success=update");
        exit;
    } else {
        die("Update gagal: " . mysqli_error($connect));
    }
} else {
    die("Akses tidak valid.");
}
