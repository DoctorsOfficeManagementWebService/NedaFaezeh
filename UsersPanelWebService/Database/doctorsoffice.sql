-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 02, 2021 at 12:06 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fgatieco_doctorsoffice`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(255) NOT NULL,
  `code` bigint(255) NOT NULL,
  `fname` varchar(500) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `tell` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `national` bigint(255) NOT NULL,
  `image` varchar(500) NOT NULL,
  `date_time_register` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `code`, `fname`, `lname`, `tell`, `email`, `state`, `city`, `address`, `national`, `image`, `date_time_register`) VALUES
(1, 1003, 'رضا', 'رحمانی', '0912', 'reza@yahoo.com', 'تهران', 'تهران', 'تهران خیابان...', 11122233344, '', '2021-04-02 12:04:01');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` bigint(255) NOT NULL,
  `client_code` bigint(255) NOT NULL,
  `doctor_code` bigint(255) NOT NULL,
  `title` varchar(500) NOT NULL,
  `caption` text NOT NULL,
  `situation` int(10) NOT NULL,
  `date_time_submit` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `client_code`, `doctor_code`, `title`, `caption`, `situation`, `date_time_submit`) VALUES
(1, 1003, 1001, 'Good', 'Good Thanks!', 0, '2021-03-27 13:26:52'),
(2, 1003, 1002, 'Good', 'Good Thanks!', 0, '2021-03-27 13:42:36'),
(3, 1003, 1002, 'Good', 'Good Thanks!', 0, '2021-03-27 13:49:11'),
(4, 1003, 1002, 'Good', 'Good Thanks!', 0, '2021-03-27 13:57:00');

-- --------------------------------------------------------

--
-- Table structure for table `visit`
--

CREATE TABLE `visit` (
  `id` bigint(255) NOT NULL,
  `client_code` bigint(255) NOT NULL,
  `doctor_code` bigint(255) NOT NULL,
  `date_visit` date NOT NULL,
  `time_visit_of` time NOT NULL,
  `time_visit_to` time NOT NULL,
  `situation` int(10) NOT NULL,
  `date_time_submit` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visit`
--

INSERT INTO `visit` (`id`, `client_code`, `doctor_code`, `date_visit`, `time_visit_of`, `time_visit_to`, `situation`, `date_time_submit`) VALUES
(1, 1003, 1002, '2021-05-22', '10:00:00', '11:00:00', 0, '2021-04-01 10:08:21'),
(9, 1003, 1001, '2021-05-22', '11:10:00', '12:00:00', 0, '2021-04-01 11:47:12'),
(8, 1003, 1002, '2021-05-22', '11:10:00', '12:00:00', 0, '2021-04-01 11:12:14'),
(10, 1003, 1001, '2021-04-01', '17:10:00', '18:00:00', 0, '2021-04-02 10:59:46'),
(11, 1003, 1001, '2021-04-01', '18:10:00', '19:00:00', 0, '2021-04-02 11:01:01');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` bigint(255) NOT NULL,
  `client_code` bigint(255) NOT NULL,
  `doctor_code` bigint(255) NOT NULL,
  `date_time_submit` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `client_code`, `doctor_code`, `date_time_submit`) VALUES
(1, 1003, 1002, '2021-03-28 11:12:17'),
(2, 1, 12, '2021-04-02 11:46:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visit`
--
ALTER TABLE `visit`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
