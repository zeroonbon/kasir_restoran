<?php
// Cek apakah session sudah aktif sebelum memulai session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_user'])) {
    header('Location: ../../pages/dashboard/index.php');
    exit();
}

$error = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Kasir Restoran - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="../../../template_admin/img/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            min-height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }
        .auth-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            padding: 40px 30px;
            border-radius: 15px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .auth-card h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 700;
        }
        .form-control {
            background: rgba(0,0,0,0.3);
            border: 1px solid #444;
            color: #fff;
            border-radius: 10px;
        }
        .form-control::placeholder { color:#aaa; }
        .input-group-text {
            background: rgba(0,0,0,0.3);
            border: 1px solid #444;
            color:#aaa;
            width:45px;
            justify-content:center;
        }
        .btn-login {
            width: 100%;
            background: #ffc107;
            color: #333;
            font-weight: 700;
            border-radius: 10px;
            padding: 12px;
            border: none;
            transition: all 0.3s;
        }
        .btn-login:hover { background: #e0a800; }
        .toggle-password { cursor:pointer;color:#aaa; }
        .alert { border-radius:10px; }
        
        /* Link Daftar Akun */
        a.text-white {
            text-decoration: none;
            font-weight: 600;
        }
        a.text-white:hover {
            color: #ffc107;
        }
        
        /* Center content */
        .login-container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }
        
        /* Error message styling */
        .error-message {
            background: rgba(220, 53, 69, 0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="auth-card">
            <h2>Login Pelanggan</h2>
            
            <?php if (!empty($error)): ?>
                <div class="error-message">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            
            <form action="../../actions/auth/login_proses1.php" method="POST">
                <input type="hidden" name="role" value="pelanggan">
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="mb-3 input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password" id="password_pelanggan" class="form-control" placeholder="Password" required>
                    <span class="input-group-text toggle-password" onclick="togglePassword('password_pelanggan', this)"><i class="bi bi-eye-slash-fill"></i></span>
                </div>
                <button type="submit" class="btn btn-login">Masuk Pelanggan</button>
            </form>

        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
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
</html>