<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    die("ID order tidak ditemukan.");
}

$id = intval($_GET['id']);
$query = "SELECT * FROM `order` WHERE id_order = $id";
$result = mysqli_query($connect, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Data order tidak ditemukan.");
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
                        <i class="bi bi-pencil-square me-2"></i> Edit Order
                    </h4>
                    <a href="./index.php" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="../../actions/order/update.php" method="POST">
                        <input type="hidden" name="id_order" value="<?= $item['id_order'] ?>">

                        <div class="mb-3">
                            <label for="no_meja" class="form-label fw-bold">No Meja</label>
                            <input type="text" class="form-control" id="no_meja" name="no_meja" 
                                   value="<?= htmlspecialchars($item['no_meja']) ?>" required>
                        </div>

                        <div class="mb-3">
    <label for="tanggal" class="form-label fw-bold">Tanggal</label>
    <input type="date" class="form-control" id="tanggal" name="tanggal" 
           value="<?= date('Y-m-d', strtotime($item['tanggal'])) ?>" required>
</div>




                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= htmlspecialchars($item['keterangan']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status_order" class="form-label fw-bold">Status</label>
                            <select class="form-select" id="status_order" name="status_order" required>
                                <option value="pending" <?= $item['status_order'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="proses" <?= $item['status_order'] == 'proses' ? 'selected' : '' ?>>Proses</option>
                                <option value="selesai" <?= $item['status_order'] == 'selesai' ? 'selected' : '' ?>>Selesai</option>
                                <option value="batal" <?= $item['status_order'] == 'batal' ? 'selected' : '' ?>>Batal</option>
                            </select>
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
