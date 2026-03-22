-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2024 at 04:10 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

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
-- Table structure for table `role_akses`
--

CREATE TABLE `role_akses` (
  `id_roleakses` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `create` int(11) DEFAULT NULL,
  `read` int(11) DEFAULT NULL,
  `update` int(11) DEFAULT NULL,
  `delete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role_akses`
--

INSERT INTO `role_akses` (`id_roleakses`, `id_role`, `id_menu`, `create`, `read`, `update`, `delete`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(2, 1, 3, 1, 0, 0, 0),
(3, 1, 4, 0, 0, 0, 0),
(4, 1, 5, 0, 0, 0, 0),
(5, 1, 6, 0, 0, 0, 0),
(6, 1, 7, 0, 0, 0, 0),
(7, 1, 8, 0, 0, 0, 0),
(8, 1, 9, 0, 0, 0, 0),
(9, 1, 10, 0, 0, 0, 0),
(10, 1, 11, 0, 0, 0, 0),
(11, 1, 12, 1, 1, 1, 1),
(12, 2, 1, 1, 1, 1, 1),
(13, 2, 3, 1, 0, 0, 0),
(14, 2, 4, 0, 0, 0, 0),
(15, 2, 5, 0, 0, 0, 0),
(16, 2, 6, 0, 0, 0, 0),
(17, 2, 7, 0, 0, 0, 0),
(18, 2, 8, 0, 0, 0, 0),
(19, 2, 9, 0, 0, 0, 0),
(20, 2, 10, 0, 0, 0, 0),
(21, 2, 11, 0, 0, 0, 0),
(22, 2, 12, 0, 0, 0, 0),
(23, 4, 1, 1, 1, 1, 1),
(24, 4, 3, 1, 1, 1, 1),
(25, 4, 4, 1, 1, 1, 1),
(26, 4, 5, 1, 1, 1, 1),
(27, 4, 6, 1, 1, 1, 1),
(28, 4, 7, 1, 1, 1, 1),
(29, 4, 8, 1, 1, 1, 1),
(30, 4, 9, 1, 1, 1, 1),
(31, 4, 10, 1, 1, 1, 1),
(32, 4, 11, 1, 1, 1, 1),
(33, 4, 12, 1, 1, 1, 1),
(34, 4, 13, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `role_akses`
--
ALTER TABLE `role_akses`
  ADD PRIMARY KEY (`id_roleakses`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `role_akses`
--
ALTER TABLE `role_akses`
  MODIFY `id_roleakses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
