-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2020 at 08:25 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `temp_spo`
--

-- --------------------------------------------------------

--
-- Table structure for table `l_pegawai`
--

CREATE TABLE `l_pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `pegawai_nik` varchar(16) DEFAULT NULL,
  `pegawai_nama` varchar(100) NOT NULL,
  `pegawai_opd` int(11) NOT NULL,
  `pegawai_upload` int(11) DEFAULT NULL,
  `is_updated` int(1) NOT NULL DEFAULT 0,
  `tgl_updated` date DEFAULT NULL,
  `is_aktif` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `l_pegawai`
--

INSERT INTO `l_pegawai` (`id_pegawai`, `pegawai_nik`, `pegawai_nama`, `pegawai_opd`, `pegawai_upload`, `is_updated`, `tgl_updated`, `is_aktif`) VALUES
(1, '-', 'Emmanuel Kongo', 1, NULL, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_level_user`
--

CREATE TABLE `m_level_user` (
  `id_level_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `is_aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_level_user`
--

INSERT INTO `m_level_user` (`id_level_user`, `nama`, `is_aktif`) VALUES
(1, 'Administrator', 1),
(2, 'Admin Wilayah', 1),
(3, 'Pemantau Wilayah', 1),
(4, 'OPD', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_opd`
--

CREATE TABLE `m_opd` (
  `id_opd` int(11) NOT NULL,
  `opd_nama` varchar(100) NOT NULL,
  `opd_alias` varchar(25) NOT NULL,
  `opd_wil` varchar(4) NOT NULL,
  `is_aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_opd`
--

INSERT INTO `m_opd` (`id_opd`, `opd_nama`, `opd_alias`, `opd_wil`, `is_aktif`) VALUES
(1, 'BPS Provinsi Bali', 'bpsbali', '5100', 1),
(4, 'Badan Kepegawaian Daerah', 'bkdbali', '5100', 2),
(5, 'Badan Kesatuan Bangsa Dan Politik', 'bkbpbali', '5100', 1),
(6, 'Badan Penanggulangan Bencana Daerah', 'bpbdbali', '5100', 1),
(7, 'Badan Pendapatan Daerah', 'bapendabali', '5100', 1),
(8, 'Badan Pengelola Keuangan Dan Aset Daerah', 'bpkadbali', '5100', 1),
(9, 'Badan Pengembangan Sumber Daya Manusia', 'bpsdmbali', '5100', 1),
(10, 'Badan Penghubung', 'babungbali', '5100', 1),
(11, 'Badan Perencanaan Pembangunan Daerah', 'bappedabali', '5100', 1),
(12, 'Badan Riset Dan Inovasi Daerah', 'bridbali', '5100', 1),
(13, 'Biro Hukum', 'birokumbali', '5100', 1),
(14, 'Biro Organisasi', 'birogbali', '5100', 1),
(15, 'Biro Pemerintahan Dan Kesejahteraan Rakyat', 'biropkesrabali', '5100', 1),
(16, 'Biro Pengadaan Barang Dan Jasa', 'biropbjbali', '5100', 1),
(17, 'Biro Perekonomian Dan Administrasi Pembangunan', 'biroekadpembali', '5100', 1),
(18, 'Biro Umum Dan Protokol', 'biroumprobali', '5100', 1),
(19, 'Dinas Kearsipan Dan Perpustakaan', 'disarpusbali', '5100', 1),
(20, 'Dinas Kebudayaan', 'disbudbali', '5100', 1),
(21, 'Dinas Kehutanan Dan Lingkungan Hidup', 'dklhbali', '5100', 1),
(22, 'Dinas Kelautan Dan Perikanan', 'dislautkanbali', '5100', 1),
(23, 'Dinas Kesehatan', 'dinkesbali', '5100', 1),
(24, 'Dinas Ketenagakerjaan Dan Energi Sumber Daya Mineral', 'disnakeresdmbali', '5100', 1),
(25, 'Dinas Komunikasi, Informatika Dan Statistik', 'diskominfosbali', '5100', 1),
(26, 'Dinas Koperasi, Usaha Kecil Dan Menengah', 'dinkopukmbali', '5100', 1),
(27, 'Dinas Pariwisata', 'disparbali', '5100', 1),
(28, 'Dinas Pekerjaan Umum, Penataan Ruang, Perumahan Dan Kawasan Permukiman', 'dinpuprbali', '5100', 1),
(29, 'Dinas Pemajuan Masyarakat Adat', 'dpmabali', '5100', 1),
(30, 'Dinas Pemberdayaan Masyarakat, Desa, Kependudukan Dan Catatan Sipil', 'dispmddukcapilbali', '5100', 1),
(31, 'Dinas Penanaman Modal Dan Pelayanan Terpadu Satu Pintu', 'dpmptspbali', '5100', 1),
(32, 'Dinas Pendidikan, Kepemudaan Dan Olahraga', 'disdikporabali', '5100', 1),
(33, 'Dinas Perhubungan', 'disbhubbali', '5100', 1),
(34, 'Dinas Perindustrian Dan Perdagangan', 'disperindagbali', '5100', 1),
(35, 'Dinas Pertanian Dan Ketahanan Pangan', 'distanpanganbali', '5100', 1),
(36, 'Dinas Sosial, Pemberdayaan Perempuan Dan Perlindungan Anak', 'dinsospppabali', '5100', 1),
(37, 'Gubernur Bali (Staf Ahli)', 'gubbali', '5100', 1),
(38, 'Inspektorat', 'inspekbali', '5100', 1),
(39, 'Satuan Polisi Pamong Praja', 'satpolppbali', '5100', 1),
(40, 'Sekretariat Daerah', 'setdabali', '5100', 1),
(41, 'Sekretariat Dprd', 'setdprdbali', '5100', 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_user`
--

CREATE TABLE `m_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `salt_password` varchar(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `avatar` varchar(50) NOT NULL,
  `user_opd` int(11) NOT NULL,
  `user_wil` varchar(4) NOT NULL,
  `user_level` int(11) NOT NULL,
  `is_aktif` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_user`
--

INSERT INTO `m_user` (`id_user`, `username`, `password`, `salt_password`, `nama`, `avatar`, `user_opd`, `user_wil`, `user_level`, `is_aktif`) VALUES
(1, 'admin5100', '9afc61ca2602d97d4b64a04655bc5434', '58ed7d88bf8703.80862057', 'Admin Provinsi Bali', 'default.png', 1, '5100', 2, 1),
(12, 'bps5100', '9afc61ca2602d97d4b64a04655bc5434', '58ed7d88bf8703.80862057', 'BPS Prov. Bali', 'default.png', 1, '5100', 4, 1),
(14, 'pim5100', '9afc61ca2602d97d4b64a04655bc5434', '58ed7d88bf8703.80862057', 'Pimpinan Provinsi Bali', 'default.png', 40, '5100', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_wil`
--

CREATE TABLE `m_wil` (
  `id_wil` varchar(4) NOT NULL,
  `wil_nama` varchar(50) NOT NULL,
  `wil_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `m_wil`
--

INSERT INTO `m_wil` (`id_wil`, `wil_nama`, `wil_level`) VALUES
('5100', 'Provinsi Bali', 2),
('5101', 'Kabupaten Jembrana', 3),
('5102', 'Kabupaten Tabanan', 3),
('5103', 'Kabupaten Badung', 3),
('5104', 'Kabupaten Gianyar', 3),
('5105', 'Kabupaten Klungkung', 3),
('5106', 'Kabupaten Bangli', 3),
('5107', 'Kabupaten Karangasem', 3),
('5108', 'Kabupaten Buleleng', 3),
('5171', 'Kota Denpasar', 3);

-- --------------------------------------------------------

--
-- Table structure for table `t_generated`
--

CREATE TABLE `t_generated` (
  `id_generated` int(11) NOT NULL,
  `generated_nama` varchar(100) NOT NULL,
  `id_upload` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `t_upload`
--

CREATE TABLE `t_upload` (
  `id_upload` int(11) NOT NULL,
  `upload_md5` varchar(50) NOT NULL,
  `upload_file_loc` varchar(250) NOT NULL,
  `upload_opd` int(11) NOT NULL,
  `upload_status` int(1) NOT NULL,
  `upload_flag_pegawai` int(1) NOT NULL DEFAULT 0,
  `tgl_upload` date NOT NULL,
  `upload_ket` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `l_pegawai`
--
ALTER TABLE `l_pegawai`
  ADD PRIMARY KEY (`id_pegawai`),
  ADD KEY `pegawai_opd` (`pegawai_opd`),
  ADD KEY `pegawai_upload` (`pegawai_upload`);

--
-- Indexes for table `m_level_user`
--
ALTER TABLE `m_level_user`
  ADD PRIMARY KEY (`id_level_user`);

--
-- Indexes for table `m_opd`
--
ALTER TABLE `m_opd`
  ADD PRIMARY KEY (`id_opd`),
  ADD KEY `opd_wil` (`opd_wil`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_level` (`user_level`),
  ADD KEY `user_opd` (`user_opd`),
  ADD KEY `user_wil` (`user_wil`);

--
-- Indexes for table `m_wil`
--
ALTER TABLE `m_wil`
  ADD PRIMARY KEY (`id_wil`);

--
-- Indexes for table `t_generated`
--
ALTER TABLE `t_generated`
  ADD PRIMARY KEY (`id_generated`),
  ADD KEY `id_upload` (`id_upload`);

--
-- Indexes for table `t_upload`
--
ALTER TABLE `t_upload`
  ADD PRIMARY KEY (`id_upload`),
  ADD KEY `id_opd` (`upload_opd`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `l_pegawai`
--
ALTER TABLE `l_pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `m_level_user`
--
ALTER TABLE `m_level_user`
  MODIFY `id_level_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `m_opd`
--
ALTER TABLE `m_opd`
  MODIFY `id_opd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `t_generated`
--
ALTER TABLE `t_generated`
  MODIFY `id_generated` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_upload`
--
ALTER TABLE `t_upload`
  MODIFY `id_upload` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `l_pegawai`
--
ALTER TABLE `l_pegawai`
  ADD CONSTRAINT `l_pegawai_ibfk_1` FOREIGN KEY (`pegawai_opd`) REFERENCES `m_opd` (`id_opd`),
  ADD CONSTRAINT `l_pegawai_ibfk_2` FOREIGN KEY (`pegawai_upload`) REFERENCES `t_upload` (`id_upload`);

--
-- Constraints for table `m_opd`
--
ALTER TABLE `m_opd`
  ADD CONSTRAINT `m_opd_ibfk_1` FOREIGN KEY (`opd_wil`) REFERENCES `m_wil` (`id_wil`) ON UPDATE CASCADE;

--
-- Constraints for table `m_user`
--
ALTER TABLE `m_user`
  ADD CONSTRAINT `m_user_ibfk_1` FOREIGN KEY (`user_level`) REFERENCES `m_level_user` (`id_level_user`),
  ADD CONSTRAINT `m_user_ibfk_2` FOREIGN KEY (`user_opd`) REFERENCES `m_opd` (`id_opd`),
  ADD CONSTRAINT `m_user_ibfk_3` FOREIGN KEY (`user_wil`) REFERENCES `m_wil` (`id_wil`);

--
-- Constraints for table `t_generated`
--
ALTER TABLE `t_generated`
  ADD CONSTRAINT `t_generated_ibfk_1` FOREIGN KEY (`id_upload`) REFERENCES `t_upload` (`id_upload`);

--
-- Constraints for table `t_upload`
--
ALTER TABLE `t_upload`
  ADD CONSTRAINT `t_upload_ibfk_1` FOREIGN KEY (`upload_opd`) REFERENCES `m_opd` (`id_opd`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
