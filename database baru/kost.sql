-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2021 at 02:42 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(255) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_user` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `no_telp`, `foto`, `id_user`) VALUES
(3, 'admin', 'admin@gmail.com', '12341234', '1_2fpfv8Np1AGdmp2axA9rXQ.png', 17);

-- --------------------------------------------------------

--
-- Table structure for table `bayar_di_muka`
--

CREATE TABLE `bayar_di_muka` (
  `kode_dp` int(11) NOT NULL,
  `jam` varchar(255) COLLATE utf8_bin NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_transfer` varchar(255) COLLATE utf8_bin NOT NULL,
  `id_lunas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kamar`
--

CREATE TABLE `kamar` (
  `id_kamar` int(255) NOT NULL,
  `kode_kamar` varchar(255) NOT NULL,
  `kode_kos` varchar(255) NOT NULL,
  `harga` int(255) NOT NULL,
  `harga_smesteran` int(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_tersedia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `kode_kamar`, `kode_kos`, `harga`, `harga_smesteran`, `deskripsi`, `foto`, `status`, `tgl_tersedia`) VALUES
(8, '1', 'OSAB6456', 12000000, 6000000, 'asdsa', 'BACKGROUND_MUBES_HMDSI.png', 'Booked', '2021-04-08'),
(10, '2', 'OSAB6456', 5000000, 2500000, '3x2', 'Tom_Clancys_Rainbow_Six®_Siege2021-3-26-22-51-25.jpg', 'Booked', '2021-05-20'),
(12, '007', 'OSAB6456', 4000000, 2000000, 'kamar james bond', 'Tom_Clancys_Rainbow_Six®_Siege2021-4-19-1-37-52.jpg', 'Booked', '2021-03-01'),
(13, '1', 'osta5568', 2000000, 0, 'asdsa', 'aa.jpg', 'Tersedia', '2021-06-21'),
(14, 'coba harga', 'OSAB6456', 2131, 0, 'sada', 'Screenshot_(17).png', 'Tersedia', '2021-06-25'),
(15, '444', 'dasd2569', 30000000, 2000000, 'coba dulu', 'australia.png', 'Booked', '2021-07-03');

-- --------------------------------------------------------

--
-- Table structure for table `kosan`
--

CREATE TABLE `kosan` (
  `kode_kos` varchar(255) NOT NULL,
  `nama_kos` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `jenis_kosan` varchar(255) NOT NULL,
  `saldo_kos` int(255) NOT NULL,
  `tanggal_daftar` date NOT NULL DEFAULT current_timestamp(),
  `id_pemilik` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kosan`
--

INSERT INTO `kosan` (`kode_kos`, `nama_kos`, `alamat`, `deskripsi`, `foto`, `jenis_kosan`, `saldo_kos`, `tanggal_daftar`, `id_pemilik`) VALUES
('dasd2569', 'Bener Kos', 'asdas', 'Luas kamar ini adalah 213. Untuk tegangan listrik yaitu asdas. Deskrip lainnya berupa, asdas', 'external-content_duckduckgo_com.jpg', 'Putra', 0, '2021-06-22', 9),
('OSAB6456', 'KOSABC', 'Bandung', 'Luas kamar ini adalah 12. Untuk tegangan listrik yaitu 12. Deskrip lainnya berupa, 12', 'thumb-1920-1125041.png', 'Putra', 0, '2021-04-08', 9),
('osta5568', 'kostada', 'asdsa', 'Luas kamar ini adalah 1231. Untuk tegangan listrik yaitu 12. Deskrip lainnya berupa, adsa', 'external-content_duckduckgo_com.jpg', 'Putri', 0, '2021-06-21', 9),
('sdas4764', 'asdas', 'asdas', 'Luas kamar ini adalah 12. Untuk tegangan listrik yaitu 123. Deskrip lainnya berupa, asds', 'sadasd.jpg', 'Putra', 0, '2021-06-22', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `isi_pesan` varchar(250) NOT NULL,
  `dari` varchar(250) NOT NULL,
  `untuk` varchar(250) NOT NULL,
  `status_baca` int(11) NOT NULL,
  `jenis` varchar(50) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp(),
  `kode_kos` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `isi_pesan`, `dari`, `untuk`, `status_baca`, `jenis`, `date`, `kode_kos`) VALUES
(9, 'Segera Bayar DP untuk kosanmu!', '26', '4', 1, 'pembayaran', '2021-05-29 06:53:11', NULL),
(10, 'Ada pesanan baru nih!', '27', '26', 1, 'pemesanan', '2021-05-29 07:05:22', NULL),
(11, 'Pesanan Ditolak', '26', '4', 1, 'pemesanan', '2021-05-29 08:01:39', NULL),
(12, 'Segera Bayar DP untuk kosanmu!', '26', '4', 1, 'pembayaran', '2021-05-29 08:18:37', NULL),
(13, 'Ada pesanan baru nih!', '27', '26', 1, 'pemesanan', '2021-05-29 08:20:19', NULL),
(14, 'Pesanan Ditolak', '26', '4', 1, 'pemesanan', '2021-05-30 15:13:11', NULL),
(15, 'Segera Bayar DP untuk kosanmu!', '26', '4', 1, 'pembayaran', '2021-05-30 15:14:16', NULL),
(16, 'Ada pesanan baru nih!', '27', '26', 1, 'pemesanan', '2021-05-30 15:15:38', NULL),
(17, 'Pesanan Ditolak', '26', '4', 1, 'info', '2021-05-30 15:20:28', NULL),
(18, 'Segera Bayar DP untuk kosanmu!', '26', '4', 1, 'pembayaran', '2021-05-30 16:17:48', NULL),
(19, 'Ada pesanan baru nih!', '27', '26', 1, 'pemesanan', '2021-05-30 16:18:00', NULL),
(20, 'Pesanan Ditolak', '26', '4', 1, 'info', '2021-05-30 16:44:10', NULL),
(21, 'Segera Bayar DP untuk kosanmu!', '26', '4', 1, 'pembayaran', '2021-05-30 17:24:52', NULL),
(22, 'Ada pesanan baru nih!', '27', '26', 1, 'pemesanan', '2021-05-30 17:25:13', NULL),
(23, 'Silahkan Melakukan Pelunasan', '9', '4', 1, 'pelunasan', '2021-05-30 17:50:38', NULL),
(24, 'Silahkan Melakukan Pelunasan', '9', '4', 1, 'pelunasan', '2021-05-30 23:00:45', NULL),
(25, 'Pesanan Diterima', '9', '4', 1, 'info', '2021-05-30 23:24:09', NULL),
(26, 'Segera Bayar DP untuk kosanmu!', '26', '4', 0, 'pembayaran', '2021-06-21 23:35:01', NULL),
(27, 'Ada pesanan baru nih!', '27', '26', 1, 'pemesanan', '2021-06-21 23:35:52', NULL),
(28, 'Pesanan Ditolak', '26', '4', 1, 'info', '2021-06-21 23:37:18', NULL),
(29, 'Segera Bayar DP untuk kosanmu!', '26', '4', 0, 'pembayaran', '2021-06-21 23:37:52', NULL),
(30, 'Ada pesanan baru nih!', '27', '26', 0, 'pemesanan', '2021-06-21 23:38:10', NULL),
(31, 'Silahkan Melakukan Pelunasan', '9', '4', 0, 'pelunasan', '2021-06-24 16:44:48', NULL),
(32, 'Segera Bayar DP untuk kosanmu!', 'pembayaran', '26', 0, '4', '2021-06-24 16:48:37', NULL),
(33, 'Ada pesanan baru nih!', 'pemesanan', '27', 0, '26', '2021-06-24 16:53:13', NULL),
(34, 'Pembayaran Lunas', '26', '4', 0, 'pembayaran', '2021-06-24 17:07:19', NULL),
(35, 'Segera Bayar DP untuk kosanmu!', 'pembayaran', '26', 0, '4', '2021-06-24 17:51:18', NULL),
(36, 'Segera Bayar DP untuk kosanmu!', 'pembayaran', '26', 0, '4', '2021-06-24 19:33:44', NULL),
(37, 'Ada pesanan baru nih!', 'pemesanan', '27', 0, '26', '2021-06-24 19:34:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelunasan`
--

CREATE TABLE `pelunasan` (
  `id_lunas` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_pelunasan` varchar(250) COLLATE utf8_bin NOT NULL,
  `jumlah_pelunasan` int(255) NOT NULL,
  `bukti_pelunasan` varchar(250) COLLATE utf8_bin NOT NULL,
  `id_pesan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pelunasan`
--

INSERT INTO `pelunasan` (`id_lunas`, `tanggal`, `jam_pelunasan`, `jumlah_pelunasan`, `bukti_pelunasan`, `id_pesan`) VALUES
(13, '2021-04-26', '19:43:27', 4800000, '6086fbbf01bc6.png', 30),
(14, '2021-05-18', '17:55:04', 8000000, '60a3e358f1f01.jpg', 31),
(15, '2021-05-30', '17:59:22', 1200000, '60b3b65a409f4.png', 41),
(16, '2021-05-30', '18:04:47', 0, '60b3b79f545d5.jpg', 41),
(17, '2021-06-24', '11:53:51', 3200000, '60d4562f031fc.png', 43),
(18, '2021-06-24', '12:07:19', 4000000, '60d45957b9deb.png', 44);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pesan` int(10) NOT NULL,
  `nama_penghuni` varchar(250) COLLATE utf8_bin NOT NULL,
  `nomor_ktp` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `nomor_hp` varchar(15) COLLATE utf8_bin DEFAULT NULL,
  `tanggal_pesan` date NOT NULL DEFAULT current_timestamp(),
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jam` varchar(255) COLLATE utf8_bin NOT NULL,
  `jangka_waktu` varchar(250) COLLATE utf8_bin NOT NULL,
  `jumlah_dp` varchar(255) COLLATE utf8_bin NOT NULL,
  `bukti_bayar` varchar(250) COLLATE utf8_bin NOT NULL,
  `sisa_pembayaran` int(255) DEFAULT NULL,
  `status_transaksi` tinyint(255) DEFAULT NULL,
  `keterangan_pembatalan` text COLLATE utf8_bin DEFAULT NULL,
  `id_pencari` int(255) DEFAULT NULL,
  `id_penghuni` int(11) DEFAULT NULL,
  `id_kamar` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pesan`, `nama_penghuni`, `nomor_ktp`, `nomor_hp`, `tanggal_pesan`, `tanggal_masuk`, `tanggal_keluar`, `jam`, `jangka_waktu`, `jumlah_dp`, `bukti_bayar`, `sisa_pembayaran`, `status_transaksi`, `keterangan_pembatalan`, `id_pencari`, `id_penghuni`, `id_kamar`) VALUES
(30, 'asdsa', '12312321', '213213', '2021-04-26', '2021-04-26', '2021-10-26', '', '6 Bulan', '1200000', '6086a8669ea4f.png', 0, 2, NULL, 4, NULL, 8),
(32, 'Yanto', NULL, NULL, '2021-05-18', '2021-05-21', '2021-11-21', '', '6 Bulan', '0', '', 2500000, 3, NULL, 6, NULL, 10),
(42, 'adsada', '123123', '123123', '2021-06-21', '2021-06-21', '2021-12-21', '', '6 Bulan', '400000', '60d0bfe88211c.jpg', 1600000, 4, 'adsad', 4, NULL, 12),
(43, 'asdas', '12312', '12321', '2021-06-21', '2021-06-21', '2022-06-21', '', '1 Tahun', '800000', '60d0c0729f502.jpg', 0, 0, NULL, 4, NULL, 12),
(44, 'ff', '231', '1231', '2021-06-24', '2021-06-25', '2022-06-25', '', '1 Tahun', '1000000', '60d456095b892.png', 0, 0, NULL, 4, NULL, 10),
(45, 'sda', NULL, NULL, '2021-06-24', '2021-06-30', '2021-12-30', '', '6 Bulan', '0', '', 0, 3, NULL, 4, NULL, 13),
(46, 'sdaas', '2131', '1231', '2021-06-24', '2021-06-25', '2021-12-25', '', '6 Bulan', '400000', '60d47bb89dd6f.jpg', 1600000, 0, NULL, 4, NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `pemilik_kos`
--

CREATE TABLE `pemilik_kos` (
  `id_pemilik` int(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `id_user` int(255) DEFAULT NULL,
  `no_ktp` varchar(255) DEFAULT NULL,
  `no_rek` varchar(255) DEFAULT NULL,
  `bank` varchar(250) NOT NULL,
  `atas_nama_rek` varchar(255) DEFAULT NULL,
  `tgl_daftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilik_kos`
--

INSERT INTO `pemilik_kos` (`id_pemilik`, `nama_pemilik`, `no_telp`, `email`, `jenis_kelamin`, `foto`, `id_user`, `no_ktp`, `no_rek`, `bank`, `atas_nama_rek`, `tgl_daftar`) VALUES
(9, 'Dadang Eko', '13231232', 'ani@gmail.com', 'Laki-laki', 'artworks-000233389383-ndff7j-t500x500.jpg', 26, '1232131232', '12321321321', 'Mandiri', 'Dadang Konelo', '2021-04-08'),
(11, 'Pencari CInta Sejati', '123123213', 'm.abizard1123@gmail.com', 'Laki-laki', 'Capture.PNG', 28, '123123123', '112321321', 'BCA', 'Jeks', '2021-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `pencari_kos`
--

CREATE TABLE `pencari_kos` (
  `id_pencari` int(255) NOT NULL,
  `nama_pencari` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `no_ktp` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `no_telp_wali` varchar(255) DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `tgl_daftar` date NOT NULL,
  `id_user` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pencari_kos`
--

INSERT INTO `pencari_kos` (`id_pencari`, `nama_pencari`, `tempat_lahir`, `tgl_lahir`, `jenis_kelamin`, `email`, `no_telp`, `no_ktp`, `status`, `no_telp_wali`, `foto`, `tgl_daftar`, `id_user`) VALUES
(4, 'Pencari Kos Abi', 'Bandung', '2021-04-09', 'Laki-laki', 'ani@gmail.com', '1232132321', '12321321', '123232', '12312321321', 'pic03.jpg', '2021-04-08', 27),
(6, 'fad', 'das', '0000-00-00', '', '', '', NULL, NULL, NULL, '', '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penghuni_kos`
--

CREATE TABLE `penghuni_kos` (
  `nik` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8_bin NOT NULL,
  `umur` varchar(255) COLLATE utf8_bin NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `no_telp` varchar(255) COLLATE utf8_bin NOT NULL,
  `pekerjaan` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `status_transaksi`
--

CREATE TABLE `status_transaksi` (
  `id_status` int(11) NOT NULL,
  `keterangan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_forget_pass`
--

CREATE TABLE `tmp_forget_pass` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `kode` varchar(255) NOT NULL,
  `exp` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_pemilik` tinyint(255) DEFAULT NULL,
  `is_admin` tinyint(255) DEFAULT NULL,
  `status_aktif_pemilik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `is_pemilik`, `is_admin`, `status_aktif_pemilik`) VALUES
(17, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1, 0),
(26, 'pemilik', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 1),
(27, 'pencari', '827ccb0eea8a706c4c34a16891f84e7b', 0, 0, 0),
(28, 'pemilik2', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id_token` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `token` varchar(250) NOT NULL,
  `date_created` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`) USING BTREE,
  ADD KEY `admin_ibfk_1` (`id_user`);

--
-- Indexes for table `bayar_di_muka`
--
ALTER TABLE `bayar_di_muka`
  ADD PRIMARY KEY (`kode_dp`),
  ADD KEY `id_lunas_foreign_key` (`id_lunas`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`) USING BTREE,
  ADD UNIQUE KEY `kode_kamar` (`id_kamar`),
  ADD KEY `kode_kos` (`kode_kos`);

--
-- Indexes for table `kosan`
--
ALTER TABLE `kosan`
  ADD PRIMARY KEY (`kode_kos`),
  ADD UNIQUE KEY `kode_kos` (`kode_kos`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id_notifikasi`);

--
-- Indexes for table `pelunasan`
--
ALTER TABLE `pelunasan`
  ADD PRIMARY KEY (`id_lunas`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pesan`),
  ADD KEY `pemesanan_ibfk_3` (`id_penghuni`),
  ADD KEY `id_kamar` (`id_kamar`),
  ADD KEY `pemesanan_ibfk_2` (`id_pencari`);

--
-- Indexes for table `pemilik_kos`
--
ALTER TABLE `pemilik_kos`
  ADD PRIMARY KEY (`id_pemilik`),
  ADD KEY `pemilik_kos_ibfk_1` (`id_user`);

--
-- Indexes for table `pencari_kos`
--
ALTER TABLE `pencari_kos`
  ADD PRIMARY KEY (`id_pencari`),
  ADD KEY `pencari_kos_ibfk_1` (`id_user`);

--
-- Indexes for table `penghuni_kos`
--
ALTER TABLE `penghuni_kos`
  ADD PRIMARY KEY (`nik`);

--
-- Indexes for table `status_transaksi`
--
ALTER TABLE `status_transaksi`
  ADD PRIMARY KEY (`id_status`);

--
-- Indexes for table `tmp_forget_pass`
--
ALTER TABLE `tmp_forget_pass`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `unique_username` (`username`);

--
-- Indexes for table `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bayar_di_muka`
--
ALTER TABLE `bayar_di_muka`
  MODIFY `kode_dp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `pelunasan`
--
ALTER TABLE `pelunasan`
  MODIFY `id_lunas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pesan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `pemilik_kos`
--
ALTER TABLE `pemilik_kos`
  MODIFY `id_pemilik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pencari_kos`
--
ALTER TABLE `pencari_kos`
  MODIFY `id_pencari` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tmp_forget_pass`
--
ALTER TABLE `tmp_forget_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `bayar_di_muka`
--
ALTER TABLE `bayar_di_muka`
  ADD CONSTRAINT `id_lunas_foreign_key` FOREIGN KEY (`id_lunas`) REFERENCES `pelunasan` (`id_lunas`) ON DELETE CASCADE;

--
-- Constraints for table `kamar`
--
ALTER TABLE `kamar`
  ADD CONSTRAINT `kamar_ibfk_1` FOREIGN KEY (`kode_kos`) REFERENCES `kosan` (`kode_kos`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kosan`
--
ALTER TABLE `kosan`
  ADD CONSTRAINT `kosan_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik_kos` (`id_pemilik`);

--
-- Constraints for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_pencari`) REFERENCES `pencari_kos` (`id_pencari`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_3` FOREIGN KEY (`id_penghuni`) REFERENCES `penghuni_kos` (`nik`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_4` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`) ON DELETE CASCADE;

--
-- Constraints for table `pemilik_kos`
--
ALTER TABLE `pemilik_kos`
  ADD CONSTRAINT `pemilik_kos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `pencari_kos`
--
ALTER TABLE `pencari_kos`
  ADD CONSTRAINT `pencari_kos_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `update_pemesanan_status` ON SCHEDULE EVERY 1 MINUTE STARTS '2021-03-30 13:41:12' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE pemesanan set status_transaksi = 3 WHERE datediff(current_date(), tanggal_pesan) > 0$$

CREATE DEFINER=`root`@`localhost` EVENT `cancle_pesanan` ON SCHEDULE EVERY 10 HOUR STARTS '2021-04-22 01:03:21' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM pemesanan WHERE DATEDIFF(NOW(),tanggal_pesan) >=2$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
