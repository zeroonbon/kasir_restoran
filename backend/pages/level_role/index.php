<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Query ambil data level
$query = "SELECT id_level, nama_level, deskripsi_level FROM level ORDER BY id_level ASC";
$result = mysqli_query($connect, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($connect));
}
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
            margin-left: 0px;
        }
    }

    .table thead {
        background: #007bff;
        color: white;
    }

    .card-header {
        background: #007bff !important;
        color: white !important;
    }
</style>

<div class="container-fluid main-content">
    <div class="row">
        <div class="col-12 px-2 py-2">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-shield-lock me-2"></i> Data Table Level
                    </h4>
                    <a href="./create.php" class="btn btn-light text-primary fw-bold rounded-pill px-4">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Level
                    </a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Level</th>
                                    <th>Deskripsi Level</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                if (mysqli_num_rows($result) > 0):
                                    while ($item = mysqli_fetch_assoc($result)): 
                                ?>
                                <tr>
                                    <td class="fw-medium"><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($item['nama_level']) ?></td>
                                    <td><?= htmlspecialchars($item['deskripsi_level']) ?></td>
                                    <td>
                                        <a href="./edit.php?id=<?= $item['id_level'] ?>" 
                                           class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="../../actions/level_role/destroy.php?id=<?= $item['id_level'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus level ini?')" 
                                           title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php 
                                    endwhile;
                                else: 
                                ?>
                                <tr>
                                    <td colspan="4" class="text-muted">Belum ada data level.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>
