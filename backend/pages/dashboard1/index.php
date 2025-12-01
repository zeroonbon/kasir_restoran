<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';
include '../../config/connaction.php'; // koneksi database

// --- Ambil data statistik ---
// Karakter spasi non-standar telah dihapus dari baris-baris ini:
$totalMenu = $connect->query("SELECT COUNT(*) AS jml FROM masakan")->fetch_assoc()['jml'];
$totalPelanggan = $connect->query("SELECT COUNT(*) AS jml FROM users WHERE role='Pelanggan'")->fetch_assoc()['jml'];
$totalUser = $connect->query("SELECT COUNT(*) AS jml FROM users")->fetch_assoc()['jml'];
$totalPendapatan = $connect->query("SELECT IFNULL(SUM(total_harga),0) AS total FROM transaksi")->fetch_assoc()['total'];

// Pendapatan bulan ini
$pendapatan = $connect->query("
    SELECT IFNULL(SUM(total_harga),0) AS total 
    FROM transaksi 
    WHERE MONTH(tanggal)=MONTH(CURRENT_DATE()) 
    AND YEAR(tanggal)=YEAR(CURRENT_DATE())
")->fetch_assoc()['total'];

// Pendapatan hari ini
$pendapatan_hari_ini = $connect->query("
    SELECT IFNULL(SUM(total_harga),0) AS total 
    FROM transaksi 
    WHERE DATE(tanggal)=CURRENT_DATE()
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

<style>
/* ... (CSS Anda yang sudah ada) ... */
.stats-card {
 border-radius: 10px;
 transition: transform 0.3s, box-shadow 0.3s;
}
.stats-card:hover {
 transform: translateY(-5px);
 box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}
.card-header {
 border-top-left-radius: 20px !important;
 border-top-right-radius: 20px !important;
}

/* --- CSS Garis Biru Tambahan --- */
.section-divider {
    border: none;
    height: 5px; /* Ketebalan garis */
    background: linear-gradient(90deg, #36A2EB, #36A2EB 50%, transparent 100%); /* Garis biru solid atau gradient */
    border-radius: 2px;
    margin: 3rem 0; /* Jarak atas dan bawah */
    opacity: 0.7;
}

/* Warna untuk Stats Card */
.bg-primary { background-color: #36A2EB !important; }
.text-primary { color: #36A2EB !important; }
</style>


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
<hr class="section-divider">


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
     <div class="stats-icon bg-info bg-opacity-10 rounded-circle p-3">
      <i class="bi bi-cash-stack fs-2 text-info"></i>
     </div>
    </div>
    <h3 class="fw-bold text-info mb-1">Rp <?= number_format($totalPendapatan, 0, ",", ".") ?></h3>
    <p class="text-muted mb-0 fw-medium">Total Pendapatan</p>
   </div>
  </div>
 </div>
</div>
<hr class="section-divider">


<div class="row g-4 mb-5">
  <div class="col-lg-8">
  <div class="card stats-card border-0 shadow-lg h-100 position-relative overflow-hidden">
   <div class="card-header bg-info text-white fw-bold d-flex justify-content-between align-items-center">
    <span><i class="bi bi-graph-up-arrow me-2"></i>Pendapatan Bulanan</span>
   </div>
   <div class="card-body p-4">
    <canvas id="pendapatanChart" style="height:280px"></canvas>
   </div>
  </div>
 </div>

  <div class="col-lg-4">
  <div class="card stats-card border-0 shadow-lg h-100 position-relative overflow-hidden">
   <div class="card-header bg-success text-white fw-bold d-flex justify-content-between align-items-center">
    <span><i class="bi bi-people-fill me-2"></i>Distribusi User</span>
   </div>
   <div class="card-body p-4 d-flex justify-content-center align-items-center">
    <canvas id="pelangganChart" style="height:280px; max-width:100%"></canvas>
   </div>
  </div>
 </div>
</div>
<hr class="section-divider">


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
// --- Ambil data pendapatan per bulan (pakai total_harga) ---
$pendapatan_bulanan = [];
$bulan_labels = [];
$query = $connect->query("
    SELECT MONTH(tanggal) as bulan, SUM(total_harga) as total 
    FROM transaksi 
    WHERE YEAR(tanggal)=YEAR(CURRENT_DATE())
    GROUP BY MONTH(tanggal)
    ORDER BY bulan ASC
");
while($row = $query->fetch_assoc()){
    $bulan_labels[] = date("F", mktime(0,0,0,$row['bulan'],10));
    $pendapatan_bulanan[] = $row['total'];
}

// --- Ambil data role user untuk diagram ---
$roles = [];
$role_count = [];
$q_roles = $connect->query("SELECT role, COUNT(*) as jml FROM users GROUP BY role");
while($r = $q_roles->fetch_assoc()){
    $roles[] = $r['role'];
    $role_count[] = $r['jml'];
}
?>

<script>
// Data PHP ke JS
const bulanLabels = <?= json_encode($bulan_labels) ?>;
const pendapatanData = <?= json_encode($pendapatan_bulanan) ?>;
const roleLabels = <?= json_encode($roles) ?>;
const roleCounts = <?= json_encode($role_count) ?>;

// Chart Pendapatan Bulanan (total_harga)
// Chart Pendapatan Bulanan (total_harga)
new Chart(document.getElementById('pendapatanChart'), {
    type: 'line',
    data: {
        labels: bulanLabels,
        datasets: [{
            label: 'Pendapatan Bulanan (Rp)',
            data: pendapatanData,
            borderColor: '#36A2EB',
            borderWidth: 4, // garis lebih tebal
            backgroundColor: 'rgba(54,162,235,0.1)',
            fill: true,
            tension: 0.5, // 0 = lurus, 1 = melengkung penuh
            cubicInterpolationMode: 'monotone', // bikin wave smooth
            pointRadius: 5,
            pointHoverRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'top' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let value = context.parsed.y || 0;
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        },
        scales: {
            y: {
                ticks: {
                    callback: function(value) {
                        return 'Rp ' + value.toLocaleString('id-ID');
                    }
                }
            }
        }
    }
});


// Chart Distribusi User
new Chart(document.getElementById('pelangganChart'), {
    type: 'pie',
    data: {
        labels: roleLabels,
        datasets: [{
            data: roleCounts,
            backgroundColor: ['#36A2EB','#4BC0C0','#FFCE56','#FF6384','#9966FF','#FF9F40']
        }]
    }
});
</script>


<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>