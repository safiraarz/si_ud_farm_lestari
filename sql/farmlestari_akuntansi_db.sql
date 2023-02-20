-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 20 Feb 2023 pada 09.06
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Struktur dari tabel `akun`
--

CREATE TABLE `akun` (
  `no_akun` varchar(15) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `jenis_akun` enum('aset','kewajiban','ekuitas','pendapatan','biaya') DEFAULT NULL,
  `saldo_awal` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleteed_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `akun`
--

INSERT INTO `akun` (`no_akun`, `nama`, `jenis_akun`, `saldo_awal`, `created_at`, `updated_at`, `deleteed_at`) VALUES
('000', 'Ihtisar Labar Rugi', NULL, 0, NULL, NULL, NULL),
('101', 'Kas di Tangan', 'aset', 50000000, NULL, NULL, NULL),
('102', 'Kas di Bank', 'aset', 150000000, '2023-02-06 07:29:37', '2023-02-06 07:29:37', NULL),
('103', 'Piutang Usaha', 'aset', 25000000, NULL, NULL, NULL),
('104', 'Perlengkapan Habis Pakai', 'aset', 15000000, NULL, NULL, NULL),
('105', 'Sewa Gedung Dibayar di Muka', 'aset', 1000000, NULL, NULL, NULL),
('110', 'Peralatan', 'aset', 30000000, NULL, NULL, NULL),
('111', 'Akumulasi Penyusutan Peralatan', 'aset', 12000000, NULL, NULL, NULL),
('201', 'Hutang Bank \'Masa Depan\'', 'kewajiban', 9000000, NULL, NULL, NULL),
('202', 'Hutang Bank \'Untung Terus\'', 'kewajiban', 13000000, NULL, NULL, NULL),
('203', 'Uang Muka Jasa Dekorasi', 'kewajiban', 20000000, NULL, NULL, NULL),
('204', 'Uang Muka Sewa Sound System', 'kewajiban', 17000000, NULL, NULL, NULL),
('301', 'Modal Callista', 'ekuitas', 200000000, NULL, NULL, NULL),
('302', 'Prive', 'ekuitas', 0, NULL, NULL, NULL),
('401', 'Pendapatan Jasa Dekorasi', 'pendapatan', 0, '2023-02-06 07:31:43', '2023-02-06 07:31:43', NULL),
('402', 'Pendapatan Sewa Sound System', 'pendapatan', 0, NULL, NULL, NULL),
('501', 'Biaya Gaji', 'biaya', 0, '2023-02-06 07:33:14', '2023-02-06 07:33:14', NULL),
('502', 'Biaya Sewa Gedung', 'biaya', 0, NULL, NULL, NULL),
('503', 'Biaya Perlengkapan Habis Pakai', 'biaya', 0, NULL, NULL, NULL),
('504', 'Biaya Penyusutan Peralatan', 'biaya', 0, NULL, NULL, NULL),
('505', 'Biaya Transportasi', 'biaya', 0, NULL, NULL, NULL),
('506', 'Biaya Listrik, Air, Telepon', 'biaya', 0, NULL, NULL, NULL),
('507', 'Biaya Lain Lain', 'biaya', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal`
--

CREATE TABLE `jurnal` (
  `id` int(11) NOT NULL,
  `jenis` enum('umum','penyesuaian','penutup') DEFAULT NULL,
  `tanggal_transaksi` date DEFAULT NULL,
  `no_bukti` varchar(45) DEFAULT NULL,
  `transaksi_id` int(11) NOT NULL,
  `periode_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jurnal`
--

INSERT INTO `jurnal` (`id`, `jenis`, `tanggal_transaksi`, `no_bukti`, `transaksi_id`, `periode_id`) VALUES
(1, 'umum', '2023-02-01', 'T00001', 1, 20201),
(2, 'umum', '2023-02-02', 'T00002', 2, 20201),
(3, 'umum', '2023-02-03', 'T00003', 3, 20201),
(4, 'umum', '2023-02-04', 'T00004', 4, 20201),
(5, 'umum', '2023-02-05', 'T00005', 5, 20201),
(6, 'umum', '2023-02-06', 'T00006', 18, 20201),
(7, 'umum', '2023-02-07', 'T00007', 6, 20201),
(8, 'umum', '2023-02-08', 'T00008', 7, 20201),
(9, 'umum', '2023-02-09', 'T00009', 8, 20201),
(10, 'umum', '2023-02-10', 'T000010', 9, 20201),
(11, 'penyesuaian', '2023-02-11', 'P00001', 10, 20201),
(12, 'penyesuaian', '2023-02-12', 'P00002', 11, 20201),
(13, 'penyesuaian', '2023-02-13', 'P00003', 12, 20201),
(14, 'penyesuaian', '2023-02-14', 'P00004', 13, 20201),
(15, 'penutup', '2023-02-15', 'PT00001', 14, 20201),
(16, 'penutup', '2023-02-16', 'PT00002', 15, 20201),
(17, 'penutup', '2023-02-17', 'PT00003', 16, 20201),
(18, 'penutup', '2023-02-18', 'PT00004', 17, 20201);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurnal_has_akun`
--

CREATE TABLE `jurnal_has_akun` (
  `jurnal_id` int(11) NOT NULL,
  `akun_no_akun` varchar(15) NOT NULL,
  `no_urut` int(11) DEFAULT NULL,
  `nominal_debit` int(11) DEFAULT NULL,
  `nominal_kredit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `jurnal_has_akun`
--

INSERT INTO `jurnal_has_akun` (`jurnal_id`, `akun_no_akun`, `no_urut`, `nominal_debit`, `nominal_kredit`) VALUES
(1, '102', 2, 0, 800000),
(1, '202', 1, 800000, 0),
(2, '101', 1, 10000000, 0),
(2, '103', 2, 0, 10000000),
(3, '102', 2, 0, 2000000),
(3, '302', 1, 2000000, 0),
(4, '101', 1, 20000000, 0),
(4, '203', 2, 0, 20000000),
(5, '101', 2, 0, 30000000),
(5, '105', 1, 100000000, 0),
(5, '201', 3, 0, 70000000),
(6, '102', 2, 0, 30000000),
(6, '110', 1, 30000000, 0),
(7, '101', 2, 0, 3000000),
(7, '104', 1, 3000000, 0),
(8, '102', 1, 60000000, 0),
(8, '204', 2, 0, 60000000),
(9, '102', 2, 0, 1000000),
(9, '202', 3, 0, 800000),
(9, '505', 1, 1800000, 0),
(10, '102', 1, 30000000, 0),
(10, '401', 2, 0, 30000000),
(11, '105', 2, 0, 12500000),
(11, '502', 1, 12500000, 0),
(12, '204', 1, 10000000, 0),
(12, '402', 2, 0, 10000000),
(13, '104', 2, 0, 2000000),
(13, '503', 1, 2000000, 0),
(14, '111', 2, 0, 1500000),
(14, '504', 1, 1500000, 0),
(15, '000', 3, 0, 40000000),
(15, '401', 1, 30000000, 0),
(15, '402', 2, 10000000, 0),
(16, '000', 1, 17800000, 0),
(16, '501', 2, 0, 0),
(16, '502', 3, 0, 12500000),
(16, '503', 4, 0, 2000000),
(16, '504', 5, 0, 1500000),
(16, '505', 6, 0, 1800000),
(16, '506', 7, 0, 0),
(16, '507', 8, 0, 0),
(17, '000', 1, 22000000, 0),
(17, '301', 2, 0, 22200000),
(18, '301', 1, 2000000, 0),
(18, '302', 2, 0, 2000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `periode`
--

CREATE TABLE `periode` (
  `id` int(11) NOT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `periode`
--

INSERT INTO `periode` (`id`, `tanggal_awal`, `tanggal_akhir`, `status`) VALUES
(20201, '2022-12-01', '2023-03-01', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `keterangan`) VALUES
(1, 'Membayar hutang ke Bank \'Untung Terus\' secara transfer.'),
(2, 'Menerima pelunasan dari pelanggan secara tunai.'),
(3, 'Pemilik mengambil uang dari rekening bank untuk keperluan pribadinya.'),
(4, 'Menerima pembayaran uang muka jasa dekorasi dari pelanggan \'X\' secara tunai.'),
(5, 'Membayar sewa gedung ke pihak ketiga untuk periode 2 tahun ke depan. Perusahaan membayar uang muka secara tunai, sisanya menggunakan jasa kredit Bank \'Masa Depan\'. '),
(6, 'Membeli perlengkapan habis pakai ke supplier secara tunai.'),
(7, 'Menerima uang muka jasa sewa sound system dari pelanggan untuk periode sewa 6 bulan ke depan secara transfer.'),
(8, 'Ternyata terjadi kesalahan penjurnalan transaksi pada tanggal 1 Januari 2021. Seharusnya yang benar adalah membayar biaya transportasi secara transfer.'),
(9, 'Menyelesaikan jasa dekorasi untuk pesta pernikahan pelanggan \'X\', sekaligus menerima pelunasan jasa dekorasi dari pelanggan \'X\' secara transfer (dikurangi uang muka yang telah dibayarkan).'),
(10, 'Penyesuaian - Sewa Gedung Dibayar di Muka'),
(11, 'Penyesuaian - Uang Muka Sound System'),
(12, 'Penyesuaian - Perlengkapan Habis Pakai'),
(13, 'Penyesuaian - Penyusutan Peralatan'),
(14, 'Penutupan Step 1'),
(15, 'Penutupan Step 2'),
(16, 'Penutupan Step 3'),
(17, 'Penutupan Step 4'),
(18, 'Membeli peralatan sound system secara transfer. Peralatan ini diperkirakan dapat digunakan selama 5 tahun.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`no_akun`);

--
-- Indeks untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jurnal_transaksi1_idx` (`transaksi_id`),
  ADD KEY `fk_jurnal_periode1_idx` (`periode_id`);

--
-- Indeks untuk tabel `jurnal_has_akun`
--
ALTER TABLE `jurnal_has_akun`
  ADD PRIMARY KEY (`jurnal_id`,`akun_no_akun`),
  ADD KEY `fk_jurnal_has_akun_akun1_idx` (`akun_no_akun`),
  ADD KEY `fk_jurnal_has_akun_jurnal1_idx` (`jurnal_id`);

--
-- Indeks untuk tabel `periode`
--
ALTER TABLE `periode`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `jurnal`
--
ALTER TABLE `jurnal`
  ADD CONSTRAINT `fk_jurnal_periode1` FOREIGN KEY (`periode_id`) REFERENCES `periode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jurnal_transaksi1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `jurnal_has_akun`
--
ALTER TABLE `jurnal_has_akun`
  ADD CONSTRAINT `fk_jurnal_has_akun_akun1` FOREIGN KEY (`akun_no_akun`) REFERENCES `akun` (`no_akun`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_jurnal_has_akun_jurnal1` FOREIGN KEY (`jurnal_id`) REFERENCES `jurnal` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
