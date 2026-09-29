<?php
$page_title = "Daftar Peminjam";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

// Proses hapus (kalau ada permintaan ?hapus=id lewat link Hapus di bawah)
if (isset($_GET['hapus']) && is_numeric($_GET['hapus'])) {
    $stmt = $pdo->prepare("DELETE FROM peminjam WHERE id = :id");
    $stmt->execute(['id' => (int) $_GET['hapus']]);

    $_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Peminjam berhasil dihapus.'];
    header('Location: list.php');
    exit;
}

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarPeminjam = $pdo->query("SELECT * FROM peminjam ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#5c1030;">Daftar Peminjam Alat Musik</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
                <?php endif; ?>

                <div class="mb-3">
                    <label for="search-input" class="form-label fw-semibold">Cari Data Peminjam</label>
                    <input type="text" class="form-control" id="search-input" placeholder="Cari kode atau nama peminjam...">
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle">
                        <thead style="background-color:#5c1030;">
                            <tr class="text-white">
                                <th>No</th>
                                <th>Kode Peminjam</th>
                                <th>Nama Peminjam</th>
                                <th>No Whatsapp</th>
                                <th>Alamat</th>
                                <th>Status Member</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($daftarPeminjam)): ?>
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data peminjam. Silakan tambah lewat menu "Tambah Peminjam".</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($daftarPeminjam as $i => $peminjam): ?>
                                <tr>
                                    <td><?php echo $i + 1; ?></td>
                                    <td><?php echo htmlspecialchars($peminjam['kode_peminjam']); ?></td>
                                    <td><?php echo htmlspecialchars($peminjam['nama_peminjam']); ?></td>
                                    <td><?php echo htmlspecialchars($peminjam['no_hp']); ?></td>
                                    <td><?php echo htmlspecialchars($peminjam['alamat']); ?></td>
                                    <td><?php echo htmlspecialchars($peminjam['status_member']); ?></td>
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