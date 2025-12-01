<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../config/connaction.php'; // koneksi database

// --- Ambil data statistik ---
$totalMenu      = $connect->query("SELECT COUNT(*) AS jml FROM masakan")->fetch_assoc()['jml'];
$totalPelanggan = $connect->query("SELECT COUNT(*) AS jml FROM users WHERE role='Pelanggan'")->fetch_assoc()['jml'];

// Jumlah user (Admin, Kasir, Waiter, dll)
$totalUser      = $connect->query("SELECT COUNT(*) AS jml FROM users")->fetch_assoc()['jml'];

// Total transaksi
$totalTransaksi = $connect->query("SELECT COUNT(*) AS jml FROM transaksi")->fetch_assoc()['jml'];

// Pendapatan bulan ini
$pendapatan = $connect->query("
    SELECT IFNULL(SUM(total_harga),0) AS total 
    FROM transaksi 
    WHERE MONTH(tanggal)=MONTH(CURRENT_DATE()) 
    AND YEAR(tanggal)=YEAR(CURRENT_DATE())
")->fetch_assoc()['total'];

// --- Ambil pesanan terbaru ---
$pesanan = $connect->query("
    SELECT o.id_order, u.username, m.nama_masakan, do.keterangan, o.status_order
    FROM `order` o
    JOIN detail_order do ON o.id_order = do.id_order
    JOIN masakan m ON do.id_masakan = m.id_masakan
    JOIN users u ON o.id_user = u.id_user
    ORDER BY o.id_order DESC
    LIMIT 5
");
?>

<div class="container-fluid my-5">

<div class="row mb-4">
    <div class="col-12">
        <div class="dashboard-header p-4 rounded-4 text-white position-relative overflow-hidden d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg,#667eea 0%,#764ba2 100%); min-height: 120px;">
            <div>
                <h2 class="fw-bold mb-2">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard 
                </h2>
                <p class="mb-0 fs-5 text-white-50">
                    Selamat datang kembali    
                    <span class="badge bg-black bg-opacity-20 text-black ms-2" id="dashboard-datetime">
                        <i class="bi bi-calendar-check me-1"></i>
                        <span id="clock"></span>
                    </span>
                </p>
            </div>
            <div class="display-1 opacity-25">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-5">
    <div class="col-lg-3 col-md-6">
        <div class="card stats-card border-0 shadow-lg h-100 position-relative overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stats-icon bg-primary bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-journal-food fs-2 text-primary"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-primary mb-1"><?= $totalMenu ?></h3>
                <p class="text-muted mb-0 fw-medium">Menu Makanan</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card stats-card border-0 shadow-lg h-100 position-relative overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stats-icon bg-success bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-people-fill fs-2 text-success"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-success mb-1"><?= $totalPelanggan ?></h3>
                <p class="text-muted mb-0 fw-medium">Total Pelanggan</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card stats-card border-0 shadow-lg h-100 position-relative overflow-hidden">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stats-icon bg-warning bg-opacity-10 rounded-circle p-3">
                        <i class="bi bi-person-badge-fill fs-2 text-warning"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-warning mb-1"><?= $totalUser ?></h3>
                <p class="text-muted mb-0 fw-medium">Jumlah User</p>
            </div>
        </div>
    </div>
<div class="col-lg-3 col-md-6">
    <div class="card stats-card border-0 shadow-lg h-100 position-relative overflow-hidden">
        <div class="card-body p-4">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="stats-icon bg-success bg-opacity-10 rounded-circle p-3">
                    <i class="bi bi-receipt fs-2 text-success"></i>
                </div>
            </div>
            <h3 class="fw-bold text-success mb-1"><?= number_format($totalTransaksi, 0, ",", ".") ?></h3>
            <p class="text-muted mb-0 fw-medium">Total Transaksi</p>
        </div>
    </div>
</div>

</div>

<!-- Orders Table -->
<div class="row g-0">
    <div class="col-12">
        <div class="card border-0 shadow-lg rounded-0">
            <div class="card-header bg-primary text-white fw-bold d-flex justify-content-between align-items-center">
                <span><i class="bi bi-list-check me-2"></i>Pesanan Terbaru</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0 align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Pesanan</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no=1; 
                        while($row = $pesanan->fetch_assoc()): ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['username']) ?></td>
                                <td><?= htmlspecialchars($row['nama_masakan']) ?></td>
                                <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                <td>
                                    <?php if($row['status_order']=="Proses"): ?>
                                        <span class="badge bg-warning text-white">Proses</span>
                                    <?php elseif($row['status_order']=="Selesai"): ?>
                                        <span class="badge bg-success text-white">Selesai</span>
                                    <?php else: ?>
                                        <span class="badge bg-primary text-white">Baru</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<style>
.stats-card { border-radius: 20px; transition: transform 0.3s, box-shadow 0.3s; }
.stats-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.1); }
.table-hover tbody tr:hover { background-color: rgba(102,126,234,0.05); }
</style>

<script>
function updateClock() {
    const now = new Date();
    const hours = now.getHours().toString().padStart(2,'0');
    const minutes = now.getMinutes().toString().padStart(2,'0');
    const seconds = now.getSeconds().toString().padStart(2,'0');
    document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
}
setInterval(updateClock, 1000);
updateClock();
</script>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>
