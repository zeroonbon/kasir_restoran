<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Ambil kata kunci pencarian
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

// Query ambil data order
if ($search != '') {
    $query = "SELECT id_order, no_meja, tanggal, id_user, keterangan, status_order 
              FROM `order` 
              WHERE no_meja LIKE '%$search%' 
                 OR id_user LIKE '%$search%' 
                 OR keterangan LIKE '%$search%'
                 OR status_order LIKE '%$search%'
              ORDER BY id_order ASC";
} else {
    $query = "SELECT id_order, no_meja, tanggal, id_user, keterangan, status_order 
              FROM `order` 
              ORDER BY id_order ASC";
}
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
            margin-left: 0px; /* geser dikit dari kiri */
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
                        <i class="bi bi-list-check me-2"></i> Data Table Order
                    </h4>

                    <div class="d-flex">
                        <!-- Form Pencarian -->
                        <form class="d-flex me-2" method="GET" action="">
                            <input type="text" 
                                   name="q" 
                                   class="form-control form-control-sm rounded-pill" 
                                   placeholder="Cari order..." 
                                   value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                            <button type="submit" 
                                    class="btn btn-secondary rounded-circle d-flex align-items-center justify-content-center ms-2" 
                                    style="width:35px; height:34px;">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>

                        <!-- Tombol Tambah Order -->
                        <a href="./create.php" class="btn btn-light text-primary fw-bold rounded-pill px-4">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Order
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Meja</th>
                                    <th>Tanggal</th>
                                    <th>Keterangan</th>
                                    <th>Status</th>
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
                                    <td><?= htmlspecialchars($item['no_meja']) ?></td>
                                    <td><?= htmlspecialchars($item['tanggal']) ?></td>
                                    <td><?= htmlspecialchars($item['keterangan']) ?></td>
                                    <td><?= htmlspecialchars($item['status_order']) ?></td>
                                    <td>
                                        <a href="./edit.php?id=<?= $item['id_order'] ?>" 
                                           class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="../../actions/order/destroy.php?id=<?= $item['id_order'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus order ini?')" 
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
                                    <td colspan="7" class="text-muted">Belum ada data order.</td>
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
