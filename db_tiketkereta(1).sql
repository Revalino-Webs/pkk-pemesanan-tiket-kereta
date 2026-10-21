-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 21, 2026 at 02:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tiketkereta`
--

-- --------------------------------------------------------

--
-- Table structure for table `biodata`
--

CREATE TABLE `biodata` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `kontak` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `biodata`
--

INSERT INTO `biodata` (`id`, `nama`, `nik`, `tanggal_lahir`, `kontak`) VALUES
(2, 'valino sitorang', '99220088845', '2022-11-16', ''),
(3, 'valino sitorang', '99220088845', '2026-05-14', ''),
(4, 'valino sitorang', '99220088845', '2026-05-15', '082593800984'),
(5, 'dean situpang', '99768976540', '2018-08-10', '08226956213'),
(6, 'fadli', '98986676980', '2008-06-19', '089835679899'),
(7, 'repal', '09080777607', '2019-07-13', ''),
(8, 'dinda', '09080777607', '2008-06-13', ''),
(9, 'Revalino', '0988896780', '2019-08-09', ''),
(10, 'Valino', '08993789544', '2010-11-18', ''),
(11, 'Ino', '56738945610', '2006-05-09', ''),
(12, 'repla', '12345678910', '2007-05-20', '');

-- --------------------------------------------------------

--
-- Table structure for table `harga_tiket`
--

CREATE TABLE `harga_tiket` (
  `id_hargatiket` int(11) NOT NULL,
  `id_stasiunasal` int(11) NOT NULL,
  `id_stasiuntujuan` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harga_tiket`
--

INSERT INTO `harga_tiket` (`id_hargatiket`, `id_stasiunasal`, `id_stasiuntujuan`, `harga`) VALUES
(1, 4, 1, 100000),
(2, 5, 2, 75000);

-- --------------------------------------------------------

--
-- Table structure for table `kereta`
--

CREATE TABLE `kereta` (
  `id` int(11) NOT NULL,
  `nama_kereta` varchar(100) NOT NULL,
  `kursi_kereta` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kereta`
--

INSERT INTO `kereta` (`id`, `nama_kereta`, `kursi_kereta`) VALUES
(2, 'harina', '2');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `total_pembayaran` decimal(10,2) DEFAULT NULL,
  `tanggal_pembayaran` timestamp NOT NULL DEFAULT current_timestamp(),
  `nama_pemesan` varchar(255) DEFAULT NULL,
  `kursi_dipilih` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `total_pembayaran`, `tanggal_pembayaran`, `nama_pemesan`, `kursi_dipilih`, `metode_pembayaran`) VALUES
(16, 1000000.00, '2026-05-16 13:31:16', 'Pengguna Tidak Diketahui', '8', 'BCA'),
(17, 900000.00, '2026-05-16 13:32:56', 'Pengguna Tidak Diketahui', '14', 'Mandiri'),
(18, 150000.00, '2026-05-16 13:39:34', 'Pengguna Tidak Diketahui', '20', 'Mandiri'),
(19, 750000.00, '2026-05-16 13:42:08', 'admin', '7', 'BCA'),
(20, 450000.00, '2026-05-16 13:43:05', 'admin', '9', 'Mandiri');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_tiket`
--

CREATE TABLE `pesanan_tiket` (
  `id` int(11) NOT NULL,
  `stasiun_asal` varchar(100) NOT NULL,
  `stasiun_tujuan` varchar(100) NOT NULL,
  `jumlah_penumpang` int(11) NOT NULL,
  `kelas_kereta` varchar(100) NOT NULL,
  `tanggal_berangkat` date NOT NULL,
  `nama_kereta` varchar(100) DEFAULT NULL,
  `jam_keberangkatan` varchar(50) DEFAULT NULL,
  `kursi_penumpang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesanan_tiket`
--

INSERT INTO `pesanan_tiket` (`id`, `stasiun_asal`, `stasiun_tujuan`, `jumlah_penumpang`, `kelas_kereta`, `tanggal_berangkat`, `nama_kereta`, `jam_keberangkatan`, `kursi_penumpang`) VALUES
(40, 'Yogyakarta', 'Bandung', 1, 'Ekonomi', '2026-05-12', 'Ambarawa Express', '09:00', '0'),
(51, 'Yogyakarta', 'Bandung', 2, 'Eksekutif', '2026-05-16', 'Ambarawa Express', '06:00', '8'),
(52, 'Yogyakarta', 'Bandung', 2, 'Eksekutif', '2026-05-16', 'Ambarawa Express', '06:00', '8'),
(53, 'Yogyakarta', 'Bandung', 3, 'Bisnis', '2026-05-20', 'Gajayana', '18:00', '14, 15, 16'),
(54, 'Surabaya', 'Semarang', 1, 'Ekonomi', '2008-06-17', 'Ambarawa Express', '12:00', '20'),
(55, 'Yogyakarta', 'Bandung', 5, 'Ekonomi', '2026-05-06', 'Ambarawa Express', '18:00', '7'),
(56, 'Surabaya', 'Bandung', 3, 'Ekonomi', '2026-05-21', 'Ambarawa Express', '18:00', '9'),
(57, 'Yogyakarta', 'Bandung', 2, 'Bisnis', '2026-05-27', 'Ambarawa Express', '15:00', '3');

-- --------------------------------------------------------

--
-- Table structure for table `stasiun_asal`
--

CREATE TABLE `stasiun_asal` (
  `id_stasiunasal` int(11) NOT NULL,
  `stasiun_asal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stasiun_asal`
--

INSERT INTO `stasiun_asal` (`id_stasiunasal`, `stasiun_asal`) VALUES
(4, 'Yogyakarta'),
(5, 'Surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `stasiun_tujuan`
--

CREATE TABLE `stasiun_tujuan` (
  `id_stasiuntujuan` int(11) NOT NULL,
  `stasiun_tujuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stasiun_tujuan`
--

INSERT INTO `stasiun_tujuan` (`id_stasiuntujuan`, `stasiun_tujuan`) VALUES
(1, 'Bandung'),
(2, 'Semarang');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `pass`, `birth`) VALUES
(12, 'admin', 'admin00@gmail.com', 'admin', '2026-05-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `birth` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `biodata`
--
ALTER TABLE `biodata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `harga_tiket`
--
ALTER TABLE `harga_tiket`
  ADD PRIMARY KEY (`id_hargatiket`);

--
-- Indexes for table `kereta`
--
ALTER TABLE `kereta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan_tiket`
--
ALTER TABLE `pesanan_tiket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stasiun_asal`
--
ALTER TABLE `stasiun_asal`
  ADD PRIMARY KEY (`id_stasiunasal`);

--
-- Indexes for table `stasiun_tujuan`
--
ALTER TABLE `stasiun_tujuan`
  ADD PRIMARY KEY (`id_stasiuntujuan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `biodata`
--
ALTER TABLE `biodata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `harga_tiket`
--
ALTER TABLE `harga_tiket`
  MODIFY `id_hargatiket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kereta`
--
ALTER TABLE `kereta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pesanan_tiket`
--
ALTER TABLE `pesanan_tiket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `stasiun_asal`
--
ALTER TABLE `stasiun_asal`
  MODIFY `id_stasiunasal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stasiun_tujuan`
--
ALTER TABLE `stasiun_tujuan`
  MODIFY `id_stasiuntujuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
