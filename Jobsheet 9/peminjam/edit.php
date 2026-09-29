<?php
$page_title = "Edit Peminjam";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM peminjam WHERE id = :id");
$stmt->execute(['id' => $id]);
$peminjam = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$peminjam) {
    header('Location: list.php');
    exit;
}

$statusList = ['Regular', 'Member VIP'];
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#5c1030;">Formulir Edit Peminjam</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
                <?php endif; ?>

                <form method="post" action="proses_edit.php">
                    <input type="hidden" name="id" value="<?php echo $peminjam['id']; ?>">
                    <div class="mb-3">
                        <label for="kode_peminjam" class="form-label fw-semibold">Kode Peminjam</label>
                        <input type="text" class="form-control" id="kode_peminjam" name="kode_peminjam" value="<?php echo htmlspecialchars($peminjam['kode_peminjam']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_peminjam" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" value="<?php echo htmlspecialchars($peminjam['nama_peminjam']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label fw-semibold">No. Telepon / WhatsApp</label>
                        <input type="tel" class="form-control" id="no_hp" name="no_hp" value="<?php echo htmlspecialchars($peminjam['no_hp']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo htmlspecialchars($peminjam['alamat']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status_member" class="form-label fw-semibold">Status Member</label>
                        <select class="form-select" id="status_member" name="status_member" required>
                            <?php foreach ($statusList as $opsi): ?>
                            <option value="<?php echo $opsi; ?>" <?php echo $peminjam['status_member'] === $opsi ? 'selected' : ''; ?>><?php echo $opsi; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn" style="background-color:#5c1030; color:#fff;">Update</button>
                    <a href="list.php" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>