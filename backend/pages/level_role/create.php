<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
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
</style>

<div class="container-fluid main-content">
    <div class="row">
        <div class="col-12 px-2 py-2">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="bi bi-plus-circle me-2"></i> Tambah Level</h4>
                    <a href="./index.php" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <form action="../../actions/level_role/store.php" method="POST">
                        <div class="mb-3">
                            <label for="nama_level" class="form-label fw-bold">Nama Level</label>
                            <input type="text" class="form-control" id="nama_level" name="nama_level" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_level" class="form-label fw-bold">Deskripsi Level</label>
                            <textarea class="form-control" id="deskripsi_level" name="deskripsi_level" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary fw-bold w-100">
                            <i class="bi bi-save me-1"></i> Simpan Level
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
