-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 07:33 AM
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
-- Table structure for table `amalgamatedclub`
--

CREATE TABLE `amalgamatedclub` (
  `userid` int(11) NOT NULL,
  `post` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `equipmentid` int(11) NOT NULL,
  `sport_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `issued_amount` int(20) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`equipmentid`, `sport_id`, `name`, `type`, `issued_amount`, `description`) VALUES
(1, 3, 'Sticks', 'Team', 0, NULL),
(2, 1, 'ball', 'recreational', 5, 'abc'),
(3, 4, 'foot balls', 'recreational', 5, 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `external_user`
--

CREATE TABLE `external_user` (
  `userid` int(11) NOT NULL,
  `companyid` varchar(100) DEFAULT NULL,
  `company_name` varchar(100) NOT NULL,
  `nic` varchar(255) NOT NULL
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
-- Table structure for table `inventoryedit`
--

CREATE TABLE `inventoryedit` (
  `editid` int(11) NOT NULL,
  `equipmentid` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventoryrequest`
--

CREATE TABLE `inventoryrequest` (
  `requestid` int(11) NOT NULL,
  `equipmentid` int(11) DEFAULT NULL,
  `quantityrequested` int(11) NOT NULL,
  `date` date NOT NULL,
  `bywhom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventoryrequest`
--

INSERT INTO `inventoryrequest` (`requestid`, `equipmentid`, `quantityrequested`, `date`, `bywhom`) VALUES
(1, 2, 50, '2024-11-05', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE `noticeboard` (
  `noticeid` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `publishdate` date NOT NULL,
  `publishetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userid` int(11) NOT NULL
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
-- Table structure for table `sport`
--

CREATE TABLE `sport` (
  `sport_id` int(20) NOT NULL,
  `sport_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`sport_id`, `sport_name`) VALUES
(1, 'Cricket'),
(2, 'Baseball'),
(3, 'Hockey'),
(4, 'Football');

-- --------------------------------------------------------

--
-- Table structure for table `sports_captain`
--

CREATE TABLE `sports_captain` (
  `userid` int(11) NOT NULL,
  `sport` varchar(50) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockid` int(11) NOT NULL,
  `equipmentid` int(11) DEFAULT NULL,
  `indent_no` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `unit` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `issued_quantity` int(20) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `userid` int(255) NOT NULL,
  `registrationnumber` varchar(15) DEFAULT NULL,
  `faculty` varchar(50) NOT NULL,
  `department` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unpackedinventory`
--

CREATE TABLE `unpackedinventory` (
  `equipmentid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unpackedinventory`
--

INSERT INTO `unpackedinventory` (`equipmentid`, `quantity`) VALUES
(2, 2),
(3, 2);

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
  `role` enum('Admin','Sports Captain','Amalgamated Club Executive','Internal User','External User','Gym Instructor','GroundIndoorStaff') NOT NULL,
  `createdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `gender`, `nic`, `email`, `date_of_birth`, `contact_number`, `address`, `image`, `username`, `password`, `role`, `createdate`) VALUES
(1, 'uma', 'Female', '22020292', 'uma@gmail.com', '2024-11-20', '0759834721', 'no 30,adress lane , colombo 5.', '', 'umazz', '123', 'Sports Captain', NULL),
(3, 'Hamdi', 'Male', '22020748', 'hamdi@gmail.com', '2024-11-22', '0705691983', 'address', '', 'External User', 'abc', 'External User', NULL),
(6, 'Ali Khan', 'Male', '546372819V', 'alikhan@example.com', '1985-01-10', '0773456789', '789 Lakeside Road, Galle', '', 'alikhan', 'admin789', 'Admin', NULL),
(9, 'sanudi', 'Female', '2203324556', 'sanu@gmail.com', '2024-11-06', '0765548374', 'abc address', '', 'sanu', 'abc123', 'GroundIndoorStaff', NULL),
(11, 'amantha', 'Male', '2203394556', 'amantha@gmail.com', '2024-11-06', '0765548374', 'abc address', '', 'amantha', 'abc1234', 'Gym Instructor', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amalgamatedclub`
--
ALTER TABLE `amalgamatedclub`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`equipmentid`),
  ADD KEY `sportequipmentFK` (`sport_id`);

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
-- Indexes for table `inventoryedit`
--
ALTER TABLE `inventoryedit`
  ADD PRIMARY KEY (`editid`),
  ADD KEY `equipmentid` (`equipmentid`);

--
-- Indexes for table `inventoryrequest`
--
ALTER TABLE `inventoryrequest`
  ADD PRIMARY KEY (`requestid`),
  ADD KEY `equipmentid` (`equipmentid`);

--
-- Indexes for table `noticeboard`
--
ALTER TABLE `noticeboard`
  ADD PRIMARY KEY (`noticeid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `ped_incharge`
--
ALTER TABLE `ped_incharge`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`sport_id`);

--
-- Indexes for table `sports_captain`
--
ALTER TABLE `sports_captain`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockid`),
  ADD KEY `equipmentid` (`equipmentid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`userid`,`faculty`),
  ADD UNIQUE KEY `registrationnumber` (`registrationnumber`);

--
-- Indexes for table `unpackedinventory`
--
ALTER TABLE `unpackedinventory`
  ADD PRIMARY KEY (`equipmentid`);

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
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `equipmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `inventoryedit`
--
ALTER TABLE `inventoryedit`
  MODIFY `editid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventoryrequest`
--
ALTER TABLE `inventoryrequest`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `noticeboard`
--
ALTER TABLE `noticeboard`
  MODIFY `noticeid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `sport_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amalgamatedclub`
--
ALTER TABLE `amalgamatedclub`
  ADD CONSTRAINT `amalgamatedclub_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `sportequipmentFK` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`);

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
-- Constraints for table `inventoryedit`
--
ALTER TABLE `inventoryedit`
  ADD CONSTRAINT `inventoryedit_ibfk_1` FOREIGN KEY (`equipmentid`) REFERENCES `unpackedinventory` (`equipmentid`);

--
-- Constraints for table `inventoryrequest`
--
ALTER TABLE `inventoryrequest`
  ADD CONSTRAINT `inventoryrequest_ibfk_1` FOREIGN KEY (`equipmentid`) REFERENCES `unpackedinventory` (`equipmentid`);

--
-- Constraints for table `noticeboard`
--
ALTER TABLE `noticeboard`
  ADD CONSTRAINT `noticeboard_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

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
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`equipmentid`) REFERENCES `equipments` (`equipmentid`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `unpackedinventory`
--
ALTER TABLE `unpackedinventory`
  ADD CONSTRAINT `unpackedinventory_ibfk_1` FOREIGN KEY (`equipmentid`) REFERENCES `equipments` (`equipmentid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
