<?php
session_start();

// Koneksi database
$host = "localhost";
$db_name = "kasir_restoran";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    $_SESSION['login_error'] = "Koneksi database gagal: " . $e->getMessage();
    header('Location: ../../pages/auth/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = $_POST['role']; // Owner, Admin, Kasir, Waiter, Pelanggan
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Mapping role ke file dashboard
    $redirects = [
        'Owner'     => '../../../backend/pages/dashboard1/index.php',
        'Admin'     => '../../../backend/pages/dashboard/index.php',
        'Kasir'     => '../../../backend/pages/transaksi/index.php',
        'Waiter'    => '../../../backend/pages/order/index.php',
        'Pelanggan' => '../../../backend/pages/menu_makanan2/index.php',
    ];

    // === LOGIN KHUSUS OWNER (langsung masuk tanpa username/password) ===
    if ($role === 'Owner') {
        $_SESSION['id_user']  = 0; 
        $_SESSION['username'] = 'Owner';
        $_SESSION['role']     = 'Owner';

        header("Location: " . $redirects['Owner']);
        exit();
    }

    // === LOGIN KHUSUS PELANGGAN (langsung masuk tanpa username/password) ===
    if ($role === 'Pelanggan') {
        $_SESSION['id_user']  = -1; 
        $_SESSION['username'] = 'Pelanggan';
        $_SESSION['role']     = 'Pelanggan';

        header("Location: " . $redirects['Pelanggan']);
        exit();
    }

    // === LOGIN USER LAIN (Admin, Kasir, Waiter tetap cek database) ===
    try {
        $query = "SELECT * FROM users WHERE username = :username AND role = :role";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':role', $role);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id_user']  = $user['id_user'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];

            $redirect = $redirects[$user['role']] ?? '../../../backend/pages/dashboard/index.php';
            header("Location: " . $redirect);
            exit();
        } else {
            $_SESSION['login_error'] = "Username, password, atau role salah!";
            header('Location: ../../pages/auth/login.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['login_error'] = "Terjadi kesalahan sistem: " . $e->getMessage();
        header('Location: ../../pages/auth/login.php');
        exit();
    }
} else {
    header('Location: ../../pages/auth/login.php');
    exit();
}
