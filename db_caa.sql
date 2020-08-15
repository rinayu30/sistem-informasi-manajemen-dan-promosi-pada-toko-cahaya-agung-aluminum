-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2020 at 04:52 PM
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
  `satuan` varchar(15) NOT NULL,
  `harga_satuan` double NOT NULL,
  `total_harga` double NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bahan_masuk`
--

INSERT INTO `bahan_masuk` (`id_bmasuk`, `id_pemasok`, `id_item`, `jumlah`, `satuan`, `harga_satuan`, `total_harga`, `created`, `updated`) VALUES
('BMK001', 13, 1, 2, 'meter', 40000, 80000, '2020-08-06 00:00:00', '2020-08-06 11:09:12'),
('BMK002', 7, 1, 2, 'meter', 50000, 100000, '2020-08-06 00:00:00', NULL),
('BMK003', 7, 1, 3, 'meter', 100000, 300000, '2020-08-06 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bahan_perabot`
--

CREATE TABLE `bahan_perabot` (
  `id_bahan` int(11) NOT NULL,
  `id_kalkulasi` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `nama_bahan` varchar(30) NOT NULL,
  `banyak` int(11) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `uk_panjang` int(11) NOT NULL,
  `uk_lebar` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_satuan` double NOT NULL,
  `jumlah_harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan`
--

CREATE TABLE `detail_penjualan` (
  `id_detail` int(11) NOT NULL,
  `kd_penjualan` varchar(30) NOT NULL,
  `kd_produk` varchar(15) NOT NULL,
  `harga_jual` double NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `nama_item` varchar(50) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `id_jenis`, `nama_item`, `created`, `updated`) VALUES
(1, 1, '1x1 ca', '2020-08-01 13:58:36', '2020-08-01 10:08:13'),
(2, 1, 'Holo u', '2020-08-06 13:46:40', NULL);

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
(1, 'Aluminium', 590, '2020-08-01 12:00:41', NULL),
(2, 'Kaca', 0.033, '2020-08-01 12:12:41', '2020-08-01 07:19:22'),
(3, 'Plat', 0.033, '2020-08-07 14:08:16', NULL),
(6, 'Dan lain-lain', 1, '2020-08-07 14:11:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kalkulasi`
--

CREATE TABLE `kalkulasi` (
  `id_kalkulasi` int(11) NOT NULL,
  `kd_produk` varchar(15) NOT NULL,
  `harga_modal` double NOT NULL,
  `harga_jual` double NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(20) NOT NULL,
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
  `nama_pemasok` varchar(30) NOT NULL,
  `kontak` varchar(15) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
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
  `nama_pembeli` varchar(50) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`id_pembeli`, `nama_pembeli`, `jk`, `no_telp`, `alamat`, `created`, `updated`) VALUES
(1, 'weeefwe', 'L', '085243111', 'uuywqev', '2020-07-29 16:33:33', '2020-07-29 11:49:01'),
(3, 'hanyan belii', 'P', '0852435353', 'alkshbx iuwqehbw', '2020-07-29 16:51:09', '2020-07-29 11:52:56'),
(6, 'Karin', 'P', '085261737380', 'Pauh', '2020-07-29 18:14:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `kd_penjualan` varchar(30) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `cara_beli` varchar(30) NOT NULL,
  `tot_bayar` double NOT NULL,
  `dp_awal` double NOT NULL,
  `diskon` double NOT NULL,
  `sisa` double NOT NULL,
  `tgl_penjualan` date NOT NULL,
  `tgl_pengiriman` date NOT NULL,
  `status` enum('0','1','-1') NOT NULL COMMENT '0 = proses, 1=selesai, -1= batal',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kd_produk` varchar(15) NOT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kd_produk`, `nama_produk`, `gambar`, `stok`, `id_kategori`, `detail`, `created`, `updated`) VALUES
('PR001', 'Steling Tipe A', 'produk-200809-15814cc287.jpeg', 3, 5, 'Tanpa meja kecil samping', '2020-08-09 11:33:43', '2020-08-09 18:17:34'),
('PR002', 'Lemari Baju 3 Pintu', 'produk-200809-79e6669bde.jpeg', 1, 1, 'Baju', '2020-08-09 22:32:25', '2020-08-09 17:54:21'),
('PR003', 'Lemari Baju', 'produk-200812-648b9a6d68.jpeg', 1, 1, 'Lengkap dengan kaca dan pintu lemari tiga buah, desain keramik', '2020-08-12 15:21:18', NULL),
('PR004', 'Jemuran', 'produk-200812-bf6bfb59d7.jpeg', 2, 6, 'Jemuran dengan tiga tingkatan, dsertai dengan rantai untuk sangkutan baju yanng di hanger', '2020-08-12 15:22:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `level` varchar(10) NOT NULL COMMENT '1. admin,2.karyawan,3. pengunjung ',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `username`, `password`, `email`, `no_telp`, `level`, `created`, `updated`) VALUES
(1, 'Rinayu', 'admin1', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@gmail.com', '085263xxxxx', '1', '2020-08-01 15:14:21', NULL),
(2, 'Rina', 'karyawan', '2a901c08e5888c18d421b47e5861c4250aa99d71', 'guess1@gmail.com', '082345xxxx', '2', '2020-08-01 15:14:21', NULL);

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
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jenis_bahan`
--
ALTER TABLE `jenis_bahan`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id_pembeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_bahan` (`id_jenis`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `kalkulasi`
--
ALTER TABLE `kalkulasi`
  ADD CONSTRAINT `kalkulasi_ibfk_1` FOREIGN KEY (`kd_produk`) REFERENCES `produk` (`kd_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
