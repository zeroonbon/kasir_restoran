<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
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
                        <i class="bi bi-plus-circle me-2"></i> Tambah Order
                    </h4>
                    <a href="./index.php" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="../../actions/order/store.php" method="POST">
                        <div class="mb-3">
                            <label for="no_meja" class="form-label fw-bold">No Meja</label>
                            <input type="text" class="form-control" id="no_meja" name="no_meja" required>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_user" class="form-label fw-bold">No User</label>
                            <input type="number" class="form-control" id="id_user" name="id_user" required>
                        </div>

                        <div class="mb-3">
                            <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="status_order" class="form-label fw-bold">Status</label>
                            <select class="form-select" id="status_order" name="status_order" required>
                                <option value="pending">Pending</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                                <option value="batal">Batal</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary-custom rounded-pill px-4 shadow-sm">
                            <i class="bi bi-save me-1"></i> Simpan
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
