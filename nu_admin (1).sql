-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2021 at 09:19 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nu_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `nu_admin`
--

CREATE TABLE `nu_admin` (
  `id` int(11) NOT NULL,
  `user_name_admin` varchar(600) COLLATE utf16_unicode_ci NOT NULL,
  `password_admin` varchar(600) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `nu_admin`
--

INSERT INTO `nu_admin` (`id`, `user_name_admin`, `password_admin`) VALUES
(1, 'Saima', '123456'),
(2, 'priyanka', '123456'),
(3, 'Sami', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `st_info`
--

CREATE TABLE `st_info` (
  `id` int(11) NOT NULL,
  `student_name` varchar(600) COLLATE utf16_unicode_ci NOT NULL,
  `student_phn` varchar(500) COLLATE utf16_unicode_ci NOT NULL,
  `nu_roll` varchar(50) COLLATE utf16_unicode_ci NOT NULL,
  `rocket_trx_id` int(50) NOT NULL,
  `action` varchar(50) COLLATE utf16_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `st_info`
--

INSERT INTO `st_info` (`id`, `student_name`, `student_phn`, `nu_roll`, `rocket_trx_id`, `action`) VALUES
(1, 'Saima Akter', '01521222087', '4321', 8765432, '1'),
(2, 'ruhi', '01521222087', '45678', 23456789, '0'),
(3, 'lahab', '01537400863', '78', 123456, '1'),
(4, 'xtfcgvhb', '1521222087', '4375', 214748647, '0'),
(11, 'Kolmilota', '015212220874876575443', '234356789', 2147483647, '1'),
(12, 'Kolmilota', '1521222087875', '673452', 214836647, '0'),
(13, 'Kolmilota', '15212220874', '9685674', 247483647, '0'),
(14, 'Mehedi', '1521222087', '9786542', 214748364, '0'),
(15, 'Nasrin Toma', '01918943688', '8765432', 46768087, '0');

-- --------------------------------------------------------

--
-- Table structure for table `trx_match`
--

CREATE TABLE `trx_match` (
  `id` int(11) NOT NULL,
  `trx_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trx_match`
--

INSERT INTO `trx_match` (`id`, `trx_no`) VALUES
(1, 8765432),
(2, 123456),
(3, 9685674),
(4, 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `nu_admin`
--
ALTER TABLE `nu_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `st_info`
--
ALTER TABLE `st_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trx_match`
--
ALTER TABLE `trx_match`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `nu_admin`
--
ALTER TABLE `nu_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `st_info`
--
ALTER TABLE `st_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `trx_match`
--
ALTER TABLE `trx_match`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
