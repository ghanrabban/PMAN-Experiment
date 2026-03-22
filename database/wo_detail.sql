-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 12:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fids`
--

-- --------------------------------------------------------

--
-- Table structure for table `wo_detail`
--

CREATE TABLE `wo_detail` (
  `id_wodetail` int(11) NOT NULL,
  `id_wo` int(11) DEFAULT NULL,
  `id_fasilitas` int(11) DEFAULT NULL,
  `id_jenismasalah` int(11) DEFAULT NULL,
  `id_masalah` int(11) DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wo_detail`
--

INSERT INTO `wo_detail` (`id_wodetail`, `id_wo`, `id_fasilitas`, `id_jenismasalah`, `id_masalah`, `tanggal_mulai`, `tanggal_selesai`, `keterangan`, `status`) VALUES
(1, 1, 4, NULL, NULL, NULL, NULL, 'adas', 0),
(2, 2, 4, NULL, NULL, NULL, NULL, '', 0),
(3, 2, 5, NULL, NULL, NULL, NULL, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wo_detail`
--
ALTER TABLE `wo_detail`
  ADD PRIMARY KEY (`id_wodetail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wo_detail`
--
ALTER TABLE `wo_detail`
  MODIFY `id_wodetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
