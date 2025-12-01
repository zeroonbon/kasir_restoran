<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    die("ID Detail Order tidak ditemukan.");
}

$id = intval($_GET['id']);
$query = "
    SELECT 
        d.id_detail_order,
        d.id_order,
        d.id_masakan,
        d.keterangan,
        d.status_detail_order,
        o.no_meja,
        m.nama_masakan
    FROM detail_order d
    LEFT JOIN `order` o ON d.id_order = o.id_order
    LEFT JOIN masakan m ON d.id_masakan = m.id_masakan
    WHERE d.id_detail_order = $id
    LIMIT 1
";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Data detail order tidak ditemukan.");
}

$item = mysqli_fetch_assoc($result);

// Data dropdown
$orders = mysqli_query($connect, "SELECT id_order, no_meja FROM `order` ORDER BY no_meja ASC");
$masakans = mysqli_query($connect, "SELECT id_masakan, nama_masakan FROM masakan ORDER BY nama_masakan ASC");
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
                        <i class="bi bi-pencil-square me-2"></i> Edit Detail Order
                    </h4>
                    <a href="./index.php" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="../../actions/detail_order/update.php" method="POST">
                        <input type="hidden" name="id_detail_order" value="<?= $item['id_detail_order'] ?>">

                        <div class="mb-3">
                            <label for="id_order" class="form-label fw-bold">No Meja</label>
                            <select name="id_order" id="id_order" class="form-control" required>
                                <option value="">-- Pilih No Meja --</option>
                                <?php while ($order = mysqli_fetch_assoc($orders)): ?>
                                    <option value="<?= $order['id_order'] ?>" <?= $order['id_order'] == $item['id_order'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($order['no_meja']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_masakan" class="form-label fw-bold">Nama Masakan</label>
                            <select name="id_masakan" id="id_masakan" class="form-control" required>
                                <option value="">-- Pilih Masakan --</option>
                                <?php while ($masakan = mysqli_fetch_assoc($masakans)): ?>
                                    <option value="<?= $masakan['id_masakan'] ?>" <?= $masakan['id_masakan'] == $item['id_masakan'] ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($masakan['nama_masakan']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" 
                                   value="<?= htmlspecialchars($item['keterangan']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status_detail_order" class="form-label fw-bold">Status Order</label>
                            <select class="form-select" id="status_detail_order" name="status_detail_order" required>
                                <option value="pending" <?= $item['status_detail_order'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="proses" <?= $item['status_detail_order'] == 'proses' ? 'selected' : '' ?>>Proses</option>
                                <option value="selesai" <?= $item['status_detail_order'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary-custom rounded-pill px-4 shadow-sm">
                            <i class="bi bi-save me-1"></i> Update Detail Order
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
