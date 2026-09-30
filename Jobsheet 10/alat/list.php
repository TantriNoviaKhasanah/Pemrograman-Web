<?php
$page_title = "Daftar Alat";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM alat WHERE nama_alat ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM alat WHERE nama_alat ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM alat")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM alat ORDER BY id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarAlat = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#5c1030;">Daftar Alat Musik</h2>
                <p class="text-muted small mb-3">Menampilkan <?php echo count($daftarAlat); ?> dari <?php echo $totalRows; ?> alat.</p>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
                <?php endif; ?>

                <div class="search-box mb-3">
                    <form method="get" action="list.php" class="d-flex gap-2 align-items-end">
                        <div>
                            <label for="search-input" class="form-label fw-semibold">Cari Data Alat</label>
                            <input type="text" class="form-control" id="search-input" name="q" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Contoh: Gitar, Drum, Keyboard...">
                        </div>
                        <button type="submit" class="btn" style="background-color:#5c1030; color:#fff;">Cari</button>
                        <?php if ($keyword !== ''): ?>
                        <a href="list.php" class="btn btn-outline-secondary">Reset</a>
                        <?php endif; ?>
                    </form>
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
                                <td colspan="7" class="text-center">Tidak ada data alat yang cocok.</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($daftarAlat as $i => $alat): ?>
                                <tr>
                                    <td><?php echo $offset + $i + 1; ?></td>
                                    <td><?php echo htmlspecialchars($alat['kode_alat']); ?></td>
                                    <td><?php echo htmlspecialchars($alat['nama_alat']); ?></td>
                                    <td><?php echo htmlspecialchars($alat['kategori']); ?></td>
                                    <td>Rp <?php echo number_format($alat['tarif'], 0, ',', '.'); ?></td>
                                    <td><?php echo htmlspecialchars($alat['status']); ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $alat['id']; ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                                        <form class="form-hapus d-inline" method="post" action="hapus.php">
                                            <input type="hidden" name="id" value="<?php echo $alat['id']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm btn-hapus">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                               <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <nav class="pagination mt-3">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="list.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                       class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                    <?php endfor; ?>
                </nav>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>