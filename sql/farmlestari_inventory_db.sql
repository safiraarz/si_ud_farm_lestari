-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2023 at 09:05 AM
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
  `estimasi_bulan` int(11) NOT NULL,
  `nota_pembelian_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `harga` int(11) DEFAULT NULL,
  `lead_time` int(11) DEFAULT NULL,
  `kuantitas_stok_onorder_supplier` int(11) DEFAULT NULL,
  `kuantitas_stok_onorder_produksi` int(11) DEFAULT NULL,
  `kuantitas_stok_pengaman` int(11) NOT NULL,
  `kuantitas_stok_ready` int(11) DEFAULT NULL,
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
(10501, 'Jagung A', 5850, 1, 10474, 500, 200, 10424, 23171, 'Bahan Baku', 'kg', NULL, '2023-02-04 09:31:30', NULL),
(10502, 'Katul', 4600, 1, 607, 1200, 9200, 547, 10966, 'Bahan Baku', 'kg', NULL, '2023-02-04 08:06:52', NULL),
(10503, 'K 36 SPR', 9550, 1, 5010, 6500, 0, 5000, 23500, 'Bahan Baku', 'kg', NULL, '2023-02-04 07:46:04', NULL),
(10504, 'Telur A3', 25200, NULL, NULL, NULL, 0, NULL, 12000, 'Barang Jadi', 'kg', NULL, NULL, NULL),
(10505, 'Telur A1', 24300, NULL, NULL, NULL, 0, NULL, 50000, 'Barang Jadi', 'kg', NULL, NULL, NULL),
(10506, 'Pakan Jadi Super', 7035, NULL, NULL, 4000, 41000, 41000, 45000, 'Barang Jadi', 'kg', NULL, NULL, NULL),
(10507, 'Premix (Metabolizer)', 45000, 1, 1208, 8200, 3000, 3002, 12410, 'Bahan Baku', 'kg', NULL, '2023-02-04 08:07:30', NULL),
(10508, 'Ciromecyne 10%', 88000, 1, 6500, 3000, 1000, 1000, 10500, 'Bahan Baku', 'kg', NULL, NULL, NULL),
(10509, 'Pakan Jadi A', 8000, NULL, NULL, 4280, 4300, 4300, 8580, 'Barang Jadi', 'kg', NULL, NULL, NULL),
(10510, 'Tes Tambah', 10000, 1, 30, 10, 10, 10, 50, 'Bahan Baku', '15', NULL, '2023-02-04 08:06:52', '2022-12-21 07:24:22'),
(10511, 'Tes Tambah 2', 30000, 1, 10, 11, 12, 12, 13, 'Bahan Baku', 'kg', NULL, '2022-12-21 07:24:49', '2022-12-21 07:24:49'),
(10512, 'Test barang masuk edit', 20000, 100, 111, 111, 10000, 100, 322, 'Barang Jadi', 'kg', NULL, '2023-02-04 09:35:20', '2023-01-31 17:56:42'),
(10513, '111', 1000000, 111, 21, 11, 1000, 19, 51, 'Bahan Baku', 'kg', NULL, '2023-02-04 09:48:41', '2023-01-31 18:18:37');

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
(10303, 'Tes Tambah', 'Tes Tambah', 'Tes Tambah Cust', NULL, '2022-12-23 07:19:23', '2022-12-20 01:08:20');

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
  `keterangan` varchar(100) DEFAULT NULL,
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
  `barang_id` int(11) NOT NULL,
  `MRP_id` int(11) NOT NULL,
  `periode` int(11) NOT NULL,
  `GR` int(11) NOT NULL,
  `SR` int(11) NOT NULL,
  `OHI` int(11) NOT NULL,
  `NR` int(11) NOT NULL,
  `POR` int(11) NOT NULL,
  `PORel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(10502, 10802, 1300, 4600),
(10502, 10808, 5, 4600),
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
(10505, 10901, 1100, 24300),
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
(10505, 11604, 1, 1, 1),
(10505, 11605, 1, 2, 3),
(10505, 11606, 1, 2, 1),
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
(10513, 11406, 2);

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
(10509, 11101, '2023-01-06', '2023-01-17', 4280),
(10509, 11102, '2023-01-11', '2023-01-18', 10448),
(10509, 11104, '2023-02-01', '2023-02-03', 3),
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
  `usia_hari` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `flok`
--

INSERT INTO `flok` (`id`, `nama`, `keterangan`, `cage`, `strain`, `populasi`, `usia_hari`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10601, 'Flok I', 'Ayam DOC Gel. 05', 'Cage 1-6	', 'Lohman Platinum	', 11330, '26 mg/6\r\n', NULL, NULL, NULL),
(10602, 'Flok II', 'Ayam DOC Gel. 02', 'Cage 1-4	', 'Lohman Platinum', 7239, '50 mg/6\r\n', NULL, NULL, NULL),
(10603, 'Flok III', 'Ayam DOC Gel. 02', 'Cage 1-4	', 'Lohman Platinum', 7239, '78 mg/6\r\n', NULL, NULL, NULL),
(10604, 'Flok IV', 'Ayam DOC Gel. 03', 'Cage 1-6', 'Lohman Platinum', 10867, '63 mg/3\r\n', NULL, NULL, NULL),
(10605, 'Flok V', 'Ayam DOC Gel. 04', 'Cage 1-8	', 'Lohman Platinum', 11579, '44 mg/1', NULL, NULL, NULL),
(10606, 'Flok AB Edited', '', '', '', 0, '0', NULL, NULL, NULL),
(10607, 'Flok Coba Edit', 'Gelombang 1', 'Cage 5', 'Longham', 1200, '2 mg/3', '2023-01-25 10:06:09', '2023-01-25 10:10:28', NULL);

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
(10108, 'Mandor Gudang Pakan', NULL, '2022-12-20 01:22:13', '2022-12-20 01:21:11');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_pakan`
--

CREATE TABLE `jadwal_pakan` (
  `tgl_pemberian` date NOT NULL,
  `barang_id` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
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
('2022-12-15', 10506, 17800, NULL, 10205, 10604, NULL, NULL, NULL),
('2022-12-13', 10509, 16900, NULL, 10205, 10601, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mps`
--

CREATE TABLE `mps` (
  `id` int(11) NOT NULL,
  `tgl_mulai_produksi` date NOT NULL,
  `tgl_selesai_produksi` date NOT NULL,
  `kuantitas_barang_jadi` int(11) NOT NULL,
  `surat_perintah_kerja_id` int(11) DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mps`
--

INSERT INTO `mps` (`id`, `tgl_mulai_produksi`, `tgl_selesai_produksi`, `kuantitas_barang_jadi`, `surat_perintah_kerja_id`, `barang_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(11201, '2022-12-19', '2022-12-23', 4280, 11101, 10509, NULL, NULL, NULL),
(11202, '2022-12-19', '2022-12-23', 4000, 11101, 10506, NULL, NULL, NULL),
(11206, '2023-02-01', '2023-02-02', 10, 11103, 10505, '2023-01-31 23:39:13', '2023-01-31 23:39:13', NULL),
(11207, '2023-02-01', '2023-02-02', 10, 11103, 10506, '2023-01-31 23:39:13', '2023-01-31 23:39:13', NULL),
(11208, '2023-02-01', '2023-02-04', 10, 11104, 10512, '2023-02-04 00:26:47', '2023-02-04 00:26:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mrp`
--

CREATE TABLE `mrp` (
  `id` int(11) NOT NULL,
  `MPS_id` int(11) NOT NULL,
  `BOM_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(10801, '19.12.19.01', '2022-12-19', 56941600, 'tunai', NULL, 10204, 10701, 10402),
(10802, '51.20-52.20', '2022-12-26', 25737000, 'tunai', NULL, 10209, 10702, 10401),
(10808, '20230204-02-001', '2023-02-04', 63950, 'tunai', NULL, 10201, 10708, 10401),
(10809, '20230204-02-002', '2023-02-04', 160000, 'tunai', NULL, 10201, 10713, 10402);

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
(10701, '12.12-12.03', '2022-12-12', 56941600, 'dalam proses', 10204, 10402, NULL, NULL, NULL),
(10702, '11.01-12.01', '2022-12-20', 25737000, 'dalam proses', 10209, 10401, NULL, NULL, NULL),
(10708, '20230204-01-001', '2023-02-04', 81500, '', 10201, 10401, NULL, '2023-02-04 07:56:27', '2023-02-04 07:56:27'),
(10709, '20230204-01-002', '2023-02-04', 246000, '', 10201, 10401, NULL, '2023-02-04 08:06:52', '2023-02-04 08:06:52'),
(10710, '20230204-01-003', '2023-02-04', 450000, '', 10201, 10402, NULL, '2023-02-04 08:07:30', '2023-02-04 08:07:30'),
(10711, '20230204-01-004', '2023-02-04', 900, '', 10201, 10401, NULL, '2023-02-04 08:08:11', '2023-02-04 08:08:11'),
(10712, '20230204-01-005', '2023-02-04', 100000, '', 10201, 10401, NULL, '2023-02-04 09:31:30', '2023-02-04 09:31:30'),
(10713, '20230204-01-006', '2023-02-04', 200000, '', 10201, 10402, NULL, '2023-02-04 09:32:42', '2023-02-04 09:32:42'),
(10714, '20230204-01-007', '2023-02-04', 10000000, '', 10201, 10401, NULL, '2023-02-04 09:48:41', '2023-02-04 09:48:41');

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
(10914, '20230204-03-005', '2023-02-04', 12221, 'tunai', NULL, 10201, 10301);

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
  `keterangan` varchar(100) DEFAULT NULL,
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
(11606, '2023-02-01', 2, 2, 3, 'Test Keterangan', 10201, 10607, '2023-01-31 22:00:42', NULL, '2023-01-31 22:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran_bahan_baku`
--

CREATE TABLE `pengeluaran_bahan_baku` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(45) NOT NULL,
  `tgl_pengeluaran_barang` date NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
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
(11406, '20230201-02-02-003', '2023-02-01', 'Test Tambah LPB 3', 10201);

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
(10210, 'testlogin', 'testlogin', '$2y$10$/4CpDo95DqjFHw6b1cLN6eid738j5B18bH6q7DRgGOX0QC23rTb9O', 10102, '2023-01-31 17:45:16', '2023-01-31 17:45:16');

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
(10402, 'Manunggal Jaya', 'Jl Kyai Radiman RT. 06, RW. 02, Krajan Bantur, Malang', '081334325774', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surat_jalan`
--

CREATE TABLE `surat_jalan` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(45) NOT NULL,
  `tgl_pengiriman_barang` date NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `pengguna_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surat_jalan`
--

INSERT INTO `surat_jalan` (`id`, `no_surat`, `tgl_pengiriman_barang`, `keterangan`, `pengguna_id`) VALUES
(11601, '13.05-12.12', '2022-12-26', NULL, 10208),
(11603, '13.05-12.12', '2022-12-24', 'Coba', 10206),
(11604, '20230201-02-03-001', '2023-02-01', NULL, 10201),
(11605, '20230201-02-03-002', '2023-02-01', 'Test input surat jalan', 10201);

-- --------------------------------------------------------

--
-- Table structure for table `surat_perintah_kerja`
--

CREATE TABLE `surat_perintah_kerja` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(45) NOT NULL,
  `tgl_pembuatan_surat` date NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `pengguna_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `surat_perintah_kerja`
--

INSERT INTO `surat_perintah_kerja` (`id`, `no_surat`, `tgl_pembuatan_surat`, `keterangan`, `pengguna_id`) VALUES
(11101, '12.123-13.021', '2022-12-01', NULL, 10208),
(11102, '13.06.01-12.12.01', '2022-12-01', NULL, 10208),
(11103, '20230201-02-01-001', '2023-02-01', NULL, 10201),
(11104, '20230201-02-01-002', '2023-02-01', 'jjj', 10201);

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
  ADD PRIMARY KEY (`barang_id`,`MRP_id`),
  ADD KEY `fk_barang_has_MRP_MRP1_idx` (`MRP_id`),
  ADD KEY `fk_barang_has_MRP_barang1_idx` (`barang_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10304;

--
-- AUTO_INCREMENT for table `daftar_hasil_produksi`
--
ALTER TABLE `daftar_hasil_produksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11508;

--
-- AUTO_INCREMENT for table `flok`
--
ALTER TABLE `flok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10608;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10109;

--
-- AUTO_INCREMENT for table `mps`
--
ALTER TABLE `mps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11209;

--
-- AUTO_INCREMENT for table `mrp`
--
ALTER TABLE `mrp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nota_pembelian`
--
ALTER TABLE `nota_pembelian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10810;

--
-- AUTO_INCREMENT for table `nota_pemesanan`
--
ALTER TABLE `nota_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10715;

--
-- AUTO_INCREMENT for table `nota_penjualan`
--
ALTER TABLE `nota_penjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10915;

--
-- AUTO_INCREMENT for table `pemasukan_telur`
--
ALTER TABLE `pemasukan_telur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11607;

--
-- AUTO_INCREMENT for table `pengeluaran_bahan_baku`
--
ALTER TABLE `pengeluaran_bahan_baku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11407;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10211;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10403;

--
-- AUTO_INCREMENT for table `surat_jalan`
--
ALTER TABLE `surat_jalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11606;

--
-- AUTO_INCREMENT for table `surat_perintah_kerja`
--
ALTER TABLE `surat_perintah_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11105;

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
  ADD CONSTRAINT `fk_barang_has_MRP_MRP1` FOREIGN KEY (`MRP_id`) REFERENCES `mrp` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_barang_has_MRP_barang1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
