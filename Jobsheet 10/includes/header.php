<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$sudahLogin = isset($_SESSION['user_id']);

$__jobsheetRoot = dirname(__DIR__);
$__scriptDir = dirname($_SERVER['SCRIPT_FILENAME']);
$__rel = ltrim(str_replace('\\', '/', substr($__scriptDir, strlen($__jobsheetRoot))), '/');
$base = $__rel === '' ? '' : str_repeat('../', substr_count($__rel, '/') + 1);

$__halaman = ($__rel === '' ? '' : $__rel . '/') . basename($_SERVER['SCRIPT_FILENAME']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Peminjaman Alat Musik Studio<?php echo isset($page_title) ? ' | ' . $page_title : ''; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
</head>
<body class="d-flex flex-column min-vh-100" style="background-color: #faf3f6;">
    <header class="navbar navbar-expand-lg navbar-dark" style="background-color:#5c1030;">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="<?php echo $base; ?>index.php">
                Sistem Peminjaman Alat Musik Studio
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu"
                aria-controls="navMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <nav class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link<?php echo $__halaman === 'index.php' ? ' active' : ''; ?>" href="<?php echo $base; ?>index.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $__halaman === 'alat/list.php' ? ' active' : ''; ?>" href="<?php echo $base; ?>alat/list.php">Data Alat</a>
                    </li>
                    <?php if ($sudahLogin): ?>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $__halaman === 'alat/tambah.php' ? ' active' : ''; ?>" href="<?php echo $base; ?>alat/tambah.php">Tambah Alat</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $__halaman === 'peminjam/list.php' ? ' active' : ''; ?>" href="<?php echo $base; ?>peminjam/list.php">Data Peminjam</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?php echo $__halaman === 'peminjam/tambah.php' ? ' active' : ''; ?>" href="<?php echo $base; ?>peminjam/tambah.php">Tambah Peminjam</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <ul class="navbar-nav">
                    <?php if ($sudahLogin): ?>
                    <li class="nav-item d-flex align-items-center me-2">
                        <span class="text-white small">Halo, <?php echo htmlspecialchars($_SESSION['nama']); ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>auth/logout.php">Logout</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>auth/login.php">Login</a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container my-4">