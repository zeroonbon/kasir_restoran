<?php
session_start();

// Jika form login ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Set session langsung sebagai Pelanggan
    $_SESSION['id_user']  = -1; 
    $_SESSION['username'] = 'Pelanggan';
    $_SESSION['role']     = 'Pelanggan';

    // Redirect ke halaman menu pelanggan
    header("Location: ../../../backend/pages/menu_makanan1/index.php");
    exit();
} else {
    // Jika akses langsung tanpa submit form
    header('Location: ../../pages/auth/login.php');
    exit();
}
