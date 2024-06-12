-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Jun 2024 pada 07.14
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengajuan_pembelian_barang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_login`
--

CREATE TABLE `db_login` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `db_login`
--

INSERT INTO `db_login` (`id`, `username`, `password`, `role`) VALUES
(1, 'officer', 'f611cd1f8f91638960d2d20b29f5c9ba', 'officer'),
(2, 'manager', '0795151defba7a4b5dfa89170de46277', 'manager'),
(3, 'finance', 'b9c9b331a8a5007cb2b766c6cd293372', 'finance');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_officer`
--

CREATE TABLE `db_officer` (
  `id` int(11) NOT NULL,
  `image` varchar(20) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_satuan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Pending',
  `keterangan` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `db_login`
--
ALTER TABLE `db_login`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `db_officer`
--
ALTER TABLE `db_officer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `db_login`
--
ALTER TABLE `db_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `db_officer`
--
ALTER TABLE `db_officer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
