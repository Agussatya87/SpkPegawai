-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2024 at 05:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `calon_staff`
--

CREATE TABLE `calon_staff` (
  `id_calon` varchar(25) NOT NULL,
  `nama_calon` varchar(80) NOT NULL,
  `c1` varchar(25) NOT NULL,
  `c2` varchar(25) NOT NULL,
  `c3` varchar(25) NOT NULL,
  `c4` varchar(25) NOT NULL,
  `c5` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `calon_staff`
--

INSERT INTO `calon_staff` (`id_calon`, `nama_calon`, `c1`, `c2`, `c3`, `c4`, `c5`) VALUES
('111', 'Satya', '72', '1', '85', '1', '75'),
('112', 'Rahmat', '70', '1', '80', '1', '78'),
('113', 'Denada', '60', '1', '78', '2', '66'),
('114', 'Aji', '81', '1', '72', '0', '71'),
('115', 'Fadlan', '63', '1', '86', '1', '66'),
('116', 'Rizki', '85', '1', '80', '2', '74'),
('117', 'Fanny', '70', '1', '70', '2', '81'),
('118', 'Flores', '75', '1', '81', '2', '80'),
('119', 'Yanti', '68', '1', '90', '1', '69'),
('120', 'Tasya', '84', '1', '75', '0', '80');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_akhir`
--

CREATE TABLE `hasil_akhir` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `tanggal` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_akhir`
--

INSERT INTO `hasil_akhir` (`id`, `kode`, `tanggal`) VALUES
(27, 'k001', '09 - Sep - 2024 | 14 : 44 : 48'),
(28, 'k002', '10 - Sep - 2024 | 10 : 39 : 37');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kriteria` varchar(80) NOT NULL,
  `bobot` varchar(25) NOT NULL,
  `type` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `kriteria`, `bobot`, `type`) VALUES
(1, 'Nilai Psikotes', '0.1', 'Benefit'),
(2, 'Verifikasi ijazah', '0.25', 'Benefit'),
(3, 'Interview', '0.25', 'Benefit'),
(4, 'Pengalaman', '0.2', 'Benefit'),
(5, 'Keahlian', '0.2', 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `level`) VALUES
(1, 'admin', 'admin', 'admin'),
(2, 'user', 'user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `kode_hasil` varchar(20) NOT NULL,
  `id_calon` varchar(25) NOT NULL,
  `nama_calon` varchar(80) NOT NULL,
  `total` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id`, `kode_hasil`, `id_calon`, `nama_calon`, `total`) VALUES
(108, 'k001', '111', 'Tono', '0.3029'),
(109, 'k001', '112', 'Budi', '0.2996'),
(110, 'k001', '113', 'Arif', '0.3278'),
(111, 'k001', '114', 'Aji', '0.2458'),
(112, 'k001', '115', 'Siregar', '0.2923'),
(113, 'k001', '116', 'Rizki', '0.3474'),
(114, 'k001', '117', 'Fanny', '0.337'),
(115, 'k001', '118', 'Pores', '0.3492'),
(116, 'k001', '119', 'Wulyono', '0.301'),
(117, 'k001', '120', 'Satya', '0.2577'),
(118, 'k002', '111', 'Satya', '0.3029'),
(119, 'k002', '112', 'Rahmat', '0.2996'),
(120, 'k002', '113', 'Denada', '0.3278'),
(121, 'k002', '114', 'Aji', '0.2458'),
(122, 'k002', '115', 'Fadlan', '0.2923'),
(123, 'k002', '116', 'Rizki', '0.3474'),
(124, 'k002', '117', 'Fanny', '0.337'),
(125, 'k002', '118', 'Flores', '0.3492'),
(126, 'k002', '119', 'Yanti', '0.301'),
(127, 'k002', '120', 'Tasya', '0.2577');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calon_staff`
--
ALTER TABLE `calon_staff`
  ADD PRIMARY KEY (`id_calon`);

--
-- Indexes for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil_akhir`
--
ALTER TABLE `hasil_akhir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
