<?php
session_start();

// Cek jika user sudah login, redirect ke dashboard
if (isset($_SESSION['id_user'])) {
    header('Location: ../../pages/dashboard/index.php');
    exit();
}

// Ambil error message jika ada
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
        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            background-color: rgba(0,0,0,0.6);
            border-radius: 50%;
            padding: 15px;
        }
        /* Link Daftar Akun */
        a.text-white {
            text-decoration: none;
            font-weight: 600;
        }
        a.text-white:hover {
            color: #ffc107;
        }
        /* Indicator dots */
        .carousel-indicators {
            bottom: -50px;
        }
        .carousel-indicators button {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 5px;
        }
    </style>
</head>

<body>
<div id="loginCarousel" class="carousel slide" data-bs-ride="false" data-bs-interval="false">
    
    <!-- Indicators -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#loginCarousel" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#loginCarousel" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#loginCarousel" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#loginCarousel" data-bs-slide-to="3"></button>
    </div>

    <div class="carousel-inner">

        <!-- Admin -->
        <div class="carousel-item active">
            <div class="d-flex align-items-center justify-content-center min-vh-100">
                <div class="auth-card">
                    <h2>Login Admin</h2>
                    <?php if($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form action="../../actions/auth/login_proses.php" method="POST">
                        <input type="hidden" name="role" value="Admin">
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password" id="password_admin" class="form-control" placeholder="Password" required>
                            <span class="input-group-text toggle-password" onclick="togglePassword('password_admin', this)"><i class="bi bi-eye-slash-fill"></i></span>
                        </div>
                        <button type="submit" class="btn btn-login">Masuk Admin</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="register.php" class="text-white">Daftar Akun Baru</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Owner -->
        <div class="carousel-item">
            <div class="d-flex align-items-center justify-content-center min-vh-100">
                <div class="auth-card">
                    <h2>Login Owner</h2>
                    <?php if($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form action="../../actions/auth/login_proses.php" method="POST">
                        <input type="hidden" name="role" value="Owner">
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password" id="password_owner" class="form-control" placeholder="Password" required>
                            <span class="input-group-text toggle-password" onclick="togglePassword('password_owner', this)"><i class="bi bi-eye-slash-fill"></i></span>
                        </div>
                        <button type="submit" class="btn btn-login">Masuk Owner</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Waiter -->
        <div class="carousel-item">
            <div class="d-flex align-items-center justify-content-center min-vh-100">
                <div class="auth-card">
                    <h2>Login Waiter</h2>
                    <?php if($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form action="../../actions/auth/login_proses.php" method="POST">
                        <input type="hidden" name="role" value="Waiter">
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password" id="password_waiter" class="form-control" placeholder="Password" required>
                            <span class="input-group-text toggle-password" onclick="togglePassword('password_waiter', this)"><i class="bi bi-eye-slash-fill"></i></span>
                        </div>
                        <button type="submit" class="btn btn-login">Masuk Waiter</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="register.php" class="text-white">Daftar Akun Baru</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Kasir -->
        <div class="carousel-item">
            <div class="d-flex align-items-center justify-content-center min-vh-100">
                <div class="auth-card">
                    <h2>Login Kasir</h2>
                    <?php if($error): ?>
                        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                    <?php endif; ?>
                    <form action="../../actions/auth/login_proses.php" method="POST">
                        <input type="hidden" name="role" value="Kasir">
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password" id="password_kasir" class="form-control" placeholder="Password" required>
                            <span class="input-group-text toggle-password" onclick="togglePassword('password_kasir', this)"><i class="bi bi-eye-slash-fill"></i></span>
                        </div>
                        <button type="submit" class="btn btn-login">Masuk Kasir</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="register.php" class="text-white">Daftar Akun Baru</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Navigasi -->
    <button class="carousel-control-prev" type="button" data-bs-target="#loginCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#loginCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
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