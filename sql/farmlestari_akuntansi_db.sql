-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2023 at 04:43 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `farmlestari_akuntansi_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `no_akun` varchar(15) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `jenis_akun` enum('aset','kewajiban','ekuitas','pendapatan','biaya') DEFAULT NULL,
  `saldo_awal` bigint(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`,`no_akun`, `nama`, `jenis_akun`, `saldo_awal`, `periode_id`,`created_at`, `updated_at`, `deleted_at`) VALUES
(1,'000', 'Ihtisar Laba Rugi', NULL, 0, 1, NULL, NULL, NULL),
(2,'101', 'Kas di Tangan', 'aset', 2000000000, 1, NULL, NULL, NULL),
(3,'102', 'Kas di Bank', 'aset', 2000000000, 1, NULL, NULL, NULL),
(4,'103', 'Bahan Baku Pakan', 'aset', 0, 1, NULL, NULL, NULL),
(5,'104', 'DOC', 'aset', 0, 1, NULL, NULL, NULL),
(6,'105', 'Pullet', 'aset', 0, 1, NULL, NULL, NULL),
(7,'106', 'Obat Produksi', 'aset', 0, 1, NULL, NULL, NULL),
(8,'107', 'Obat DOC/Pullet', 'aset', 0, 1, NULL, NULL, NULL),
(9,'108', 'Pakan DOC/Pullet', 'aset', 0, 1, NULL, NULL, NULL),
(10,'110', 'Peralatan', 'aset', 0, 1, NULL, NULL, NULL),
(11,'111', 'Akumulasi Penyusutan Peralatan', 'aset', 0, 1, NULL, NULL, NULL),
(12,'301', 'Modal UD Farm Lestari', 'ekuitas', 4000000000, 1, NULL, NULL, NULL),
(13,'401', 'Pendapatan Telur', 'pendapatan', 0, 1, NULL, NULL, NULL),
(14,'402', 'Pendapatan Ayam Afkir', 'pendapatan', 0, 1, NULL, NULL, NULL),
(15,'403', 'Pendapatan Zak dll', 'pendapatan', 0, 1, NULL, NULL, NULL),
(16,'501', 'Biaya Gaji', 'biaya', 0, 1, NULL, NULL, NULL),
(17,'502', 'Biaya Operasional', 'biaya', 0, NULL, 1, NULL, NULL),
(18,'503', 'Biaya Supporting Unit', 'biaya', 0, 1, NULL, NULL, NULL),
(19,'504', 'Biaya Konstruksi', 'biaya', 0, NULL, 1, NULL, NULL),
(20,'505', 'Biaya Office, Donasi, dll', 'biaya', 0, 1, NULL, NULL, NULL),
(21,'506', 'Biaya PLN dan Air', 'biaya', 0, 1, NULL, NULL, NULL),
(22,'507', 'Biaya Penyusutan Peralatan', 'biaya', 0, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `jenis` enum('umum','penutup') DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `transaksi_id` int(11) NOT NULL,
  `periode_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal`
--

INSERT INTO `jurnal` (`id`, `jenis`, `tanggal_transaksi`, `no_bukti`, `transaksi_id`, `periode_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'umum', '2023-01-01', NULL, 1, 1, NULL, NULL, NULL),
(2, 'umum', '2023-01-02', NULL, 2, 1, NULL, NULL, NULL),
(3, 'umum', '2023-01-10', NULL, 3, 1, NULL, NULL, NULL),
(4, 'umum', '2023-01-15', NULL, 4, 1, NULL, NULL, NULL),
(5, 'umum', '2023-01-30', NULL, 5, 1, NULL, NULL, NULL),
(6, 'umum', '2023-01-30', NULL, 6, 1, NULL, NULL, NULL),
(7, 'umum', '2023-02-10', NULL, 7, 1, NULL, NULL, NULL),
(8, 'umum', '2023-03-30', NULL, 8, 1, NULL, NULL, NULL),
(9, 'umum', '2023-04-20', NULL, 9, 1, NULL, NULL, NULL),
(10, 'umum', '2023-04-24', NULL, 10, 1, NULL, NULL, NULL),
(11, 'umum', '2023-04-24', NULL, 11, 1, NULL, NULL, NULL),
(12, 'penutup', '2023-04-30', NULL, 12, 1, NULL, NULL, NULL),
(13, 'penutup', '2023-04-30', NULL, 13, 1, NULL, NULL, NULL),
(14, 'penutup', '2023-04-30', NULL, 14, 1, NULL, NULL, NULL),
(15, 'penutup', '2023-04-30', NULL, 15, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal_has_akun`
--

CREATE TABLE `jurnal_has_akun` (
  `jurnal_id` int(11) NOT NULL,
  `akun_no_akun` varchar(15) NOT NULL,
  `no_urut` int(11) DEFAULT NULL,
  `nominal_debit` bigint(15) DEFAULT NULL,
  `nominal_kredit` bigint(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jurnal_has_akun`
--

INSERT INTO `jurnal_has_akun` (`jurnal_id`, `akun_id`, `no_urut`, `nominal_debit`, `nominal_kredit`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 1, NULL, 10800000, NULL, NULL, NULL),
(1, 4, 2, 10800000, NULL, NULL, NULL, NULL),
(2, 2, 1, 35210000, NULL, NULL, NULL, NULL),
(2, 13, 2, NULL, 35210000, NULL, NULL, NULL),
(3, 11, 2, NULL, 50000000, NULL, NULL, NULL),
(3, 22, 1, 50000000, NULL, NULL, NULL, NULL),
(4, 3, 1, NULL, 9000000, NULL, NULL, NULL),
(4, 5, 2, 9000000, NULL, NULL, NULL, NULL),
(5, 2, 1, 10000000, NULL, NULL, NULL, NULL),
(5, 15, 2, NULL, 10000000, NULL, NULL, NULL),
(6, 3, 1, NULL, 500000000, NULL, NULL, NULL),
(6, 10, 2, 500000000, NULL, NULL, NULL, NULL),
(7, 2, 1, NULL, 3000000, NULL, NULL, NULL),
(7, 7, 2, 3000000, NULL, NULL, NULL, NULL),
(8, 3, 1, NULL, 11500000, NULL, NULL, NULL),
(8, 16, 2, 11500000, NULL, NULL, NULL, NULL),
(9, 3, 1, 6700000, NULL, NULL, NULL, NULL),
(9, 5, 2, NULL, 9000000, NULL, NULL, NULL),
(9, 19, 3, 2300000, NULL, NULL, NULL, NULL),
(10, 3, 1, 15100000, NULL, NULL, NULL, NULL),
(10, 14, 2, NULL, 15100000, NULL, NULL, NULL),
(11, 3, 1, 20000000, NULL, NULL, NULL, NULL),
(11, 13, 2, NULL, 20000000, NULL, NULL, NULL),
(12, 1, 4, NULL, 80310000, NULL, NULL, NULL),
(12, 13, 1, 55210000, NULL, NULL, NULL, NULL),
(12, 14, 2, 15100000, NULL, NULL, NULL, NULL),
(12, 15, 3, 10000000, NULL, NULL, NULL, NULL),
(13, 1, 1, 63800000, NULL, NULL, NULL, NULL),
(13, 16, 2, NULL, 11500000, NULL, NULL, NULL),
(13, 17, 3, NULL, NULL, NULL, NULL, NULL),
(13, 18, 4, NULL, NULL, NULL, NULL, NULL),
(13, 19, 5, NULL, 2300000, NULL, NULL, NULL),
(13, 20, 6, NULL, NULL, NULL, NULL, NULL),
(13, 21, 7, NULL, NULL, NULL, NULL, NULL),
(13, 22, 8, NULL, 50000000, NULL, NULL, NULL),
(14, 1, 1, 16510000, NULL, NULL, NULL, NULL),
(14, 12, 2, NULL, 16510000, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `tanggal_awal`, `tanggal_akhir`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2023-01-01', '2023-04-30', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `keterangan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Membayar hutang bahan baku untuk pakan ayam sebesar Rp. 10.800.000,- secara transfer.', NULL, NULL, NULL),
(2, 'Menerima pembayaran telur dari pelanggan sebesar Rp. 35.210.000,- secara tunai.', NULL, NULL, NULL),
(3, 'Biaya penyusutan peralatan sebesar Rp. 50.000.000,00', NULL, NULL, NULL),
(4, 'Membeli DOC sebesar Rp. 9.000.000,- secara transfer.', NULL, NULL, NULL),
(5, 'Mendapatkan Rp. 10.000.000,00 dari penjualan zak secara tunai.', NULL, NULL, NULL),
(6, 'Membeli mesin produksi baru Rp. 500.000.000,- secara transfer. Peralatan ini diperkirakan dapat digunakan selama 5 tahun.', NULL, NULL, NULL),
(7, 'Membeli obat produksi ke supplier Rp. 3.000.000,- secara tunai.', NULL, NULL, NULL),
(8, 'Membayarkan gaji karyawan sebesar Rp. 11.500.000,- secara transfer.', NULL, NULL, NULL),
(9, 'Ternyata terjadi kesalahan penjurnalan transaksi pada tanggal 15 Januari 2023. Seharusnya yang benar adalah membayar biaya konstruksi Rp. 2.300.000,- secara transfer.', NULL, NULL, NULL),
(10, 'Menerima pembayaran ayam afkir dari pelanggan sebesar Rp. 15.100.000,- secara transfer.', NULL, NULL, NULL),
(11, 'Menerima pembayaran telur dari pelanggan sebesar Rp. 20.000.000,- secara transfer.', NULL, NULL, NULL),
(12, 'Penutupan Step 1 - Pendapatan', NULL, NULL, NULL),
(13, 'Penutupan Step 2 - Biaya', NULL, NULL, NULL),
(14, 'Penutupan Step 3 - Modal & Laba Rugi', NULL, NULL, NULL),
(15, 'Penutupan Step 4 - Modal & Prive', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`no_akun`);

--
-- Indexes for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jurnal_transaksi1_idx` (`transaksi_id`),
  ADD KEY `fk_jurnal_periode1_idx` (`periode_id`);

--
-- Indexes for table `jurnal_has_akun`
--
ALTER TABLE `jurnal_has_akun`
  ADD PRIMARY KEY (`jurnal_id`,`akun_no_akun`),
  ADD KEY `fk_jurnal_has_akun_akun1_idx` (`akun_no_akun`),
  ADD KEY `fk_jurnal_has_akun_jurnal1_idx` (`jurnal_id`);

--
-- Indexes for table `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jurnal`
--
ALTER TABLE `jurnal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `periode`
--
ALTER TABLE `periode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `fk_jurnal_periode1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jurnal_transaksi1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jurnal_has_akun`
--
ALTER TABLE `jurnal_has_akun`
  ADD CONSTRAINT `fk_jurnal_has_akun_akun1` FOREIGN KEY (`akun_no_akun`) REFERENCES `akun` (`no_akun`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jurnal_has_akun_jurnal1` FOREIGN KEY (`jurnal_id`) REFERENCES `jurnal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
