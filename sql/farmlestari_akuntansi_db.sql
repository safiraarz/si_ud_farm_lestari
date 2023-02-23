-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2023 at 09:03 AM
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
  `deleteed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`no_akun`, `nama`, `jenis_akun`, `saldo_awal`, `created_at`, `updated_at`, `deleteed_at`) VALUES
('000', 'Ihtisar Labar Rugi', NULL, 0, NULL, NULL, NULL),
('101', 'Kas di Tangan', 'aset', 2000000000, NULL, NULL, NULL),
('102', 'Kas di Bank', 'aset', 2000000000, NULL, NULL, NULL),
('103', 'Piutang Usaha', 'aset', 0, NULL, NULL, NULL),
('104', 'Bahan Baku Pakan', 'aset', 15000000, NULL, NULL, NULL),
('105', 'DOC', 'aset', 0, NULL, NULL, NULL),
('106', 'Pullet', 'aset', 0, NULL, NULL, NULL),
('107', 'Obat Produksi', 'aset', 0, NULL, NULL, NULL),
('108', 'Obat DOC/Pullet', 'aset', 0, NULL, NULL, NULL),
('109', 'Pakan DOC/Pullet', 'aset', 0, NULL, NULL, NULL),
('110', 'Peralatan', 'aset', 0, NULL, NULL, NULL),
('111', 'Akumulasi Penyusutan Peralatan', 'aset', 0, NULL, NULL, NULL),
('201', 'Hutang Bahan Baku Pakan', 'kewajiban', 0, NULL, NULL, NULL),
('202', 'Hutang DOC', 'kewajiban', 0, NULL, NULL, NULL),
('203', 'Hutang Pullet', 'kewajiban', 0, NULL, NULL, NULL),
('301', 'Modal UD Farm Lestari', 'ekuitas', 4000000000, NULL, NULL, NULL),
('302', 'Prive', 'ekuitas', 0, NULL, NULL, NULL),
('401', 'Pendapatan Telur', 'pendapatan', 0, NULL, NULL, NULL),
('402', 'Pendapatan Ayam Afkir', 'pendapatan', 0, NULL, NULL, NULL),
('403', 'Pendapatan Zak dll', 'pendapatan', 0, NULL, NULL, NULL),
('501', 'Biaya Gaji', 'biaya', 0, NULL, NULL, NULL),
('502', 'Biaya Operasional', 'biaya', 0, NULL, NULL, NULL),
('503', 'Biaya Supporting Unit', 'biaya', 0, NULL, NULL, NULL),
('504', 'Biaya Konstruksi', 'biaya', 0, NULL, NULL, NULL),
('505', 'Biaya Office, Donasi, dll', 'biaya', 0, NULL, NULL, NULL),
('506', 'Biaya PLN dan Air', 'biaya', 0, NULL, NULL, NULL),
('507', 'Biaya Penyusutan Peralatan', 'biaya', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `jenis` enum('umum','penyesuaian','penutup') DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `transaksi_id` int(11) NOT NULL,
  `periode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `periode`
--

INSERT INTO `periode` (`id`, `tanggal_awal`, `tanggal_akhir`, `status`) VALUES
(20201, '2022-12-01', '2023-03-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `keterangan`) VALUES
(1, 'Membayar hutang bahan baku untuk pakan ayam sebesar Rp. 10.800.000,- secara transfer.'),
(2, 'Menerima pembayaran telur dari pelanggan sebesar Rp. 35.210.000,- secara tunai.');

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
-- Constraints for dumped tables
--

--
-- Constraints for table `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `fk_jurnal_periode1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jurnal_transaksi1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
