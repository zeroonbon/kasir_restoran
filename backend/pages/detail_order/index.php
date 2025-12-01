<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Query ambil data detail_order + join order & masakan
$query = "
SELECT 
    d.id_detail_order,
    d.keterangan,
    d.status_detail_order,
    o.no_meja,
    m.nama_masakan
FROM detail_order d
LEFT JOIN `order` o ON d.id_order = o.id_order
LEFT JOIN masakan m ON d.id_masakan = m.id_masakan
ORDER BY d.id_detail_order ASC
";

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
    .card-header {
        background: linear-gradient(135deg, #007bff, #00c6ff);
        color: white !important;
        font-weight: bold;
    }
    .order-card {
        border: 1.5px solid #e0e0e0; /* 🔹 garis tipis abu-abu */
        border-radius: 14px;
        background: #fff;
        transition: 0.3s;
        box-shadow: 0px 3px 10px rgba(0,0,0,0.05);
        overflow: hidden;
    }
    .order-card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 20px rgba(0,0,0,0.12);
        border-color: #007bff; /* 🔹 border ikut highlight saat hover */
    }
    .order-card h5 {
        font-weight: 700;
        color: #333;
    }
    .order-info {
        font-size: 0.9rem;
        margin-bottom: 6px;
    }
    .badge-status {
        font-size: 0.8rem;
        padding: 6px 10px;
        border-radius: 20px;
    }
    .badge-status.pending { background: #fff3cd; color: #856404; }
    .badge-status.selesai { background: #d4edda; color: #155724; }
    .badge-status.proses   { background: #f8d7da; color: #ff00ff; }
    .action-btns a {
        border-radius: 10px;
    }
</style>


<div class="container-fluid main-content">
    <div class="row">
        <div class="col-12 px-2 py-2">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header border-0 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-basket2 me-2"></i> Data Detail Order
                    </h4>
                    <a href="./create.php" class="btn btn-light text-primary fw-bold rounded-pill px-4 shadow-sm">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Detail Order
                    </a>
                </div>

                <div class="card-body">
                    <div class="row g-4">
                        <?php 
                        if (mysqli_num_rows($result) > 0):
                            while ($item = mysqli_fetch_assoc($result)): 
                                $status = strtolower($item['status_detail_order'] ?? '');
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="order-card p-4 h-100">
                                <h5 class="mb-3">
                                    <i class="bi bi-egg-fried  text-primary me-2"></i> 
                                    <?= htmlspecialchars($item['nama_masakan'] ?? '-') ?>
                                </h5>
                                <p class="order-info">
                                    <i class="bi bi-table me-2 text-secondary"></i> 
                                    <strong>Meja:</strong> <?= htmlspecialchars($item['no_meja'] ?? '-') ?>
                                </p>
                                <p class="order-info">
                                    <i class="bi bi-chat-dots me-2 text-secondary"></i> 
                                    <?= htmlspecialchars($item['keterangan'] ?? '-') ?>
                                </p>
                                <span class="badge-status <?= $status ?>">
                                    <i class="bi bi-circle-fill me-1"></i> 
                                    <?= htmlspecialchars($item['status_detail_order'] ?? '-') ?>
                                </span>
                                <div class="d-flex justify-content-end mt-3 action-btns">
                                    <a href="./edit.php?id=<?= $item['id_detail_order'] ?>" 
                                       class="btn btn-sm btn-outline-warning me-2" title="Edit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="../../actions/detail_order/destroy.php?id=<?= $item['id_detail_order'] ?>" 
                                       class="btn btn-sm btn-outline-danger" 
                                       onclick="return confirm('Yakin ingin menghapus detail order ini?')" 
                                       title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <?php 
                            endwhile;
                        else: 
                        ?>
                        <div class="col-12 text-center text-muted py-4">
                            <i class="bi bi-emoji-frown fs-1 d-block mb-2"></i>
                            Belum ada data detail order.
                        </div>
                        <?php endif; ?>
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
