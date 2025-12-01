<?php
session_start();
$error = $_SESSION['register_error'] ?? '';
unset($_SESSION['register_error']);
$success = $_SESSION['register_success'] ?? '';
unset($_SESSION['register_success']);
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Kasir Restoran - Register</title>

    <!-- Logo favicon -->
    <link rel="icon" type="image/png" href="../../../template_admin/img/logo.png">

    <!-- Custom fonts for this template-->
    <link href="../../../template_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../../template_admin/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
<style>
body {
    background: linear-gradient(135deg,#667eea 0%,#764ba2 100%);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    font-family: 'Poppins', sans-serif;
}
.auth-card {
    background: #0008ffff;
    padding: 40px 30px;
    border-radius: 15px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
}
.auth-card h2 {
    color: #fff;
    text-align: center;
    margin-bottom: 25px;
    font-weight: 700;
}
.form-control {
    background: #111;
    border: 1px solid #444;
    color: #fff;
    border-radius: 10px;
}
.form-control::placeholder {
    color: #aaa;
}
.input-group-text {
    background: #111;
    border: 1px solid #444;
    color: #aaa;
    width: 45px;
    justify-content: center;
}
.btn-register {
    width: 100%;
    background: #667eea;
    color: #fff;
    font-weight: 600;
    border-radius: 10px;
    padding: 12px;
    transition: all 0.3s ease;
}
.btn-register:hover {
    background: #5a67d8;
}
.toggle-password {
    cursor: pointer;
    color: #aaa;
}
.alert {
    border-radius: 10px;
}
.text-center a {
    color: #fff;
    font-weight: 500;
    text-decoration: underline;
}
.text-center a:hover {
    color: #ccc;
}
</style>

<body>
<div class="auth-card">
    <h2>Register Akun</h2>

    <?php if($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <?php if($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form action="../../actions/auth/register_proses.php" method="POST">
        <!-- Username -->
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>

        <!-- Role Pelanggan -->
        <input type="hidden" name="role" value="Pelanggan">

        <!-- Password -->
        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
            <span class="input-group-text toggle-password" onclick="togglePassword('password',this)"><i class="bi bi-eye-slash-fill"></i></span>
        </div>

        <!-- Konfirmasi Password -->
<div class="mb-3 input-group">
    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
    <span class="input-group-text toggle-password" onclick="togglePassword('confirm_password',this)"><i class="bi bi-eye-slash-fill"></i></span>
</div>

<!-- Role -->
<div class="mb-3 input-group">
    <span class="input-group-text"><i class="bi bi-people-fill"></i></span>
    <select name="role" class="form-control" required>
        <option value="">-- Pilih Role --</option>

        <option value="Admin">Admin</option>
        <option value="Kasir">Kasir</option>
        <option value="Waiter">Waiter</option>
    </select>
</div>


        <button type="submit" class="btn btn-register">Daftar Sekarang</button>
    </form>

    <div class="text-center text-white mt-3">
        Sudah punya akun? <a href="login.php">Login</a>
    </div>
</div>

<script>
function togglePassword(id, el){
    const input = document.getElementById(id);
    const icon = el.querySelector('i');
    if(input.type==='password'){
        input.type='text';
        icon.classList.replace('bi-eye-slash-fill','bi-eye-fill');
    } else {
        input.type='password';
        icon.classList.replace('bi-eye-fill','bi-eye-slash-fill');
    }
}
</script>
</body>
