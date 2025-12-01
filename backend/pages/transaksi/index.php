<?php
include '../../partials/header.php';
include '../../partials/sidebar.php';
include '../../partials/navbar.php';

// Koneksi database
include '../../config/connaction.php';

// Query ambil data transaksi
$query = "
    SELECT t.id_transaksi, t.id_user, t.id_order, o.no_meja, 
           t.tanggal, t.total_harga, t.status_transaksi
    FROM transaksi t
    LEFT JOIN `order` o ON t.id_order = o.id_order
    ORDER BY t.id_transaksi ASC
";


$result = mysqli_query($connect, $query);

if (!$result) {
    die("Query Error: " . mysqli_error($connect));
}
?>

<!-- Link Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Library untuk export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

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

    .table thead {
        background: #007bff;
        color: white;
    }

    .card-header {
        background: #007bff !important;
        color: white !important;
    }
    
    .btn-export {
        border-radius: 50px;
        padding: 8px 20px;
        font-weight: 600;
    }
</style>

<div class="container-fluid main-content">
    <div class="row">
        <div class="col-12 px-2 py-2">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="bi bi-cash-stack me-2"></i> Data Table Transaksi
                    </h4>
                    <div>
                        <a href="./create.php" class="btn btn-light text-primary fw-bold btn-export me-2">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Transaksi
                        </a>
                        <button onclick="exportToPDF()" class="btn btn-light text-danger fw-bold btn-export me-2">
                            <i class="bi bi-file-earmark-pdf me-1"></i> PDF
                        </button>
                        <button onclick="exportToExcel()" class="btn btn-light text-success fw-bold btn-export me-2">
                            <i class="bi bi-file-earmark-spreadsheet me-1"></i> Excel
                        </button>
                        <button onclick="printTable()" class="btn btn-light text-info fw-bold btn-export">
                            <i class="bi bi-printer me-1"></i> Print
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered align-middle text-center" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Meja</th>
                                    <th>Tanggal</th>
                                    <th>Total Harga</th>
                                    <th>Status Transaksi</th>
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
                                    <td><?= htmlspecialchars($item['no_meja'] ?? '') ?></td>

                                    <td><?= !empty($item['tanggal']) ? date('Y-m-d', strtotime($item['tanggal'])) : '' ?></td>
                                    <td><?= 'Rp ' . number_format($item['total_harga'] ?? 0, 0, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($item['status_transaksi'] ?? '') ?></td>
                                    <td>
                                        <a href="./edit.php?id=<?= $item['id_transaksi'] ?>" 
                                           class="btn btn-sm btn-outline-warning me-1" title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="../../actions/transaksi/destroy.php?id=<?= $item['id_transaksi'] ?>" 
                                           class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Yakin ingin menghapus transaksi ini?')" 
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
                                    <td colspan="8" class="text-muted">Belum ada data transaksi.</td>
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

<script>
// Inisialisasi jsPDF
const { jsPDF } = window.jspdf;

function printTable() {
    // Clone tabel untuk print
    var table = document.querySelector('.table-responsive table').cloneNode(true);
    
    // Hapus kolom aksi (kolom terakhir)
    var rows = table.querySelectorAll('tr');
    rows.forEach(function(row) {
        if (row.cells.length > 0) {
            row.removeChild(row.lastElementChild);
        }
    });

    // Buat jendela baru untuk print
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write('<html><head><title>Print Transaksi</title>');
    printWindow.document.write('<style>');
    printWindow.document.write('body { font-family: Arial, sans-serif; }');
    printWindow.document.write('table { width: 100%; border-collapse: collapse; margin: 20px 0; }');
    printWindow.document.write('table, th, td { border: 1px solid #ddd; }');
    printWindow.document.write('th, td { padding: 10px; text-align: center; }');
    printWindow.document.write('th { background-color: #007bff; color: white; }');
    printWindow.document.write('h1 { text-align: center; color: #007bff; }');
    printWindow.document.write('</style></head><body>');
    printWindow.document.write('<h1>Laporan Data Transaksi</h1>');
    printWindow.document.write(table.outerHTML);
    printWindow.document.write('</body></html>');

    printWindow.document.close();
    printWindow.focus();
    printWindow.print();
    printWindow.close();
}

function exportToPDF() {
    // Buat instance jsPDF
    const doc = new jsPDF();
    
    // Judul laporan
    doc.setFontSize(18);
    doc.text('LAPORAN DATA TRANSAKSI', 105, 15, { align: 'center' });
    doc.setFontSize(12);
    doc.text('Tanggal: ' + new Date().toLocaleDateString(), 105, 22, { align: 'center' });
    
    // Data untuk tabel
    const table = document.getElementById('dataTable');
    const rows = [];
    
    // Ambil header
    const headers = [];
    for (let i = 0; i < table.rows[0].cells.length - 1; i++) { // Kurangi 1 untuk menghilangkan kolom aksi
        headers.push(table.rows[0].cells[i].textContent);
    }
    
    // Ambil data (tidak termasuk header dan kolom aksi)
    for (let i = 1; i < table.rows.length; i++) {
        const row = [];
        for (let j = 0; j < table.rows[i].cells.length - 1; j++) { // Kurangi 1 untuk menghilangkan kolom aksi
            row.push(table.rows[i].cells[j].textContent);
        }
        rows.push(row);
    }
    
    // Buat tabel di PDF
    doc.autoTable({
        head: [headers],
        body: rows,
        startY: 30,
        styles: { overflow: 'linebreak', fontSize: 10 },
        columnStyles: {
            0: { cellWidth: 'auto' },
            1: { cellWidth: 'auto' },
            2: { cellWidth: 'auto' },
            3: { cellWidth: 'auto' },
            4: { cellWidth: 'auto' },
            5: { cellWidth: 'auto' }
        }
    });
    
    // Simpan PDF
    doc.save('laporan-transaksi-' + new Date().toISOString().slice(0, 10) + '.pdf');
}

function exportToExcel() {
    // Data untuk Excel
    const table = document.getElementById('dataTable');
    const data = [];
    
    // Ambil header (tidak termasuk kolom aksi)
    const headers = [];
    for (let i = 0; i < table.rows[0].cells.length - 1; i++) {
        headers.push(table.rows[0].cells[i].textContent);
    }
    data.push(headers);
    
    // Ambil data (tidak termasuk kolom aksi)
    for (let i = 1; i < table.rows.length; i++) {
        const row = [];
        for (let j = 0; j < table.rows[i].cells.length - 1; j++) {
            row.push(table.rows[i].cells[j].textContent);
        }
        data.push(row);
    }
    
    // Buat worksheet
    const ws = XLSX.utils.aoa_to_sheet(data);
    
    // Atur lebar kolom
    const wscols = [
        { wch: 5 },  // No
        { wch: 10 }, // No Role
        { wch: 10 }, // No User
        { wch: 15 }, // Tanggal
        { wch: 20 }, // Total Harga
        { wch: 20 }  // Status Transaksi
    ];
    ws['!cols'] = wscols;
    
    // Buat workbook
    const wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Transaksi");
    
    // Simpan file
    XLSX.writeFile(wb, 'laporan-transaksi-' + new Date().toISOString().slice(0, 10) + '.xlsx');
}
</script>

<?php
include '../../partials/footer.php';
include '../../partials/script.php';
?>