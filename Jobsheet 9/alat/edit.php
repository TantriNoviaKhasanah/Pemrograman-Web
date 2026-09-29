<?php
$page_title = "Edit Alat";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM alat WHERE id = :id");
$stmt->execute(['id' => $id]);
$alat = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$alat) {
    header('Location: list.php');
    exit;
}

$kategoriList = ['Gitar Akustik', 'Gitar Elektrik', 'Perkusi', 'Keyboard', 'Perangkat Audio'];
$statusList = ['Tersedia', 'Dipinjam', 'Maintenance'];
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#5c1030;">Formulir Edit Unit Alat</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
                <?php endif; ?>

                <form method="post" action="proses_edit.php">
                    <input type="hidden" name="id" value="<?php echo $alat['id']; ?>">
                    <div class="mb-3">
                        <label for="kode_alat" class="form-label fw-semibold">Kode Alat</label>
                        <input type="text" class="form-control" id="kode_alat" name="kode_alat" value="<?php echo htmlspecialchars($alat['kode_alat']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_alat" class="form-label fw-semibold">Nama Alat</label>
                        <input type="text" class="form-control" id="nama_alat" name="nama_alat" value="<?php echo htmlspecialchars($alat['nama_alat']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-semibold">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <?php foreach ($kategoriList as $opsi): ?>
                            <option value="<?php echo $opsi; ?>" <?php echo $alat['kategori'] === $opsi ? 'selected' : ''; ?>><?php echo $opsi; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tarif" class="form-label fw-semibold">Tarif / Jam (Rp)</label>
                        <input type="number" class="form-control" id="tarif" name="tarif" value="<?php echo htmlspecialchars($alat['tarif']); ?>" min="1000" step="500" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status Unit</label>
                        <div>
                            <?php foreach ($statusList as $opsi): ?>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="status_<?php echo strtolower($opsi); ?>" name="status" value="<?php echo $opsi; ?>" <?php echo $alat['status'] === $opsi ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="status_<?php echo strtolower($opsi); ?>"><?php echo $opsi; ?></label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn" style="background-color:#5c1030; color:#fff;">Update</button>
                    <a href="list.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>