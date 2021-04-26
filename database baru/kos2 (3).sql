-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2021 at 02:33 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kos2`
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
(8, '1', 'OSAB6456', 12000000, 6000000, 'asdsa', 'BACKGROUND_MUBES_HMDSI.png', 'Booked', '2021-04-08');

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
('OSAB6456', 'KOSABC', 'Bandung', 'Luas kamar ini adalah 12. Untuk tegangan listrik yaitu 12. Deskrip lainnya berupa, 12', 'thumb-1920-1125041.png', 'Putra', 0, '2021-04-08', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id_notifikasi` int(11) NOT NULL,
  `isi_pesan` varchar(250) NOT NULL,
  `dari` varchar(250) NOT NULL,
  `untuk` varchar(250) NOT NULL,
  `status_baca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `isi_pesan`, `dari`, `untuk`, `status_baca`) VALUES
(2, 'Ada pesanan baru nih!', '27', '26', 0),
(3, 'Ada pesanan baru nih!', '27', '26', 0);

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
(30, 'asdsa', '12312321', '213213', '2021-04-26', '2021-04-26', '2021-10-26', '', '6 Bulan', '1200000', '6086a8669ea4f.png', 4800000, 0, NULL, 4, NULL, 8);

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
(9, 'Dadang Konelo', '13231232', 'ani@gmail.com', 'Laki-laki', 'thumb-1920-1125041.png', 26, '1232131232', '12321321321', 'Mandiri', 'Dadang Konelo', '2021-04-08'),
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
(4, 'Pencari Kos abadai', 'Bandung', '2021-04-09', 'Laki-laki', 'ani@gmail.com', '1232132321', '12321321', '123232', '12312321321', 'thumb-1920-1125041.png', '2021-04-08', 27);

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
  MODIFY `id_kamar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pelunasan`
--
ALTER TABLE `pelunasan`
  MODIFY `id_lunas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pesan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pemilik_kos`
--
ALTER TABLE `pemilik_kos`
  MODIFY `id_pemilik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pencari_kos`
--
ALTER TABLE `pencari_kos`
  MODIFY `id_pencari` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
