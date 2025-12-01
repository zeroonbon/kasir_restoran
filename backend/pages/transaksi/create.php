<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Ambil data order dan user untuk dropdown
$orders = mysqli_query($connect, "SELECT id_order, no_meja FROM `order` ORDER BY id_order ASC");
$users  = mysqli_query($connect, "SELECT id_user, username FROM users ORDER BY id_user ASC");
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
                    <h4><i class="bi bi-plus-circle me-2"></i> Tambah Transaksi</h4>
                    <a href="./index.php" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="../../actions/transaksi/store.php" method="POST">
                        

                        <!-- Pilih Order (No Meja) -->
                        <div class="mb-3">
                            <label for="id_order" class="form-label fw-bold">Order (No Meja)</label>
                            <select name="id_order" id="id_order" class="form-select" required>
                                <option value="">-- Pilih Order --</option>
                                <?php while ($order = mysqli_fetch_assoc($orders)): ?>
                                    <option value="<?= $order['id_order'] ?>">
                                        Meja <?= htmlspecialchars($order['no_meja']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- Input Tanggal -->
                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal" required>
                        </div>

                        <!-- Input Total Harga -->
                        <div class="mb-3">
                            <label for="total_harga" class="form-label fw-bold">Total Harga</label>
                            <input type="number" class="form-control" name="total_harga" id="total_harga" required>
                        </div>

                        <!-- Pilih Status -->
                        <div class="mb-3">
                            <label for="status_transaksi" class="form-label fw-bold">Status Transaksi</label>
                            <select name="status_transaksi" id="status_transaksi" class="form-select" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="pending">Pending</option>
                                <option value="lunas">Lunas</option>
                                <option value="batal">Batal</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary fw-bold w-100">
                            <i class="bi bi-save me-1"></i> Simpan Transaksi
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
