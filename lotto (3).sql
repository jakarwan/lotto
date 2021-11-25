-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2021 at 07:10 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.24

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
-- Table structure for table `lotto_match`
--

CREATE TABLE `lotto_match` (
  `match_id` int(11) NOT NULL,
  `lotto_id` int(11) NOT NULL,
  `lotto_match_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL DEFAULT 0,
  `lotto_name_match` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `installment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lotto_match`
--

INSERT INTO `lotto_match` (`match_id`, `lotto_id`, `lotto_match_date`, `user_id`, `lotto_name_match`, `installment`) VALUES
(1079, 460553, '2021-11-25 17:30:53', 1, '', 1),
(1080, 460553, '2021-11-25 17:30:53', 1, '', 1),
(1081, 460553, '2021-11-25 17:30:53', 1, '', 1),
(1082, 460553, '2021-11-25 17:30:53', 1, '', 1),
(1083, 460553, '2021-11-25 17:30:53', 1, '', 1),
(1084, 460553, '2021-11-25 17:30:53', 1, '', 1),
(1085, 460553, '2021-11-25 17:38:53', 1, '', 1),
(1086, 460553, '2021-11-25 17:40:34', 1, '', 1),
(1087, 460553, '2021-11-25 17:40:41', 1, '', 1),
(1088, 460553, '2021-11-25 17:40:41', 1, '', 1),
(1089, 460553, '2021-11-25 17:42:40', 1, '', 1),
(1090, 460553, '2021-11-25 17:42:46', 1, '', 1),
(1091, 460553, '2021-11-25 17:46:11', 1, '', 1),
(1092, 460553, '2021-11-25 18:04:55', 1, '', 1),
(1093, 460553, '2021-11-25 18:04:55', 1, '', 1),
(1094, 460553, '2021-11-25 18:05:32', 1, '', 1),
(1095, 460553, '2021-11-25 18:05:48', 1, '', 1),
(1096, 460553, '2021-11-25 18:06:29', 1, '', 1),
(1097, 460553, '2021-11-25 18:06:29', 1, '', 1),
(1098, 460553, '2021-11-25 18:06:29', 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lotto_number`
--

CREATE TABLE `lotto_number` (
  `lotto_id` int(11) NOT NULL,
  `lotto_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `installment` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lotto_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lotto_number`
--

INSERT INTO `lotto_number` (`lotto_id`, `lotto_number`, `installment`, `lotto_name`, `date`, `user_id`) VALUES
(34918, '460553', '1', '', '2021-11-26', 1);

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
  `status` int(11) NOT NULL DEFAULT 0,
  `isActive` int(11) NOT NULL DEFAULT 0,
  `online` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `username`, `password`, `date`, `phone`, `image`, `status`, `isActive`, `online`) VALUES
(1, 'jakarwan', 'jakarwan', '123456', '2021-10-23', '0918041510', 'imgpf/Cat03.jpeg', 1, 1, 1),
(4, 'test', 'test', 'test', '2021-10-25', '12345656', 'imgpf/240100109_108927884840285_176770923204998251', 0, 1, 0),
(5, 'ทักษ์ดนัย จันทะวงษ์', 'Takdanai', '123456', '2021-11-05', '0902200978', 'imgpf/241430173_1753308004839867_39254091597323155', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lotto_match`
--
ALTER TABLE `lotto_match`
  ADD PRIMARY KEY (`match_id`);

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
-- AUTO_INCREMENT for table `lotto_match`
--
ALTER TABLE `lotto_match`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1099;

--
-- AUTO_INCREMENT for table `lotto_number`
--
ALTER TABLE `lotto_number`
  MODIFY `lotto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34919;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
