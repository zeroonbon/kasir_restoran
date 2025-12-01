<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

<!-- Topbar Navbar -->
<ul class="navbar-nav ml-auto">

<!-- Nav Item - User Information -->
<?php if (isset($_SESSION['id_user'])): ?>
    <?php
    // Ambil role dari session
    $role = strtolower($_SESSION['role'] ?? 'guest');

    // Mapping role agar tampil lebih rapi
    $role_labels = [
        'owner'  => 'Owner',
        'admin'  => 'Admin',
        'kasir'  => 'Kasir',
        'waiter' => 'Waiter',
        'guest'  => 'Guest'
    ];

    // Mapping gambar berdasarkan role
    $role_images = [
        'owner'  => '../../../template_admin/img/logo.png',
        'admin'  => '../../../template_admin/img/logo.png',
        'kasir'  => '../../../template_admin/img/logo.png',
        'waiter' => '../../../template_admin/img/logo.png',
        'guest'  => '../../../template_admin/img/logo.png'
    ];

    $role_name  = $role_labels[$role] ?? ucfirst($role);
    $role_image = $role_images[$role] ?? '../../../template_admin/img/logo.png';
    ?>
    <!-- Sudah login -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                <?= htmlspecialchars($role_name); ?>
            </span>
            <img class="img-profile rounded-circle"
                 src="<?= $role_image; ?>" alt="Profile">
        </a>

        <!-- Dropdown - User Information -->
        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
             aria-labelledby="userDropdown">
            <a class="dropdown-item" href="../../../backend/pages/auth/logout.php"
               onclick="return confirm('Yakin ingin logout?')">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
            </a>
        </div>
    </li>
<?php else: ?>
    <!-- Belum login -->
    <li class="nav-item no-arrow">
        <a class="nav-link" href="../../pages/auth/login.php">
            <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                Login
            </span>
            <i class="fas fa-sign-in-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        </a>
    </li>
<?php endif; ?>


</ul>



</nav>
<!-- End of Topbar -->

            </nav>
            <!-- End of Topbar -->