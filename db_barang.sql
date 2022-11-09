-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2022 at 08:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_barang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stock` int(10) NOT NULL,
  `harga` int(10) NOT NULL,
  `harga_beli` int(10) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `stock`, `harga`, `harga_beli`, `id_kategori`, `id_satuan`) VALUES
('BRG001', 'AQUA', 25, 17000, 15000, 1, 4),
('BRG002', 'AQUA AIR MINERAL 600ml - DUS(24)', 29, 50000, 40000, 1, 2),
('BRG003', 'AQUA AIR MINERAL 330ml - DUS(24)', 25, 38000, 30000, 1, 2),
('BRG004', 'AQUA AIR MINERAL GELAS 240ml - DUS(48)', 25, 30000, 25000, 1, 2),
('BRG005', 'AQUA REFLECTIONS SPARKLING 380ml - DUS(12)', 5, 120000, 100000, 1, 2),
('BRG006', 'FRUIT TEA BLACKCURRANT - BOX(12)', 15, 20000, 18000, 3, 2),
('BRG007', 'FRUIT TEA FREEZE - BOX(12)', 15, 20000, 17000, 3, 2),
('BRG008', 'FRUIT TEA KURMA - BOX(12)', 15, 25000, 20000, 3, 2),
('BRG009', 'FRUIT TEA LEMON - BOX(12)', 15, 20000, 18000, 3, 2),
('BRG010', 'FRUIT TEA BLACKCURRANT POUCH 230ml - DUS(24)', 25, 43500, 40000, 3, 2),
('BRG011', 'FRUIT TEA APEL POUCH 230ml - DUS(24)', 25, 43500, 40000, 3, 2),
('BRG012', 'TEH BOTOL SOSRO KOTAK 330ml - DUS(24)', 25, 60000, 55000, 3, 2),
('BRG013', 'TEH BOTOL SOSRO KOTAK 250ml - DUS(24)', 10, 56000, 53000, 3, 2),
('BRG014', 'TEH BOTOL SOSRO KOTAK 200ml - DUS(24)', 15, 52000, 50000, 3, 2),
('BRG015', 'TEH BOTOL SOSRO KOTAK 1L', 45, 6500, 5000, 3, 1),
('BRG016', 'TEH BOTOL SOSRO KOTAK 1L - DUS(12)', 10, 95000, 85000, 3, 2),
('BRG017', 'PRIMA AIR MINERAL 600ml - DUS(24)', 15, 31000, 28000, 1, 2),
('BRG018', 'PRIMA AIR MINERAL 330ml - DUS(24)', 15, 25000, 22000, 1, 2),
('BRG019', 'STEE/S-TEE BOTOL PET 350ml - DUS(12)', 10, 26500, 25000, 3, 2),
('BRG020', 'STEE/S-TEE KOTAK 200ml - DUS(24)', 15, 44000, 40000, 3, 2),
('BRG021', 'teh pucuk', 20, 30000, 35000, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_brgkeluar` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_brgkeluar`, `id_user`, `id_barang`, `jumlah_keluar`, `tgl_keluar`, `total_harga`) VALUES
('BK001', 'U001', 'BRG004', 10, '2022-06-08', 250000),
('BK002', 'U001', 'BRG004', 5, '2022-06-13', 125000),
('BK003', 'U001', 'BRG015', 5, '2022-07-12', 32500),
('BK004', 'U001', 'BRG008', 5, '2022-07-17', 125000),
('BK005', 'U002', 'BRG002', 1, '2022-08-04', 50000);

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id_brgmasuk` varchar(11) NOT NULL,
  `id_supplier` varchar(11) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_barang` varchar(11) NOT NULL,
  `jmlh_masuk` int(11) NOT NULL,
  `tgl_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_masuk`
--

INSERT INTO `barang_masuk` (`id_brgmasuk`, `id_supplier`, `id_user`, `id_barang`, `jmlh_masuk`, `tgl_masuk`) VALUES
('BM001', 'SUP002', 'U002', 'BRG002', 20, '2022-07-26'),
('BM002', 'SUP001', 'U002', 'BRG001', 30, '2022-04-07'),
('BM003', 'SUP002', 'U001', 'BRG008', 10, '2022-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Air Mineral'),
(2, 'Air Isi Ulang'),
(3, 'Teh Dalam Kemasan');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'piece'),
(2, 'box'),
(3, 'pack'),
(4, 'galon');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `no_tlpn` varchar(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_tlpn`, `alamat`) VALUES
('SUP001', 'AQUA', ' 0822-9995-573', 'Apartement Bassura City Tower A 7, Jl. Jend. Basuki Rachmat, RT.8/RW.10, Cipinang Besar Sel., Kecamatan Jatinegara, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13410'),
('SUP002', 'PT Sinar Sosro', '02188734321', 'Jl. Raya Sultan Agung KM 28 Kel, Medan Satria, Bekasi City, West Java 17132');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `status`) VALUES
('U001', 'Selly', 'selly1122', '5be057accb25758101fa5eadbbd79503', '1'),
('U002', 'Neneng', 'neneng123', 'df9bbbfcc24a4c192513521fa4e69336', '2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_brgkeluar`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id_brgmasuk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
