<?php
// Pastikan session sudah start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil role dari session dengan default 'guest' - GUNAKAN CASE SENSITIVE
$role = $_SESSION['role'] ?? 'guest';
$current_url = $_SERVER['REQUEST_URI'];

// Base path
$base_path = '../../../backend/pages/';

// Daftar menu berdasarkan role (GUNAKAN HURUF KAPITAL)
$menus = [
    'Owner' => [
        ['label' => 'Dashboard',    'icon' => 'fas fa-fw fa-tachometer-alt', 'link' => $base_path . 'dashboard1/index.php'],
        ['label' => 'Menu Makanan', 'icon' => 'fas fa-fw fa-utensils',       'link' => $base_path . 'menu_makanan/index.php'],
        ['label' => 'Order',        'icon' => 'fas fa-fw fa-receipt',        'link' => $base_path . 'order/index.php'],
        ['label' => 'Detail Order', 'icon' => 'fas fa-fw fa-list',           'link' => $base_path . 'detail_order/index.php'],
        ['label' => 'Transaksi',    'icon' => 'fas fa-fw fa-money-bill-wave','link' => $base_path . 'transaksi/index.php'],
        ['label' => 'Level Role',   'icon' => 'fas fa-fw fa-user-shield',    'link' => $base_path . 'level_role/index.php'],
        ['label' => 'User',         'icon' => 'fas fa-fw fa-users',          'link' => $base_path . 'users/index.php'],
    ],
    'Admin' => [
        ['label' => 'Dashboard',    'icon' => 'fas fa-fw fa-tachometer-alt', 'link' => $base_path . 'dashboard/index.php'],
        ['label' => 'Menu Makanan', 'icon' => 'fas fa-fw fa-utensils',       'link' => $base_path . 'menu_makanan/index.php'],
        ['label' => 'Order',        'icon' => 'fas fa-fw fa-receipt',        'link' => $base_path . 'order/index.php'],
        ['label' => 'Detail Order', 'icon' => 'fas fa-fw fa-list',           'link' => $base_path . 'detail_order/index.php'],
        ['label' => 'Transaksi',    'icon' => 'fas fa-fw fa-money-bill-wave','link' => $base_path . 'transaksi/index.php'],
        ['label' => 'Level Role',   'icon' => 'fas fa-fw fa-user-shield',    'link' => $base_path . 'level_role/index.php'],
        ['label' => 'User',         'icon' => 'fas fa-fw fa-users',          'link' => $base_path . 'users/index.php'],
    ],
    'Kasir' => [
        ['label' => 'Transaksi',    'icon' => 'fas fa-fw fa-money-bill-wave','link' => $base_path . 'transaksi/index.php'],
    ],
    'Waiter' => [
        ['label' => 'Order',        'icon' => 'fas fa-fw fa-receipt',        'link' => $base_path . 'order/index.php'],
        ['label' => 'Detail Order', 'icon' => 'fas fa-fw fa-list',           'link' => $base_path . 'detail_order/index.php'],
    ],
    'guest' => [
        ['label' => 'Login',        'icon' => 'fas fa-fw fa-sign-in-alt',    'link' => '../../../backend/login.php'],
    ]
];

// Pilih menu sesuai role
$sidebar_menu = $menus[$role] ?? $menus['guest'];

// Fungsi check active menu
function isMenuActive($menu_link, $current_url) {
    return (strpos($current_url, basename($menu_link)) !== false) ? 'active' : '';
}
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" 
       href="<?= ($role === 'Owner') ? $base_path . 'dashboard1/index.php' : $base_path . 'dashboard/index.php' ?>">
        <div class="sidebar-brand-icon">
            <img src="../../../template_admin/img/logo.png" alt="Logo Restoran" style="width:40px; height:auto;">
        </div>
        <div class="sidebar-brand-text mx-3">Kasir Restoran</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Looping menu sesuai role -->
    <?php if (!empty($sidebar_menu)): ?>
        <?php foreach ($sidebar_menu as $menu): ?>
            <?php $isActive = isMenuActive($menu['link'], $current_url); ?>
            <li class="nav-item <?= $isActive ?>">
                <a class="nav-link <?= $isActive ?>" href="<?= $menu['link'] ?>">
                    <i class="<?= $menu['icon'] ?>"></i>
                    <span><?= $menu['label'] ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    <?php else: ?>
        <li class="nav-item">
            <a class="nav-link" href="../../../backend/login.php">
                <i class="fas fa-fw fa-exclamation-triangle"></i>
                <span>No Access</span>
            </a>
        </li>
    <?php endif; ?>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- User Info -->
    <div class="sidebar-card d-none d-lg-flex">
        <div class="sidebar-card-body">
            <small class="text-light">Logged in as: 
                <strong><?= htmlspecialchars($role) ?></strong>
            </small>
        </div>
    </div>


</ul>
<!-- End of Sidebar -->