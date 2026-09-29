<?php
$page_title = "Daftar Alat";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

// Proses hapus (kalau ada permintaan ?hapus=id lewat link Hapus di bawah)
if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $stmt = $pdo->prepare("DELETE FROM alat WHERE id = :id");
    $stmt->execute(['id' => (int) $_GET['hapus']]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Alat musik berhasil dihapus.'];
    header('Location: list.php');
    exit;
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarAlat = $pdo->query("SELECT * FROM alat ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#5c1030;">Daftar Alat Musik</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="search-input" class="form-label fw-semibold">Cari Data Alat</label>
                    <input type="text" class="form-control" id="search-input" placeholder="Cari kode atau nama alat...">
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead style="background-color:#5c1030;">
                            <tr class="text-white">
                                <th>No</th>
                                <th>Kode Alat</th>
                                <th>Nama Alat</th>
                                <th>Kategori</th>
                                <th>Tarif / Jam</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($daftarAlat)): ?>
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data alat. Silakan tambah lewat menu "Tambah Alat".</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($daftarAlat as $i => $alat): ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo htmlspecialchars($alat['kode_alat']); ?></td>
                                    <td><?php echo htmlspecialchars($alat['nama_alat']); ?></td>
                                    <td><?php echo htmlspecialchars($alat['kategori']); ?></td>
                                    <td>Rp <?php echo number_format($alat['tarif'], 0, ',', '.'); ?></td>
                                    <td><?php echo htmlspecialchars($alat['status']); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm text-white">Edit</button>
                                        <button type="button" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>