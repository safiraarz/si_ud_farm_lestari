-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2023 at 08:22 AM
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
(10501, 'Jagung A', 12000, 1, 10564, 500, 200, 0, 11264, 'Bahan Baku', 'kg', NULL, '2023-02-28 12:16:34', NULL),
(10502, 'Katul', 4600, 2, 602, 1200, 9200, 0, 11002, 'Bahan Baku', 'kg', NULL, '2023-02-28 12:16:34', NULL),
(10503, 'K 36 SPR', 9550, 1, 5010, 6500, 0, 0, 11510, 'Bahan Baku', 'kg', NULL, '2023-02-13 05:59:44', NULL),
(10504, 'Telur A3', 25200, 0, 0, 0, 0, 42845, 42845, 'Barang Jadi', 'pc', NULL, '2023-02-28 05:00:37', NULL),
(10505, 'Telur A1', 24300, 0, 0, 0, 0, 5780, 5780, 'Barang Jadi', 'kg', NULL, '2023-02-28 05:00:38', NULL),
(10506, 'Pakan Jadi Super', 7035, 0, 0, 4000, 41000, 0, 45000, 'Barang Jadi', 'kg', NULL, '2023-02-25 02:31:41', NULL),
(10507, 'Premix (Metabolizer)', 45000, 1, 1208, 8200, 3000, 0, 12408, 'Bahan Baku', 'kg', NULL, '2023-02-28 12:26:06', NULL),
(10508, 'Ciromecyne 10%', 88000, 1, 6500, 3000, 1000, 939, 11439, 'Bahan Baku', 'kg', NULL, '2023-02-28 04:26:51', NULL),
(10509, 'Pakan Jadi A', 8000, 0, 0, 4280, 4300, 0, 8580, 'Barang Jadi', 'kg', NULL, '2023-02-25 02:27:57', NULL),
(10510, 'Konsetrat ABC', 10000, 1, 30, 10, 10, 0, 50, 'Bahan Baku', 'kg', NULL, '2023-02-28 12:20:03', '2022-12-21 07:24:22'),
(10511, 'Jagung B', 30000, 1, 10, 11, 12, 0, 33, 'Bahan Baku', 'kg', NULL, '2023-02-28 04:26:51', '2022-12-21 07:24:49'),
(10512, 'Pakan DOC D', 20000, 100, 111, 111, 10000, 5000, 15222, 'Barang Jadi', 'kg', NULL, '2023-02-25 02:36:59', '2023-01-31 17:56:42'),
(10513, 'Ciromecyne 7%', 15000, 2, 21, 11, 1000, 10000, 11032, 'Bahan Baku', 'kg', NULL, '2023-02-20 06:47:20', '2023-01-31 18:18:37'),
(10516, 'Katul Super A+', 10000, 2, 12000, 5000, 6300, 0, 23300, 'Bahan Baku', 'pc', NULL, '2023-02-28 12:20:03', '2023-02-25 00:20:11'),
(10518, 'Pakan DOC AB', 13000, 2, 1300, 140, 60, 12000, 13500, 'Barang Jadi', 'kg', '2023-02-27 04:25:13', '2023-02-27 04:25:13', '2023-02-27 04:17:27'),
(10519, 'Pakan Pullet A+', 35000, 2, 1200, 100, 1000, 4000, 6300, 'Barang Jadi', 'kg', NULL, '2023-02-27 04:23:46', '2023-02-27 04:23:46'),
(10520, 'Telur A2', 1500, 0, 0, 0, 3000, 16992, 19992, 'Barang Jadi', 'kg', NULL, '2023-02-28 04:50:30', '2023-02-28 04:41:59'),
(10521, 'Telur Cream', 12000, 1, 0, 0, 0, 187, 187, 'Barang Jadi', 'kg', NULL, '2023-02-28 05:25:35', '2023-02-28 04:43:26'),
(10522, 'Telur Bentes', 20, 2, 0, 0, 30, 1183, 2683, 'Barang Jadi', 'kg', NULL, '2023-02-28 05:25:35', '2023-02-28 04:44:35'),
(10523, 'Pakan Pullet B', 20000, 1, 0, 0, 0, 30000, 30000, 'Barang Jadi', 'kg', NULL, '2023-02-28 06:01:18', '2023-02-28 06:01:18');

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
(11006, 700),
(11007, 200),
(11008, 130),
(11009, 120);

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
(10303, 'Dina Trisandi', 'Tes Tambah', 'Tes Tambah Cust', NULL, '2022-12-23 07:19:23', '2022-12-20 01:08:20'),
(10304, 'UD Joyo Boyo', 'Tes\r\n                jjj', '0812', NULL, '2023-02-20 06:48:42', '2023-02-08 04:57:31'),
(10305, 'Tritan', 'Bandung Raya', '08130202071', NULL, '2023-02-25 00:30:17', '2023-02-25 00:12:12');

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
(11501, 11101, '2022-12-24', 10509, 3880, 120, 4000, 'reject dibuang\r\n', 10201),
(11502, 11102, '2022-12-24', 10509, 4220, 130, 4350, 'reject dijual jadi pupuk', 10201),
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
(10501, 11007, 100),
(10502, 11001, 15),
(10502, 11007, 50),
(10502, 11008, 40),
(10503, 11001, 35),
(10506, 11001, NULL),
(10507, 11006, 100),
(10507, 11007, 1),
(10507, 11009, 10),
(10508, 11006, 10),
(10509, 11006, NULL),
(10510, 11007, 49),
(10510, 11008, 40),
(10510, 11009, 10),
(10511, 11006, 300),
(10511, 11008, 50),
(10511, 11009, 60),
(10512, 11007, NULL),
(10516, 11006, 290),
(10516, 11009, 40),
(10519, 11008, NULL),
(10523, 11009, NULL);

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
(11901, '2023-02-28 11:28:38', 0, 0, 0, 0, 0, 0, 10507, 11301),
(11902, '2023-02-28 11:28:43', 457, 0, 2545, 0, 0, 0, 10507, 11301),
(11903, '2023-02-28 11:28:52', 154, 0, 2391, 0, 0, 0, 10507, 11301),
(11904, '2023-02-28 11:28:55', 0, 0, 2391, 0, 0, 0, 10507, 11301),
(11905, '2023-02-28 11:28:57', 0, 0, 2391, 0, 0, 0, 10507, 11301),
(11906, '2023-02-28 11:29:01', 0, 0, 2391, 0, 0, 0, 10507, 11301),
(11907, '2023-02-28 11:29:04', 0, 0, 0, 0, 0, 0, 10508, 11301),
(11908, '2023-02-28 11:29:07', 46, 0, 954, 0, 0, 0, 10508, 11301),
(11909, '2023-02-28 11:29:10', 15, 0, 939, 0, 0, 0, 10508, 11301),
(11910, '2023-02-28 11:29:14', 0, 0, 939, 0, 0, 0, 10508, 11301),
(11911, '2023-02-28 11:29:36', 0, 0, 939, 0, 0, 0, 10508, 11301),
(11912, '2023-02-28 11:29:41', 0, 0, 939, 0, 0, 0, 10508, 11301),
(11913, '2023-02-28 11:29:44', 0, 0, 0, 0, 0, 1361, 10511, 11301),
(11914, '2023-02-28 11:29:55', 1371, 0, 0, 1361, 1361, 463, 10511, 11301),
(11915, '2023-02-28 11:29:58', 463, 0, 0, 463, 463, 0, 10511, 11301),
(11916, '2023-02-28 11:30:00', 0, 0, 0, 0, 0, 0, 10511, 11301),
(11917, '2023-02-28 11:30:04', 0, 0, 0, 0, 0, 0, 10511, 11301),
(11918, '2023-02-28 11:30:07', 0, 0, 0, 0, 0, 0, 10511, 11301),
(11919, '2023-02-28 11:30:10', 0, 0, 0, 0, 0, 0, 10516, 11301),
(11920, '2023-02-28 11:30:18', 0, 0, 0, 0, 0, 0, 10516, 11301),
(11921, '2023-02-28 11:30:21', 1326, 0, 8674, 0, 0, 0, 10516, 11301),
(11922, '2023-02-28 11:30:25', 447, 0, 8227, 0, 0, 0, 10516, 11301),
(11923, '2023-02-28 11:30:28', 0, 0, 8227, 0, 0, 0, 10516, 11301),
(11924, '2023-02-28 11:30:31', 0, 0, 8227, 0, 0, 0, 10516, 11301),
(11925, '2023-02-28 11:30:36', 0, 0, 8227, 0, 0, 0, 10516, 11301),
(11926, '2022-12-17 17:00:00', 0, 0, 0, 0, 0, 1319, 10501, 11302),
(11927, '2022-12-18 17:00:00', 1600, 0, 0, 1319, 1319, 1600, 10501, 11302),
(11928, '2022-12-19 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 11302),
(11929, '2022-12-20 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 11302),
(11930, '2022-12-21 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 11302),
(11931, '2022-12-22 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 11302),
(11932, '2022-12-23 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 11302),
(11933, '2022-12-24 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 11302),
(11934, '2022-12-25 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 11302),
(11935, '2022-12-26 17:00:00', 1600, 0, 0, 1600, 1600, 600, 10501, 11302),
(11936, '2022-12-27 17:00:00', 600, 0, 0, 600, 600, 0, 10501, 11302),
(11937, '2022-12-28 17:00:00', 0, 0, 0, 0, 0, 0, 10501, 11302),
(11938, '2022-12-16 17:00:00', 0, 0, 0, 0, 0, 468, 10502, 11302),
(11939, '2022-12-17 17:00:00', 0, 0, 0, 0, 0, 480, 10502, 11302),
(11940, '2022-12-18 17:00:00', 480, 0, 0, 468, 468, 480, 10502, 11302),
(11941, '2022-12-19 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 11302),
(11942, '2022-12-20 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 11302),
(11943, '2022-12-21 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 11302),
(11944, '2022-12-22 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 11302),
(11945, '2022-12-23 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 11302),
(11946, '2022-12-24 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 11302),
(11947, '2022-12-25 17:00:00', 480, 0, 0, 480, 480, 180, 10502, 11302),
(11948, '2022-12-26 17:00:00', 480, 0, 0, 480, 480, 0, 10502, 11302),
(11949, '2022-12-27 17:00:00', 180, 0, 0, 180, 180, 0, 10502, 11302),
(11950, '2022-12-28 17:00:00', 0, 0, 0, 0, 0, 0, 10502, 11302),
(11951, '2022-12-17 17:00:00', 0, 0, 0, 0, 0, 1120, 10503, 11302),
(11952, '2022-12-18 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11302),
(11953, '2022-12-19 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11302),
(11954, '2022-12-20 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11302),
(11955, '2022-12-21 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11302),
(11956, '2022-12-22 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11302),
(11957, '2022-12-23 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11302),
(11958, '2022-12-24 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11302),
(11959, '2022-12-25 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11302),
(11960, '2022-12-26 17:00:00', 1120, 0, 0, 1120, 1120, 420, 10503, 11302),
(11961, '2022-12-27 17:00:00', 420, 0, 0, 420, 420, 0, 10503, 11302),
(11962, '2022-12-28 17:00:00', 0, 0, 0, 0, 0, 0, 10503, 11302),
(12004, '2023-02-26 17:00:00', 0, 0, 0, 0, 0, 0, 10507, 11304),
(12005, '2023-02-27 17:00:00', 267, 0, 41, 0, 0, 225, 10507, 11304),
(12006, '2023-02-28 17:00:00', 267, 0, 0, 225, 225, 267, 10507, 11304),
(12007, '2023-03-01 17:00:00', 267, 0, 0, 267, 267, 267, 10507, 11304),
(12008, '2023-03-02 17:00:00', 267, 0, 0, 267, 267, 267, 10507, 11304),
(12009, '2023-03-03 17:00:00', 267, 0, 0, 267, 267, 267, 10507, 11304),
(12010, '2023-03-04 17:00:00', 267, 0, 0, 267, 267, 267, 10507, 11304),
(12011, '2023-03-05 17:00:00', 267, 0, 0, 267, 267, 217, 10507, 11304),
(12012, '2023-03-06 17:00:00', 217, 0, 0, 217, 217, 0, 10507, 11304),
(12013, '2023-03-07 17:00:00', 0, 0, 0, 0, 0, 0, 10507, 11304),
(12014, '2023-02-26 17:00:00', 0, 0, 0, 0, 0, 267, 10510, 11304),
(12015, '2023-02-27 17:00:00', 267, 0, 0, 267, 267, 267, 10510, 11304),
(12016, '2023-02-28 17:00:00', 267, 0, 0, 267, 267, 267, 10510, 11304),
(12017, '2023-03-01 17:00:00', 267, 0, 0, 267, 267, 267, 10510, 11304),
(12018, '2023-03-02 17:00:00', 267, 0, 0, 267, 267, 267, 10510, 11304),
(12019, '2023-03-03 17:00:00', 267, 0, 0, 267, 267, 267, 10510, 11304),
(12020, '2023-03-04 17:00:00', 267, 0, 0, 267, 267, 267, 10510, 11304),
(12021, '2023-03-05 17:00:00', 267, 0, 0, 267, 267, 217, 10510, 11304),
(12022, '2023-03-06 17:00:00', 217, 0, 0, 217, 217, 0, 10510, 11304),
(12023, '2023-03-07 17:00:00', 0, 0, 0, 0, 0, 0, 10510, 11304),
(12024, '2023-02-26 17:00:00', 0, 0, 0, 0, 0, 1600, 10511, 11304),
(12025, '2023-02-27 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10511, 11304),
(12026, '2023-02-28 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10511, 11304),
(12027, '2023-03-01 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10511, 11304),
(12028, '2023-03-02 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10511, 11304),
(12029, '2023-03-03 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10511, 11304),
(12030, '2023-03-04 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10511, 11304),
(12031, '2023-03-05 17:00:00', 1600, 0, 0, 1600, 1600, 1300, 10511, 11304),
(12032, '2023-03-06 17:00:00', 1300, 0, 0, 1300, 1300, 0, 10511, 11304),
(12033, '2023-03-07 17:00:00', 0, 0, 0, 0, 0, 0, 10511, 11304),
(12034, '2023-02-25 17:00:00', 0, 0, 0, 0, 0, 1067, 10516, 11304),
(12035, '2023-02-26 17:00:00', 0, 0, 0, 0, 0, 1067, 10516, 11304),
(12036, '2023-02-27 17:00:00', 1067, 0, 0, 1067, 1067, 1067, 10516, 11304),
(12037, '2023-02-28 17:00:00', 1067, 0, 0, 1067, 1067, 1067, 10516, 11304),
(12038, '2023-03-01 17:00:00', 1067, 0, 0, 1067, 1067, 1067, 10516, 11304),
(12039, '2023-03-02 17:00:00', 1067, 0, 0, 1067, 1067, 1067, 10516, 11304),
(12040, '2023-03-03 17:00:00', 1067, 0, 0, 1067, 1067, 1067, 10516, 11304),
(12041, '2023-03-04 17:00:00', 1067, 0, 0, 1067, 1067, 867, 10516, 11304),
(12042, '2023-03-05 17:00:00', 1067, 0, 0, 1067, 1067, 0, 10516, 11304),
(12043, '2023-03-06 17:00:00', 867, 0, 0, 867, 867, 0, 10516, 11304),
(12044, '2023-03-07 17:00:00', 0, 0, 0, 0, 0, 0, 10516, 11304),
(12045, '2023-02-27 17:00:00', 0, 0, 0, 0, 0, 1600, 10501, 11305),
(12046, '2023-02-28 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 11305),
(12047, '2023-03-01 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 11305),
(12048, '2023-03-02 17:00:00', 1600, 0, 0, 1600, 1600, 1600, 10501, 11305),
(12049, '2023-03-03 17:00:00', 1600, 0, 0, 1600, 1600, 12, 10501, 11305),
(12050, '2023-03-04 17:00:00', 12, 0, 0, 12, 12, 0, 10501, 11305),
(12051, '2023-02-26 17:00:00', 0, 0, 0, 0, 0, 480, 10502, 11305),
(12052, '2023-02-27 17:00:00', 0, 0, 0, 0, 0, 480, 10502, 11305),
(12053, '2023-02-28 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 11305),
(12054, '2023-03-01 17:00:00', 480, 0, 0, 480, 480, 480, 10502, 11305),
(12055, '2023-03-02 17:00:00', 480, 0, 0, 480, 480, 4, 10502, 11305),
(12056, '2023-03-03 17:00:00', 480, 0, 0, 480, 480, 0, 10502, 11305),
(12057, '2023-03-04 17:00:00', 4, 0, 0, 4, 4, 0, 10502, 11305),
(12058, '2023-02-27 17:00:00', 0, 0, 0, 0, 0, 1120, 10503, 11305),
(12059, '2023-02-28 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11305),
(12060, '2023-03-01 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11305),
(12061, '2023-03-02 17:00:00', 1120, 0, 0, 1120, 1120, 1120, 10503, 11305),
(12062, '2023-03-03 17:00:00', 1120, 0, 0, 1120, 1120, 8, 10503, 11305),
(12063, '2023-03-04 17:00:00', 8, 0, 0, 8, 8, 0, 10503, 11305);

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
(10501, 10810, 10, 5850),
(10501, 10811, 150, 15000),
(10501, 10812, 10, 5850),
(10501, 10813, 111, 5850),
(10501, 10814, 10, 5850),
(10502, 10802, 1300, 4600),
(10502, 10810, 5, 4600),
(10502, 10812, 12, 4600),
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
(10501, 10711, 10, 90),
(10501, 10712, 10, 10000),
(10501, 10717, 150, 15000),
(10501, 10718, 10, 5850),
(10501, 10719, 111, 5850),
(10501, 10720, 10, 5850),
(10501, 10721, 100, 1000),
(10502, 10702, 1300, 4600),
(10502, 10709, 10, 4600),
(10502, 10718, 12, 4600),
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
(10504, 10917, 4440, 25200),
(10504, 10918, 404, 25200),
(10504, 10919, 1, 25200),
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
(10504, 11701, 1200, 10, 1210),
(10504, 11702, 1200, 13, 1213),
(10504, 11704, 100, 10, 110),
(10504, 11705, 30, 1, 31),
(10504, 11707, 10, 1, 11),
(10505, 11701, 30000, 200, 30200),
(10505, 11702, 500, 10, 510),
(10505, 11704, 230, 1, 231),
(10505, 11707, 30, 1, 31),
(10520, 11704, 30, 1, 31),
(10520, 11706, 32, 2, 34),
(10521, 11703, 120, 3, 123),
(10521, 11706, 20, 1, 21),
(10521, 11708, 12, 1, 13),
(10522, 11703, 100, 2, 102),
(10522, 11705, 45, 2, 47),
(10522, 11706, 18, 1, 19),
(10522, 11708, 20, 2, 22);

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
(10506, 11108, '2023-03-01', '2023-03-05', 12824),
(10509, 11101, '2023-01-06', '2023-01-17', 4280),
(10509, 11102, '2023-01-11', '2023-01-18', 10448),
(10509, 11104, '2023-02-01', '2023-02-03', 3),
(10509, 11106, '2023-02-16', '2023-02-23', 30000),
(10512, 11104, '2023-02-01', '2023-02-04', 8),
(10519, 11107, '2023-02-28', '2023-03-02', 5000),
(10519, 11108, '2023-03-06', '2023-03-09', 8325),
(10523, 11107, '2023-02-28', '2023-03-08', 25000);

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
(10601, 'Flok I', 'Ayam DOC Gel. 05', 'Cage 1-6	', 'Lohman Platinum	', 11330, '26 mg/6\r\n', 95, 'gr', NULL, NULL, NULL),
(10602, 'Flok II', 'Ayam DOC Gel. 02', 'Cage 1-4	', 'Lohman Platinum', 7239, '50 mg/6\r\n', 110, 'gr', NULL, NULL, NULL),
(10603, 'Flok III', 'Ayam DOC Gel. 02', 'Cage 1-4	', 'Lohman Platinum', 7239, '78 mg/6\r\n', 115, 'gr', NULL, NULL, NULL),
(10604, 'Flok IV', 'Ayam DOC Gel. 03', 'Cage 1-6', 'Lohman Platinum', 10867, '63 mg/3\r\n', 118, 'gr', NULL, NULL, NULL),
(10605, 'Flok V', 'Ayam DOC Gel. 04', 'Cage 1-8	', 'Lohman Platinum', 11579, '44 mg/1', 117, 'gr', NULL, NULL, NULL),
(10606, 'Flok VI', 'Ayam DOC Gel. 06', '1', 'Lohman Platinum', 11111, '3 mg/1', 30, 'gr', '2023-02-25 00:24:59', '2023-02-25 00:24:59', NULL);

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
(10101, 'Direktur', NULL, NULL, NULL),
(10102, 'Manajer Logistik', NULL, NULL, NULL),
(10103, 'Manajer Marketing & HUMAS', NULL, NULL, NULL),
(10104, 'Manajer Produksi', NULL, NULL, NULL),
(10105, 'Manajer Keuangan', NULL, NULL, NULL),
(10106, 'Mandor Kandang', NULL, NULL, NULL),
(10107, 'Mandor Gudang Telur', NULL, NULL, NULL),
(10108, 'Mandor Gudang Pakan', NULL, '2022-12-20 01:22:13', '2022-12-20 01:21:11');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pakan`
--

CREATE TABLE `jadwal_pakan` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `tgl_pemberian` date NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `keterangan` varchar(150) DEFAULT NULL,
  `pengguna_id` int(11) NOT NULL,
  `flok_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal_pakan`
--

INSERT INTO `jadwal_pakan` (`id`, `barang_id`, `tgl_pemberian`, `kuantitas`, `keterangan`, `pengguna_id`, `flok_id`) VALUES
(11801, 10509, '2023-02-01', 200, NULL, 10203, 10602),
(11802, 10506, '2023-02-03', 4000, NULL, 10203, 10601);

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
(11201, '2022-12-19', '2022-12-23', 4280, 'selesai produksi', 11101, 10509, NULL, '2023-02-28 07:05:32', NULL),
(11202, '2022-12-19', '2022-12-29', 30000, 'proses produksi', 11101, 10506, NULL, '2023-02-28 12:16:34', NULL),
(11203, '2023-02-28', '2023-03-08', 25000, 'proses produksi', 11107, 10523, '2023-02-28 11:48:47', '2023-02-28 12:36:00', NULL),
(11204, '2023-03-01', '2023-03-05', 12824, 'proses produksi', 11108, 10506, '2023-02-28 12:38:02', '2023-02-28 12:38:47', NULL);

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
(11301, 11201, 11006),
(11302, 11202, 11001),
(11304, 11203, 11009),
(11305, 11204, 11001);

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
  `pengguna_id` int(11) NOT NULL,
  `nota_pemesanan_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `nota_pembelian`
--

INSERT INTO `nota_pembelian` (`id`, `no_nota`, `tgl_pembuatan_nota`, `total_harga`, `cara_bayar`, `keterangan`, `pengguna_id`, `nota_pemesanan_id`, `supplier_id`) VALUES
(10801, '20230219-02-001', '2022-12-19', 56941600, 'tunai', NULL, 10201, 10701, 10402),
(10802, '20230226-02-001', '2022-12-26', 25737000, 'tunai', NULL, 10201, 10702, 10401),
(10809, '20230204-02-002', '2023-02-04', 160000, 'tunai', NULL, 10201, 10713, 10402),
(10810, '20230208-02-001', '2023-02-08', 81500, 'transfer', 'transfer bni 23200 an Jeremy', 10201, 10708, 10401),
(10811, '20230226-02-001', '2023-02-26', 2250000, 'tunai', NULL, 10201, 10717, 10401),
(10812, '20230226-02-002', '2023-02-26', 113700, 'transfer', 'transfer bca 23200 an Baiq', 10201, 10718, 10401),
(10813, '20230226-02-003', '2023-02-26', 649350, 'tunai', '', 10201, 10719, 10405),
(10814, '20230227-02-001', '2023-02-27', 58500, 'tunai', '', 10201, 10720, 10405);

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
(10701, '20221212-01-001', '2022-12-12', 56941600, 'beli', 10201, 10402, NULL, '2023-02-05 22:08:01', NULL),
(10702, '20221220-01-001', '2022-12-20', 25737000, 'beli', 10201, 10401, NULL, NULL, NULL),
(10708, '20230204-01-001', '2023-02-04', 81500, 'beli', 10201, 10401, NULL, '2023-02-04 07:56:27', '2023-02-04 07:56:27'),
(10709, '20230204-01-002', '2023-02-04', 246000, 'batal', 10201, 10401, NULL, '2023-02-04 08:06:52', '2023-02-04 08:06:52'),
(10710, '20230204-01-003', '2023-02-04', 450000, 'batal', 10201, 10402, NULL, '2023-02-04 08:07:30', '2023-02-04 08:07:30'),
(10711, '20230204-01-004', '2023-02-04', 900, 'batal', 10201, 10401, NULL, '2023-02-04 08:08:11', '2023-02-04 08:08:11'),
(10712, '20230204-01-005', '2023-02-04', 100000, 'batal', 10201, 10401, NULL, '2023-02-04 09:31:30', '2023-02-04 09:31:30'),
(10713, '20230204-01-006', '2023-02-04', 200000, 'beli', 10201, 10402, NULL, '2023-02-04 09:32:42', '2023-02-04 09:32:42'),
(10714, '20230204-01-007', '2023-02-04', 10000000, 'batal', 10201, 10401, NULL, '2023-02-04 09:48:41', '2023-02-04 09:48:41'),
(10715, '20230206-01-001', '2023-02-06', 19550000, 'batal', 10201, 10401, NULL, '2023-02-06 00:48:12', '2023-02-06 00:48:12'),
(10716, '20230206-01-002', '2023-02-06', 11550000, 'batal', 10201, 10401, NULL, '2023-02-06 00:49:34', '2023-02-06 00:49:34'),
(10717, '20230206-01-003', '2023-02-06', 2250000, 'beli', 10201, 10401, NULL, '2023-02-26 03:11:27', '2023-02-06 00:51:04'),
(10718, '20230226-01-001', '2023-02-26', 113700, 'beli', 10201, 10401, NULL, '2023-02-26 03:38:43', '2023-02-26 03:38:27'),
(10719, '20230226-01-002', '2023-02-26', 649350, 'beli', 10201, 10405, NULL, '2023-02-26 04:04:20', '2023-02-26 04:03:59'),
(10720, '20230227-01-001', '2023-02-27', 58500, 'batal', 10201, 10405, NULL, '2023-02-27 01:36:33', '2023-02-27 01:35:57'),
(10721, '20230227-01-002', '2023-02-27', 100000, 'dalam proses', 10201, 10401, NULL, '2023-02-27 01:39:07', '2023-02-27 01:39:07');

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
(10901, '10.02-10.31', '2022-06-04', 13257000, 'tunai', NULL, 10201, 10301),
(10910, '20230204-03-001', '2023-02-04', 46000, 'tunai', NULL, 10201, 10301),
(10911, '20230204-03-002', '2023-02-04', 92000, 'tunai', NULL, 10201, 10302),
(10912, '20230204-03-003', '2023-02-04', 92000, 'tunai', NULL, 10201, 10303),
(10913, '20230204-03-004', '2023-02-04', 104500, 'tunai', NULL, 10201, 10302),
(10914, '20230204-03-005', '2023-02-04', 12221, 'tunai', NULL, 10201, 10301),
(10915, '20230206-03-001', '2023-02-06', 300000000, 'tunai', NULL, 10201, 10301),
(10916, '20230206-03-002', '2023-02-06', 301500000, 'transfer', 'trf an maulidya 2212000', 10201, 10301),
(10917, '20230226-03-001', '2023-02-26', 111888000, 'transfer', NULL, 10201, 10304),
(10918, '20230226-03-002', '2023-02-26', 10180800, 'transfer', NULL, 10201, 10302),
(10919, '20230226-03-003', '2023-02-26', 25200, 'transfer', NULL, 10201, 10302);

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
(11701, '2023-01-25', 4, 1, 1, 'Telur reject dibuang', 10201, 10601, '2023-01-25 10:00:00', NULL, NULL),
(11702, '2023-02-26', 0, 0, 0, NULL, 10201, 10603, '2023-02-28 04:32:01', NULL, '2023-02-28 04:32:01'),
(11703, '2023-02-28', 0, 0, 2, NULL, 10201, 10601, '2023-02-28 04:45:16', NULL, '2023-02-28 04:45:16'),
(11704, '2023-02-28', 0, 0, 0, NULL, 10201, 10602, '2023-02-28 04:47:06', NULL, '2023-02-28 04:47:06'),
(11705, '2023-02-28', 0, 1, 0, NULL, 10201, 10604, '2023-02-28 04:47:43', NULL, '2023-02-28 04:47:43'),
(11706, '2023-02-28', 1, 0, 0, 'Telur reject dibuang', 10201, 10605, '2023-02-28 04:50:30', NULL, '2023-02-28 04:50:30'),
(11707, '2023-02-28', 1, 0, 0, NULL, 10201, 10603, '2023-02-28 05:00:37', NULL, '2023-02-28 05:00:37'),
(11708, '2023-02-28', 0, 0, 0, NULL, 10201, 10606, '2023-02-28 05:25:35', NULL, '2023-02-28 05:25:35');

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
(11401, '20221221-02-02-001', '2022-12-21', 'Kirim ke tim produksi sore', 10201),
(11402, '20221213-02-02-001', '2022-12-13', 'Kirim ke tim produksi pagi', 10201),
(11404, '20230201-02-02-001', '2023-02-01', '', 10201),
(11405, '20230201-02-02-002', '2023-02-01', NULL, 10201),
(11406, '20230201-02-02-003', '2023-02-01', '', 10201),
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
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `username`, `password`, `jabatan_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10201, 'Manajer Marketing & HUMAS', 'marketing1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10103, '2023-02-23 10:23:34', '0000-00-00 00:00:00', NULL),
(10202, 'Direktur', 'direktur1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10101, '2023-02-23 10:23:38', '0000-00-00 00:00:00', NULL),
(10203, 'Manajer Logistik', 'logistik1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10102, '2023-02-23 10:23:43', '0000-00-00 00:00:00', NULL),
(10204, 'Manajer Produksi', 'produksi1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10104, '2023-02-23 10:23:47', '0000-00-00 00:00:00', NULL),
(10205, 'Manajer Keuangan', 'keuangan1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10105, '2023-02-23 10:23:52', '0000-00-00 00:00:00', NULL),
(10206, 'Manajer Kandang', 'kandang1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10106, '2023-02-23 10:23:55', '0000-00-00 00:00:00', NULL),
(10207, 'Mandor Gudang Telur', 'telur1', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10107, '2023-02-23 10:23:59', '0000-00-00 00:00:00', NULL),
(10208, 'Lorem Ipsum is simply dummy text of the print', 'Lorem Ipsum is simpl', '$2y$10$WVGRsOxdsthx1/nVDJ/8w.0iCXG3CUvtmADnhdkJQAw0BQsUWfYJy', 10108, '2023-02-27 17:24:35', '2023-02-27 10:24:35', '2023-02-27 10:24:35');

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
(10403, 'CV Indah Pribadi', 'Tes gatau', '081278888', NULL, '2023-02-20 06:48:26', '2023-02-08 04:54:14'),
(10404, 'PT Hijau Daun', '111', '111', NULL, '2023-02-25 00:06:16', '2023-02-25 00:06:16'),
(10405, 'UD Abu Bakar', 'Jalan Sukoharjo 10, Bali', '08129330020', NULL, '2023-02-25 00:29:39', '2023-02-25 00:29:28');

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
(11601, '13.05-12.12', '2022-12-26', NULL, 'dalam pengiriman', 10201),
(11603, '13.05-12.12', '2022-12-24', 'Coba', 'dalam pengiriman', 10201),
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
(11101, '20221201-02-01-001', '2022-12-01', NULL, 10201),
(11102, '20221201-02-01-002', '2022-12-01', NULL, 10201),
(11103, '20230201-02-01-001', '2023-02-01', NULL, 10201),
(11104, '20230201-02-01-002', '2023-02-01', NULL, 10201),
(11105, '20230209-02-01-001', '2023-02-09', 'Dikerjakan segera', 10201),
(11106, '20230209-02-01-002', '2023-02-09', NULL, 10201),
(11107, '20230228-02-01-001', '2023-02-28', NULL, 10201),
(11108, '20230228-02-01-002', '2023-02-28', NULL, 10201);

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jadwal_pakan_barang1_idx` (`barang_id`),
  ADD KEY `fk_jadwal_pakan_pengguna1_idx` (`pengguna_id`),
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
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10524;

--
-- AUTO_INCREMENT for table `bom`
--
ALTER TABLE `bom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11010;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10306;

--
-- AUTO_INCREMENT for table `daftar_hasil_produksi`
--
ALTER TABLE `daftar_hasil_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11508;

--
-- AUTO_INCREMENT for table `d_mrp`
--
ALTER TABLE `d_mrp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12064;

--
-- AUTO_INCREMENT for table `flok`
--
ALTER TABLE `flok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10607;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10109;

--
-- AUTO_INCREMENT for table `mps`
--
ALTER TABLE `mps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11205;

--
-- AUTO_INCREMENT for table `mrp`
--
ALTER TABLE `mrp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11306;

--
-- AUTO_INCREMENT for table `nota_pembelian`
--
ALTER TABLE `nota_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10815;

--
-- AUTO_INCREMENT for table `nota_pemesanan`
--
ALTER TABLE `nota_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10722;

--
-- AUTO_INCREMENT for table `nota_penjualan`
--
ALTER TABLE `nota_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10920;

--
-- AUTO_INCREMENT for table `pemasukan_telur`
--
ALTER TABLE `pemasukan_telur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11709;

--
-- AUTO_INCREMENT for table `pengeluaran_bahan_baku`
--
ALTER TABLE `pengeluaran_bahan_baku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11410;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10209;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10406;

--
-- AUTO_INCREMENT for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11606;

--
-- AUTO_INCREMENT for table `surat_perintah_kerja`
--
ALTER TABLE `surat_perintah_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11109;

--
-- Constraints for dumped tables
--

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
