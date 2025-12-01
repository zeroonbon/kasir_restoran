<?php
session_start();
include '../../config/connaction.php';

$username = trim($_POST['username']);
$password = $_POST['password'];
$confirm  = $_POST['confirm_password'];
$role     = $_POST['role'] ?? 'Pelanggan';

if ($password !== $confirm) {
    $_SESSION['register_error'] = "Password dan konfirmasi tidak sama.";
    header('Location: ../../pages/auth/register.php');
    exit();
}

// cek apakah username sudah ada
$check = $connect->prepare("SELECT id_user FROM users WHERE username = ?");
$check->bind_param("s", $username);
$check->execute();
$check->store_result();

if ($check->num_rows > 0) {
    $_SESSION['register_error'] = "Username sudah digunakan.";
    header('Location: ../../pages/auth/register.php');
    exit();
}
$check->close();

// hash password
$hashed = password_hash($password, PASSWORD_DEFAULT);

// insert user
$sql = "INSERT INTO users (username,password,role) VALUES (?,?,?)";
$stmt = $connect->prepare($sql);
$stmt->bind_param("sss", $username, $hashed, $role);

if ($stmt->execute()) {
    $_SESSION['register_success'] = "Registrasi berhasil, silakan login.";
    header('Location: ../../pages/auth/login.php');
    exit();
} else {
    $_SESSION['register_error'] = "Terjadi kesalahan. Coba lagi.";
    header('Location: ../../pages/auth/register.php');
    exit();
}
?>
