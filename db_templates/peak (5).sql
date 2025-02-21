-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 06:13 AM
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
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `date` date NOT NULL,
  `regno` int(11) NOT NULL,
  `attendance` enum('Present','Absent') NOT NULL,
  `sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coaches`
--

CREATE TABLE `coaches` (
  `empid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `experience` int(11) NOT NULL,
  `sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `equipmentid` int(11) NOT NULL,
  `sport_id` int(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('Team','Recreational','','') NOT NULL,
  `issued_amount` int(20) NOT NULL DEFAULT 0,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`equipmentid`, `sport_id`, `name`, `type`, `issued_amount`, `description`) VALUES
(1, 3, 'Balls', 'Team', 0, 'practice balls'),
(2, 1, 'ball', 'Recreational', 5, 'abc'),
(3, 4, 'foot balls', 'Recreational', 5, 'abc'),
(4, 2, 'gloves', 'Recreational', 15, 'abc'),
(6, 1, 'bats', 'Team', 0, ''),
(9, 2, 'cones', 'Team', 0, 'practice sessions');

-- --------------------------------------------------------

--
-- Table structure for table `eventrecords`
--

CREATE TABLE `eventrecords` (
  `eventid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `venue` varchar(255) NOT NULL,
  `sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `external_user`
--

CREATE TABLE `external_user` (
  `userid` int(11) NOT NULL,
  `companyid` varchar(100) DEFAULT NULL,
  `company_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `external_user`
--

INSERT INTO `external_user` (`userid`, `companyid`, `company_name`) VALUES
(27, '678', 'abc678'),
(30, '11', 'Hello'),
(31, 'jhsfd', 'uhdvdsig'),
(32, 'The Bike Manufactures (pvt) ltd', 'The Bike Manufactures (pvt) ltd');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `content` text NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `rating`, `content`, `time`, `date`, `userid`) VALUES
(1, 4, 'goood', '10:44:57', '2025-02-20', 27),
(2, 5, 'exccellent', '10:47:38', '2025-02-20', 27);

-- --------------------------------------------------------

--
-- Table structure for table `freshersrecords`
--

CREATE TABLE `freshersrecords` (
  `freshersid` int(11) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `first_place` varchar(255) DEFAULT NULL,
  `second_place` varchar(255) DEFAULT NULL,
  `third_place` varchar(255) DEFAULT NULL,
  `no_of_players` int(11) DEFAULT NULL,
  `playersregno` text DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL
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
-- Table structure for table `gymequipments`
--

CREATE TABLE `gymequipments` (
  `gymequipmentid` int(11) NOT NULL,
  `equipmentname` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `description` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gymequipments`
--

INSERT INTO `gymequipments` (`gymequipmentid`, `equipmentname`, `quantity`, `description`) VALUES
(32, 'rowing machine', 6, 'ddfdf');

-- --------------------------------------------------------

--
-- Table structure for table `interfacultyrecords`
--

CREATE TABLE `interfacultyrecords` (
  `interfacrecid` int(11) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `first_place` varchar(255) DEFAULT NULL,
  `second_place` varchar(255) DEFAULT NULL,
  `third_place` varchar(255) DEFAULT NULL,
  `no_of_players` int(11) DEFAULT NULL,
  `players_regno` text DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interuniversityrecords`
--

CREATE TABLE `interuniversityrecords` (
  `interrecordid` int(11) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `year` year(4) NOT NULL,
  `place` varchar(255) NOT NULL,
  `venueid` int(11) DEFAULT NULL,
  `no_of_players` int(11) NOT NULL,
  `sport_id` int(11) DEFAULT NULL
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
  `equipmentid` int(11) NOT NULL,
  `sport_id` int(20) NOT NULL,
  `quantityrequested` int(11) NOT NULL,
  `date` date NOT NULL,
  `requested_by` varchar(100) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messageid`, `userid`, `content`, `date`, `time`) VALUES
(3, 21, 'fda', '2025-02-20', '2025-02-20 08:58:21'),
(4, 21, 'fa', '2025-02-20', '2025-02-20 08:59:09'),
(5, 21, 'afdg', '2025-02-20', '2025-02-20 09:02:08'),
(6, 27, 'avsg', '2025-02-20', '2025-02-20 09:03:13'),
(7, 27, 'cv', '2025-02-20', '2025-02-20 09:07:48'),
(8, 27, 'cv', '2025-02-20', '2025-02-20 09:08:57'),
(9, 27, 'f', '2025-02-20', '2025-02-20 09:16:56'),
(10, 27, 'try', '2025-02-20', '2025-02-20 09:23:11'),
(11, 27, 'try1', '2025-02-20', '2025-02-20 09:26:49'),
(12, 27, 'gs', '2025-02-20', '2025-02-20 09:47:27');

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE `noticeboard` (
  `noticeid` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `publishdate` date DEFAULT NULL,
  `publishtime` time DEFAULT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `noticeboard`
--

INSERT INTO `noticeboard` (`noticeid`, `title`, `content`, `publishdate`, `publishtime`, `userid`) VALUES
(31, 'Freshers', 'Freshers dchgwejdcwgefjcc fcywdcywecwjycw edyctewyctwejdctwjudc edcweydctwtjucwkdcf ejdcgweudcgwudcwe cjwgdcjuwegcwuef cfejyctwgefjuctw wjcgwejucw cewjfgcwejcgw cewdgcwejuc cwecgwejcufgw cefycgwjecfyw cewytdcwtjeyc', '2024-12-01', '08:24:00', NULL),
(34, 'freshers', 'all faculty', '2024-12-02', '08:17:00', NULL),
(38, 'umaa', 'this is the test successful', '2024-12-02', '09:32:00', NULL);

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
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `regno` int(11) NOT NULL,
  `position` varchar(100) NOT NULL,
  `jerseyno` int(11) NOT NULL,
  `sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `practiceschedule`
--

CREATE TABLE `practiceschedule` (
  `scheduleid` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `sportid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recruitments`
--

CREATE TABLE `recruitments` (
  `recruitmentid` int(11) NOT NULL,
  `regno` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `reason` text DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `accept` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservationid` int(11) NOT NULL,
  `facility` varchar(200) NOT NULL,
  `event` varchar(300) NOT NULL,
  `date` date NOT NULL,
  `time` datetime NOT NULL,
  `price` float NOT NULL,
  `status` enum('pending','rejected','confirmed','') NOT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservationid`, `facility`, `event`, `date`, `time`, `price`, `status`, `userid`) VALUES
(1, 'ground', 'new year', '2025-02-04', '2025-02-20 11:33:13', 3000, 'pending', 27),
(2, 'badminton court', 'matches', '2025-02-11', '2025-02-18 12:32:14', 2000, 'pending', 21),
(3, 'basketball court', 'matches', '2025-02-12', '2025-02-27 12:32:50', 2500, 'confirmed', 27),
(4, 'hockey court', 'practices', '2025-02-19', '2025-02-28 13:03:30', 2500, 'confirmed', 27);

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
-- Table structure for table `sportnews`
--

CREATE TABLE `sportnews` (
  `newsid` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockid`, `equipmentid`, `indent_no`, `description`, `unit`, `quantity`, `issued_quantity`, `date`) VALUES
(1, 1, '678', 'practice balls ', 6, 4, 0, '2025-01-05');

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

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`userid`, `registrationnumber`, `faculty`, `department`) VALUES
(25, '2020is074', 'ucsc', 'IS');

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
(2, 4),
(3, 2),
(4, 8);

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
(20, 'a b sportscaptain', 'Male', '200255401683', 'sportscaptain@gmail.com', '0000-00-00', '0715691983', 'JNSVF', '', 'sportscaptain@gmail.com', '$2y$10$6y5dnE6iY59o0BbmxJxe5.RqTF6M3/1PlD/1uI9kxmSQl84YJYbnm', 'Sports Captain', '2024-12-02'),
(21, 'abmaintainance', 'Male', '200255401684', 'maintenance@gmail.com', '0000-00-00', '0715691983', 'fdsb', '', 'maintenance@gmail.com', '$2y$10$cLJSRvLOUHxb.0N2ivJn1OD1b.jq3zRZZAx5DL3prNKJv1/vZHyb.', 'GroundIndoorStaff', '2024-12-02'),
(22, 'ab gym', 'Male', '200255401685', 'gym@gmail.com', '0000-00-00', '0716835810', 'fgs', '', 'gym@gmail.com', '$2y$10$EeMhbccCjhm3LPagPagBGuz4FMXU2MpMQqdcGkYQVuMnIJFPSsr0K', 'Gym Instructor', '2024-12-02'),
(23, 'ab amal', 'Male', '200255401686', 'amalgamated@gmail.com', '0000-00-00', '0715691983', 'anderson flats', '', 'amalgamated@gmail.com', '$2y$10$W.2L2x11n4U4KdczgxnOIOpQe1vXrPgWWV0yHxdJVp7pyv1eodrRu', 'Amalgamated Club Executive', '2024-12-02'),
(25, 'p u piyumini', 'Male', '200255401689', 'student@gmail.com', '0000-00-00', '0112123456', 'fugaj', '', 'student@gmail.com', '$2y$10$d/mMSuQenuf5yjpaitpie.pxga0.pEDhT76dI0CFwluCpAOTcUmhW', 'Internal User', '2024-12-02'),
(27, 'a b external', 'Male', '200255401698', 'external@gmail.com', '0000-00-00', '0716835810', 'fdab', '', 'external@gmail.com', '$2y$10$p1TRib3mRVOcqkvETvhW6O3yGRMQrhcxPPQTLRsSYXv5Ftz./a7qy', 'External User', '2024-12-02'),
(29, 'a b admin', 'Male', '200254441680', 'admin@gmail.com', '0000-00-00', '0716835810', 'fgsd', '', 'admin@gmail.com', '$2y$10$3WEmOjTp8Qa.GdaMRlZJQe3/j0THGwD1zjyID8jXejoVlVAvCMU4m', 'Admin', '2024-12-02'),
(30, 'Admin User', 'Male', '200224303240', 'a@gmail.com', '0000-00-00', '0787798230', 'Colombo', '', 'a@gmail.com', '$2y$10$bCXdwnvHU2HNZpzXekhCOucYd8dIOKdSfjCqAzVZcxWjqnhQOJSSe', 'Admin', '2024-12-02'),
(31, 'Amar', 'Male', '123456789123', 'student1@gmail.com', '0000-00-00', '0112123456', 'fugajfds', '', 'student1@gmail.com', '$2y$10$6cY1B7s.dkOvtOjz6/goQOF9asud.TDhdmMJLnz76GY7Rr3R75tZa', 'External User', '2024-12-02'),
(32, 'ab saman', 'Male', '200212323456', 'umazz20023@gmail.com', '0000-00-00', '0112123456', 'abc adress', '', 'umazz20023@gmail.com', '$2y$10$OLP6PM5aN3CBca2ZULcqpuhDR6JBoNr..iSQfaTAON.lwDGJl4hFW', 'External User', '2024-12-02');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `venueid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amalgamatedclub`
--
ALTER TABLE `amalgamatedclub`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`date`,`regno`),
  ADD KEY `regno` (`regno`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `coaches`
--
ALTER TABLE `coaches`
  ADD PRIMARY KEY (`empid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `nic` (`nic`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`equipmentid`),
  ADD KEY `sportequipmentFK` (`sport_id`);

--
-- Indexes for table `eventrecords`
--
ALTER TABLE `eventrecords`
  ADD PRIMARY KEY (`eventid`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `external_user`
--
ALTER TABLE `external_user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `freshersrecords`
--
ALTER TABLE `freshersrecords`
  ADD PRIMARY KEY (`freshersid`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `ground_indoor_staff`
--
ALTER TABLE `ground_indoor_staff`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `gymequipments`
--
ALTER TABLE `gymequipments`
  ADD PRIMARY KEY (`gymequipmentid`);

--
-- Indexes for table `interfacultyrecords`
--
ALTER TABLE `interfacultyrecords`
  ADD PRIMARY KEY (`interfacrecid`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `interuniversityrecords`
--
ALTER TABLE `interuniversityrecords`
  ADD PRIMARY KEY (`interrecordid`),
  ADD KEY `venueid` (`venueid`),
  ADD KEY `sport_id` (`sport_id`);

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
  ADD KEY `fk_inventoryrequest_equipment` (`equipmentid`),
  ADD KEY `fk_inventoryrequest_sport` (`sport_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageid`),
  ADD KEY `userid` (`userid`);

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
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`regno`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `practiceschedule`
--
ALTER TABLE `practiceschedule`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `sportid` (`sportid`);

--
-- Indexes for table `recruitments`
--
ALTER TABLE `recruitments`
  ADD PRIMARY KEY (`recruitmentid`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservationid`),
  ADD KEY `fk_userid` (`userid`);

--
-- Indexes for table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`sport_id`);

--
-- Indexes for table `sportnews`
--
ALTER TABLE `sportnews`
  ADD PRIMARY KEY (`newsid`),
  ADD KEY `sport_id` (`sport_id`);

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
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`venueid`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `equipmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `eventrecords`
--
ALTER TABLE `eventrecords`
  MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `freshersrecords`
--
ALTER TABLE `freshersrecords`
  MODIFY `freshersid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gymequipments`
--
ALTER TABLE `gymequipments`
  MODIFY `gymequipmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `interfacultyrecords`
--
ALTER TABLE `interfacultyrecords`
  MODIFY `interfacrecid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interuniversityrecords`
--
ALTER TABLE `interuniversityrecords`
  MODIFY `interrecordid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventoryedit`
--
ALTER TABLE `inventoryedit`
  MODIFY `editid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventoryrequest`
--
ALTER TABLE `inventoryrequest`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `noticeboard`
--
ALTER TABLE `noticeboard`
  MODIFY `noticeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `practiceschedule`
--
ALTER TABLE `practiceschedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recruitments`
--
ALTER TABLE `recruitments`
  MODIFY `recruitmentid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `sport_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sportnews`
--
ALTER TABLE `sportnews`
  MODIFY `newsid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `venueid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `amalgamatedclub`
--
ALTER TABLE `amalgamatedclub`
  ADD CONSTRAINT `amalgamatedclub_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`regno`) REFERENCES `players` (`regno`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `sportequipmentFK` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`);

--
-- Constraints for table `eventrecords`
--
ALTER TABLE `eventrecords`
  ADD CONSTRAINT `eventrecords_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `external_user`
--
ALTER TABLE `external_user`
  ADD CONSTRAINT `external_user_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `freshersrecords`
--
ALTER TABLE `freshersrecords`
  ADD CONSTRAINT `freshersrecords_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`);

--
-- Constraints for table `ground_indoor_staff`
--
ALTER TABLE `ground_indoor_staff`
  ADD CONSTRAINT `ground_indoor_staff_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `interfacultyrecords`
--
ALTER TABLE `interfacultyrecords`
  ADD CONSTRAINT `interfacultyrecords_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`);

--
-- Constraints for table `interuniversityrecords`
--
ALTER TABLE `interuniversityrecords`
  ADD CONSTRAINT `interuniversityrecords_ibfk_1` FOREIGN KEY (`venueid`) REFERENCES `venue` (`venueid`) ON DELETE CASCADE,
  ADD CONSTRAINT `interuniversityrecords_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `inventoryedit`
--
ALTER TABLE `inventoryedit`
  ADD CONSTRAINT `inventoryedit_ibfk_1` FOREIGN KEY (`equipmentid`) REFERENCES `unpackedinventory` (`equipmentid`);

--
-- Constraints for table `inventoryrequest`
--
ALTER TABLE `inventoryrequest`
  ADD CONSTRAINT `fk_inventoryrequest_equipment` FOREIGN KEY (`equipmentid`) REFERENCES `unpackedinventory` (`equipmentid`),
  ADD CONSTRAINT `fk_inventoryrequest_sport` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`);

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE;

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
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `practiceschedule`
--
ALTER TABLE `practiceschedule`
  ADD CONSTRAINT `practiceschedule_ibfk_1` FOREIGN KEY (`sportid`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `recruitments`
--
ALTER TABLE `recruitments`
  ADD CONSTRAINT `recruitments_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_userid` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `sportnews`
--
ALTER TABLE `sportnews`
  ADD CONSTRAINT `sportnews_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

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
