-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2024 at 02:50 AM
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
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_privilege` tinyint(1) NOT NULL COMMENT '1 = su; 2 = ap2; 3 = OM, 4 = operator',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nik` varchar(25) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(16) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jabatan` varchar(255) NOT NULL,
  `unit_kerja` varchar(255) NOT NULL,
  `type_user` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `user_privilege`, `username`, `password`, `nik`, `nama`, `email`, `no_hp`, `tanggal_lahir`, `jabatan`, `unit_kerja`, `type_user`, `created`, `status`) VALUES
(1, 1, 'admin', 'ba03808b99363319e463b190816d5a38b7d93a9169c7c47e1beb35d39c16eed0', '20007534', 'Muhammad Arif', 'muhammad.a@angkasapura2.co.id', '085260819533', '1993-08-19', 'Technician', '1', '', '2019-05-25 07:02:32', 1),
(13, 1, 'dinul', '914d60b322c8e87021e98947a6fdc8f1c5f561c27588fe373261efaed981d279', '20007461', 'Aulia Dinul', '', '', '1995-11-03', 'Technician', '1', '', '2019-06-10 04:34:01', 1),
(15, 2, 'heru', 'c02f59caaec677b05131d11856278e05a21f53ceafbb03de5f0a071240a8c1b2', '20007507', 'Heru Sabrides', 'heru.sabrides@angkasapura2.co.id', '', '2019-07-01', 'Technician', '1', '', '2019-07-30 12:45:56', 1),
(19, 2, 'ricky', '5c5286fe06fb83893b35d437135fc9cc4b9fe7b075193caff5f4c6eea7ac5463', '20005786', 'Ricky Yacob Ba\'dung', 'ricky.jacob@angkasapura2.co.id', '081322393761', '1989-07-14', 'SPV', '1', '', '2020-11-16 15:10:16', 1),
(20, 2, 'aulia', '8fbb6a7908e63df4c0feeab568f231eabe699d62649a4c74398ac2c7669b5a88', '20005775', 'Aulia Arafat', 'aulia.arafat@angkasapura2.co.id', '082368158245', '1988-07-23', 'SPV', '1', '', '2020-11-16 15:11:02', 1),
(21, 2, 'rully', '6ffeac56a36c208a72d88021604f76911420be7ea4797bfdf8d4ef699dfdc678', '2222', 'Rully Setyawan', '111', '111', '2020-11-30', 'SPV', '1', '', '2020-11-16 15:11:42', 1),
(22, 2, 'dori', '9b262659aaafb20eb7d31f6bca90df24cae1e9a5d15f4170a138b41db0b12966', '2222', 'Dori Adi Wibowo', '222', '222', '2020-11-25', 'SPV', '1', '', '2020-11-16 15:12:35', 1),
(23, 2, 'anca', 'e63b7ce674db20afb1c95d95bdaa17877a83f5965e038da17ec09dfd8e8042c9', '333', 'Hermawansyah', '333', '33', '2020-11-26', 'SPV', '1', '', '2020-11-16 15:13:35', 1),
(24, 2, 'dedy', '0aed079745467c85174bb9c1c12b735feea9a0635acc1efbfbf358b5d9679f18', '444', 'Dedy Widyanto', '444', '44', '2020-11-18', 'SPV', '1', '', '2020-11-16 15:14:17', 1),
(25, 2, 'ulud', 'd524a94a198a46604ed7b7d2f243fd7173c5679f5c6765cb94c48d8f95a2acc6', '555', 'Ulud Nopriyadi', '555', '555', '2020-11-26', 'SPV', '1', '', '2020-11-16 15:15:31', 1),
(27, 3, 'omfids', 'dfa536e8e6f8ca21ed6215d5ee7311efac59d2cb40f653911e9122ab494fe67d', '-', 'OM FIDS T1-T2-NonTerminal', '-', '-', '2018-01-01', 'Teknisi', '1', '', '2021-04-16 02:00:10', 1),
(28, 3, 'omfidst3', '944d542fa321f49a7fd9c6824d1e7937e4093f3dde95c01a15cd7aa95d18c355', '-', 'OM FIDS T3', '-', '-', '2018-01-01', 'Teknisi', '1', '', '2021-04-16 02:30:22', 1),
(29, 2, 'idham', 'bfc86ab61e5b2d1a8297bbf4b0eeb6b0568b921d87478e738de96f8d3d1f78ae', '20003709', 'Idham Iriansyah', 'idham.iriansyah@angkasapura2.co.id', '5505056', '2018-08-05', 'SPV', '1', '', '2022-05-09 06:04:28', 1),
(30, 4, 'view', 'cb09567f732bb0c0cb8273b2e8cb7929ce7ec3f2a08ac817241b82831b1c877a', '12344321', 'User View Only', '', '', '2024-02-06', '', '', '', '2024-01-03 05:13:49', 1),
(32, 0, 'james21', '$2y$12$hJ1952UoVHYwvGMkjuke9OxxuKwS6Bo2RhnHsKnZtcpJ/0J3ROp8a', '3671095409', 'james tri', 'tri.emotion213@gmail.com', '', '0000-00-00', '', '1', '1', '2024-01-17 05:35:33', 1),
(159, 0, 'debi nurani', '$2y$12$8hmiublBhYqTzOZMZM7jaO0VSwXH6Yn1aihXWgkEwuobvXBxjsFHC', '200402006722', 'DEBI NURANI', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(160, 0, 'muhamat jibril', '$2y$12$LZykDYv7XaXQr/BplC6u9.cpb0gF0.UrKUunfSH98QOq0KPXB6e5W', '180802004431', 'MUHAMAT JIBRIL', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(161, 0, 'nanang susanto', '$2y$12$dItU35DORlXKMpG5hp6lvuPQwMemPqmo/tHQzq.5E51n5Nr2lx2Ma', '200402006737', 'NANANG SUSANTO', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(162, 0, 'fattah fadhlurrahman', '$2y$12$Wj6y.0X/RyxtSAbB.uip8e4xLskrZMQblOrkOMSHpJiuJvMLNKWs2', '200402006761', 'FATTAH FADHLURRAHMAN', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(163, 0, 'elza satrio a', '$2y$12$3/RaWt6Po.09jvVI7DDij.3wzdCnrl2XySMm02BqxJ7os5hMi5dcO', '220202008305', 'ELZA SATRIO A', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(164, 0, 'rizki aditya', '$2y$12$cqrEez7IyVJjPjZ75vPgoubBh/j.g9UOFJvDs1WpfA3lir4yyGjJ6', '180802004450', 'RIZKI ADITYA', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(165, 0, 'warliman', '$2y$12$894Ag7yYUEP3reh9fr/OB.jT7k.ks6Jeged95r43ssxQqXYiqrV6a', '180802004445', 'WARLIMAN', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(166, 0, 'muhamad kahfi', '$2y$12$rQKX7CE2EaH57KspSqeDD..2DoZcuqqzJe43vaDA.iiKzx2W9GIAK', '180802004440', 'MUHAMAD KAHFI', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(167, 0, 'm hesya', '$2y$12$k7FRSZ5IA4.srEZ7aqJr1ecVj21V0xMm4wpWtBUts4AviC.ck6yAq', '210402007744', 'M HESYA', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(168, 0, 'iwan yuhanies', '$2y$12$Uvdje.djgLQx8Nj.QsxtF.MrVDKFGfbwuQ9KHbCPgC5Vuae6Hm07K', '181002004958', 'IWAN YUHANIES', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(169, 0, ' ilham basyar isya', '$2y$12$UW9R3RSWA10YC0SyKYjY4.qCkp6j9fkhPx9EQpSoxWRJPCAYnNkpC', '230202009263', ' ILHAM BASYAR ISYA', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(170, 0, 'amarullah ', '$2y$12$eUZLhyM0/SvxYkbuqjzZieCRuuB9EApoQRECVxlhwNRmK.TWbXNc2', '200402006725', 'AMARULLAH ', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(171, 0, 'suprianto', '$2y$12$9NTHmz8QJXQxpGjZi74xY.2QPPrmXtapQMDS7t4XtHl3jGMD.ffuC', '200402006739', 'SUPRIANTO', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(172, 0, 'ahmad zaenudin', '$2y$12$ircegMl3Kvi.xOSWFJdEDO1ESRV04GA78Aonr8PKHthPmvEM2qPam', '200402006747', 'AHMAD ZAENUDIN', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(173, 0, 'nanda muhammad', '$2y$12$2R.IcHsmCFn3UjIPGT9jEeWC9Ox8SQzHHJHP5K7.8BQZUjYZ8D1Mq', '210102007727', 'NANDA MUHAMMAD', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(174, 0, 'hendra permana dharma n', '$2y$12$o4vXbo.Xj0XfLKg5pQGwReqv/WZR3XXZt6ox0cMC0fLH3IGms3gRK', '200302006946', 'HENDRA PERMANA DHARMA N', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(175, 0, 'anggi pratama yudha', '$2y$12$Eg4lzJjCRJltcv1i5vstE.HGkv7pDnKhReNuQMJFhZHFpmzh.3bSG', '180802004429', 'ANGGI PRATAMA YUDHA', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(176, 0, 'salam ibrahim', '$2y$12$l79gUEYgfjzvwGTquPOuYeOFwQHFONoFLqHsB12hIhB7UnINt80..', '180802004449', 'SALAM IBRAHIM', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(177, 0, 'rudi', '$2y$12$NmNMbTgQFw/B6r1M2h9GLuDKJNi9yHHt2a3heGE/eH7fTdEVaP4HC', '190502005399', 'RUDI', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(178, 0, 'indra cahyadi', '$2y$12$lCvacJtn8RV..6VnRmrmi.OpVVnkkA4SuIQU0iexxk9GQAB7Iuqra', '190402005491', 'INDRA CAHYADI', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(179, 0, 'bobby setiawan', '$2y$12$6kF//8F2LEw0XTvGwCZAiOF2IFTuRuPJpBCLAamNpwKOZh5nl27U.', '230302009373', 'BOBBY SETIAWAN', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(180, 0, 'cecep taufiqurohman', '$2y$12$XAExjRJCbwDmlBXvMZ06XuL/ddBZ0vkCI7yIpkVyoZu7N6xZNKAfa', '200402006728', 'CECEP TAUFIQUROHMAN', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(181, 0, 'm.ridwan ', '$2y$12$ERwJ8Kp64Zmz3UrxcnSFs.CA/H.bQB8ZeL/lAGM7yCC0t7oKTDDT6', '200402006736', 'M.RIDWAN ', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(182, 0, 'miftah nurhadiansyah', '$2y$12$MuSRJwz1S0qSawKzH9dDD.JC1XAEz10sLK5LziwbZ6ByyHX0smuFK', '200402006769', 'MIFTAH NURHADIANSYAH', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(183, 0, 'viki faizal', '$2y$12$Zue3RRWoSTNAPWKR/iWJWOaCx.xSCw.LG6EFNXmSlsg0mWP.4xiUq', '180802004452', 'VIKI FAIZAL', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(184, 0, 'tomi hamdani', '$2y$12$zRK.UwfWHgtiPi5GBFMniOCN89u4zrODW.t/C0c8HDV4K8BK8oZqu', '170902002626', 'TOMI HAMDANI', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(185, 0, 'damar fiqri nurhidayat', '$2y$12$QIvQ0Xu0VKHX/vBruPpe2.N3ma8mW6EU7XqHzSNB.i10ovYXvj7zy', '220902009004', 'DAMAR FIQRI NURHIDAYAT', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(186, 0, 'ceorido ghalib wibowo ', '$2y$12$uGhXWVs.v/qng/28WftSFupymaWzB37yw8Z9ujIJVHxalL9SMlM9m', '230902009638', 'CEORIDO GHALIB WIBOWO ', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(187, 0, 'viky maulana', '$2y$12$sLDOILe9vJqTlJAy1E3W/Olm0mEfvXgx/5ytvKZXVHdahszhSiWoq', '190302005489', 'VIKY MAULANA', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(188, 0, 'amri hamzah', '$2y$12$bMfrEqkBrkI6.28mZgXiD.r2J0WNEDXF84.pR8iR2U2Iy0YcoHX0.', '200302006949', 'AMRI HAMZAH', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(189, 0, 'james tri apninety manalu', '$2y$12$E7n5QT.IRnmxY5noXhifdu7POjI2kQKR8KLrXgbn4XmlvJ8jSCj6C', '230902009639', 'JAMES TRI APNINETY MANALU', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(190, 0, 'julriyan dwi kurniawan', '$2y$12$LYtnuekZ4GgoqBQSdoTTlegGjj4dRiwjP3gcy6Pa5tGzXvzAOCGaq', '200402006735', 'JULRIYAN DWI KURNIAWAN', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(191, 0, 'egi hardadi', '$2y$12$cyhOAgD5X0gfHQUXVN75MeRdYsg89SS/.S5qkzl34.KbqCa/CYlLO', '200402006759', 'EGI HARDADI', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(192, 0, 'asep maulana', '$2y$12$s2bdUg.RYYzeE5/RUr.XdOKyBUbgV9Ig8nKtf0hZdYwgA7Epb3CVy', '200402006727', 'ASEP MAULANA', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(193, 0, 'didik setyo', '$2y$12$48eJxg3SkNStOiI1FiLrKeiecjiNa8SisyB.nDUZvK09q/uwg5Dpa', '210402007742', 'DIDIK SETYO', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(194, 0, 'nugroho adi wijoyo', '$2y$12$jB.gYcRzHRqRIncihAmagOtBmMERQMYt5wVcSKvjl/98nNd3CJOtq', '180802004451', 'NUGROHO ADI WIJOYO', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(195, 0, 'maruta mandra rahmadesya', '$2y$12$FpXsxU5V5UNu5lc1fHqX.esMGuoTOg6S4NjizoC58BiJi3QiRVuDq', '200302006945', 'MARUTA MANDRA RAHMADESYA', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(196, 0, 'achmad budi utomo', '$2y$12$7VhyBhALkiQ.myu8qU2QyOrOGS1/6HPrArRlr5vna1mHhtItqWYw6', '180802004433', 'ACHMAD BUDI UTOMO', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(197, 0, 'muhammad tahrirul hakim', '$2y$12$vTanDUFK9wZnMSotgwR0muLKgYp98ONhzaOoH59BJ95uM0gRMeQtm', '180802004436', 'MUHAMMAD TAHRIRUL HAKIM', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(198, 0, ' m. yudistira ramadhan sudarmadi', '$2y$12$FvXSXAa5QT8HsHdUhSTQF.7Y2508/ZvKBH8Eg1TIRtAfrWTeuQPQe', '230302009357', ' M. YUDISTIRA RAMADHAN SUDARMADI', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1),
(199, 0, 'muhammad iqbal reihansyah', '$2y$12$f2zG9SvKiIXO6lbrAye8AeohZVxW2HGmUQq/1PH16ddIDyoDUkrH2', '231102009715', 'MUHAMMAD IQBAL REIHANSYAH', '', '', '0000-00-00', '', '1', '2', '0000-00-00 00:00:00', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
