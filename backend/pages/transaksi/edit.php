<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID transaksi tidak ditemukan'); window.location='index.php';</script>";
    exit;
}
$id = intval($_GET['id']);

// Query ambil data transaksi
$query = "SELECT * FROM transaksi WHERE id_transaksi = $id LIMIT 1";
$result = mysqli_query($connect, $query);
$item = mysqli_fetch_assoc($result);

if (!$item) {
    echo "<script>alert('Data transaksi tidak ditemukan'); window.location='index.php';</script>";
    exit;
}

// Ambil data order untuk dropdown
$orders = mysqli_query($connect, "SELECT id_order, no_meja FROM `order` ORDER BY id_order ASC");
?>

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

<div class="container-fluid main-content mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="bi bi-pencil-square me-2"></i> Edit Transaksi</h4>
                    <a href="./index.php" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="../../actions/transaksi/update.php" method="POST">
                        <input type="hidden" name="id_transaksi" value="<?= $item['id_transaksi'] ?>">

                        <div class="mb-3">
                            <label for="id_order" class="form-label fw-bold">Order</label>
                            <select name="id_order" id="id_order" class="form-select" required>
                                <option value="">-- Pilih Order --</option>
                                <?php while ($order = mysqli_fetch_assoc($orders)): ?>
                                    <option value="<?= $order['id_order'] ?>" 
                                        <?= $order['id_order'] == $item['id_order'] ? 'selected' : '' ?>>
                                        Order #<?= $order['id_order'] ?> (Meja: <?= htmlspecialchars($order['no_meja']) ?>)
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" 
                                   value="<?= htmlspecialchars($item['tanggal']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="total_harga" class="form-label fw-bold">Total Harga</label>
                            <input type="number" class="form-control" name="total_harga" id="total_harga" 
                                   value="<?= htmlspecialchars($item['total_harga']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="status_transaksi" class="form-label fw-bold">Status Transaksi</label>
                            <select name="status_transaksi" id="status_transaksi" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="pending" <?= $item['status_transaksi'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="lunas" <?= $item['status_transaksi'] == 'lunas' ? 'selected' : '' ?>>Lunas</option>
                                <option value="batal" <?= $item['status_transaksi'] == 'batal' ? 'selected' : '' ?>>Batal</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary fw-bold w-100">
                            <i class="bi bi-save me-1"></i> Update Transaksi
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
