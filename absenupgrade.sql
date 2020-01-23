-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2019 at 12:36 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `absenupgrade`
--

-- --------------------------------------------------------

--
-- Table structure for table `datapegawai`
--

CREATE TABLE `datapegawai` (
  `id` int(255) NOT NULL,
  `tag` text NOT NULL,
  `nama` text NOT NULL,
  `jabatan` text NOT NULL,
  `nomerhp` text NOT NULL,
  `email` text NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `icon`
--

CREATE TABLE `icon` (
  `id_icon` int(11) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `icon`
--

INSERT INTO `icon` (`id_icon`, `icon`) VALUES
(1, 'mdi mdi-plus'),
(2, 'mdi mdi-home'),
(3, 'mdi mdi-pencil'),
(4, 'mdi mdi-delete'),
(5, 'mdi mdi-upload'),
(6, 'mdi mdi-download'),
(7, 'mdi mdi-refresh'),
(9, 'mdi mdi-archive'),
(11, 'mdi  mdi-camera'),
(12, 'mdi mdi-printer'),
(13, 'mdi mdi-file');

-- --------------------------------------------------------

--
-- Table structure for table `konfig`
--

CREATE TABLE `konfig` (
  `id_konfig` int(11) NOT NULL,
  `nama_aplikasi` varchar(50) NOT NULL,
  `tgl` date DEFAULT NULL,
  `klien` text,
  `created_by` varchar(45) DEFAULT NULL,
  `footer` text NOT NULL,
  `logo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `konfig`
--

INSERT INTO `konfig` (`id_konfig`, `nama_aplikasi`, `tgl`, `klien`, `created_by`, `footer`, `logo`) VALUES
(41, 'Sistem Presensi Pegawai', '2019-08-22', 'Bithub.id', 'Alfajri Hulvi', 'Copyrigth 2019 ', 'e5b12b19e902fc8563b95bb57498860b.png');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `level` varchar(50) NOT NULL,
  `direct_link` varchar(45) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `level`, `direct_link`, `keterangan`) VALUES
(1, 'administrator', 'dashboard', 'Hanya Untuk Admin'),
(2, 'user', 'dashboard', 'Hanya Untuk User Biasa');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id_log` int(11) NOT NULL,
  `time_log` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_log` varchar(255) DEFAULT NULL,
  `tipe_log` int(11) DEFAULT NULL,
  `desc_log` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id_log`, `time_log`, `user_log`, `tipe_log`, `desc_log`) VALUES
(1, '2019-10-02 10:09:37', 'admin', 2, 'Menambahkan data menu'),
(2, '2019-10-02 10:10:05', 'admin', 2, 'Menambahkan data menu'),
(3, '2019-10-02 10:10:18', 'admin', 2, 'Menambahkan data menu'),
(4, '2019-10-02 10:10:50', 'admin', 2, 'Menambahkan data menu'),
(5, '2019-10-02 10:16:29', 'admin', 2, 'Menambahkan data user');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `menu` varchar(45) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `icon` int(11) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  `id_parents` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `menu`, `level`, `icon`, `link`, `id_parents`) VALUES
(1, 'Pegawai', 1, 9, '', 0),
(2, 'Kelola Data', 1, 9, 'pegawai', 1),
(3, 'Presensi', 1, 9, '', 0),
(4, 'Kelola Data', 1, 9, 'presensi', 3);

-- --------------------------------------------------------

--
-- Table structure for table `presensi`
--

CREATE TABLE `presensi` (
  `id` int(255) NOT NULL,
  `tag` text NOT NULL,
  `nama` text NOT NULL,
  `tanggal` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirm_password` varchar(100) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `level` int(11) NOT NULL,
  `token` varchar(45) DEFAULT NULL,
  `token_expired` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_loginIP` varchar(45) DEFAULT NULL,
  `created_user` datetime DEFAULT NULL,
  `created_IP` varchar(45) DEFAULT NULL,
  `hint` varchar(200) DEFAULT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `confirm_password`, `f_name`, `l_name`, `email`, `no_hp`, `level`, `token`, `token_expired`, `last_login`, `last_loginIP`, `created_user`, `created_IP`, `hint`, `status`, `foto`) VALUES
(1, 'admin', 'fcea920f7412b5da7be0cf42b8c93759', 'fcea920f7412b5da7be0cf42b8c93759', 'Super', 'Admin', 'admin123@gmail.com', '081287881363', 1, '898989', '2019-03-31 10:26:27', '2019-10-02 17:08:54', '::1', '2019-03-01 11:29:33', '::1', NULL, '1', 'no_img.jpg'),
(2, 'fajri', 'e10adc3949ba59abbe56e057f20f883e', 'e10adc3949ba59abbe56e057f20f883e', 'Fajri', 'Hulvi', 'fajri@gmail,com', '081287881363', 2, '356461', NULL, '2019-10-02 17:17:03', '::1', '2019-10-02 17:16:29', '::1', NULL, '0', 'no_img.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datapegawai`
--
ALTER TABLE `datapegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `icon`
--
ALTER TABLE `icon`
  ADD PRIMARY KEY (`id_icon`);

--
-- Indexes for table `konfig`
--
ALTER TABLE `konfig`
  ADD PRIMARY KEY (`id_konfig`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`),
  ADD KEY `fk_menu_menu1_idx` (`id_parents`),
  ADD KEY `fk_menu_level1_idx` (`level`);

--
-- Indexes for table `presensi`
--
ALTER TABLE `presensi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD KEY `fk_user_level_idx` (`level`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datapegawai`
--
ALTER TABLE `datapegawai`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `icon`
--
ALTER TABLE `icon`
  MODIFY `id_icon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `konfig`
--
ALTER TABLE `konfig`
  MODIFY `id_konfig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `presensi`
--
ALTER TABLE `presensi`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
