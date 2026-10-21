<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$kodePeminjam = trim($_POST['kode_peminjam'] ?? '');
$namaPeminjam = trim($_POST['nama_peminjam'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$statusMember = trim($_POST['status_member'] ?? '');

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
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO peminjam (kode_peminjam, nama_peminjam, no_hp, alamat, status_member)
     VALUES (:kode_peminjam, :nama_peminjam, :no_hp, :alamat, :status_member)
     RETURNING id"
);
$stmt->execute([
    'kode_peminjam' => $kodePeminjam,
    'nama_peminjam' => $namaPeminjam,
    'no_hp' => $noHp,
    'alamat' => $alamat,
    'status_member' => $statusMember,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Peminjam berhasil ditambahkan.'];
header('Location: list.php');
exit;