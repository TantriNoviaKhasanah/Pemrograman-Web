CREATE TABLE IF NOT EXISTS alat (
    id SERIAL PRIMARY KEY,
    kode_alat VARCHAR(50) NOT NULL UNIQUE,
    nama_alat VARCHAR(255) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    tarif INTEGER NOT NULL,
    status VARCHAR(20) NOT NULL
);

CREATE TABLE IF NOT EXISTS peminjam (
    id SERIAL PRIMARY KEY,
    kode_peminjam VARCHAR(50) NOT NULL UNIQUE,
    nama_peminjam VARCHAR(255) NOT NULL,
    no_hp VARCHAR(30) NOT NULL,
    alamat VARCHAR(255) NOT NULL,
    status_member VARCHAR(20) NOT NULL
);