-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 01 Des 2025 pada 06.03
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir_restoran`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_order`
--

CREATE TABLE `detail_order` (
  `id_detail_order` int NOT NULL,
  `id_order` varchar(255) NOT NULL,
  `id_masakan` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `status_detail_order` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_order`
--

INSERT INTO `detail_order` (`id_detail_order`, `id_order`, `id_masakan`, `keterangan`, `status_detail_order`) VALUES
(6, '1', '2', 'kurang sambal', 'selesai'),
(7, '2', '1', 'ini kurang pedas', 'proses'),
(8, '3', '7', 'Tambahkan cabai level 4', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `level`
--

CREATE TABLE `level` (
  `id_level` int NOT NULL,
  `nama_level` varchar(255) NOT NULL,
  `deskripsi_level` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `level`
--

INSERT INTO `level` (`id_level`, `nama_level`, `deskripsi_level`) VALUES
(1, 'Owner', 'Pemilik restoran dengan akses penuh'),
(2, 'Admin', 'Pengelola sistem & manajemen user'),
(3, 'Kasir', 'Bertugas mencatat transaksi pembayaran'),
(4, 'Waiter', 'Melayani pelanggan dan input order'),
(5, 'Pelanggan', 'User pelanggan untuk melakukan pemesanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `masakan`
--

CREATE TABLE `masakan` (
  `id_masakan` int NOT NULL,
  `nama_masakan` varchar(255) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `status_masakan` varchar(255) NOT NULL,
  `gambar_masakan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `deskripsi_makanan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `masakan`
--

INSERT INTO `masakan` (`id_masakan`, `nama_masakan`, `harga`, `status_masakan`, `gambar_masakan`, `deskripsi_makanan`) VALUES
(1, 'Nasi Goreng Spesial', 25000.00, 'tersedia', '1757994453_OIP (16).jpg', 'Nasi goreng dengan telur, ayam, dan sayuran.'),
(2, 'Mie Ayam Bakso', 20000.00, 'tersedia', '1757994402_mie-ayam-goyang-lidah.webp', 'Mie ayam gurih dengan tambahan bakso sapi.'),
(3, 'Sate Ayam', 30000.00, 'tersedia', '1757994321_OIP (15).jpg', '10 tusuk sate ayam panggang harum, disajikan dengan bumbu kacang gurih.'),
(4, 'Ayam Geprek', 25000.00, 'tersedia', '1757994697_OIP (17).jpg', 'Ayam goreng geprek sambal pedas, di sajikan dengan sayuran'),
(6, 'Ikan Bakar', 12000.00, 'tersedia', '68c8df07b7db1.jpg', 'Ikan bakar bumbu kecap pedas manis dan di sajikan dengan sayuran '),
(7, 'Bakso Urat', 17000.00, 'tersedia', '68c8df4c7aa53.jpg', 'Bakso urat dengan kuah gurih, dengan isi bakso kecil kecil'),
(8, 'Sop Buntut', 18000.00, 'tersedia', '68c8dfbb27531.jpg', 'Sop buntut sapi dengan kuah gurih dan sayuran segar.'),
(9, 'Rendang Padang', 25000.00, 'tersedia', '68c8dfed072c1.jpg', 'Daging sapi empuk dimasak dengan rempah khas Minang.'),
(10, 'Tahu Crispy', 10000.00, 'tersedia', '68c8e02a6d708.jpg', 'Tahu goreng renyah dengan sambal kecap.'),
(11, 'Martabak Telur', 23000.00, 'tersedia', '68c8e0690b967.jpg', 'Martabak isi daging cincang, daun bawang, dan telur.');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id_order` int NOT NULL,
  `no_meja` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tanggal` date NOT NULL,
  `id_user` int NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status_order` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id_order`, `no_meja`, `tanggal`, `id_user`, `keterangan`, `status_order`) VALUES
(1, 'A1', '2025-09-16', 3, 'Tanpa sambal', 'pending'),
(2, 'A2', '2025-09-16', 4, 'kurang sambel', 'proses'),
(3, 'A3', '2025-09-16', 3, 'Tambahkan Kecap ', 'selesai'),
(10, 'A4', '2025-09-11', 3, 'kurang sambal', 'proses');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int NOT NULL,
  `id_user` int NOT NULL,
  `id_masakan` int NOT NULL,
  `jumlah` int NOT NULL DEFAULT '1',
  `status_pesanan` enum('Menunggu Konfirmasi','Diproses','Selesai','Dibatalkan') DEFAULT 'Menunggu Konfirmasi',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int NOT NULL,
  `id_user` int NOT NULL,
  `id_order` int NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_harga` decimal(12,2) NOT NULL,
  `status_transaksi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_order`, `tanggal`, `total_harga`, `status_transaksi`) VALUES
(12, 0, 1, '2025-09-22 00:00:00', 25000.00, 'pending'),
(13, 0, 2, '2025-09-22 00:00:00', 28000.00, 'lunas'),
(14, 0, 3, '2025-09-21 00:00:00', 22442.00, 'batal'),
(15, 0, 10, '2025-09-16 00:00:00', 35456.00, 'lunas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Owner','Admin','Kasir','Waiter','Pelanggan') NOT NULL DEFAULT 'Pelanggan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `username`, `password`, `role`) VALUES
(2, 'Rusdi', '$2y$10$t9tubjiuLHZSx6S/wONu8.Fq/KDfDzu1MHf7eJSCsULyv1B/b.6UG', 'Admin'),
(3, 'Musti', '$2y$10$.bSNsyLhmlNycMynLz6RjObjUxgcawcY25.HQRlGPCEicXDl78e1G', 'Kasir'),
(4, 'Ordan', '$2y$10$yhRnGnPHVkeyWtA0Rb6hr.o12BiB5Di0F0uKCWEsH8hM4iYqRcy/K', 'Waiter'),
(5, 'Mas Memet', '$2y$10$/i/9TNBNZBoz/sY8xELvTuIdU26w5Y2TE4ExZzBt/4A3L0NxPyFp2', 'Pelanggan'),
(6, 'Zuyck', '$2y$10$vY//MZqL/2y1pyfBQvX7/Oy2UVd2q8lFXFY8ByFye5rB3ycV1dIKe', 'Owner'),
(7, 'admin', '$2y$10$pK00bD4fJ9NslC/gk2HQseyoTd0dgimNhazX6VXJQZ4Q4kijbKyLm', 'Admin'),
(9, 'sfbksj', '$2y$10$4C8Hb0MKW3VDfX/d8YasaerS/goBwSlLVQbhStiSwZtaMW2H0z21i', 'Kasir'),
(11, 'zuyck1', '$2y$10$9iSG15yGJl/q4KMvnMiWm.djwZgo5JTPuRJ8dMOI/0WxIzBsfX94W', 'Admin'),
(12, 'wkwkwk', '$2y$10$aTwzubz.KsvaQwxDx3XriOX75xHMKxguMoeQMkWo/pSuMOTiwth82', 'Admin'),
(13, '123456', '$2y$10$GnesZCn0puKtG7R/wRrMd.Txhg9QUJO5LMvEhLqkN5sgTKBwXnOYW', 'Waiter'),
(14, '12345678', '$2y$10$tR08hElvSBLkw.HhFOiNOe1l0QE9TCebUGAx6Vf0hCoEIWL54LmrG', 'Kasir'),
(15, '12345678d', '$2y$10$N.xuqPD5F0mh7fBw8QxiPuMGvBFexQS59D.hZ2iJ3TYmjOvI4x51e', 'Kasir'),
(16, '12345678222', '$2y$10$LeGZ.07LFtGq1TWCsAjhyOukF.HAFg6ILKMiWiEG/CWoOYzjOcMzC', 'Waiter'),
(17, '1234567890', '$2y$10$znpra8PxQLGr3Ce7jMPGleSRgA.YQaJ9B.EbY/4TxSwBahSlsGfV6', 'Admin'),
(18, 'au', '$2y$10$qnVOBLPgcHBiFVRVv2zDt.hrQztpimrq4.Dtr8kIgXwq2ZkVngmeK', 'Admin'),
(20, 'auadwfwwefefwedwdwdwddwdwd', '$2y$10$eU9uIMT0Cjxy7gpaKhH0fuY1F2nI76p8JBwh0779Mrxo97MJ66jvO', 'Admin'),
(21, 'masuk', '$2y$10$c29OBHZ0VY23E6mbMuB.Nudtpg5Tg.hOuxrK.bp1AIyL43W3Nrdoi', 'Kasir');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  ADD PRIMARY KEY (`id_detail_order`);

--
-- Indeks untuk tabel `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indeks untuk tabel `masakan`
--
ALTER TABLE `masakan`
  ADD PRIMARY KEY (`id_masakan`);

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_masakan` (`id_masakan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_order`
--
ALTER TABLE `detail_order`
  MODIFY `id_detail_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `masakan`
--
ALTER TABLE `masakan`
  MODIFY `id_masakan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_masakan`) REFERENCES `masakan` (`id_masakan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
