-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2023 at 11:02 AM
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
-- Database: `farmlestari_inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aset`
--

CREATE TABLE `aset` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `nominal` int(11) NOT NULL,
  `estimasi_pemakaian` int(11) NOT NULL,
  `nilai_residu` int(11) NOT NULL,
  `nota_pembelian_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aset`
--

INSERT INTO `aset` (`id`, `nama`, `nominal`, `estimasi_pemakaian`, `nilai_residu`, `nota_pembelian_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11801, 'Mesin produksi', 2000000000, 60, 0, 10809, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `harga` int(11) NOT NULL,
  `lead_time` int(11) NOT NULL,
  `kuantitas_stok_onorder_supplier` int(11) NOT NULL,
  `kuantitas_stok_onorder_produksi` int(11) NOT NULL,
  `kuantitas_stok_pengaman` int(11) NOT NULL,
  `kuantitas_stok_ready` int(11) NOT NULL,
  `total_kuantitas_stok` int(11) NOT NULL,
  `jenis` enum('Bahan Baku','Barang Jadi') NOT NULL,
  `satuan` varchar(10) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama`, `harga`, `lead_time`, `kuantitas_stok_onorder_supplier`, `kuantitas_stok_onorder_produksi`, `kuantitas_stok_pengaman`, `kuantitas_stok_ready`, `total_kuantitas_stok`, `jenis`, `satuan`, `deleted_at`, `updated_at`, `created_at`) VALUES
(10501, 'Jagung A', 5850, 1, 10614, 500, 200, 0, 11314, 'Bahan Baku', 'kg', NULL, '2023-02-13 05:59:42', NULL),
(10502, 'Katul', 4600, 2, 602, 1200, 9200, 0, 11002, 'Bahan Baku', 'kg', NULL, '2023-02-13 05:59:43', NULL),
(10503, 'K 36 SPR', 9550, 1, 5010, 6500, 0, 0, 11510, 'Bahan Baku', 'kg', NULL, '2023-02-13 05:59:44', NULL),
(10504, 'Telur A3', 25200, 0, 0, 0, 0, 44990, 44990, 'Bahan Baku', 'kg', NULL, '2023-02-08 22:25:29', NULL),
(10505, 'Telur A1', 24300, 0, 0, 0, 0, -9988, 40012, 'Barang Jadi', 'kg', NULL, '2023-02-06 00:50:41', NULL),
(10506, 'Pakan Jadi Super', 7035, 0, 0, 4000, 41000, 41000, 45000, 'Barang Jadi', 'kg', NULL, NULL, NULL),
(10507, 'Premix (Metabolizer)', 45000, 1, 1208, 8200, 3000, 3002, 12410, 'Bahan Baku', 'kg', NULL, '2023-02-04 08:07:30', NULL),
(10508, 'Ciromecyne 10%', 88000, 1, 6500, 3000, 1000, 1000, 10500, 'Bahan Baku', 'kg', NULL, NULL, NULL),
(10509, 'Pakan Jadi A', 8000, 0, 0, 4280, 4300, 4300, 8580, 'Barang Jadi', 'kg', NULL, NULL, NULL),
(10510, 'Tes Tambah', 10000, 1, 30, 10, 10, 9, 59, 'Bahan Baku', '15', NULL, '2023-02-15 04:35:39', '2022-12-21 07:24:22'),
(10511, 'Tes Tambah 2', 30000, 1, 10, 11, 12, 10, 43, 'Bahan Baku', 'kg', NULL, '2023-02-15 04:35:39', '2022-12-21 07:24:49'),
(10512, 'Test barang masuk edit', 20000, 100, 111, 111, 10000, 100, 322, 'Barang Jadi', 'kg', NULL, '2023-02-04 09:35:20', '2023-01-31 17:56:42'),
(10513, 'Tes Edit2', 1000000, 111, 21, 11, 1000, 0, 32, 'Bahan Baku', 'kg', NULL, '2023-02-08 04:57:58', '2023-01-31 18:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `bom`
--

CREATE TABLE `bom` (
  `id` int(11) NOT NULL,
  `kuantitas_barang_jadi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bom`
--

INSERT INTO `bom` (`id`, `kuantitas_barang_jadi`) VALUES
(11001, 100),
(11004, 150),
(11005, 50);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nama`, `alamat`, `no_telepon`, `deleted_at`, `updated_at`, `created_at`) VALUES
(10301, 'CV Bakery', 'Jalan Karya Abadi gg 5, Surabaya', '08123216369', NULL, '2022-12-20 01:08:06', NULL),
(10302, 'UD Roti Bakar', 'Jalan Sentosa Abadi, Malang', '0217064521', NULL, NULL, NULL),
(10303, 'Tes Tambah', 'Tes Tambah', 'Tes Tambah Cust', NULL, '2022-12-23 07:19:23', '2022-12-20 01:08:20'),
(10304, 'Tes Tambah', 'Tes', '0812', NULL, '2023-02-08 04:57:44', '2023-02-08 04:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_hasil_produksi`
--

CREATE TABLE `daftar_hasil_produksi` (
  `id` int(11) NOT NULL,
  `surat_perintah_kerja_id` int(11) DEFAULT NULL,
  `tgl_pencatatan` date NOT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `kuantitas_bersih` int(11) NOT NULL,
  `kuantitas_reject` int(11) NOT NULL,
  `total_kuantitas` int(11) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `pengguna_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `daftar_hasil_produksi`
--

INSERT INTO `daftar_hasil_produksi` (`id`, `surat_perintah_kerja_id`, `tgl_pencatatan`, `barang_id`, `kuantitas_bersih`, `kuantitas_reject`, `total_kuantitas`, `keterangan`, `pengguna_id`) VALUES
(11501, 11101, '2022-12-24', 10509, 3880, 120, 4000, 'reject dibuang\r\n', 10208),
(11502, 11102, '2022-12-24', 10509, 4220, 130, 4350, 'reject dijual jadi pupuk', 10208),
(11505, 11102, '2023-02-01', 10506, 11, 10, 21, 'RUSAK', 10201),
(11506, 11102, '2023-02-01', 10509, 11, 10, 21, 'RUSAK', 10201),
(11507, 11104, '2023-02-11', 10512, 20, 10, 30, 'test', 10201);

-- --------------------------------------------------------

--
-- Table structure for table `d_bom`
--

CREATE TABLE `d_bom` (
  `barang_id` int(11) NOT NULL,
  `BOM_id` int(11) NOT NULL,
  `kuantitas_bahan_baku` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_bom`
--

INSERT INTO `d_bom` (`barang_id`, `BOM_id`, `kuantitas_bahan_baku`) VALUES
(10501, 11001, 50),
(10501, 11004, 2),
(10502, 11001, 15),
(10503, 11001, 35),
(10503, 11004, 6),
(10504, 11004, NULL),
(10506, 11001, NULL),
(10510, 11004, 8),
(10510, 11005, 5),
(10511, 11005, 10),
(10512, 11005, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `d_mrp`
--

CREATE TABLE `d_mrp` (
  `id` int(11) NOT NULL,
  `periode` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `GR` int(11) NOT NULL,
  `SR` int(11) NOT NULL,
  `OHI` int(11) NOT NULL,
  `NR` int(11) NOT NULL,
  `POR` int(11) NOT NULL,
  `PORel` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `MRP_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `d_mrp`
--

INSERT INTO `d_mrp` (`id`, `periode`, `GR`, `SR`, `OHI`, `NR`, `POR`, `PORel`, `barang_id`, `MRP_id`) VALUES
(149, '2022-12-17 17:00:00', 0, 0, 0, 0, 0, 0, 10501, 10),
(150, '2022-12-18 17:00:00', 1600, 0, 8824, 0, 0, 0, 10501, 10),
(151, '2022-12-19 17:00:00', 1600, 0, 7224, 0, 0, 0, 10501, 10),
(152, '2022-12-20 17:00:00', 1600, 0, 5624, 0, 0, 0, 10501, 10),
(153, '2022-12-21 17:00:00', 1600, 0, 4024, 0, 0, 0, 10501, 10),
(154, '2022-12-22 17:00:00', 1600, 0, 2424, 0, 0, 0, 10501, 10),
(155, '2022-12-23 17:00:00', 1600, 0, 824, 0, 0, 776, 10501, 10),
(156, '2022-12-24 17:00:00', 1600, 0, 0, 776, 776, 1600, 10501, 10),
(157, '2022-12-25 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 10),
(158, '2022-12-26 17:00:00', 1600, 0, 0, 1600, 1600, 600, 10501, 10),
(159, '2022-12-27 17:00:00', 600, 0, 0, 600, 600, 0, 10501, 10),
(160, '2022-12-28 17:00:00', 0, 0, 0, 0, 0, 0, 10501, 10),
(161, '2022-12-16 17:00:00', 0, 0, 0, 0, 0, 0, 10502, 10),
(162, '2022-12-17 17:00:00', 0, 0, 0, 0, 0, 408, 10502, 10),
(163, '2022-12-18 17:00:00', 480, 0, 72, 0, 0, 480, 10502, 10),
(164, '2022-12-19 17:00:00', 480, 0, 0, 408, 408, 480, 10502, 10),
(165, '2022-12-20 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 10),
(166, '2022-12-21 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 10),
(167, '2022-12-22 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 10),
(168, '2022-12-23 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 10),
(169, '2022-12-24 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 10),
(170, '2022-12-25 17:00:00', 480, 0, 0, 480, 480, 180, 10502, 10),
(171, '2022-12-26 17:00:00', 480, 0, 0, 480, 480, 0, 10502, 10),
(172, '2022-12-27 17:00:00', 180, 0, 0, 180, 180, 0, 10502, 10),
(173, '2022-12-28 17:00:00', 0, 0, 0, 0, 0, 0, 10502, 10),
(174, '2022-12-17 17:00:00', 0, 0, 0, 0, 0, 0, 10503, 10),
(175, '2022-12-18 17:00:00', 1120, 0, 3880, 0, 0, 0, 10503, 10),
(176, '2022-12-19 17:00:00', 1120, 0, 2760, 0, 0, 0, 10503, 10),
(177, '2022-12-20 17:00:00', 1120, 0, 1640, 0, 0, 0, 10503, 10),
(178, '2022-12-21 17:00:00', 1120, 0, 520, 0, 0, 600, 10503, 10),
(179, '2022-12-22 17:00:00', 1120, 0, 0, 600, 600, 1120, 10503, 10),
(180, '2022-12-23 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 10),
(181, '2022-12-24 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 10),
(182, '2022-12-25 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 10),
(183, '2022-12-26 17:00:00', 1120, 0, 0, 1120, 1120, 420, 10503, 10),
(184, '2022-12-27 17:00:00', 420, 0, 0, 420, 420, 0, 10503, 10),
(185, '2022-12-28 17:00:00', 0, 0, 0, 0, 0, 0, 10503, 10),
(186, '2023-01-30 17:00:00', 0, 0, 0, 0, 0, 5, 10501, 11),
(187, '2023-01-31 17:00:00', 5, 0, 0, 5, 5, 0, 10501, 11),
(188, '2023-02-01 17:00:00', 0, 0, 0, 0, 0, 0, 10501, 11),
(189, '2023-01-29 17:00:00', 0, 0, 0, 0, 0, 2, 10502, 11),
(190, '2023-01-30 17:00:00', 0, 0, 0, 0, 0, 0, 10502, 11),
(191, '2023-01-31 17:00:00', 2, 0, 0, 2, 2, 0, 10502, 11),
(192, '2023-02-01 17:00:00', 0, 0, 0, 0, 0, 0, 10502, 11),
(193, '2023-01-30 17:00:00', 0, 0, 0, 0, 0, 4, 10503, 11),
(194, '2023-01-31 17:00:00', 4, 0, 0, 4, 4, 0, 10503, 11),
(195, '2023-02-01 17:00:00', 0, 0, 0, 0, 0, 0, 10503, 11),
(196, '2023-01-30 17:00:00', 0, 0, 0, 0, 0, 0, 10510, 12),
(197, '2023-01-31 17:00:00', 1, 0, 9, 0, 0, 0, 10510, 12),
(198, '2023-02-01 17:00:00', 0, 0, 9, 0, 0, 0, 10510, 12),
(199, '2023-02-02 17:00:00', 0, 0, 9, 0, 0, 0, 10510, 12),
(200, '2023-02-03 17:00:00', 0, 0, 9, 0, 0, 0, 10510, 12),
(201, '2023-01-30 17:00:00', 0, 0, 0, 0, 0, 0, 10511, 12),
(202, '2023-01-31 17:00:00', 2, 0, 10, 0, 0, 0, 10511, 12),
(203, '2023-02-01 17:00:00', 0, 0, 10, 0, 0, 0, 10511, 12),
(204, '2023-02-02 17:00:00', 0, 0, 10, 0, 0, 0, 10511, 12),
(205, '2023-02-03 17:00:00', 0, 0, 10, 0, 0, 0, 10511, 12);

-- --------------------------------------------------------

--
-- Table structure for table `d_nota_pembelian`
--

CREATE TABLE `d_nota_pembelian` (
  `barang_id` int(11) NOT NULL,
  `nota_pembelian_id` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_nota_pembelian`
--

INSERT INTO `d_nota_pembelian` (`barang_id`, `nota_pembelian_id`, `kuantitas`, `harga`) VALUES
(10501, 10801, 10448, 5450),
(10501, 10802, 1500, 5850),
(10501, 10808, 7, 5850),
(10501, 10810, 10, 5850),
(10502, 10802, 1300, 4600),
(10502, 10808, 5, 4600),
(10502, 10810, 5, 4600),
(10503, 10802, 1150, 9550),
(10506, 10802, 10, 10),
(10513, 10809, 8, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `d_nota_pemesanan`
--

CREATE TABLE `d_nota_pemesanan` (
  `barang_id` int(11) NOT NULL,
  `nota_pemesanan_id` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_nota_pemesanan`
--

INSERT INTO `d_nota_pemesanan` (`barang_id`, `nota_pemesanan_id`, `kuantitas`, `harga`) VALUES
(10501, 10701, 10448, 5450),
(10501, 10702, 1500, 5850),
(10501, 10708, 10, 5850),
(10501, 10711, 10, 90),
(10501, 10712, 10, 10000),
(10501, 10717, 150, 15000),
(10502, 10702, 1300, 4600),
(10502, 10708, 5, 4600),
(10502, 10709, 10, 4600),
(10503, 10702, 1150, 9550),
(10507, 10710, 10, 45000),
(10508, 10702, 111, 111),
(10509, 10702, 1000, 1000),
(10510, 10709, 20, 10000),
(10513, 10713, 10, 20000),
(10513, 10714, 10, 1000000);

-- --------------------------------------------------------

--
-- Table structure for table `d_nota_penjualan`
--

CREATE TABLE `d_nota_penjualan` (
  `barang_id` int(11) NOT NULL,
  `nota_penjualan_id` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_nota_penjualan`
--

INSERT INTO `d_nota_penjualan` (`barang_id`, `nota_penjualan_id`, `kuantitas`, `harga`) VALUES
(10501, 10910, 10, 5850),
(10501, 10911, 10, 5850),
(10501, 10912, 10, 5850),
(10501, 10913, 10, 5850),
(10502, 10910, 10, 4600),
(10502, 10911, 20, 4600),
(10502, 10912, 20, 4600),
(10502, 10913, 10, 4600),
(10504, 10901, 42000, 25200),
(10504, 10915, 10000, 10000),
(10504, 10916, 10000, 5850),
(10505, 10901, 1100, 24300),
(10505, 10916, 10000, 24300),
(10512, 10914, 11, 1111);

-- --------------------------------------------------------

--
-- Table structure for table `d_pemasukan_telur`
--

CREATE TABLE `d_pemasukan_telur` (
  `barang_id` int(11) NOT NULL,
  `pemasukan_telur_id` int(11) NOT NULL,
  `kuantitas_bersih` int(11) NOT NULL,
  `kuantitas_reject` int(11) NOT NULL,
  `total_kuantitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_pemasukan_telur`
--

INSERT INTO `d_pemasukan_telur` (`barang_id`, `pemasukan_telur_id`, `kuantitas_bersih`, `kuantitas_reject`, `total_kuantitas`) VALUES
(10504, 11601, 65200, 300, 65500),
(10504, 11605, 1, 1, 1),
(10504, 11606, 1, 1, 1),
(10504, 11608, 10, 2, 12),
(10505, 11604, 1, 1, 1),
(10505, 11605, 1, 2, 3),
(10505, 11606, 1, 2, 1),
(10505, 11608, 12, 2, 14),
(10509, 11604, 1, 1, 2),
(10509, 11606, 1, 2, 5),
(10512, 11604, 4, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `d_pengeluaran_bahan_baku`
--

CREATE TABLE `d_pengeluaran_bahan_baku` (
  `barang_id` int(11) NOT NULL,
  `pengeluaran_bahan_baku_id` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_pengeluaran_bahan_baku`
--

INSERT INTO `d_pengeluaran_bahan_baku` (`barang_id`, `pengeluaran_bahan_baku_id`, `kuantitas`) VALUES
(10501, 11404, 2),
(10501, 11405, 1),
(10501, 11406, 1),
(10501, 11409, 10000000),
(10503, 11401, 1200),
(10503, 11402, 10448),
(10503, 11404, 4),
(10503, 11405, 2),
(10503, 11406, 4),
(10507, 11402, 1300),
(10507, 11406, 3),
(10508, 11401, 100),
(10508, 11405, 3),
(10510, 11404, 8),
(10513, 11406, 2),
(10513, 11407, 19),
(10513, 11408, 38);

-- --------------------------------------------------------

--
-- Table structure for table `d_surat_jalan`
--

CREATE TABLE `d_surat_jalan` (
  `barang_id` int(11) NOT NULL,
  `surat_jalan_id` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_surat_jalan`
--

INSERT INTO `d_surat_jalan` (`barang_id`, `surat_jalan_id`, `kuantitas`) VALUES
(10504, 11605, 1),
(10505, 11604, 4),
(10505, 11605, 2),
(10506, 11604, 3),
(10506, 11605, 3),
(10509, 11601, 3880),
(10509, 11604, 4);

-- --------------------------------------------------------

--
-- Table structure for table `d_surat_perintah_kerja`
--

CREATE TABLE `d_surat_perintah_kerja` (
  `barang_id` int(11) NOT NULL,
  `surat_perintah_kerja_id` int(11) NOT NULL,
  `tgl_mulai_produksi` date NOT NULL,
  `tgl_selesai_produksi` date NOT NULL,
  `kuantitas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `d_surat_perintah_kerja`
--

INSERT INTO `d_surat_perintah_kerja` (`barang_id`, `surat_perintah_kerja_id`, `tgl_mulai_produksi`, `tgl_selesai_produksi`, `kuantitas`) VALUES
(10505, 11103, '2023-02-02', '2023-02-09', 1),
(10506, 11101, '2023-01-21', '2023-01-31', 4000),
(10506, 11102, '2023-01-11', '2023-01-18', 17800),
(10506, 11103, '2023-02-02', '2023-02-09', 4),
(10506, 11105, '2023-02-09', '2023-02-19', 31000),
(10506, 11106, '2023-02-09', '2023-02-16', 10000),
(10509, 11101, '2023-01-06', '2023-01-17', 4280),
(10509, 11102, '2023-01-11', '2023-01-18', 10448),
(10509, 11104, '2023-02-01', '2023-02-03', 3),
(10509, 11106, '2023-02-16', '2023-02-23', 30000),
(10512, 11104, '2023-02-01', '2023-02-04', 8);

-- --------------------------------------------------------

--
-- Table structure for table `flok`
--

CREATE TABLE `flok` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `cage` varchar(45) NOT NULL,
  `strain` varchar(100) NOT NULL,
  `populasi` int(11) NOT NULL,
  `usia` varchar(45) NOT NULL,
  `kebutuhan_pakan` int(11) NOT NULL,
  `satuan` varchar(5) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flok`
--

INSERT INTO `flok` (`id`, `nama`, `keterangan`, `cage`, `strain`, `populasi`, `usia`, `kebutuhan_pakan`, `satuan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10601, 'Flok I', 'Ayam DOC Gel. 05', 'Cage 1-6	', 'Lohman Platinum	', 11330, '26 mg/6\r\n', 10, 'gr', NULL, NULL, NULL),
(10602, 'Flok II', 'Ayam DOC Gel. 02', 'Cage 1-4	', 'Lohman Platinum', 7239, '50 mg/6\r\n', 20, 'gr', NULL, NULL, NULL),
(10603, 'Flok III', 'Ayam DOC Gel. 02', 'Cage 1-4	', 'Lohman Platinum', 7239, '78 mg/6\r\n', 15, 'gr', NULL, NULL, NULL),
(10604, 'Flok IV', 'Ayam DOC Gel. 03', 'Cage 1-6', 'Lohman Platinum', 10867, '63 mg/3\r\n', 17, 'gr', NULL, NULL, NULL),
(10605, 'Flok V', 'Ayam DOC Gel. 04', 'Cage 1-8	', 'Lohman Platinum', 11579, '44 mg/1', 18, 'gr', NULL, NULL, NULL),
(10606, 'Flok AB Edited', '', '', '', 0, '0', 20, 'gr', NULL, NULL, NULL),
(10607, 'Flok Coba Edit', 'Gelombang 1', 'Cage 5', 'Longham', 1200, '2 mg/3', 13, 'gr', '2023-01-25 10:06:09', '2023-01-25 10:10:28', NULL),
(10608, 'Tes editable', 'Tes diedt', 'Cage 1-10', 'Longham', 1500, 'edit', 11, 'gr', '2023-02-08 04:52:11', '2023-02-08 05:01:18', NULL),
(10609, 'Tes', '11', '111', '111', 1111, '1111', 111, 'pc', '2023-02-14 04:28:35', '2023-02-14 04:28:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id`, `nama`, `deleted_at`, `updated_at`, `created_at`) VALUES
(10101, 'Pemilik', NULL, NULL, NULL),
(10102, 'Manager', NULL, NULL, NULL),
(10103, 'Administrator', NULL, NULL, NULL),
(10104, 'Mandor Gudang Telur', NULL, NULL, NULL),
(10105, 'Mandor Gudang Logistik', NULL, NULL, NULL),
(10106, 'Kepala Produksi', NULL, NULL, NULL),
(10107, 'Admin Keuangan', NULL, NULL, NULL),
(10108, 'Mandor Gudang Pakan', NULL, '2022-12-20 01:22:13', '2022-12-20 01:21:11'),
(10109, 'Cek Edited', NULL, '2023-02-08 04:59:19', '2023-02-08 04:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pakan`
--

CREATE TABLE `jadwal_pakan` (
  `tgl_pemberian` date NOT NULL,
  `barang_id` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `pengguna_id` int(11) NOT NULL,
  `flok_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jadwal_pakan`
--

INSERT INTO `jadwal_pakan` (`tgl_pemberian`, `barang_id`, `kuantitas`, `keterangan`, `pengguna_id`, `flok_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
('2023-02-01', 10504, 15000, 'Tes tambah', 10201, 10601, '2023-02-06 07:34:40', '2023-02-06 07:34:40', NULL),
('2022-12-15', 10506, 17800, NULL, 10205, 10604, NULL, NULL, NULL),
('2022-12-13', 10509, 16900, NULL, 10205, 10601, NULL, NULL, NULL),
('2023-02-05', 10512, 322, 'Gatau', 10201, 10601, '2023-02-05 08:11:51', '2023-02-05 08:11:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mps`
--

CREATE TABLE `mps` (
  `id` int(11) NOT NULL,
  `tgl_mulai_produksi` date NOT NULL,
  `tgl_selesai_produksi` date NOT NULL,
  `kuantitas_barang_jadi` int(11) NOT NULL,
  `status` enum('belum diproses','proses produksi','selesai produksi') NOT NULL,
  `surat_perintah_kerja_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mps`
--

INSERT INTO `mps` (`id`, `tgl_mulai_produksi`, `tgl_selesai_produksi`, `kuantitas_barang_jadi`, `status`, `surat_perintah_kerja_id`, `barang_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11201, '2022-12-19', '2022-12-23', 4280, 'belum diproses', 11101, 10509, NULL, '2023-02-05 22:08:35', NULL),
(11202, '2022-12-19', '2022-12-29', 30000, 'proses produksi', 11101, 10506, NULL, '2023-02-13 05:59:46', NULL),
(11206, '2023-02-01', '2023-02-02', 10, 'belum diproses', 11103, 10505, '2023-01-31 23:39:13', '2023-01-31 23:39:13', NULL),
(11207, '2023-02-01', '2023-02-02', 10, 'proses produksi', 11103, 10506, '2023-01-31 23:39:13', '2023-02-13 07:29:30', NULL),
(11208, '2023-02-01', '2023-02-04', 10, 'proses produksi', 11104, 10512, '2023-02-04 00:26:47', '2023-02-15 04:35:39', NULL),
(11209, '2023-02-16', '2023-02-23', 30000, 'selesai produksi', 11106, 10509, '2023-02-08 23:59:28', '2023-02-09 02:07:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mrp`
--

CREATE TABLE `mrp` (
  `id` int(11) NOT NULL,
  `MPS_id` int(11) NOT NULL,
  `BOM_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mrp`
--

INSERT INTO `mrp` (`id`, `MPS_id`, `BOM_id`) VALUES
(10, 11202, 11001),
(11, 11207, 11001),
(12, 11208, 11005);

-- --------------------------------------------------------

--
-- Table structure for table `nota_pembelian`
--

CREATE TABLE `nota_pembelian` (
  `id` int(11) NOT NULL,
  `no_nota` varchar(45) NOT NULL,
  `tgl_pembuatan_nota` date NOT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `cara_bayar` enum('tunai','transfer') NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `status` enum('belum bayar','sudah bayar') NOT NULL,
  `pengguna_id` int(11) NOT NULL,
  `nota_pemesanan_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nota_pembelian`
--

INSERT INTO `nota_pembelian` (`id`, `no_nota`, `tgl_pembuatan_nota`, `total_harga`, `cara_bayar`, `keterangan`, `status`, `pengguna_id`, `nota_pemesanan_id`, `supplier_id`) VALUES
(10801, '19.12.19.01', '2022-12-19', 56941600, 'tunai', NULL, 'sudah bayar', 10204, 10701, 10402),
(10802, '51.20-52.20', '2022-12-26', 25737000, 'tunai', NULL, 'belum bayar', 10209, 10702, 10401),
(10808, '20230204-02-001', '2023-02-04', 63950, 'tunai', NULL, 'belum bayar', 10201, 10708, 10401),
(10809, '20230204-02-002', '2023-02-04', 160000, 'tunai', NULL, 'belum bayar', 10201, 10713, 10402),
(10810, '20230208-02-001', '2023-02-08', 81500, 'transfer', 'transfer atas nama azzahra', 'belum bayar', 10201, 10708, 10401);

-- --------------------------------------------------------

--
-- Table structure for table `nota_pemesanan`
--

CREATE TABLE `nota_pemesanan` (
  `id` int(11) NOT NULL,
  `no_nota` varchar(45) NOT NULL,
  `tgl_pembuatan_nota` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` enum('dalam proses','beli','batal') NOT NULL,
  `pengguna_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nota_pemesanan`
--

INSERT INTO `nota_pemesanan` (`id`, `no_nota`, `tgl_pembuatan_nota`, `total_harga`, `status`, `pengguna_id`, `supplier_id`, `deleted_at`, `updated_at`, `created_at`) VALUES
(10701, '12.12-12.03', '2022-12-12', 56941600, 'beli', 10204, 10402, NULL, '2023-02-05 22:08:01', NULL),
(10702, '11.01-12.01', '2022-12-20', 25737000, 'dalam proses', 10209, 10401, NULL, NULL, NULL),
(10708, '20230204-01-001', '2023-02-04', 81500, '', 10201, 10401, NULL, '2023-02-04 07:56:27', '2023-02-04 07:56:27'),
(10709, '20230204-01-002', '2023-02-04', 246000, '', 10201, 10401, NULL, '2023-02-04 08:06:52', '2023-02-04 08:06:52'),
(10710, '20230204-01-003', '2023-02-04', 450000, '', 10201, 10402, NULL, '2023-02-04 08:07:30', '2023-02-04 08:07:30'),
(10711, '20230204-01-004', '2023-02-04', 900, '', 10201, 10401, NULL, '2023-02-04 08:08:11', '2023-02-04 08:08:11'),
(10712, '20230204-01-005', '2023-02-04', 100000, '', 10201, 10401, NULL, '2023-02-04 09:31:30', '2023-02-04 09:31:30'),
(10713, '20230204-01-006', '2023-02-04', 200000, '', 10201, 10402, NULL, '2023-02-04 09:32:42', '2023-02-04 09:32:42'),
(10714, '20230204-01-007', '2023-02-04', 10000000, '', 10201, 10401, NULL, '2023-02-04 09:48:41', '2023-02-04 09:48:41'),
(10715, '20230206-01-001', '2023-02-06', 19550000, 'dalam proses', 10201, 10401, NULL, '2023-02-06 00:48:12', '2023-02-06 00:48:12'),
(10716, '20230206-01-002', '2023-02-06', 11550000, 'dalam proses', 10201, 10401, NULL, '2023-02-06 00:49:34', '2023-02-06 00:49:34'),
(10717, '20230206-01-003', '2023-02-06', 2250000, 'dalam proses', 10201, 10401, NULL, '2023-02-06 00:51:04', '2023-02-06 00:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `nota_penjualan`
--

CREATE TABLE `nota_penjualan` (
  `id` int(11) NOT NULL,
  `no_nota` varchar(45) NOT NULL,
  `tgl_pembuatan_nota` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `cara_bayar` enum('tunai','transfer') NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `pengguna_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nota_penjualan`
--

INSERT INTO `nota_penjualan` (`id`, `no_nota`, `tgl_pembuatan_nota`, `total_harga`, `cara_bayar`, `keterangan`, `pengguna_id`, `customer_id`) VALUES
(10901, '10.02-10.31', '2022-06-04', 13257000, 'tunai', NULL, 10203, 10301),
(10910, '20230204-03-001', '2023-02-04', 46000, 'tunai', NULL, 10201, 10301),
(10911, '20230204-03-002', '2023-02-04', 92000, 'tunai', NULL, 10201, 10302),
(10912, '20230204-03-003', '2023-02-04', 92000, 'tunai', NULL, 10201, 10303),
(10913, '20230204-03-004', '2023-02-04', 104500, 'tunai', NULL, 10201, 10302),
(10914, '20230204-03-005', '2023-02-04', 12221, 'tunai', NULL, 10201, 10301),
(10915, '20230206-03-001', '2023-02-06', 300000000, 'tunai', NULL, 10201, 10301),
(10916, '20230206-03-002', '2023-02-06', 301500000, 'transfer', 'trf an maulidya 2212000', 10201, 10301);

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan_telur`
--

CREATE TABLE `pemasukan_telur` (
  `id` int(11) NOT NULL,
  `tgl_pencatatan` date NOT NULL,
  `karantina` int(11) NOT NULL,
  `afkir` int(11) NOT NULL,
  `kematian` int(11) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `pengguna_id` int(11) NOT NULL,
  `flok_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pemasukan_telur`
--

INSERT INTO `pemasukan_telur` (`id`, `tgl_pencatatan`, `karantina`, `afkir`, `kematian`, `keterangan`, `pengguna_id`, `flok_id`, `created_at`, `deleted_at`, `updated_at`) VALUES
(11601, '2023-01-25', 4, 1, 1, 'Telur reject dibuang', 10206, 10601, '2023-01-25 10:00:00', NULL, NULL),
(11604, '2023-02-01', 3, 1, 1, NULL, 10201, 10601, '2023-01-31 21:53:23', NULL, '2023-01-31 21:53:23'),
(11605, '2023-02-01', 3, 1, 5, 'Rusak', 10201, 10601, '2023-01-31 21:54:08', NULL, '2023-01-31 21:54:08'),
(11606, '2023-02-01', 2, 2, 3, 'Test Keterangan', 10201, 10607, '2023-01-31 22:00:42', NULL, '2023-01-31 22:00:42'),
(11607, '2023-02-05', 0, 0, 0, 'Belum ada', 10201, 10601, '2023-02-05 06:46:53', NULL, '2023-02-05 06:46:53'),
(11608, '2023-02-05', 0, 0, 0, 'Tidak ada', 10201, 10602, '2023-02-05 06:52:21', NULL, '2023-02-05 06:52:21'),
(11609, '2023-02-08', 0, 0, 0, NULL, 10201, 10601, '2023-02-08 02:02:13', NULL, '2023-02-08 02:02:13');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_bahan_baku`
--

CREATE TABLE `pengeluaran_bahan_baku` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(45) NOT NULL,
  `tgl_pengeluaran_barang` date NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `pengguna_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengeluaran_bahan_baku`
--

INSERT INTO `pengeluaran_bahan_baku` (`id`, `no_surat`, `tgl_pengeluaran_barang`, `keterangan`, `pengguna_id`) VALUES
(11401, '13.05-12.12', '2022-12-21', 'Kirim ke tim produksi', 10206),
(11402, '13.05-12.12', '2022-12-13', NULL, 10206),
(11404, '20230201-02-02-001', '2023-02-01', '20230201-02-02-001', 10201),
(11405, '20230201-02-02-002', '2023-02-01', NULL, 10201),
(11406, '20230201-02-02-003', '2023-02-01', 'Test Tambah LPB 3', 10201),
(11407, '20230205-02-02-001', '2023-02-05', NULL, 10201),
(11408, '20230205-02-02-002', '2023-02-05', NULL, 10201),
(11409, '20230209-02-02-001', '2023-02-09', NULL, 10201);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(225) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `jabatan_id`, `created_at`, `updated_at`) VALUES
(10201, 'Safira Arinta', 'safira1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10103, '2023-02-01 00:45:47', '0000-00-00 00:00:00'),
(10202, 'Joseph Tedjakusuma', 'joseph1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10101, '2023-02-01 00:45:49', '0000-00-00 00:00:00'),
(10203, 'Didik', 'didik1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10102, '2023-02-01 00:45:51', '0000-00-00 00:00:00'),
(10204, 'Diana', 'diana1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10107, '2023-02-01 00:45:44', '0000-00-00 00:00:00'),
(10205, 'Aprilia', 'aprilia1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10108, '2023-02-01 00:45:42', '0000-00-00 00:00:00'),
(10206, 'Teguh', 'teguh1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10105, '2023-02-01 00:45:40', '0000-00-00 00:00:00'),
(10208, 'Abriyanto', 'abriyanto1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10106, '2023-02-01 00:45:38', '0000-00-00 00:00:00'),
(10209, 'Mediana', 'mediana1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10104, '2023-02-01 00:45:33', '0000-00-00 00:00:00'),
(10210, 'testlogin', 'testlogin', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10102, '2023-01-31 17:45:16', '2023-01-31 17:45:16'),
(10211, 'Jony Deep', 'jonydeep', '$2y$10$Af7BuKIF/0L4KHbVoqxNuukRcgw/j/tLPKj8Ui3uXlRIo8oPgU4My', 10101, '2023-02-10 23:05:59', '2023-02-10 23:05:59'),
(10212, 'Tes Nama', 'tesuername', '$2y$10$kuyb4ZnEUt.wt2nlq.o2K.I9GKgmozJ8T4ia76vaSZHjjCtcp.7kS', 10101, '2023-02-10 23:07:27', '2023-02-10 23:07:27');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `alamat`, `no_telepon`, `deleted_at`, `updated_at`, `created_at`) VALUES
(10401, 'UD Karya Sentosa', 'Jalan Suka Karya no 141, Malang', '08932102001', NULL, '2022-12-21 07:55:11', NULL),
(10402, 'Manunggal Jaya', 'Jl Kyai Radiman RT. 06, RW. 02, Krajan Bantur, Malang', '081334325774', NULL, NULL, NULL),
(10403, 'Tes Tambah', 'Tes gatau', '0812', NULL, '2023-02-08 04:54:34', '2023-02-08 04:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan`
--

CREATE TABLE `surat_jalan` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(45) NOT NULL,
  `tgl_pengiriman_barang` date NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `status` enum('dalam pengiriman','sudah diterima') NOT NULL,
  `pengguna_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surat_jalan`
--

INSERT INTO `surat_jalan` (`id`, `no_surat`, `tgl_pengiriman_barang`, `keterangan`, `status`, `pengguna_id`) VALUES
(11601, '13.05-12.12', '2022-12-26', NULL, 'dalam pengiriman', 10208),
(11603, '13.05-12.12', '2022-12-24', 'Coba', 'dalam pengiriman', 10206),
(11604, '20230201-02-03-001', '2023-02-01', NULL, 'dalam pengiriman', 10201),
(11605, '20230201-02-03-002', '2023-02-01', 'Test input surat jalan', 'sudah diterima', 10201);

-- --------------------------------------------------------

--
-- Table structure for table `surat_perintah_kerja`
--

CREATE TABLE `surat_perintah_kerja` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(45) NOT NULL,
  `tgl_pembuatan_surat` date NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `pengguna_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surat_perintah_kerja`
--

INSERT INTO `surat_perintah_kerja` (`id`, `no_surat`, `tgl_pembuatan_surat`, `keterangan`, `pengguna_id`) VALUES
(11101, '12.123-13.021', '2022-12-01', NULL, 10208),
(11102, '13.06.01-12.12.01', '2022-12-01', NULL, 10208),
(11103, '20230201-02-01-001', '2023-02-01', NULL, 10201),
(11104, '20230201-02-01-002', '2023-02-01', 'jjj', 10201),
(11105, '20230209-02-01-001', '2023-02-09', 'Belum ada', 10201),
(11106, '20230209-02-01-002', '2023-02-09', NULL, 10201);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aset`
--
ALTER TABLE `aset`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_aset_nota_pembelian1_idx` (`nota_pembelian_id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bom`
--
ALTER TABLE `bom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_hasil_produksi`
--
ALTER TABLE `daftar_hasil_produksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_daftar_hasil_produksi_surat_perintah_kerja1_idx` (`surat_perintah_kerja_id`),
  ADD KEY `fk_daftar_hasil_produksi_barang1_idx` (`barang_id`),
  ADD KEY `fk_daftar_hasil_produksi_pengguna1_idx` (`pengguna_id`);

--
-- Indexes for table `d_bom`
--
ALTER TABLE `d_bom`
  ADD PRIMARY KEY (`barang_id`,`BOM_id`),
  ADD KEY `fk_barang_has_BOM_BOM1_idx` (`BOM_id`),
  ADD KEY `fk_barang_has_BOM_barang_idx` (`barang_id`);

--
-- Indexes for table `d_mrp`
--
ALTER TABLE `d_mrp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_d_MRP_barang1_idx` (`barang_id`),
  ADD KEY `fk_d_MRP_MRP1_idx` (`MRP_id`);

--
-- Indexes for table `d_nota_pembelian`
--
ALTER TABLE `d_nota_pembelian`
  ADD PRIMARY KEY (`barang_id`,`nota_pembelian_id`),
  ADD KEY `fk_barang_has_nota_pembelian_nota_pembelian1_idx` (`nota_pembelian_id`),
  ADD KEY `fk_barang_has_nota_pembelian_barang1_idx` (`barang_id`);

--
-- Indexes for table `d_nota_pemesanan`
--
ALTER TABLE `d_nota_pemesanan`
  ADD PRIMARY KEY (`barang_id`,`nota_pemesanan_id`),
  ADD KEY `fk_barang_has_nota_pemesanan_nota_pemesanan1_idx` (`nota_pemesanan_id`),
  ADD KEY `fk_barang_has_nota_pemesanan_barang1_idx` (`barang_id`);

--
-- Indexes for table `d_nota_penjualan`
--
ALTER TABLE `d_nota_penjualan`
  ADD PRIMARY KEY (`barang_id`,`nota_penjualan_id`),
  ADD KEY `fk_barang_has_nota_penjualan_telur_nota_penjualan_telur1_idx` (`nota_penjualan_id`),
  ADD KEY `fk_barang_has_nota_penjualan_telur_barang1_idx` (`barang_id`);

--
-- Indexes for table `d_pemasukan_telur`
--
ALTER TABLE `d_pemasukan_telur`
  ADD PRIMARY KEY (`barang_id`,`pemasukan_telur_id`),
  ADD KEY `fk_barang_has_pemasukan_telur_pemasukan_telur1_idx` (`pemasukan_telur_id`),
  ADD KEY `fk_barang_has_pemasukan_telur_barang1_idx` (`barang_id`);

--
-- Indexes for table `d_pengeluaran_bahan_baku`
--
ALTER TABLE `d_pengeluaran_bahan_baku`
  ADD PRIMARY KEY (`barang_id`,`pengeluaran_bahan_baku_id`),
  ADD KEY `fk_barang_has_pengeluaran_bahan_baku_pengeluaran_bahan_baku_idx` (`pengeluaran_bahan_baku_id`),
  ADD KEY `fk_barang_has_pengeluaran_bahan_baku_barang1_idx` (`barang_id`);

--
-- Indexes for table `d_surat_jalan`
--
ALTER TABLE `d_surat_jalan`
  ADD PRIMARY KEY (`barang_id`,`surat_jalan_id`),
  ADD KEY `fk_barang_has_surat_jalan_surat_jalan1_idx` (`surat_jalan_id`),
  ADD KEY `fk_barang_has_surat_jalan_barang1_idx` (`barang_id`);

--
-- Indexes for table `d_surat_perintah_kerja`
--
ALTER TABLE `d_surat_perintah_kerja`
  ADD PRIMARY KEY (`barang_id`,`surat_perintah_kerja_id`),
  ADD KEY `fk_barang_has_surat_perintah_kerja_surat_perintah_kerja1_idx` (`surat_perintah_kerja_id`),
  ADD KEY `fk_barang_has_surat_perintah_kerja_barang1_idx` (`barang_id`);

--
-- Indexes for table `flok`
--
ALTER TABLE `flok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jadwal_pakan`
--
ALTER TABLE `jadwal_pakan`
  ADD PRIMARY KEY (`barang_id`,`pengguna_id`,`flok_id`),
  ADD KEY `fk_jadwal_pakan_pengguna1_idx` (`pengguna_id`),
  ADD KEY `fk_jadwal_pakan_barang1_idx` (`barang_id`),
  ADD KEY `fk_jadwal_pakan_flok1_idx` (`flok_id`);

--
-- Indexes for table `mps`
--
ALTER TABLE `mps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_MPS_surat_perintah_kerja1_idx` (`surat_perintah_kerja_id`),
  ADD KEY `fk_MPS_barang1_idx` (`barang_id`);

--
-- Indexes for table `mrp`
--
ALTER TABLE `mrp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_MRP_MPS1_idx` (`MPS_id`),
  ADD KEY `fk_MRP_BOM1_idx` (`BOM_id`);

--
-- Indexes for table `nota_pembelian`
--
ALTER TABLE `nota_pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nota_pembelian_pengguna1_idx` (`pengguna_id`),
  ADD KEY `fk_nota_pembelian_nota_pemesanan1_idx` (`nota_pemesanan_id`),
  ADD KEY `fk_nota_pembelian_supplier1_idx` (`supplier_id`);

--
-- Indexes for table `nota_pemesanan`
--
ALTER TABLE `nota_pemesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nota_pemesanan_pengguna1_idx` (`pengguna_id`),
  ADD KEY `fk_nota_pemesanan_supplier1_idx` (`supplier_id`);

--
-- Indexes for table `nota_penjualan`
--
ALTER TABLE `nota_penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_nota_penjualan_telur_pengguna1_idx` (`pengguna_id`),
  ADD KEY `fk_nota_penjualan_telur_customer1_idx` (`customer_id`);

--
-- Indexes for table `pemasukan_telur`
--
ALTER TABLE `pemasukan_telur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pemasukan_telur_pengguna1_idx` (`pengguna_id`),
  ADD KEY `fk_pemasukan_telur_flok1_idx` (`flok_id`);

--
-- Indexes for table `pengeluaran_bahan_baku`
--
ALTER TABLE `pengeluaran_bahan_baku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengeluaran_bahan_baku_pengguna1_idx` (`pengguna_id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengguna_jabatan1_idx` (`jabatan_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_surat_jalan_pengguna1_idx` (`pengguna_id`);

--
-- Indexes for table `surat_perintah_kerja`
--
ALTER TABLE `surat_perintah_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_surat_perintah_kerja_pengguna1_idx` (`pengguna_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aset`
--
ALTER TABLE `aset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11802;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10514;

--
-- AUTO_INCREMENT for table `bom`
--
ALTER TABLE `bom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11006;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10305;

--
-- AUTO_INCREMENT for table `daftar_hasil_produksi`
--
ALTER TABLE `daftar_hasil_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11508;

--
-- AUTO_INCREMENT for table `d_mrp`
--
ALTER TABLE `d_mrp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `flok`
--
ALTER TABLE `flok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10610;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10110;

--
-- AUTO_INCREMENT for table `mps`
--
ALTER TABLE `mps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11210;

--
-- AUTO_INCREMENT for table `mrp`
--
ALTER TABLE `mrp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `nota_pembelian`
--
ALTER TABLE `nota_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10811;

--
-- AUTO_INCREMENT for table `nota_pemesanan`
--
ALTER TABLE `nota_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10718;

--
-- AUTO_INCREMENT for table `nota_penjualan`
--
ALTER TABLE `nota_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10917;

--
-- AUTO_INCREMENT for table `pemasukan_telur`
--
ALTER TABLE `pemasukan_telur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11610;

--
-- AUTO_INCREMENT for table `pengeluaran_bahan_baku`
--
ALTER TABLE `pengeluaran_bahan_baku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11410;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10213;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10404;

--
-- AUTO_INCREMENT for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11606;

--
-- AUTO_INCREMENT for table `surat_perintah_kerja`
--
ALTER TABLE `surat_perintah_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11107;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aset`
--
ALTER TABLE `aset`
  ADD CONSTRAINT `fk_aset_nota_pembelian1` FOREIGN KEY (`nota_pembelian_id`) REFERENCES `nota_pembelian` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `daftar_hasil_produksi`
--
ALTER TABLE `daftar_hasil_produksi`
  ADD CONSTRAINT `fk_daftar_hasil_produksi_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_daftar_hasil_produksi_pengguna1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_daftar_hasil_produksi_surat_perintah_kerja1` FOREIGN KEY (`surat_perintah_kerja_id`) REFERENCES `surat_perintah_kerja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `d_bom`
--
ALTER TABLE `d_bom`
  ADD CONSTRAINT `fk_barang_has_BOM_BOM1` FOREIGN KEY (`BOM_id`) REFERENCES `bom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_BOM_barang` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `d_mrp`
--
ALTER TABLE `d_mrp`
  ADD CONSTRAINT `fk_d_MRP_MRP1` FOREIGN KEY (`MRP_id`) REFERENCES `mrp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_d_MRP_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `d_nota_pembelian`
--
ALTER TABLE `d_nota_pembelian`
  ADD CONSTRAINT `fk_barang_has_nota_pembelian_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_nota_pembelian_nota_pembelian1` FOREIGN KEY (`nota_pembelian_id`) REFERENCES `nota_pembelian` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `d_nota_pemesanan`
--
ALTER TABLE `d_nota_pemesanan`
  ADD CONSTRAINT `fk_barang_has_nota_pemesanan_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_nota_pemesanan_nota_pemesanan1` FOREIGN KEY (`nota_pemesanan_id`) REFERENCES `nota_pemesanan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `d_nota_penjualan`
--
ALTER TABLE `d_nota_penjualan`
  ADD CONSTRAINT `fk_barang_has_nota_penjualan_telur_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_nota_penjualan_telur_nota_penjualan_telur1` FOREIGN KEY (`nota_penjualan_id`) REFERENCES `nota_penjualan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `d_pemasukan_telur`
--
ALTER TABLE `d_pemasukan_telur`
  ADD CONSTRAINT `fk_barang_has_pemasukan_telur_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_pemasukan_telur_pemasukan_telur1` FOREIGN KEY (`pemasukan_telur_id`) REFERENCES `pemasukan_telur` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `d_pengeluaran_bahan_baku`
--
ALTER TABLE `d_pengeluaran_bahan_baku`
  ADD CONSTRAINT `fk_barang_has_pengeluaran_bahan_baku_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_pengeluaran_bahan_baku_pengeluaran_bahan_baku1` FOREIGN KEY (`pengeluaran_bahan_baku_id`) REFERENCES `pengeluaran_bahan_baku` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `d_surat_jalan`
--
ALTER TABLE `d_surat_jalan`
  ADD CONSTRAINT `fk_barang_has_surat_jalan_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_surat_jalan_surat_jalan1` FOREIGN KEY (`surat_jalan_id`) REFERENCES `surat_jalan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `d_surat_perintah_kerja`
--
ALTER TABLE `d_surat_perintah_kerja`
  ADD CONSTRAINT `fk_barang_has_surat_perintah_kerja_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_surat_perintah_kerja_surat_perintah_kerja1` FOREIGN KEY (`surat_perintah_kerja_id`) REFERENCES `surat_perintah_kerja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jadwal_pakan`
--
ALTER TABLE `jadwal_pakan`
  ADD CONSTRAINT `fk_jadwal_pakan_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jadwal_pakan_flok1` FOREIGN KEY (`flok_id`) REFERENCES `flok` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jadwal_pakan_pengguna1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mps`
--
ALTER TABLE `mps`
  ADD CONSTRAINT `fk_MPS_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MPS_surat_perintah_kerja1` FOREIGN KEY (`surat_perintah_kerja_id`) REFERENCES `surat_perintah_kerja` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `mrp`
--
ALTER TABLE `mrp`
  ADD CONSTRAINT `fk_MRP_BOM1` FOREIGN KEY (`BOM_id`) REFERENCES `bom` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_MRP_MPS1` FOREIGN KEY (`MPS_id`) REFERENCES `mps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nota_pembelian`
--
ALTER TABLE `nota_pembelian`
  ADD CONSTRAINT `fk_nota_pembelian_nota_pemesanan1` FOREIGN KEY (`nota_pemesanan_id`) REFERENCES `nota_pemesanan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_pembelian_pengguna1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_pembelian_supplier1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nota_pemesanan`
--
ALTER TABLE `nota_pemesanan`
  ADD CONSTRAINT `fk_nota_pemesanan_pengguna1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_pemesanan_supplier1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `nota_penjualan`
--
ALTER TABLE `nota_penjualan`
  ADD CONSTRAINT `fk_nota_penjualan_telur_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_nota_penjualan_telur_pengguna1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pemasukan_telur`
--
ALTER TABLE `pemasukan_telur`
  ADD CONSTRAINT `fk_pemasukan_telur_flok1` FOREIGN KEY (`flok_id`) REFERENCES `flok` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_pemasukan_telur_pengguna1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pengeluaran_bahan_baku`
--
ALTER TABLE `pengeluaran_bahan_baku`
  ADD CONSTRAINT `fk_pengeluaran_bahan_baku_pengguna1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `fk_pengguna_jabatan1` FOREIGN KEY (`jabatan_id`) REFERENCES `jabatan` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  ADD CONSTRAINT `fk_surat_jalan_pengguna1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `surat_perintah_kerja`
--
ALTER TABLE `surat_perintah_kerja`
  ADD CONSTRAINT `fk_surat_perintah_kerja_pengguna1` FOREIGN KEY (`pengguna_id`) REFERENCES `pengguna` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
