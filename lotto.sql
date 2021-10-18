-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2021 at 06:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lotto`
--

-- --------------------------------------------------------

--
-- Table structure for table `lotto_number`
--

CREATE TABLE `lotto_number` (
  `lotto_id` int(11) NOT NULL,
  `lotto_number` int(10) NOT NULL,
  `installment` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lotto_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lotto_number`
--

INSERT INTO `lotto_number` (`lotto_id`, `lotto_number`, `installment`, `lotto_name`, `date`, `user_id`) VALUES
(3, 12345, '', 'test', '2021-10-17', 1),
(4, 12345, '', 'test', '2021-10-17', 1),
(5, 12345, '', 'test', '2021-10-17', 1),
(6, 12345, '', 'test', '2021-10-17', 1),
(7, 25631, '', 'test', '2021-10-17', 1),
(8, 45622, '', 'test', '2021-10-17', 1),
(9, 22222, '', 'test', '2021-10-17', 1),
(10, 11561, '', 'test', '2021-10-17', 1),
(11, 24156, '', 'test', '2021-10-17', 1),
(12, 56254, '', 'test', '2021-10-17', 1),
(13, 32161, '', 'test', '2021-10-17', 1),
(14, 15615, '', 'test', '2021-10-17', 1),
(15, 15612, '', 'test', '2021-10-17', 1),
(16, 12345, '', 'test', '2021-10-17', 1),
(17, 12345, '', 'test', '2021-10-17', 1),
(18, 12345, '', 'test', '2021-10-17', 1),
(19, 12345, '', 'test', '2021-10-17', 1),
(20, 12345, '4', 'test', '2021-10-17', 1),
(21, 145, '1', 'test', '2021-10-17', 1),
(22, 15618, '1', 'test', '2021-10-17', 1),
(23, 15631, '1', 'test', '2021-10-17', 1),
(24, 15631, '1', 'test', '2021-10-17', 1),
(25, 15448, '1', 'test', '2021-10-17', 1),
(26, 84444, '1', 'test', '2021-10-17', 1),
(27, 55411, '3', 'test', '2021-10-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lotto_number`
--
ALTER TABLE `lotto_number`
  ADD PRIMARY KEY (`lotto_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lotto_number`
--
ALTER TABLE `lotto_number`
  MODIFY `lotto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
