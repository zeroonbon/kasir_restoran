<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Query ambil data user
$query = "SELECT * FROM users ORDER BY id_user ASC";
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
                        <i class="bi bi-people me-2"></i> Data Table Users
                    </h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no = 1;
                                if (mysqli_num_rows($result) > 0):
                                    while ($user = mysqli_fetch_assoc($result)): 
                                ?>
                                <tr>
                                    <td class="fw-medium"><?= $no++ ?></td>
                                    <td><?= htmlspecialchars($user['username']) ?></td>
                                    <td>********</td>
                                    <td><?= htmlspecialchars($user['role']) ?></td>
                                    <td>
                                        <a href="../../actions/users/destroy.php?id=<?= $user['id_user'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus user ini?')" 
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
                                    <td colspan="6" class="text-muted">Belum ada data user.</td>
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
