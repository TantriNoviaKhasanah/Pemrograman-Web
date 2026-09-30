<?php
$page_title = "Beranda";
include __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/koneksi.php';

$totalAlat = $pdo->query("SELECT COUNT(*) FROM alat")->fetchColumn();
$totalPeminjam = $pdo->query("SELECT COUNT(*) FROM peminjam")->fetchColumn();
$sedangDipinjam = $pdo->query("SELECT COUNT(*) FROM alat WHERE status = 'Dipinjam'")->fetchColumn();
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title" style="color:#5c1030;">
                    Selamat Datang di Sistem Peminjaman Alat Musik Studio
                </h2>
                <p class="card-text mb-0">
                    Web Pengelola Peminjaman Alat Musik Studio.
                </p>
            </div>
        </section>

        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#5c1030;">
                    Rekapitulasi Data Peminjaman Alat Musik
                </h2>
                <div class="row g-3 text-center">
                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-3" style="background-color:#fdf1f6;">
                            <h3 class="h6 text-secondary">Total Alat</h3>
                            <p class="fs-2 fw-bold mb-0" style="color:#5c1030;"><?php echo $totalAlat; ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-3" style="background-color:#fdf1f6;">
                            <h3 class="h6 text-secondary">Total Peminjam</h3>
                            <p class="fs-2 fw-bold mb-0" style="color:#5c1030;"><?php echo $totalPeminjam; ?></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="p-3 rounded-3" style="background-color:#fdf1f6;">
                            <h3 class="h6 text-secondary">Alat Sedang Dipinjam</h3>
                            <p class="fs-2 fw-bold mb-0" style="color:#5c1030;"><?php echo $sedangDipinjam; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>