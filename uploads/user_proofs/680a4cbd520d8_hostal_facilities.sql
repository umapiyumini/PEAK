-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2025 at 06:29 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peak`
--

-- --------------------------------------------------------

--
-- Table structure for table `hostal_facilities`
--

CREATE TABLE `hostal_facilities` (
  `hostalrequest_id` int(255) NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `priority` enum('High','Medium','Low','') NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `sport_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hostal_facilities`
--

INSERT INTO `hostal_facilities` (`hostalrequest_id`, `reg_no`, `priority`, `start_date`, `end_date`, `sport_id`) VALUES
(1, '2022/IS/080', 'High', '2025-04-21', '2025-04-29', 3),
(2, '2020/IS/074', 'Medium', '2025-04-21', '2025-04-29', 3),
(3, '2022/IS/020', 'Medium', '2025-04-27', '2025-04-30', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hostal_facilities`
--
ALTER TABLE `hostal_facilities`
  ADD PRIMARY KEY (`hostalrequest_id`),
  ADD KEY `fk1_sport_id` (`sport_id`),
  ADD KEY `fk_sport_id26` (`reg_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hostal_facilities`
--
ALTER TABLE `hostal_facilities`
  MODIFY `hostalrequest_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hostal_facilities`
--
ALTER TABLE `hostal_facilities`
  ADD CONSTRAINT `fk1_sport_id` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sport_id26` FOREIGN KEY (`reg_no`) REFERENCES `players` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
