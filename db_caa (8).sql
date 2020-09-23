-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2020 at 04:33 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_caa`
--

-- --------------------------------------------------------

--
-- Table structure for table `bahan_masuk`
--

CREATE TABLE `bahan_masuk` (
  `id_bmasuk` varchar(6) NOT NULL,
  `id_pemasok` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(6) NOT NULL,
  `harga_satuan` double NOT NULL,
  `total_harga` double NOT NULL,
  `tgl_beli` datetime NOT NULL,
  `tgl_ubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_masuk`
--

INSERT INTO `bahan_masuk` (`id_bmasuk`, `id_pemasok`, `id_item`, `jumlah`, `satuan`, `harga_satuan`, `total_harga`, `tgl_beli`, `tgl_ubah`) VALUES
('BMK001', 7, 5, 20, '2', 5000, 100000, '2020-09-15 00:00:00', NULL),
('BMK002', 7, 5, 20, '2', 5000, 100000, '2020-09-15 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_perabot`
--

CREATE TABLE `bahan_perabot` (
  `id_bahan` int(11) NOT NULL,
  `id_kalkulasi` varchar(10) NOT NULL,
  `id_item` int(11) NOT NULL,
  `banyak` int(11) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `uk_panjang` int(11) NOT NULL,
  `uk_lebar` int(11) NOT NULL,
  `jumlah` float NOT NULL,
  `harga_satuan` double NOT NULL,
  `jumlah_harga` double NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '''0 = notampil, 1=tampil '''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_perabot`
--

INSERT INTO `bahan_perabot` (`id_bahan`, `id_kalkulasi`, `id_item`, `banyak`, `ukuran`, `uk_panjang`, `uk_lebar`, `jumlah`, `harga_satuan`, `jumlah_harga`, `status`) VALUES
(30, 'KH001', 5, 2, 0, 0, 0, 2, 10000, 20000, '0'),
(31, 'KH001', 5, 5, 0, 0, 0, 5, 10000, 50000, '0'),
(32, 'KH002', 5, 5, 0, 0, 0, 5, 5000, 25000, '0'),
(33, 'KH002', 5, 6, 0, 0, 0, 6, 5000, 30000, '0'),
(34, 'KH003', 5, 2, 0, 0, 0, 2, 2000, 4000, '0');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `kd_penjualan` varchar(10) NOT NULL,
  `kd_produk` varchar(6) NOT NULL,
  `harga_jual` double NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `status` enum('1','0') NOT NULL COMMENT '0 = notampil, 1=tampil ',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_penjualan`
--

INSERT INTO `detail_penjualan` (`id_detail`, `kd_penjualan`, `kd_produk`, `harga_jual`, `jumlah`, `subtotal`, `status`, `created`, `updated`) VALUES
(34, 'PJ20091801', 'PR003', 6000, 1, 6000, '0', '2020-09-19 03:46:28', NULL),
(35, 'PJ20091801', 'PR002', 82500, 2, 165000, '0', '2020-09-19 03:47:32', NULL),
(36, 'PJ20091801', 'PR003', 6000, 5, 30000, '0', '2020-09-19 03:55:29', NULL),
(37, 'PJ20091901', 'PR001', 105000, 2, 210000, '0', '2020-09-20 03:24:29', NULL),
(38, 'PJ20092001', 'PR001', 105000, 1, 105000, '0', '2020-09-20 15:51:40', NULL),
(40, 'PJ20092101', 'PR002', 82500, 2, 165000, '0', '2020-09-21 14:40:33', NULL),
(41, 'PJ20092102', 'PR001', 105000, 2, 210000, '0', '2020-09-21 14:48:25', NULL),
(42, 'PJ20092102', 'PR001', 105000, 1, 105000, '0', '2020-09-21 14:49:29', NULL),
(43, 'PJ20092103', 'PR001', 105000, 1, 105000, '0', '2020-09-21 14:51:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `nama_item` varchar(15) NOT NULL,
  `stok` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `id_jenis`, `nama_item`, `stok`, `created`, `updated`) VALUES
(5, 6, 'paku rivet', 38, '2020-08-17 11:37:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_bahan`
--

CREATE TABLE `jenis_bahan` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(15) NOT NULL,
  `nilai_satuan` float NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_bahan`
--

INSERT INTO `jenis_bahan` (`id_jenis`, `nama_jenis`, `nilai_satuan`, `created`, `updated`) VALUES
(3, 'Plat', 0.033, '2020-08-07 14:08:16', NULL),
(6, 'Dan lain-lain', 1, '2020-08-07 14:11:07', NULL),
(7, 'Kayu', 0.033, '2020-08-16 10:21:54', NULL),
(8, 'Kaca', 0.033, '2020-08-29 01:07:33', '2020-08-29 19:25:56'),
(9, 'Aluminium', 590, '2020-08-29 01:19:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kalkulasi`
--

CREATE TABLE `kalkulasi` (
  `id_kalkulasi` varchar(10) NOT NULL,
  `kd_produk` varchar(6) NOT NULL,
  `harga_modal` double NOT NULL,
  `harga_jual` double NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kalkulasi`
--

INSERT INTO `kalkulasi` (`id_kalkulasi`, `kd_produk`, `harga_modal`, `harga_jual`, `created`, `updated`) VALUES
('KH001', 'PR001', 70000, 105000, '2020-09-09 14:23:23', NULL),
('KH002', 'PR002', 55000, 82500, '2020-09-09 14:25:55', NULL),
('KH003', 'PR003', 4000, 6000, '2020-09-17 16:55:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(15) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created`, `updated`) VALUES
(1, 'Lemari', '2020-08-09 11:02:42', NULL),
(3, 'Rak', '2020-08-09 11:14:20', NULL),
(4, 'Booth', '2020-08-09 11:14:27', NULL),
(5, 'Steling Jualan', '2020-08-09 11:14:38', NULL),
(6, 'Dan lain-lain', '2020-08-09 21:58:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` int(11) NOT NULL,
  `nama_pemasok` varchar(25) NOT NULL,
  `kontak` varchar(14) NOT NULL,
  `alamat` varchar(70) NOT NULL,
  `keterangan` varchar(25) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasok`
--

INSERT INTO `pemasok` (`id_pemasok`, `nama_pemasok`, `kontak`, `alamat`, `keterangan`, `created`, `updated`) VALUES
(7, 'Rina Bangunan', '0864323xxx', 'dasad', 'cvrevervt', '2020-07-28 15:05:47', NULL),
(8, 'Rina Bangunanqcewc', '0864323xxx', 'ervtw ', 'cwrevbtwr', '2020-07-28 15:06:04', NULL),
(13, 'sayqq', '0852436161', 'kamu', 'jshdb', '2020-07-28 17:52:03', '2020-07-29 10:38:47'),
(16, 'hanyaa', '0872862', 'kjsahui', 'iudhis', '2020-07-29 15:42:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `id_pembeli` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_pembeli` varchar(25) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `id_user`, `nama_pembeli`, `jk`, `no_telp`, `alamat`, `created`, `updated`) VALUES
(1, NULL, 'weeefwe', 'L', '085243111', 'uuywqev', '2020-07-29 16:33:33', '2020-07-29 11:49:01'),
(3, NULL, 'hanyan belii', 'P', '0852435353', 'alkshbx iuwqehbw', '2020-07-29 16:51:09', '2020-07-29 11:52:56'),
(6, NULL, 'Karin', 'P', '085261737380', 'Pauh', '2020-07-29 18:14:22', NULL),
(7, NULL, 'fevave', 'L', '087893232', 'sasaa', '2020-08-21 18:55:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kd_penjualan` varchar(10) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tot_bayar` double NOT NULL,
  `dp_awal` double NOT NULL,
  `sisa` double NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `status_jual` enum('1','0','-1') NOT NULL COMMENT '0 = proses, 1=selesai, -1= batal',
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`kd_penjualan`, `id_pembeli`, `id_user`, `tot_bayar`, `dp_awal`, `sisa`, `tgl_penjualan`, `status_jual`, `updated`) VALUES
('PJ20091801', 1, 1, 201000, 30000, 171000, '2020-09-19', '0', NULL),
('PJ20091901', 1, 1, 210000, 210000, 0, '2020-09-19', '0', NULL),
('PJ20092001', 6, 1, 105000, 50000, 55000, '2020-09-20', '0', NULL),
('PJ20092101', 3, 1, 165000, 100000, 65000, '2020-09-21', '1', NULL),
('PJ20092102', 3, 1, 315000, 100000, 215000, '2020-09-21', '1', NULL),
('PJ20092103', 6, 1, 105000, 105000, 0, '2020-09-21', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kd_produk` varchar(6) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `gambar` varchar(30) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `detail` varchar(75) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` enum('1','0') DEFAULT NULL COMMENT '1 = tampil, 0= notampil'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kd_produk`, `nama_produk`, `gambar`, `stok`, `id_kategori`, `detail`, `created`, `updated`) VALUES
('PR001', 'Tes', 'produk-200922-94626329c6.jpeg', 1, 1, 'sssss', '2020-09-09 13:24:06', '0'),
('PR002', 'tesss', 'produk-200918-16611ba6e8.jpeg', 1, 5, 'aaaa', '2020-09-09 13:24:26', '0'),
('PR003', 'Lemari ', 'produk-200917-2a4acf336b.jpeg', 5, 1, 'Dengan tiga pintu dan kaca', '2020-09-17 16:44:18', '0');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(30) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(14) NOT NULL,
  `level` varchar(1) NOT NULL COMMENT '1. admin,2.karyawan,3. pengunjung ',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `email`, `no_telp`, `level`, `created`, `updated`) VALUES
(1, 'Rinayu', 'admin1', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@gmail.com', '085263xxxxx', '1', '2020-08-01 15:14:21', NULL),
(5, 'Arnila Cahya Febri Mendrova', 'arnila', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'arnila@cahya.com', '085233466', '3', '2020-09-17 17:51:04', NULL),
(6, 'karyawan', 'karyawan1', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'yaya@gmail.com', '085262xxxx', '2', '2020-09-20 17:48:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bahan_masuk`
--
ALTER TABLE `bahan_masuk`
  ADD PRIMARY KEY (`id_bmasuk`);

--
-- Indexes for table `bahan_perabot`
--
ALTER TABLE `bahan_perabot`
  ADD PRIMARY KEY (`id_bahan`),
  ADD KEY `id_jenis` (`id_item`);

--
-- Indexes for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `kd_penjualan` (`kd_penjualan`),
  ADD KEY `kd_produk` (`kd_produk`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `item_ibfk_1` (`id_jenis`);

--
-- Indexes for table `jenis_bahan`
--
ALTER TABLE `jenis_bahan`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kalkulasi`
--
ALTER TABLE `kalkulasi`
  ADD PRIMARY KEY (`id_kalkulasi`),
  ADD KEY `kd_produk` (`kd_produk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`kd_penjualan`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kd_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bahan_perabot`
--
ALTER TABLE `bahan_perabot`
  MODIFY `id_bahan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `detail_penjualan`
--
ALTER TABLE `detail_penjualan`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jenis_bahan`
--
ALTER TABLE `jenis_bahan`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id_pemasok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
