<?php
session_start();
include '../../config/connaction.php';

// --- Pastikan user login ---
$id_user = $_SESSION['id_user'] ?? null;
if (!$id_user) {
    echo "<script>alert('User belum login, silakan login dulu'); window.location='../../../login.php';</script>";
    exit();
}

// --- Ambil ID masakan dari URL ---
if (!isset($_GET['id'])) {
    echo "<script>alert('ID masakan tidak ditemukan'); window.location='index.php';</script>";
    exit();
}
$id_masakan = intval($_GET['id']);

// --- Ambil detail masakan ---
$cekMasakan = $connect->query("SELECT * FROM masakan WHERE id_masakan = '$id_masakan' LIMIT 1");
if ($cekMasakan->num_rows === 0) {
    echo "<script>alert('Menu tidak ditemukan'); window.location='index.php';</script>";
    exit();
}
$menu = $cekMasakan->fetch_assoc();

// --- Proses jika form disubmit ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jumlah = intval($_POST['jumlah'] ?? 1);
    if ($jumlah <= 0) $jumlah = 1;

    $harga = $menu['harga'];
    $total_harga = $harga * $jumlah;

    // Cek user valid di database
    $cekUser = $connect->query("SELECT id_user FROM users WHERE id_user = '$id_user'");
    if ($cekUser->num_rows === 0) {
        echo "<script>alert('User tidak ditemukan'); window.location='../../../login.php';</script>";
        exit();
    }

    // Insert pesanan
    $query = "
        INSERT INTO pesanan (id_user, id_masakan, jumlah, total_harga, status_pesanan) 
        VALUES ('$id_user', '$id_masakan', '$jumlah', '$total_harga', 'pending')
    ";

    if ($connect->query($query)) {
        echo "<script>alert('Pesanan berhasil ditambahkan!'); window.location='index.php';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal menambahkan pesanan: " . $connect->error . "'); window.history.back();</script>";
        exit();
    }
}
?>

<?php include '../../partials/header.php'; ?>
<?php include '../../partials/navbar1.php'; ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container my-5">
    <div class="card shadow-lg">
        <div class="row g-0">
            <div class="col-md-5">
                <?php if (!empty($menu['gambar_masakan'])): ?>
                <img src="../../../storages/menu_makanan/<?= htmlspecialchars($menu['gambar_masakan']) ?>" 
                     class="img-fluid rounded-start" 
                     alt="<?= htmlspecialchars($menu['nama_masakan']) ?>"
                     style="width: 100%; aspect-ratio: 1/1; object-fit: cover;">
                <?php else: ?>
                    <div class="d-flex align-items-center justify-content-center bg-light" style="height:100%">
                        <i class="bi bi-image text-muted" style="font-size:4rem;"></i>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title mb-3"><?= htmlspecialchars($menu['nama_masakan']) ?></h3>
                    <p class="text-muted"><?= nl2br(htmlspecialchars($menu['deskripsi_makanan'])) ?></p>
                    <h4 class="text-primary">Rp <?= number_format($menu['harga'], 0, ',', '.') ?></h4>
                    <span class="badge bg-success">Tersedia</span>
                    
                    <!-- Form Pesan -->
                    <form method="POST" class="mt-4">
                        <input type="hidden" name="id_masakan" value="<?= htmlspecialchars($menu['id_masakan']) ?>">
                        <div class="mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" value="1" min="1" class="form-control" required>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="bi bi-cart-plus me-2"></i> Pesan Sekarang
                            </button>
                            <a href="index.php" class="btn btn-secondary btn-lg w-100">
                                <i class="bi bi-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../partials/script.php'; ?>
