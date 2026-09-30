<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$id = $_POST['id'] ?? null;
$kodePeminjam = trim($_POST['kode_peminjam'] ?? '');
$namaPeminjam = trim($_POST['nama_peminjam'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$statusMember = trim($_POST['status_member'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($kodePeminjam === '') {
    $errors[] = "Kode peminjam wajib diisi.";
}
if ($namaPeminjam === '') {
    $errors[] = "Nama peminjam wajib diisi.";
}
if ($noHp === '') {
    $errors[] = "No. WhatsApp wajib diisi.";
}
if ($alamat === '') {
    $errors[] = "Alamat wajib diisi.";
}
if (!in_array($statusMember, ['Regular', 'Member VIP'], true)) {
    $errors[] = "Status member wajib dipilih.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE peminjam SET kode_peminjam = :kode_peminjam, nama_peminjam = :nama_peminjam,
     no_hp = :no_hp, alamat = :alamat, status_member = :status_member WHERE id = :id"
);
$stmt->execute([
    'kode_peminjam' => $kodePeminjam,
    'nama_peminjam' => $namaPeminjam,
    'no_hp' => $noHp,
    'alamat' => $alamat,
    'status_member' => $statusMember,
    'id' => $id,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Peminjam berhasil diperbarui.'];
header('Location: list.php');
exit;