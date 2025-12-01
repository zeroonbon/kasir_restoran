<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Ambil kata kunci pencarian
$search = isset($_GET['q']) ? trim($_GET['q']) : '';

// Query ambil data masakan
if ($search != '') {
    $query = "SELECT id_masakan, nama_masakan, harga, status_masakan, gambar_masakan, deskripsi_makanan 
              FROM masakan 
              WHERE nama_masakan LIKE '%$search%' 
              OR deskripsi_makanan LIKE '%$search%'
              ORDER BY id_masakan ASC";
} else {
    $query = "SELECT id_masakan, nama_masakan, harga, status_masakan, gambar_masakan, deskripsi_makanan 
              FROM masakan 
              ORDER BY id_masakan ASC";
}
$result = mysqli_query($connect, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($connect));
}
?>


<!-- Link Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* Sidebar fixed */
#accordionSidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    height: 100vh;
    overflow-y: auto; /* scroll jika menu banyak */
    z-index: 999;
}

/* Main content geser agar tidak tertutup sidebar */
.main-content {
    margin-left: 250px; /* sesuai lebar sidebar */
    margin-top: 70px;   /* tinggi navbar */
    margin-bottom: 30px;
}

/* Konten merapat ke kiri */
.container-fluid.main-content {
    max-width: 1560px;  /* agar tidak terlalu melebar */
    padding-left: 5px;  /* rapat ke kiri */
    padding-right: 15px;
}

/* Card header style */
.card-header {
    background: #007bff !important;
    color: white !important;
}

/* Table styling */
.table thead {
    background: #007bff;
    color: white;
}
table {
    width: 100%;
    table-layout: fixed;
}
td, th {
    word-wrap: break-word;
}

/* Table scroll */
.table-responsive {
    max-height: 500px;  /* tinggi maksimal table sebelum scroll vertical */
    overflow-x: auto;   /* scroll horizontal jika table lebar */
    overflow-y: auto;   /* scroll vertical jika tinggi table */
    margin-left: 0;     /* rapat ke kiri */
}

/* Gambar tetap rapi */
/* Gambar menu seragam */
.table img {
    width: 120px;         /* lebar tetap */
    height: 120px;        /* tinggi tetap */
    object-fit: cover;    /* gambar dipotong biar tidak gepeng */
    border-radius: 10px;  /* sudut membulat */
    border: 1px solid #ddd;
    display: block;       /* biar mudah diposisikan */
    margin: 0 auto;       /* center horizontal */
}

</style>

<div class="container-fluid main-content">
    <div class="row">
        <div class="col-12 px-2 py-2">
            <div class="card border-0 shadow-sm rounded-4">
<div class="card-header border-bottom d-flex justify-content-between align-items-center">
    <h4 class="mb-0">
        <i class="bi bi-journal-text me-2"></i> Data Table Menu Makanan
    </h4>

    <div class="d-flex">
        <!-- Form Pencarian -->
<form class="d-flex me-2" method="GET" action="">
    <input type="text" 
           name="q" 
           class="form-control form-control-sm rounded-pill" 
           placeholder="Cari menu..." 
           value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
    <button type="submit" 
            class="btn btn-secondary rounded-circle d-flex align-items-center justify-content-center ms-2" 
            style="width:35px; height:34px;">
        <i class="bi bi-search"></i>
    </button>
</form>



        <!-- Tombol Tambah Menu -->
        <a href="./create.php" class="btn btn-light text-primary fw-bold rounded-pill px-4">
            <i class="bi bi-plus-circle me-1"></i> Tambah Menu
        </a>
    </div>
</div>


                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                                                        <th>Gambar</th>

                                    <th>Nama Masakan</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Gambar</th>
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
                                                                        <td>
                                        <?php if (!empty($item['gambar_masakan'])): ?>
                                            <img src="../../../storages/menu_makanan/<?= htmlspecialchars($item['gambar_masakan']) ?>" 
                                                 alt="<?= htmlspecialchars($item['nama_masakan']) ?>">
                                        <?php else: ?>
                                            <span class="text-muted">Tidak ada gambar</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($item['nama_masakan']) ?></td>
                                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($item['status_masakan']) ?></td>

                                    <td><?= htmlspecialchars($item['deskripsi_makanan']) ?></td>
                                    <td>
                                        <a href="./edit.php?id=<?= $item['id_masakan'] ?>" 
                                           class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="../../actions/menu_makanan/destroy.php?id=<?= $item['id_masakan'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus menu ini?')" 
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
                                    <td colspan="7" class="text-muted">Belum ada data menu makanan.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div> <!-- .table-responsive -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>
