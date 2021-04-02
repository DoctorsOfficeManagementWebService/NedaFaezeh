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
-- Database: `fgatieco_doctorsofficeDoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` bigint(255) NOT NULL,
  `code` bigint(255) NOT NULL,
  `medical_sys_num` varchar(500) NOT NULL,
  `fname` varchar(500) NOT NULL,
  `lname` varchar(500) NOT NULL,
  `tell` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `state` varchar(500) NOT NULL,
  `city` varchar(500) NOT NULL,
  `address` text NOT NULL,
  `national` bigint(255) NOT NULL,
  `proficiency` varchar(500) NOT NULL,
  `education` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `date_time_register` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `code`, `medical_sys_num`, `fname`, `lname`, `tell`, `email`, `state`, `city`, `address`, `national`, `proficiency`, `education`, `image`, `date_time_register`) VALUES
(1, 1001, '12345', 'علی', 'معصومی', '09122222222', 'ali@yahoo.com', 'تهران', 'تهران', 'تهران، خیابان پاسداران', 0, 'چشم پزشک', 'تخصص', '', '0000-00-00 00:00:00'),
(2, 1002, '12390', 'مریم', 'اقاجانی', '09122223333', 'maryam@yahoo.com', 'قزوین', 'قزوین', 'قزوین ، خیابان خیام', 0, 'پوست و زیبایی', 'فوق تخصص', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `work_flow`
--

CREATE TABLE `work_flow` (
  `id` bigint(255) NOT NULL,
  `doctor_code` bigint(255) NOT NULL,
  `day_of_week` int(20) NOT NULL,
  `situ` int(10) NOT NULL,
  `time_of` time NOT NULL,
  `time_to` time NOT NULL,
  `slot_time` int(100) NOT NULL,
  `date_time_submit` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_flow`
--

INSERT INTO `work_flow` (`id`, `doctor_code`, `day_of_week`, `situ`, `time_of`, `time_to`, `slot_time`, `date_time_submit`) VALUES
(1, 1001, 1, 1, '16:00:00', '21:00:00', 40, '2021-04-01 10:57:34'),
(2, 1001, 1, 1, '16:00:00', '21:00:00', 40, '2021-04-01 10:57:34'),
(3, 1001, 1, 1, '16:00:00', '21:00:00', 40, '2021-04-01 10:57:34'),
(4, 1001, 1, 1, '16:00:00', '21:00:00', 40, '2021-04-01 10:57:34'),
(5, 1001, 1, 1, '16:00:00', '21:00:00', 40, '2021-04-01 10:57:34'),
(6, 1001, 1, 1, '16:00:00', '21:00:00', 40, '2021-04-01 10:57:34'),
(7, 1001, 1, 1, '16:00:00', '21:00:00', 40, '2021-04-01 10:57:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `work_flow`
--
ALTER TABLE `work_flow`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `work_flow`
--
ALTER TABLE `work_flow`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
