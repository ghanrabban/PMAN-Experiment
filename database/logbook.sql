-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 09:40 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `logbook`
--

CREATE TABLE `logbook` (
  `id_logbook` int(11) NOT NULL,
  `id_fasilitas` int(11) DEFAULT NULL,
  `id_perangkat` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `create_by` text DEFAULT NULL,
  `id_jenisperangkat` int(11) DEFAULT NULL,
  `id_jenismasalah` int(11) DEFAULT NULL,
  `note` text DEFAULT NULL,
  `tittle` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logbook`
--

INSERT INTO `logbook` (`id_logbook`, `id_fasilitas`, `id_perangkat`, `create_date`, `create_by`, `id_jenisperangkat`, `id_jenismasalah`, `note`, `tittle`) VALUES
(8, 465, NULL, '2024-02-16', NULL, 3, 10, 'close notifikasi (done)', NULL),
(9, 466, NULL, '2024-02-16', NULL, 19, 40, 'Pergantian Kamera CCTV', NULL),
(10, 0, NULL, '2024-02-17', NULL, 0, 0, 'perangkat kembali normal (done)', NULL),
(11, 0, NULL, '2024-02-18', NULL, 2, 26, 'done', NULL),
(12, 0, NULL, '2024-02-19', NULL, 2955, 0, 'ok', NULL),
(13, 0, NULL, '2024-02-23', NULL, 3, 30, 'install ulang', NULL),
(14, 466, 2955, '2024-02-24', NULL, 19, 0, 'coba', NULL),
(15, 466, 2955, '2024-02-24', NULL, 19, 40, 'Ganti Kamera CCTV', NULL),
(16, 466, 2955, '2024-02-25', NULL, 19, 40, 'Pergantian Kamera CCTV', NULL),
(17, 466, 2955, '2024-02-25', NULL, 19, 40, 'Restart ulang pada kamera CCTV', NULL),
(18, 466, 2955, '2024-02-25', NULL, 19, 40, 'Restart Ulang Pada Kamera', NULL),
(19, 466, 2955, '2024-02-25', NULL, 19, 40, 'Restart Ulang pada Kamera CCTV', NULL),
(20, 468, 2956, '2024-02-25', NULL, 19, 40, 'Restart Ulang pada kamera CCTV', NULL),
(21, 469, 2956, '2024-02-25', NULL, 19, 40, 'Restart Ulang pada Kamera', NULL),
(22, 473, 2956, '2024-02-25', NULL, 19, 40, 'Restart Kamera', NULL),
(23, 473, 2964, '2024-02-25', NULL, 3, 46, 'Restart Media Converter', NULL),
(24, 473, 2963, '2024-02-25', NULL, 4, 44, 'Restart POE Injector', NULL),
(25, 473, 2963, '2024-02-25', NULL, 4, 49, 'Ganti Adaptor Kamera', NULL),
(26, 472, 2964, '2024-02-25', NULL, 3, 29, 'Terminasi Fiber Optic', NULL),
(27, 469, 2956, '2024-02-25', NULL, 19, 40, 'Kamera restart', NULL),
(28, 473, 2956, '2024-02-25', NULL, 19, 40, 'coba', NULL),
(29, 469, 2956, '2024-02-25', NULL, 19, 47, 'Pergantian kamera CCTV', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logbook`
--
ALTER TABLE `logbook`
  ADD PRIMARY KEY (`id_logbook`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logbook`
--
ALTER TABLE `logbook`
  MODIFY `id_logbook` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
