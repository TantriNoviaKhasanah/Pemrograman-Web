<?php
$page_title = "Tambah Peminjam";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section class="card shadow-sm mb-4">
            <div class="card-body">
                <h2 class="card-title mb-3" style="color:#5c1030;">Formulir Tambah Peminjam</h2>

                <?php if ($flash): ?>
                    <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo htmlspecialchars($flash['pesan']); ?></p>
                <?php endif; ?>

                <form id="form-tambah" method="post" action="proses_tambah.php">
                    <div class="mb-3">
                        <label for="kode_peminjam" class="form-label fw-semibold">Kode Peminjam</label>
                        <input type="text" class="form-control" id="kode_peminjam" name="kode_peminjam" placeholder="Contoh: PJ005" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_peminjam" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" placeholder="Contoh: Siti Aminah" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_hp" class="form-label fw-semibold">No. Telepon / WhatsApp</label>
                        <input type="tel" class="form-control" id="no_hp" name="no_hp" placeholder="Contoh: 08123456789" required>
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label fw-semibold">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat peminjam" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status_member" class="form-label fw-semibold">Status Member</label>
                        <select class="form-select" id="status_member" name="status_member" required>
                            <option value="">-- Pilih Status Member --</option>
                            <option value="Regular">Regular</option>
                            <option value="Member VIP">Member VIP</option>
                        </select>
                    </div>
                    <button type="submit" class="btn" style="background-color:#5c1030; color:#fff;">Simpan Data</button>
                    <button type="reset" class="btn btn-secondary">Batal</button>
                </form>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>