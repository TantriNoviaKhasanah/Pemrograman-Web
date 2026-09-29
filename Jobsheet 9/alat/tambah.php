<?php
$page_title = "Tambah Alat";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#5c1030;">Formulir Tambah Unit Alat</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
                <?php endif; ?>

                <form id="form-tambah" method="post" action="proses_tambah.php">
                    <div class="mb-3">
                        <label for="kode_alat" class="form-label fw-semibold">Kode Alat</label>
                        <input type="text" class="form-control" id="kode_alat" name="kode_alat" placeholder="Contoh: AM011" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_alat" class="form-label fw-semibold">Nama Alat</label>
                        <input type="text" class="form-control" id="nama_alat" name="nama_alat" placeholder="Contoh: Gitar Bass Ibanez GSR200" required>
                    </div>
                    <div class="mb-3">
                        <label for="kategori" class="form-label fw-semibold">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori" required>
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Gitar Akustik">Gitar Akustik</option>
                            <option value="Gitar Elektrik">Gitar Elektrik</option>
                            <option value="Perkusi">Perkusi</option>
                            <option value="Keyboard">Keyboard</option>
                            <option value="Perangkat Audio">Perangkat Audio</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tarif" class="form-label fw-semibold">Tarif / Jam (Rp)</label>
                        <input type="number" class="form-control" id="tarif" name="tarif" placeholder="Contoh: 20000" min="1000" step="500" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status Unit</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="tersedia" name="status" value="Tersedia" required>
                                <label class="form-check-label" for="tersedia">Tersedia</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="dipinjam" name="status" value="Dipinjam">
                                <label class="form-check-label" for="dipinjam">Dipinjam</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="maintenance" name="status" value="Maintenance">
                                <label class="form-check-label" for="maintenance">Maintenance</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn" style="background-color:#5c1030; color:#fff;">Simpan Data</button>
                    <button type="reset" class="btn btn-secondary">Batal</button>
                </form>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>