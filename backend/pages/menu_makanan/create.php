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
                        <i class="bi bi-plus-circle me-2"></i> Tambah Menu Makanan
                    </h4>
                    <a href="./index.php" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <form action="../../actions/menu_makanan/store.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nama_masakan" class="form-label fw-bold">Nama Masakan</label>
                            <input type="text" class="form-control" id="nama_masakan" name="nama_masakan" required>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label fw-bold">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga" required>
                        </div>

                        <div class="mb-3">
                            <label for="status_masakan" class="form-label fw-bold">Status</label>
                            <select class="form-select" id="status_masakan" name="status_masakan" required>
                                <option value="tersedia">Tersedia</option>
                                <option value="habis">Habis</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="gambar_masakan" class="form-label fw-bold">Gambar</label>
                            <input type="file" class="form-control" id="gambar_masakan" name="gambar_masakan" accept="image/*">
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_makanan" class="form-label fw-bold">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi_makanan" name="deskripsi_makanan" rows="3"></textarea>
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
