-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 12, 2021 at 02:01 AM
-- Server version: 5.7.23
-- PHP Version: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk_saw_laptop`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

DROP TABLE IF EXISTS `akun`;
CREATE TABLE IF NOT EXISTS `akun` (
  `email` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `role` int(1) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `temp_kode` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`email`, `password`, `role`, `foto`, `temp_kode`) VALUES
('spklaptopsaw@gmail.com', '25d55ad283aa400af464c76d713c07ad', 1, 'foto/638138218277.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bobot_kriteria`
--

DROP TABLE IF EXISTS `bobot_kriteria`;
CREATE TABLE IF NOT EXISTS `bobot_kriteria` (
  `id_bobot` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` text NOT NULL,
  `nilai` int(1) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  PRIMARY KEY (`id_bobot`),
  KEY `id_kriteria` (`id_kriteria`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bobot_kriteria`
--

INSERT INTO `bobot_kriteria` (`id_bobot`, `keterangan`, `nilai`, `id_kriteria`) VALUES
(1, 'Intel Core Celeron', 2, 1),
(2, 'Intel Core i3', 3, 1),
(3, 'Intel Core i5', 4, 1),
(4, 'Intel Core i7', 5, 1),
(6, '1GB', 1, 2),
(7, '2GB', 2, 2),
(8, '4GB', 3, 2),
(9, '8GB', 4, 2),
(10, '16GB - 32GB', 5, 2),
(11, 'Intel HD Graphics', 3, 3),
(12, 'Intel UHD Graphics ', 4, 3),
(13, 'NVDIA Geforce ', 5, 3),
(14, '250 GB', 1, 4),
(15, '320 GB', 2, 4),
(16, '500 GB', 3, 4),
(17, '750 GB', 4, 4),
(18, '> 750GB', 5, 4),
(19, '<12 inch', 1, 5),
(20, '12 – 13 inch ', 2, 5),
(21, '13 – 14 inch', 3, 5),
(22, '14 – 15 inch ', 4, 5),
(23, '>15 inch', 5, 5),
(24, '< 2 cell', 1, 6),
(25, '2 – 3 cell ', 2, 6),
(26, '4 – 5 cell ', 3, 6),
(27, '6 – 7 cell', 4, 6),
(28, '> 7 cell', 5, 6),
(29, '> 15 Juta', 1, 7),
(30, '8 – 15 Juta', 2, 7),
(31, '6 – 8 Juta', 3, 7),
(32, '4 – 6 Juta', 4, 7),
(33, '2 – 4 Juta', 5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id_customer` varchar(8) NOT NULL,
  `nama_customer` varchar(30) NOT NULL,
  `jk` varchar(15) NOT NULL,
  `tl` date NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_customer`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_spesifikasi`
--

DROP TABLE IF EXISTS `detail_spesifikasi`;
CREATE TABLE IF NOT EXISTS `detail_spesifikasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `id_bobot` int(11) NOT NULL,
  `id_spesifikasi` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_bobot` (`id_bobot`),
  KEY `id_spesifikasi` (`id_spesifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_spesifikasi`
--

INSERT INTO `detail_spesifikasi` (`id`, `id_kriteria`, `id_bobot`, `id_spesifikasi`) VALUES
(38, 1, 3, 4),
(39, 2, 8, 4),
(40, 3, 12, 4),
(41, 4, 16, 4),
(42, 5, 21, 4),
(43, 6, 26, 4),
(50, 1, 2, 8),
(51, 2, 8, 8),
(52, 3, 12, 8),
(53, 4, 18, 8),
(54, 5, 21, 8),
(55, 6, 26, 8);

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

DROP TABLE IF EXISTS `kriteria`;
CREATE TABLE IF NOT EXISTS `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` text NOT NULL,
  `bobot_vektor` decimal(5,2) NOT NULL,
  `tipe` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kriteria`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `bobot_vektor`, `tipe`, `email`) VALUES
(1, 'Prosessor', '20.00', 'Benefit', 'spklaptopsaw@gmail.com'),
(2, 'RAM', '15.00', 'Benefit', 'spklaptopsaw@gmail.com'),
(3, 'VGA', '15.00', 'Benefit', 'spklaptopsaw@gmail.com'),
(4, 'Harddisk', '10.00', 'Benefit', 'spklaptopsaw@gmail.com'),
(5, 'Screen', '10.00', 'Benefit', 'spklaptopsaw@gmail.com'),
(6, 'Battery', '10.00', 'Benefit', 'spklaptopsaw@gmail.com'),
(7, 'Harga', '20.00', 'Cost', 'spklaptopsaw@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `laptop`
--

DROP TABLE IF EXISTS `laptop`;
CREATE TABLE IF NOT EXISTS `laptop` (
  `kd_laptop` varchar(8) NOT NULL,
  `merk` varchar(50) NOT NULL,
  `tipe_laptop` varchar(50) NOT NULL,
  `keterangan` text,
  `foto` varchar(100) NOT NULL,
  PRIMARY KEY (`kd_laptop`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laptop`
--

INSERT INTO `laptop` (`kd_laptop`, `merk`, `tipe_laptop`, `keterangan`, `foto`) VALUES
('A1', 'LENOVO', 'Thinkbook 14-IIL', '-', 'laptop/873725014025.jpg'),
('A2', 'AVITA LIBER', 'NS12A1', '-', 'laptop/708368376372.jpg'),
('A3', 'ASUS', 'A409JABV312T', '-', 'laptop/284172578833.jpg'),
('A4', 'ACER ', 'ASPIRE 3 A314', '-', 'laptop/183215232763.jpg'),
('A5', 'HP', ' 14- DQ1037WM', '-', 'laptop/382679315862.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian_laptop`
--

DROP TABLE IF EXISTS `penilaian_laptop`;
CREATE TABLE IF NOT EXISTS `penilaian_laptop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kriteria` int(11) NOT NULL,
  `kd_laptop` varchar(8) NOT NULL,
  `id_bobot` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kriteria` (`id_kriteria`),
  KEY `id_bobot` (`id_bobot`),
  KEY `fk_nilai_laptop` (`kd_laptop`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penilaian_laptop`
--

INSERT INTO `penilaian_laptop` (`id`, `id_kriteria`, `kd_laptop`, `id_bobot`) VALUES
(78, 1, 'A4', 1),
(79, 2, 'A4', 8),
(80, 3, 'A4', 11),
(81, 4, 'A4', 18),
(82, 5, 'A4', 21),
(83, 6, 'A4', 25),
(84, 7, 'A4', 32),
(85, 1, 'A5', 3),
(86, 2, 'A5', 8),
(87, 3, 'A5', 12),
(88, 4, 'A5', 14),
(89, 5, 'A5', 21),
(90, 6, 'A5', 26),
(91, 7, 'A5', 31),
(169, 1, 'A1', 3),
(170, 2, 'A1', 8),
(171, 3, 'A1', 12),
(172, 4, 'A1', 16),
(173, 5, 'A1', 21),
(174, 6, 'A1', 26),
(175, 7, 'A1', 30),
(183, 1, 'A2', 3),
(184, 2, 'A2', 9),
(185, 3, 'A2', 11),
(186, 4, 'A2', 14),
(187, 5, 'A2', 20),
(188, 6, 'A2', 25),
(189, 7, 'A2', 30),
(197, 1, 'A3', 2),
(198, 2, 'A3', 8),
(199, 3, 'A3', 12),
(200, 4, 'A3', 18),
(201, 5, 'A3', 21),
(202, 6, 'A3', 26),
(203, 7, 'A3', 31);

-- --------------------------------------------------------

--
-- Table structure for table `spesifikasi`
--

DROP TABLE IF EXISTS `spesifikasi`;
CREATE TABLE IF NOT EXISTS `spesifikasi` (
  `id_spesifikasi` int(11) NOT NULL AUTO_INCREMENT,
  `nama_spesifikasi` varchar(100) NOT NULL,
  PRIMARY KEY (`id_spesifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spesifikasi`
--

INSERT INTO `spesifikasi` (`id_spesifikasi`, `nama_spesifikasi`) VALUES
(4, 'Desain'),
(8, 'Gaming');

-- --------------------------------------------------------

--
-- Table structure for table `spesifikasi_laptop`
--

DROP TABLE IF EXISTS `spesifikasi_laptop`;
CREATE TABLE IF NOT EXISTS `spesifikasi_laptop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_spesifikasi` int(11) NOT NULL,
  `kd_laptop` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_spesifikasi` (`id_spesifikasi`),
  KEY `kd_laptop` (`kd_laptop`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spesifikasi_laptop`
--

INSERT INTO `spesifikasi_laptop` (`id`, `id_spesifikasi`, `kd_laptop`) VALUES
(9, 4, 'A1');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bobot_kriteria`
--
ALTER TABLE `bobot_kriteria`
  ADD CONSTRAINT `fk_id_kriteria_bobot` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_email_customer` FOREIGN KEY (`email`) REFERENCES `akun` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_spesifikasi`
--
ALTER TABLE `detail_spesifikasi`
  ADD CONSTRAINT `fk_bobot_spec` FOREIGN KEY (`id_bobot`) REFERENCES `bobot_kriteria` (`id_bobot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_spec` FOREIGN KEY (`id_spesifikasi`) REFERENCES `spesifikasi` (`id_spesifikasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_kriteria_spec` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD CONSTRAINT `fk_email_kriteria` FOREIGN KEY (`email`) REFERENCES `akun` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penilaian_laptop`
--
ALTER TABLE `penilaian_laptop`
  ADD CONSTRAINT `fk_nilai_bobot` FOREIGN KEY (`id_bobot`) REFERENCES `bobot_kriteria` (`id_bobot`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_kriteria` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nilai_laptop` FOREIGN KEY (`kd_laptop`) REFERENCES `laptop` (`kd_laptop`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spesifikasi_laptop`
--
ALTER TABLE `spesifikasi_laptop`
  ADD CONSTRAINT `fk_spec_id` FOREIGN KEY (`id_spesifikasi`) REFERENCES `spesifikasi` (`id_spesifikasi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_spec_laptop` FOREIGN KEY (`kd_laptop`) REFERENCES `laptop` (`kd_laptop`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
