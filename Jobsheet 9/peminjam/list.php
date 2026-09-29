<?php
$page_title = "Daftar Peminjam";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM peminjam WHERE nama_peminjam ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM peminjam WHERE nama_peminjam ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM peminjam")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM peminjam ORDER BY id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarPeminjam = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#5c1030;">Daftar Peminjam Alat Musik</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
                <?php endif; ?>

                <div class="search-box mb-3">
                    <form method="get" action="list.php" class="d-flex gap-2 align-items-end">
                        <div>
                            <label for="search-input" class="form-label fw-semibold">Cari Data Peminjam</label>
                            <input type="text" class="form-control" id="search-input" name="q" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Ketik nama peminjam...">
                        </div>
                        <button type="submit" class="btn" style="background-color:#5c1030; color:#fff;">Cari</button>
                    </form>
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
                                <td colspan="7" class="text-center">Tidak ada data peminjam yang cocok.</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($daftarPeminjam as $i => $peminjam): ?>
                                <tr>
                                    <td><?php echo $offset + $i + 1; ?></td>
                                    <td><?php echo htmlspecialchars($peminjam['kode_peminjam']); ?></td>
                                    <td><?php echo htmlspecialchars($peminjam['nama_peminjam']); ?></td>
                                    <td><?php echo htmlspecialchars($peminjam['no_hp']); ?></td>
                                    <td><?php echo htmlspecialchars($peminjam['alamat']); ?></td>
                                    <td><?php echo htmlspecialchars($peminjam['status_member']); ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $peminjam['id']; ?>" class="btn btn-warning btn-sm text-white">Edit</a>
                                        <form class="form-hapus d-inline" method="post" action="hapus.php">
                                            <input type="hidden" name="id" value="<?php echo $peminjam['id']; ?>">
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