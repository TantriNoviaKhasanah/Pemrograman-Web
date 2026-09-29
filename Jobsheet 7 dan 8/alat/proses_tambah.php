<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$kodeAlat = trim($_POST['kode_alat'] ?? '');
$namaAlat = trim($_POST['nama_alat'] ?? '');
$kategori = trim($_POST['kategori'] ?? '');
$tarif = $_POST['tarif'] ?? '';
$status = trim($_POST['status'] ?? '');

$kategoriValid = ['Gitar Akustik', 'Gitar Elektrik', 'Perkusi', 'Keyboard', 'Perangkat Audio'];
$statusValid = ['Tersedia', 'Dipinjam', 'Maintenance'];

$errors = [];
if ($kodeAlat === '') {
    $errors[] = "Kode alat wajib diisi.";
}
if ($namaAlat === '') {
    $errors[] = "Nama alat wajib diisi.";
}
if (!in_array($kategori, $kategoriValid, true)) {
    $errors[] = "Kategori wajib dipilih.";
}
if (!is_numeric($tarif) || $tarif < 1000) {
    $errors[] = "Tarif minimal Rp 1.000.";
}
if (!in_array($status, $statusValid, true)) {
    $errors[] = "Status unit wajib dipilih.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO alat (kode_alat, nama_alat, kategori, tarif, status)
     VALUES (:kode_alat, :nama_alat, :kategori, :tarif, :status)
     RETURNING id"
);
$stmt->execute([
    'kode_alat' => $kodeAlat,
    'nama_alat' => $namaAlat,
    'kategori' => $kategori,
    'tarif' => (int) $tarif,
    'status' => $status,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Alat musik berhasil ditambahkan.'];
header('Location: list.php');
exit;