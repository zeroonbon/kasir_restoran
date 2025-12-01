<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    die("ID menu tidak ditemukan.");
}

$id = intval($_GET['id']);
$query = "SELECT * FROM masakan WHERE id_masakan = $id";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Data menu tidak ditemukan.");
}

$item = mysqli_fetch_assoc($result);
?>

<!-- Link Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .main-content {
        margin-top: 70px;
        margin-bottom: 30px;
    }

    @media (min-width: 992px) {
        .main-content {
            margin-left: 0;
        }
    }

    .card-header {
        background: #007bff !important;
        color: #fff !important;
    }

    .btn-primary-custom {
        background: #007bff;
        border: none;
        color: #fff;
    }

    .btn-primary-custom:hover {
        background: #0056b3;
        color: #fff;
    }
</style>

<div class="container-fluid main-content">
    <div class="row">
        <div class="col-12 px-2 py-2">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-pencil-square me-2"></i> Edit Menu Makanan
                    </h4>
                    <a href="./index.php" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="../../actions/menu_makanan/update.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_masakan" value="<?= $item['id_masakan'] ?>">

                        <div class="mb-3">
                            <label for="nama_masakan" class="form-label fw-bold">Nama Masakan</label>
                            <input type="text" class="form-control" id="nama_masakan" name="nama_masakan" 
                                   value="<?= htmlspecialchars($item['nama_masakan']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label fw-bold">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" 
                                   value="<?= htmlspecialchars($item['harga']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status_masakan" class="form-label fw-bold">Status</label>
                            <select class="form-select" id="status_masakan" name="status_masakan" required>
                                <option value="tersedia" <?= $item['status_masakan'] == 'tersedia' ? 'selected' : '' ?>>Tersedia</option>
                                <option value="habis" <?= $item['status_masakan'] == 'habis' ? 'selected' : '' ?>>Habis</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Gambar Saat Ini</label><br>
                            <?php if (!empty($item['gambar_masakan'])): ?>
                                <img src="../../../storages/menu_makanan/<?= htmlspecialchars($item['gambar_masakan']) ?>" 
                                     alt="<?= htmlspecialchars($item['nama_masakan']) ?>" 
                                     width="100" height="100" class="rounded shadow-sm border mb-2">
                            <?php else: ?>
                                <p class="text-muted">Tidak ada gambar</p>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="gambar_masakan" class="form-label fw-bold">Ubah Gambar</label>
                            <input type="file" class="form-control" id="gambar_masakan" name="gambar_masakan" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_makanan" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_makanan" name="deskripsi_makanan" rows="3"><?= htmlspecialchars($item['deskripsi_makanan']) ?></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary-custom rounded-pill px-4 shadow-sm">
                            <i class="bi bi-save me-1"></i> Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>
