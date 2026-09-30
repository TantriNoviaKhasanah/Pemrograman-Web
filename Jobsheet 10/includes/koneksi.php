<?php

$databaseUrl = getenv('DATABASE_URL');

if (!$databaseUrl) {
    die("DATABASE_URL tidak ditemukan");
}

$url = parse_url($databaseUrl);

$host = $url['host'];
$port = $url['port'];
$db   = ltrim($url['path'], '/');
$user = $url['user'];
$pass = $url['pass'];

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db;sslmode=require",
        $user,
        $pass
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}