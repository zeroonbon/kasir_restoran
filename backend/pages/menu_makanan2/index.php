<?php

include '../../partials/header.php';
include '../../partials/navbar1.php';
include '../../config/connaction.php';


// Ambil kata kunci pencarian
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

// Query ambil data masakan
$query = "
    SELECT id_masakan, nama_masakan, harga, status_masakan, gambar_masakan, deskripsi_makanan 
    FROM masakan 
    " . ($search != '' ? "WHERE nama_masakan LIKE '%$search%' OR deskripsi_makanan LIKE '%$search%'" : "") . "
    ORDER BY id_masakan ASC
";
$result = mysqli_query($connect, $query) or die("Query Error: " . mysqli_error($connect));
?>


<!-- Bootstrap Icons + Google Fonts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
:root {
    --primary: #4e73df;
    --secondary: #6f42c1;
    --success: #1cc88a;
    --danger: #e74a3b;
    --light: #f8f9fc;
    --dark: #ffffffff;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: #f5f7fb;
}

.main-content {
    margin-left: 50px;   /* geser lebih kiri */
    margin-top: 20px;    /* geser lebih atas */
    margin-bottom: 30px;
    padding: 20px;
}

.page-header {
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.page-title {
    font-weight: 600;
    color: white;
    margin: 0;
}

.search-form {
    position: relative;
    max-width: 300px;
}

.search-form input {
    border-radius: 50px;
    padding-left: 45px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border: none;
    height: 42px;
}

.search-form button {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: transparent;
    border: none;
    color: var(--dark);
    z-index: 10;
}

.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 25px;
    justify-content: start; /* rapat ke kiri */
}

.menu-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    border: none;
}

.menu-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
}

.menu-img-container {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.menu-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.menu-card:hover .menu-img {
    transform: scale(1.05);
}

.menu-status {
    position: absolute;
    top: 15px;
    right: 15px;
    font-size: 0.75rem;
    padding: 5px 12px;
    border-radius: 50px;
    font-weight: 500;
}

.menu-body {
    padding: 20px;
}

.menu-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #2e384d;
}

.menu-desc {
    color: #8797b2;
    font-size: 0.9rem;
    margin-bottom: 15px;
    line-height: 1.5;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.menu-price {
    font-weight: 700;
    color: var(--primary);
    font-size: 1.1rem;
    margin-bottom: 15px;
}

.menu-footer {
    padding: 0 20px 20px;
}

.order-btn {
    border-radius: 50px;
    padding: 10px 20px;
    font-weight: 500;
    width: 100%;
    transition: all 0.3s;
    box-shadow: 0 3px 10px rgba(78, 115, 223, 0.25);
}

.order-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(78, 115, 223, 0.4);
}

.no-results {
    text-align: center;
    padding: 50px 20px;
    grid-column: 1 / -1;
}

.no-results i {
    font-size: 5rem;
    color: #e4e8f0;
    margin-bottom: 20px;
}

.no-results h4 {
    color: #a0a8bd;
    font-weight: 500;
}

@media (max-width: 992px) {
    .main-content {
        margin-left: 0;
        margin-top: 10px;
    }
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
    }
    
    .search-form {
        max-width: 100%;
    }
    
    .menu-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
}

@media (max-width: 576px) {
    .menu-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="main-content">
    <div class="page-header d-flex justify-content-between align-items-center flex-wrap">
        <h1 class="page-title"><i class="bi bi-journal-text me-2"></i> Menu Makanan</h1>
        <form class="search-form" method="GET" action="">
            <button type="submit"><i class="bi bi-search"></i></button>
            <input type="text" 
                   name="q" 
                   class="form-control" 
                   placeholder="Cari menu..." 
                   value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
        </form>
    </div>

    <div class="menu-grid">
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php while ($item = mysqli_fetch_assoc($result)): ?>
            <div class="menu-card">
                <div class="menu-img-container">
                    <?php if (!empty($item['gambar_masakan'])): ?>
                        <img src="../../../storages/menu_makanan/<?= htmlspecialchars($item['gambar_masakan']) ?>" 
                             class="menu-img" 
                             alt="<?= htmlspecialchars($item['nama_masakan']) ?>">
                    <?php else: ?>
                        <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                        </div>
                    <?php endif; ?>
                    
                    <span class="menu-status text-white badge bg-<?= $item['status_masakan']=='Tersedia'?'success':'danger' ?>">
                        <?= htmlspecialchars($item['status_masakan']) ?>
                    </span>
                </div>
                
                <div class="menu-body">
                    <h3 class="menu-title"><?= htmlspecialchars($item['nama_masakan']) ?></h3>
                    <p class="menu-desc"><?= htmlspecialchars($item['deskripsi_makanan']) ?></p>
                    <p class="menu-price">Rp <?= number_format($item['harga'], 0, ',', '.') ?></p>
                </div>
                
<div class="menu-footer">
    <a href="../../pages/menu_makanan2/index.php?id=<?= $item['id_masakan'] ?>" 
       class="btn btn-primary btn-lg">
       Pesan Makanan
    </a>
</div>




            </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="no-results">
                <i class="bi bi-search"></i>
                <h4>Menu tidak ditemukan</h4>
                <p class="text-muted">Coba gunakan kata kunci pencarian yang berbeda</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
include '../../partials/script.php';
?>
