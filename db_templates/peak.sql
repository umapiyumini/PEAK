-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 03:39 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
CREATE DATABASE IF NOT EXISTS `peak` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `peak`;

-- --------------------------------------------------------

--
-- Table structure for table `external_user`
--

CREATE TABLE `external_user` (
  `userid` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ground_indoor_staff`
--

CREATE TABLE `ground_indoor_staff` (
  `userid` int(11) NOT NULL,
  `staffid` varchar(20) NOT NULL,
  `type` enum('Ground','Indoor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `productID` int(11) NOT NULL,
  `sport` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `incharge` varchar(100) NOT NULL,
  `usage_type` enum('Team','Recreational') NOT NULL,
  `type` enum('Packed','Unpacked','Non-refundable') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ped_incharge`
--

CREATE TABLE `ped_incharge` (
  `userid` int(11) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `subrole` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sports_captain`
--

CREATE TABLE `sports_captain` (
  `userid` int(11) NOT NULL,
  `sport` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `registration_number` varchar(20) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `faculty` varchar(100) NOT NULL,
  `id_start_date` date NOT NULL,
  `id_expiry_date` date NOT NULL,
  `date_of_birth` date NOT NULL,
  `nic` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `nic` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','Sports Captain','Amalgamated Club Executive','Internal User','External User','Gym Instructor','GroundIndoorStaff') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `gender`, `nic`, `email`, `date_of_birth`, `contact_number`, `address`, `image`, `username`, `password`, `role`) VALUES
(1, 'uma', 'Female', '22020292', 'uma@gmail.com', '2024-11-20', '0759834721', 'no 30,adress lane , colombo 5.', '', 'umazz', '123', 'Sports Captain'),
(3, 'Hamdi', 'Male', '22020748', 'hamdi@gmail.com', '2024-11-22', '0705691983', 'address', '', 'External User', 'abc', 'External User'),
(6, 'Ali Khan', 'Male', '546372819V', 'alikhan@example.com', '1985-01-10', '0773456789', '789 Lakeside Road, Galle', '', 'alikhan', 'admin789', 'Admin'),
(9, 'sanudi', 'Female', '2203324556', 'sanu@gmail.com', '2024-11-06', '0765548374', 'abc address', '', 'sanu', 'abc123', 'GroundIndoorStaff'),
(11, 'amantha', 'Male', '2203394556', 'amantha@gmail.com', '2024-11-06', '0765548374', 'abc address', '', 'amantha', 'abc1234', 'Gym Instructor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `external_user`
--
ALTER TABLE `external_user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `ground_indoor_staff`
--
ALTER TABLE `ground_indoor_staff`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`productID`);

--
-- Indexes for table `ped_incharge`
--
ALTER TABLE `ped_incharge`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `sports_captain`
--
ALTER TABLE `sports_captain`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`registration_number`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `productID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `external_user`
--
ALTER TABLE `external_user`
  ADD CONSTRAINT `external_user_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `ground_indoor_staff`
--
ALTER TABLE `ground_indoor_staff`
  ADD CONSTRAINT `ground_indoor_staff_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `ped_incharge`
--
ALTER TABLE `ped_incharge`
  ADD CONSTRAINT `ped_incharge_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `sports_captain`
--
ALTER TABLE `sports_captain`
  ADD CONSTRAINT `sports_captain_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
