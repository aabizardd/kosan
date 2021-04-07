-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2021 at 09:26 AM
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
(2, 'A12', 'ejah3655', 12000000, 7000000, 'mantap', '1_2fpfv8Np1AGdmp2axA9rXQ.png', 'Tersedia', '2021-03-02'),
(3, 'A13', 'ejah3655', 10000000, 6000000, 'Large', '1_2fpfv8Np1AGdmp2axA9rXQ.png', 'Tersedia', '2021-03-02');

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
('ejah3655', 'sejahtera', 'Bogor', 'nyaman sejahter', '1_2fpfv8Np1AGdmp2axA9rXQ.png', 'Putra', 300000, '2021-04-01', 4);

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
  `id_pemilik` int(11) NOT NULL,
  `id_pencari` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id_notifikasi`, `isi_pesan`, `dari`, `untuk`, `status_baca`, `id_pemilik`, `id_pencari`) VALUES
(1, 'Ada Pesanan Baru Nih!', '2', '4', 1, 4, 2),
(2, 'Ada Pesanan Baru Nih!', '2', '4', 1, 4, 2),
(3, 'Ada Pesanan Baru Nih!', '2', '4', 1, 4, 2),
(4, 'Ada Pesanan Baru Nih!', '2', '4', 1, 4, 2),
(5, 'Ada Pesanan Baru Nih!', '2', '4', 1, 4, 2),
(6, 'Ada Pesanan Baru Nih!', '2', '4', 1, 4, 2),
(7, 'Pesanan anda diterima!', '4', '2', 0, 4, 2),
(8, 'Pesanan anda diterima!', '4', '2', 0, 4, 2),
(9, 'Pesanan anda diterima!', '4', '2', 0, 4, 2),
(10, 'Pesanan anda diterima!', '4', '2', 0, 4, 2),
(11, 'Ada Pesanan Baru Nih!', '2', '4', 1, 4, 2),
(12, 'Ada Pesanan Baru Nih!', '2', '4', 1, 4, 2),
(13, 'Pesanan anda diterima!', '4', '2', 0, 4, 2),
(14, 'Pesanan anda diterima!', '4', '2', 0, 4, 2);

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
(9, '2021-03-29', '10:11:02', 8000000, '60642e965ef23.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pesan` int(10) NOT NULL,
  `nama_penghuni` varchar(250) COLLATE utf8_bin NOT NULL,
  `tanggal_pesan` date NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `jam` varchar(255) COLLATE utf8_bin NOT NULL,
  `jangka_waktu` varchar(250) COLLATE utf8_bin NOT NULL,
  `jumlah_dp` varchar(255) COLLATE utf8_bin NOT NULL,
  `bukti_bayar` varchar(250) COLLATE utf8_bin NOT NULL,
  `sisa_pembayaran` int(255) DEFAULT NULL,
  `status_transaksi` tinyint(255) DEFAULT NULL,
  `id_pencari` int(255) DEFAULT NULL,
  `id_penghuni` int(11) DEFAULT NULL,
  `id_kamar` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pemesanan`
--

INSERT INTO `pemesanan` (`id_pesan`, `nama_penghuni`, `tanggal_pesan`, `tanggal_masuk`, `tanggal_keluar`, `jam`, `jangka_waktu`, `jumlah_dp`, `bukti_bayar`, `sisa_pembayaran`, `status_transaksi`, `id_pencari`, `id_penghuni`, `id_kamar`) VALUES
(1, 'Suci', '2021-03-31', '2021-03-31', '2022-03-31', '', '1 Tahun', '2000000', '6063f7059db65.jpg', 0, 2, 2, NULL, 3),
(4, 'Lisa', '2021-03-31', '2021-04-01', '2021-10-01', '', '6 Bulan', '300000', '606429f43fa02.jpg', 0, 1, 2, NULL, 2);

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
(4, 'SURAM (Suci Rara Mantap)', '081300000001', 'm.abizard1123@gmail.com', 'Laki-laki', '1_2fpfv8Np1AGdmp2axA9rXQ.png', 18, '000101010101', '12341234123', 'Mandiri', 'Suci', '2021-04-01');

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
(2, 'pencari', 'entah', '2021-12-31', 'Laki-laki', 'pencari@gmail.com', '123412341234', '123412341234', 'warga', '123412341234', '1_2fpfv8Np1AGdmp2axA9rXQ.png', '2021-04-01', 15);

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

--
-- Dumping data for table `tmp_forget_pass`
--

INSERT INTO `tmp_forget_pass` (`id`, `email`, `kode`, `exp`) VALUES
(3, 'pemilik@gmail.com', '43b52842663fa6e4100c72751d08de6f', '22'),
(2, 'pemilik@gmail.com', 'f0a5944c6a815b7bb44323d783eede4d', '22'),
(4, 'pemilik@gmail.com', 'f24ad6f72d6cc4cb51464f2b29ab69d3', '22'),
(5, 'pemilik@gmail.com', '4bb236de7787ceedafdff83bb8ea4710', '22'),
(6, 'pemilik@gmail.com', '5f0453f78909173a7ce2eb874d2a7f52', '22'),
(7, 'pemilik@gmail.com', 'b112ca4087d668785e947a57493d1740', '22'),
(8, 'pemilik@gmail.com', 'c2c2a04512b35d13102459f8784f1a2d', '22'),
(9, 'pemilik@gmail.com', '243facb29564e7b448834a7c9d901201', '22'),
(10, 'pemilik@gmail.com', '95a7e4252fc7bc562a711ef96884a383', '22'),
(11, 'pemilik@gmail.com', '4f1f29888cabf5d45f866fe457737a23', '22'),
(12, 'pemilik@gmail.com', '4764f37856fc727f70b666b8d0c4ab7a', '22'),
(13, 'pemilik@gmail.com', 'ab9ebd57177b5106ad7879f0896685d4', '21'),
(14, 'pemilik@gmail.com', 'c30fb4dc55d801fc7473840b5b161dfa', '21'),
(15, 'pemilik@gmail.com', 'dbbf603ff0e99629dda5d75b6f75f966', '22'),
(16, 'pencari@gmail.com', '5747a0021eb349e9c8d3667cf1a5e9ec', '11'),
(17, 'pemilik@gmail.com', '941e1aaaba585b952b62c14a3a175a61', '12'),
(18, 'pemilik@gmail.com', '298f587406c914fad5373bb689300433', '12'),
(19, 'pencari@gmail.com', '1d01bd2e16f57892f0954902899f0692', '07'),
(20, 'admin@gmail.com', '931af583573227f0220bc568c65ce104', '07');

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
(15, 'pencari', '827ccb0eea8a706c4c34a16891f84e7b', 0, 0, 0),
(17, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 0, 1, 0),
(18, 'pemilik', 'fcea920f7412b5da7be0cf42b8c93759', 1, 0, 1);

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
  MODIFY `id_kamar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pelunasan`
--
ALTER TABLE `pelunasan`
  MODIFY `id_lunas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pesan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pemilik_kos`
--
ALTER TABLE `pemilik_kos`
  MODIFY `id_pemilik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pencari_kos`
--
ALTER TABLE `pencari_kos`
  MODIFY `id_pencari` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tmp_forget_pass`
--
ALTER TABLE `tmp_forget_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  ADD CONSTRAINT `pemesanan_ibfk_2` FOREIGN KEY (`id_pencari`) REFERENCES `pencari_kos` (`id_pencari`),
  ADD CONSTRAINT `pemesanan_ibfk_3` FOREIGN KEY (`id_penghuni`) REFERENCES `penghuni_kos` (`nik`) ON DELETE CASCADE,
  ADD CONSTRAINT `pemesanan_ibfk_4` FOREIGN KEY (`id_kamar`) REFERENCES `kamar` (`id_kamar`);

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

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
