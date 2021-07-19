-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2021 at 08:48 AM
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
-- Table structure for table `gambar_kosan`
--

CREATE TABLE `gambar_kosan` (
  `id_gambar` int(11) NOT NULL,
  `nama_file` varchar(250) NOT NULL,
  `tempat` varchar(250) NOT NULL,
  `id_kosan` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gambar_kosan`
--

INSERT INTO `gambar_kosan` (`id_gambar`, `nama_file`, `tempat`, `id_kosan`) VALUES
(13, 'foto-60f14d8da4670.jpg', 'depan', 'osan4967'),
(14, 'foto-60f14d8da5289.jpg', 'belakang', 'osan4967'),
(15, 'foto-60f14d8da5289.jpg', 'belakang', 'OSAB6456');

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
  `tgl_tersedia` date NOT NULL,
  `is_aktif` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kamar`
--

INSERT INTO `kamar` (`id_kamar`, `kode_kamar`, `kode_kos`, `harga`, `harga_smesteran`, `deskripsi`, `foto`, `status`, `tgl_tersedia`, `is_aktif`) VALUES
(8, '1', 'OSAB6456', 12000000, 6000000, 'asdsa', 'BACKGROUND_MUBES_HMDSI.png', 'Booked', '2021-04-08', 1),
(10, '2', 'OSAB6456', 5000000, 2500000, '3x2', 'Tom_Clancys_Rainbow_Six®_Siege2021-3-26-22-51-25.jpg', 'Booked', '2021-05-20', 1),
(12, '007', 'OSAB6456', 4000000, 2000000, 'kamar james bond', 'Tom_Clancys_Rainbow_Six®_Siege2021-4-19-1-37-52.jpg', 'Tersedia', '2021-03-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int(11) NOT NULL,
  `id_kamar` int(11) NOT NULL,
  `id_pencari` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kosan`
--

CREATE TABLE `kosan` (
  `kode_kos` varchar(255) NOT NULL,
  `nama_kos` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `jenis_kosan` varchar(255) NOT NULL,
  `saldo_kos` int(255) NOT NULL,
  `tanggal_daftar` date NOT NULL DEFAULT current_timestamp(),
  `id_pemilik` int(255) NOT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kosan`
--

INSERT INTO `kosan` (`kode_kos`, `nama_kos`, `alamat`, `deskripsi`, `jenis_kosan`, `saldo_kos`, `tanggal_daftar`, `id_pemilik`, `foto`) VALUES
('OSAB6456', 'KOSABC', 'Bandung', 'Luas kamar ini adalah 12. Untuk tegangan listrik yaitu 12. Deskrip lainnya berupa, 12', 'Putra', 0, '2021-04-08', 9, ''),
('osan4967', 'Kosan Murah', 'Menteng', 'Luas kamar ini adalah 5 x 5. Untuk tegangan listrik yaitu 100 V. Deskrip lainnya berupa, Aman, Bebas Banjir, Deket Telkom Fakultas Ilmu Terapan', 'Putra', 0, '2021-07-16', 9, '');

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
(31, 'Silahkan Melakukan Pelunasan', '9', '4', 0, 'pelunasan', '2021-07-07 23:33:31', NULL),
(32, 'Ada pembayaran lunas', '4', '26', 0, 'pembayaran', '2021-07-07 23:33:49', 'OSAB6456'),
(33, 'Pesanan Diterima', '9', '4', 0, 'info', '2021-07-07 23:33:59', NULL),
(34, 'Segera Bayar DP untuk kosanmu!', '26', '4', 0, 'pembayaran', '2021-07-16 21:40:14', NULL),
(35, 'Ada Pesanan Baru', '4', '26', 0, 'pemesanan', '2021-07-16 21:40:14', 'OSAB6456'),
(36, 'Ada pesanan baru nih!', '27', '26', 0, 'pemesanan', '2021-07-16 21:40:40', 'OSAB6456'),
(37, 'Silahkan Melakukan Pelunasan', '9', '4', 0, 'pelunasan', '2021-07-16 21:41:51', NULL),
(38, 'Ada pembayaran lunas', '4', '26', 0, 'pembayaran', '2021-07-16 21:45:05', 'OSAB6456'),
(39, 'Segera Bayar DP untuk kosanmu!', '26', '4', 0, 'pembayaran', '2021-07-16 21:46:38', NULL),
(40, 'Ada Pesanan Baru', '4', '26', 0, 'pemesanan', '2021-07-16 21:46:38', 'OSAB6456'),
(41, 'Ada pesanan baru nih!', '27', '26', 0, 'pemesanan', '2021-07-16 21:47:31', 'OSAB6456'),
(42, 'Silahkan Melakukan Pelunasan', '9', '4', 0, 'pelunasan', '2021-07-16 21:47:37', NULL),
(43, 'Ada pembayaran lunas', '4', '26', 0, 'pembayaran', '2021-07-16 23:20:43', 'OSAB6456'),
(44, 'Silahkan Melakukan Pelunasan', '9', '4', 0, 'pelunasan', '2021-07-16 23:39:35', NULL),
(45, 'Segera Bayar DP untuk kosanmu!', '26', '4', 0, 'pembayaran', '2021-07-16 23:42:05', NULL),
(46, 'Ada Pesanan Baru', '4', '26', 0, 'pemesanan', '2021-07-16 23:42:05', 'OSAB6456'),
(47, 'Segera Bayar DP untuk kosanmu!', '26', '4', 0, 'pembayaran', '2021-07-16 23:42:55', NULL),
(48, 'Ada Pesanan Baru', '4', '26', 0, 'pemesanan', '2021-07-16 23:42:55', 'OSAB6456'),
(49, 'Ada pesanan baru nih!', '27', '26', 0, 'pemesanan', '2021-07-16 23:43:49', 'OSAB6456'),
(50, 'Silahkan Melakukan Pelunasan', '9', '4', 0, 'pelunasan', '2021-07-16 23:45:35', NULL),
(51, 'Ada pembayaran lunas', '4', '26', 0, 'pembayaran', '2021-07-16 23:45:49', 'OSAB6456'),
(52, 'Pesanan Diterima', '9', '4', 0, 'info', '2021-07-16 23:46:03', NULL),
(53, 'Segera Bayar DP untuk kosanmu!', '26', '4', 0, 'pembayaran', '2021-07-16 23:51:17', NULL),
(54, 'Ada Pesanan Baru', '4', '26', 0, 'pemesanan', '2021-07-16 23:51:17', 'OSAB6456'),
(55, 'Ada pesanan baru nih!', '27', '26', 0, 'pemesanan', '2021-07-16 23:51:36', 'OSAB6456'),
(56, 'Silahkan Melakukan Pelunasan', '9', '4', 0, 'pelunasan', '2021-07-16 23:51:48', NULL),
(57, 'Ada pembayaran lunas', '4', '26', 0, 'pembayaran', '2021-07-16 23:52:03', 'OSAB6456'),
(58, 'Pesanan Diterima', '9', '4', 0, 'info', '2021-07-16 23:52:28', NULL),
(59, 'Segera Bayar DP untuk kosanmu!', '26', '4', 0, 'pembayaran', '2021-07-16 23:54:01', NULL),
(60, 'Ada Pesanan Baru', '4', '26', 0, 'pemesanan', '2021-07-16 23:54:01', 'OSAB6456'),
(61, 'Ada pesanan baru nih!', '27', '26', 0, 'pemesanan', '2021-07-16 23:54:11', 'OSAB6456'),
(62, 'Silahkan Melakukan Pelunasan', '9', '4', 0, 'pelunasan', '2021-07-16 23:54:18', NULL),
(63, 'Ada pembayaran lunas', '4', '26', 0, 'pembayaran', '2021-07-16 23:54:32', 'OSAB6456'),
(64, 'Pesanan Diterima', '9', '4', 1, 'info', '2021-07-17 00:00:39', NULL),
(65, 'Segera Bayar DP untuk kosanmu!', '26', '4', 0, 'pembayaran', '2021-07-19 09:47:23', NULL),
(66, 'Ada Pesanan Baru', '4', '26', 0, 'pemesanan', '2021-07-19 09:47:23', 'OSAB6456'),
(67, 'Ada pesanan baru nih!', '27', '26', 0, 'pemesanan', '2021-07-19 09:47:49', 'OSAB6456'),
(68, 'Silahkan Melakukan Pelunasan', '9', '4', 0, 'pelunasan', '2021-07-19 09:53:22', NULL),
(69, 'Ada pembayaran lunas', '4', '26', 0, 'pembayaran', '2021-07-19 09:53:45', 'OSAB6456'),
(70, 'Pesanan Diterima', '9', '4', 0, 'info', '2021-07-19 09:53:54', NULL),
(71, 'Segera Bayar DP untuk kosanmu!', '26', '4', 0, 'pembayaran', '2021-07-19 09:56:47', NULL),
(72, 'Ada Pesanan Baru', '4', '26', 0, 'pemesanan', '2021-07-19 09:56:47', 'OSAB6456'),
(73, 'Ada pesanan baru nih!', '27', '26', 0, 'pemesanan', '2021-07-19 09:57:03', 'OSAB6456');

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
  `mou` varchar(250) COLLATE utf8_bin NOT NULL,
  `id_pesan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `pelunasan`
--

INSERT INTO `pelunasan` (`id_lunas`, `tanggal`, `jam_pelunasan`, `jumlah_pelunasan`, `bukti_pelunasan`, `mou`, `id_pesan`) VALUES
(23, '2021-07-19', '04:53:45', 9600000, '60f4e939efc20.png', '60f4e939efe59.png', 52);

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
(52, 'suci', '12312123123', '12312312312', '2021-07-19', '2021-07-19', '2022-07-19', '', '1 Tahun', '2400000', '60f4e7d5d5eae.png', 0, 2, NULL, 4, NULL, 8),
(53, 'rara', '12312312312', '12312312', '2021-07-19', '2021-07-19', '2022-07-19', '', '1 Tahun', '1000000', '60f4e9ff66370.jpg', 4000000, 0, NULL, 4, NULL, 10);

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
  `tgl_daftar` date NOT NULL,
  `file_mou` varchar(250) DEFAULT NULL,
  `tanggal_upload_mou` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilik_kos`
--

INSERT INTO `pemilik_kos` (`id_pemilik`, `nama_pemilik`, `no_telp`, `email`, `jenis_kelamin`, `foto`, `id_user`, `no_ktp`, `no_rek`, `bank`, `atas_nama_rek`, `tgl_daftar`, `file_mou`, `tanggal_upload_mou`) VALUES
(9, 'Dadang Konelo', '081382716172', 'ani@gmail.com', 'Laki-laki', 'thumb-1920-1125041.png', 26, '1232131232', '12321321321', 'Mandiri', 'Dadang Konelo', '2021-07-19', 'mou-60f513f53cf0e.pdf', '2021-07-19'),
(14, 'asdas', '123123123', 'dianpekok@gmail.com', 'Laki-laki', 'download.jpg', 33, '12312312', '12312312304', 'adas', 'asdasas', '2021-07-19', NULL, NULL);

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
(4, 'Pencari Kos abadai', 'Bandung', '2021-04-09', 'Laki-laki', 'ani@gmail.com', '1232132321', '12321321', '123232', '12312321321', 'thumb-1920-1125041.png', '2021-04-08', 27),
(8, 'ewrwe', 'asdas', '2021-07-27', 'Laki-laki', 'asdas@gmail.com', '1231312', '12312312', 'asdas', '123122', 'unnamed.jpg', '2021-07-07', 31);

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
(27, 'pencari', '827ccb0eea8a706c4c34a16891f84e7b', 0, 0, 1),
(28, 'pemilik2', '827ccb0eea8a706c4c34a16891f84e7b', 1, 0, 99),
(31, 'werw', '827ccb0eea8a706c4c34a16891f84e7b', 0, 0, 1),
(33, 'pemilik3', '25d55ad283aa400af464c76d713c07ad', 1, 0, 0);

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
-- Dumping data for table `user_token`
--

INSERT INTO `user_token` (`id_token`, `email`, `token`, `date_created`) VALUES
(4, 'm.abizard1123@gmail.com', 'gMQFjUv6Vw3HVKALUPHmVI7n66w94y/9fZrdxEU396M=', '1625677965'),
(5, 'm.abizard1123@gmail.com', 'JPC5bLfHTod+nQeS1TMzU3i+DPcnDJWLcfKHg83ea5A=', '1625677995');

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
-- Indexes for table `gambar_kosan`
--
ALTER TABLE `gambar_kosan`
  ADD PRIMARY KEY (`id_gambar`);

--
-- Indexes for table `kamar`
--
ALTER TABLE `kamar`
  ADD PRIMARY KEY (`id_kamar`) USING BTREE,
  ADD UNIQUE KEY `kode_kamar` (`id_kamar`),
  ADD KEY `kode_kos` (`kode_kos`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

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
-- AUTO_INCREMENT for table `gambar_kosan`
--
ALTER TABLE `gambar_kosan`
  MODIFY `id_gambar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `kamar`
--
ALTER TABLE `kamar`
  MODIFY `id_kamar` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id_notifikasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `pelunasan`
--
ALTER TABLE `pelunasan`
  MODIFY `id_lunas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pesan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `pemilik_kos`
--
ALTER TABLE `pemilik_kos`
  MODIFY `id_pemilik` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `pencari_kos`
--
ALTER TABLE `pencari_kos`
  MODIFY `id_pencari` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tmp_forget_pass`
--
ALTER TABLE `tmp_forget_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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

CREATE DEFINER=`root`@`localhost` EVENT `expired_pemilik` ON SCHEDULE EVERY 7 DAY STARTS '2021-07-19 13:44:40' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE user set status_aktif_pemilik = 99 WHERE is_pemilik = 1 AND status_aktif_pemilik = 0$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
