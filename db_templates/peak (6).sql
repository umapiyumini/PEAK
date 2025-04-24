-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2025 at 01:25 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `amalgamatedclub`
--

CREATE TABLE `amalgamatedclub` (
  `regno` varchar(15) NOT NULL,
  `userid` int(11) NOT NULL,
  `post` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `date` date NOT NULL,
  `regno` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `attendance` enum('Present','Absent') NOT NULL,
  `sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_excuse`
--

CREATE TABLE `attendance_excuse` (
  `request_id` int(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `sport_id` int(255) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `submit_date` date NOT NULL
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

--
-- Dumping data for table `coaches`
--

INSERT INTO `coaches` (`empid`, `name`, `role`, `email`, `phone`, `nic`, `address`, `experience`, `sport_id`) VALUES
(1, 'H.A. Perera', 'Coach', 'perera@gmail.com', '+1234567892', '43562346713v', '123 Main St, Colombo', 10, 3),
(2, 'Nihal Silva', 'Coach', 'nihal@gmail.com', '+1122334455', '54632887342v', '789 Main St,Colombo', 8, 3),
(3, 'D.L Fernando', 'Instructor', 'lalan@gmail.com', '+2234567892', '83562346713v', '101 Main St,Colombo', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `coloursnight_forms`
--

CREATE TABLE `coloursnight_forms` (
  `id` int(255) NOT NULL,
  `sport_id` int(255) NOT NULL,
  `team_gender` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `reg_no` int(255) NOT NULL,
  `interuni_performance` varchar(255) DEFAULT NULL,
  `awards` varchar(255) DEFAULT NULL,
  `rewards` varchar(255) DEFAULT NULL,
  `merit_awards` varchar(255) DEFAULT NULL,
  `captain_regno` varchar(15) NOT NULL,
  `submit_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courts`
--

CREATE TABLE `courts` (
  `courtid` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` enum('indoor','ground','strengthhall','') NOT NULL,
  `section` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`courtid`, `name`, `location`, `section`, `description`, `image`) VALUES
(1, 'Badminton', 'indoor', 'A', 'An indoor court designed for professional and recreational badminton games.', 'http://localhost/PEAK/public/assets/images/uma/badminton.jpg'),
(2, 'Table tennis', 'indoor', 'A', 'A compact indoor area equipped with high-quality table tennis setups.', 'http://localhost/PEAK/public/assets/images/uma/tabletennis.jpg'),
(3, 'Volleyball', 'indoor', 'A', 'An indoor volleyball court with professional flooring and lighting.', 'http://localhost/PEAK/public/assets/images/uma/volleyballi.jpg'),
(4, 'Karate', 'indoor', 'A', 'A dojo-style indoor facility for karate training and competitions.', 'http://localhost/PEAK/public/assets/images/uma/karate.jpg'),
(5, 'Wrestling', 'indoor', 'A', 'An indoor wrestling arena with mats and safety equipment.', 'http://localhost/PEAK/public/assets/images/uma/wrestling.jpg'),
(6, 'Sportscenter', 'indoor', 'B', 'A multi-sport indoor complex featuring a variety of facilities.', 'http://localhost/PEAK/public/assets/images/uma/hall.jpg'),
(7, 'Baseball', 'ground', 'C', 'A standard outdoor baseball field with dugouts and bleachers.', 'http://localhost/PEAK/public/assets/images/uma/baseball.jpg'),
(8, 'Hockey', 'ground', 'C', 'An outdoor hockey field built to regulation size.', 'http://localhost/PEAK/public/assets/images/uma/hockey.jpg'),
(9, 'Cricket', 'ground', 'C', 'An expansive outdoor cricket ground with turf pitch.', 'http://localhost/PEAK/public/assets/images/uma/cricket.jpg'),
(10, 'Cricketturf', 'ground', 'C', 'A cricket practice area with synthetic turf.', 'http://localhost/PEAK/public/assets/images/uma/turf.jpg'),
(11, 'Elle', 'ground', 'C', 'A traditional outdoor elle court used for community games.', 'http://localhost/PEAK/public/assets/images/uma/cricket.jpg'),
(12, 'Basketball', 'ground', 'D', 'An outdoor basketball court with standard hoops and markings.', 'http://localhost/PEAK/public/assets/images/uma/basketball.jpg'),
(13, 'Football', 'ground', 'E', 'A large football field used for matches and practice.', 'http://localhost/PEAK/public/assets/images/uma/football.jpg'),
(14, 'Netball', 'ground', 'E', 'A netball court with clear boundaries and goal rings.', 'http://localhost/PEAK/public/assets/images/uma/netball.jpg'),
(15, 'Rugby', 'ground', 'E', 'A professionally maintained rugby ground for competitive matches.', 'http://localhost/PEAK/public/assets/images/uma/rugby.jpg'),
(16, 'Tennis', 'ground', 'F', 'A high-quality outdoor tennis court with fencing and seating.', 'http://localhost/PEAK/public/assets/images/uma/tennis.jpg'),
(17, 'VolleyBall', 'ground', 'G', 'A beach-style volleyball court suitable for casual games.', 'http://localhost/PEAK/public/assets/images/uma/volleyball.jpg');

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
(1, 3, 'Balls', 'Team', 9, 'practice balls'),
(2, 3, 'ball', 'Recreational', 5, 'abc'),
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

--
-- Dumping data for table `freshersrecords`
--

INSERT INTO `freshersrecords` (`freshersid`, `tournament_name`, `year`, `first_place`, `second_place`, `third_place`, `no_of_players`, `playersregno`, `sport_id`) VALUES
(2, 'Hockey', 2024, 'UCSC', 'FOS', 'FOA', 17, '1234,11245,12167', 3),
(3, 'Hockey', 2025, 'FOM', 'UCSC', 'FOL', 12, '1234', 3);

-- --------------------------------------------------------

--
-- Table structure for table `groundcourts`
--

CREATE TABLE `groundcourts` (
  `courtid` int(11) NOT NULL,
  `event` enum('practice','tournament') NOT NULL,
  `duration` enum('half','full','2 hour','4 hour') NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groundcourts`
--

INSERT INTO `groundcourts` (`courtid`, `event`, `duration`, `description`, `price`) VALUES
(24, 'practice', 'half', 'no', 17500.00),
(24, 'practice', 'full', 'no', 30000.00),
(24, 'tournament', 'half', 'no', 35000.00),
(24, 'tournament', 'full', 'no', 65000.00),
(25, 'practice', 'half', 'With marking', 27500.00),
(25, 'practice', 'half', 'Without marking', 20000.00),
(25, 'practice', 'full', 'With marking', 40000.00),
(25, 'practice', 'full', 'Without marking', 30000.00),
(25, 'practice', '2 hour', 'With marking', 17500.00),
(25, 'practice', '2 hour', 'Without marking', 10000.00),
(25, 'tournament', 'half', 'With marking', 40000.00),
(25, 'tournament', 'full', 'With marking', 70000.00),
(25, 'tournament', '2 hour', 'With marking', 27500.00),
(26, 'practice', 'half', 'Hard ball', 17500.00),
(26, 'practice', 'full', 'Hard ball', 30000.00),
(26, 'practice', '2 hour', 'Hard ball', 10000.00),
(26, 'practice', '2 hour', 'Soft ball', 4600.00),
(26, 'tournament', 'half', 'Hard ball', 20000.00),
(26, 'tournament', 'half', 'Softball', 65000.00),
(26, 'tournament', 'full', 'Hard ball', 35000.00),
(26, 'tournament', 'full', 'Softball', 115000.00),
(26, 'tournament', '4 hour', 'Softball', 13000.00),
(27, 'practice', '2 hour', 'no', 7000.00),
(28, 'tournament', 'half', 'no', 25000.00),
(28, 'tournament', 'full', 'no', 45000.00),
(29, 'practice', 'half', 'With light', 17500.00),
(29, 'practice', 'half', 'Without light', 12000.00),
(29, 'practice', 'full', 'Without light', 20000.00),
(29, 'practice', '2 hour', 'With light', 8000.00),
(29, 'practice', '2 hour', 'Without light', 6000.00),
(29, 'tournament', 'half', 'With light', 25000.00),
(29, 'tournament', 'half', 'Without light', 40000.00),
(29, 'tournament', 'full', 'With light', 12500.00),
(29, 'tournament', 'full', 'Without light', 40000.00),
(29, 'tournament', '2 hour', 'Without light', 10000.00),
(30, 'practice', 'half', 'With marking', 27500.00),
(30, 'practice', 'half', 'Without marking', 20000.00),
(30, 'practice', 'full', 'With marking', 40000.00),
(30, 'practice', 'full', 'Without marking', 30000.00),
(30, 'practice', '2 hour', 'With marking', 17500.00),
(30, 'practice', '2 hour', 'Without marking', 10000.00),
(30, 'tournament', 'half', 'With marking', 40000.00),
(30, 'tournament', 'full', 'With marking', 70000.00),
(30, 'tournament', '2 hour', 'With marking', 27500.00),
(31, 'practice', 'half', '1', 20000.00),
(31, 'practice', 'half', '2', 30000.00),
(31, 'practice', 'full', '1', 30000.00),
(31, 'practice', 'full', '2', 45000.00),
(31, 'practice', '2 hour', '1', 7000.00),
(31, 'practice', '2 hour', '2', 12000.00),
(31, 'tournament', 'half', '1', 20000.00),
(31, 'tournament', 'half', '2', 35000.00),
(31, 'tournament', 'full', '1', 35000.00),
(31, 'tournament', 'full', '2', 55000.00),
(31, 'tournament', '2 hour', '1', 10000.00),
(31, 'tournament', '2 hour', '2', 15000.00),
(32, 'practice', 'half', 'With marking', 32500.00),
(32, 'practice', 'half', 'Without marking', 25000.00),
(32, 'practice', 'full', 'With marking', 47500.00),
(32, 'practice', 'full', 'Without marking', 40000.00),
(32, 'practice', '2 hour', 'With marking', 22500.00),
(32, 'practice', '2 hour', 'Without marking', 15000.00),
(32, 'tournament', 'half', 'With marking', 50000.00),
(32, 'tournament', 'full', 'With marking', 80000.00),
(32, 'tournament', '2 hour', 'With marking', 37500.00),
(33, 'practice', '2 hour', 'no', 4000.00),
(33, 'tournament', 'half', 'no', 20000.00),
(33, 'tournament', 'full', 'no', 35000.00),
(33, 'tournament', '2 hour', 'no', 10000.00),
(34, 'practice', 'half', 'no', 20000.00),
(34, 'practice', 'full', 'no', 30000.00),
(34, 'practice', '2 hour', 'no', 7000.00),
(34, 'tournament', 'half', 'no', 20000.00),
(34, 'tournament', 'full', 'no', 35000.00),
(34, 'tournament', '2 hour', 'no', 10000.00);

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
-- Table structure for table `hostal_facilities`
--

CREATE TABLE `hostal_facilities` (
  `hostalrequest_id` int(255) NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `priority` int(5) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `sport_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `indoorcourts`
--

CREATE TABLE `indoorcourts` (
  `courtid` int(11) NOT NULL,
  `event` enum('practice','tournament') NOT NULL,
  `duration` enum('1 hour','half','full') NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Dumping data for table `interfacultyrecords`
--

INSERT INTO `interfacultyrecords` (`interfacrecid`, `tournament_name`, `year`, `first_place`, `second_place`, `third_place`, `no_of_players`, `players_regno`, `sport_id`) VALUES
(2, '', 2024, 'FOL', 'FOS', 'FOM', 17, '1245,6543,5433', 3),
(4, 'Hockey', 2023, 'FOS', 'UCSC', 'FOL', 12, '1546', 3);

-- --------------------------------------------------------

--
-- Table structure for table `interuniversityrecords`
--

CREATE TABLE `interuniversityrecords` (
  `interrecordid` int(11) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `place` varchar(255) NOT NULL,
  `venue` varchar(100) DEFAULT NULL,
  `no_of_players` int(11) NOT NULL,
  `players_Regno` varchar(255) DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `men_women` enum('men','women','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interuniversityrecords`
--

INSERT INTO `interuniversityrecords` (`interrecordid`, `tournament_name`, `date`, `place`, `venue`, `no_of_players`, `players_Regno`, `sport_id`, `men_women`) VALUES
(5, 'SLUG', '2025-04-08', '2nd Place', 'UOC', 17, '1267,1452,1274', 3, 'men'),
(14, 'SLUG', '2025-04-08', '3rd Place', 'UOC', 17, NULL, 1, 'men');

-- --------------------------------------------------------

--
-- Table structure for table `inventoryedit`
--

CREATE TABLE `inventoryedit` (
  `editid` int(11) NOT NULL,
  `equipmentid` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventoryedit`
--

INSERT INTO `inventoryedit` (`editid`, `equipmentid`, `date`, `quantity`, `reason`) VALUES
(1, 1, '2025-02-26', 2, 'lost');

-- --------------------------------------------------------

--
-- Table structure for table `inventoryrequest`
--

CREATE TABLE `inventoryrequest` (
  `requestid` int(11) NOT NULL,
  `equipmentid` int(11) NOT NULL,
  `sport_id` int(20) NOT NULL,
  `quantityrequested` int(11) NOT NULL,
  `timeframe` enum('mid year','end year') NOT NULL,
  `date` date NOT NULL,
  `requested_by` int(255) NOT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `addnotes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventoryrequest`
--

INSERT INTO `inventoryrequest` (`requestid`, `equipmentid`, `sport_id`, `quantityrequested`, `timeframe`, `date`, `requested_by`, `status`, `addnotes`) VALUES
(5, 2, 3, 7, 'mid year', '0000-00-00', 34, 'pending', 'none');

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
  `regno` varchar(15) NOT NULL,
  `position` varchar(100) NOT NULL,
  `jerseyno` int(11) NOT NULL,
  `sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`regno`, `position`, `jerseyno`, `sport_id`) VALUES
('2020is074', 'New', 43, 3);

-- --------------------------------------------------------

--
-- Table structure for table `pool_bookings`
--

CREATE TABLE `pool_bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `booking_date` date NOT NULL,
  `booking_time` time NOT NULL,
  `status` enum('approved','cancelled','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pool_bookings`
--

INSERT INTO `pool_bookings` (`booking_id`, `user_id`, `booking_date`, `booking_time`, `status`) VALUES
(1, 34, '2025-04-16', '11:20:58', 'cancelled'),
(2, 20, '2025-04-16', '17:58:55', 'approved'),
(3, 32, '2025-04-16', '00:00:00', 'approved'),
(4, 32, '2025-04-16', '17:06:14', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `pool_settings`
--

CREATE TABLE `pool_settings` (
  `setting_id` int(11) NOT NULL,
  `student_limit` int(11) DEFAULT 20,
  `start_time` time DEFAULT '17:00:00',
  `end_time` time DEFAULT '19:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pool_settings`
--

INSERT INTO `pool_settings` (`setting_id`, `student_limit`, `start_time`, `end_time`) VALUES
(1, 20, '16:35:00', '18:35:00'),
(2, 2, '18:43:00', '19:43:00'),
(3, 3, '00:00:00', '00:00:00'),
(4, 13, '18:44:00', '21:44:00');

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
  `regno` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `reason` text DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recruitments`
--

INSERT INTO `recruitments` (`recruitmentid`, `regno`, `name`, `faculty`, `reason`, `sport_id`, `status`) VALUES
(1, '2020is074', 'H.M.Perera', 'Science', NULL, 3, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservationid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `courtid` int(11) NOT NULL,
  `event` enum('practice','tournament') DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` varchar(20) DEFAULT NULL,
  `status` enum('pending','To pay','rejected','paid','confirmed') NOT NULL DEFAULT 'pending',
  `usertype` enum('clubs','govt schools','semi govt schools','uoc faculties') DEFAULT NULL,
  `userdescription` text DEFAULT NULL,
  `userproof` varchar(255) DEFAULT NULL,
  `numberof_participants` int(11) DEFAULT NULL,
  `extradetails` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discountedprice` decimal(10,2) NOT NULL,
  `occupied` enum('0','1') DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservationid`, `userid`, `courtid`, `event`, `date`, `time`, `status`, `usertype`, `userdescription`, `userproof`, `numberof_participants`, `extradetails`, `price`, `discountedprice`, `occupied`, `created_at`) VALUES
(2, 20, 38, '', '0000-00-00', '', 'pending', '', '', '', 0, '', 100.00, 100.00, '', '2025-04-10 15:46:18'),
(3, 27, 38, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, 60000.00, 60000.00, '0', '2025-04-10 17:28:32'),
(4, 27, 38, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, 20000.00, 20000.00, '0', '2025-04-10 17:29:08'),
(5, 27, 38, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, 0.00, 0.00, '0', '2025-04-10 17:30:12'),
(6, 27, 38, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, 60000.00, 60000.00, '0', '2025-04-10 17:36:13'),
(7, 27, 38, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, 60000.00, 60000.00, '0', '2025-04-10 17:36:53'),
(8, 27, 38, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, 35000.00, 35000.00, '0', '2025-04-10 17:38:17'),
(9, 27, 38, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, 60000.00, 60000.00, '0', '2025-04-10 17:46:08'),
(10, 27, 38, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, 60000.00, 60000.00, '0', '2025-04-10 17:46:39'),
(11, 27, 38, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL, 60000.00, 60000.00, '0', '2025-04-10 17:47:58'),
(12, 27, 18, 'practice', '2025-04-08', '23:41:12', 'paid', 'clubs', 'dcafb', 'fea', 30, 'kn', 5000.00, 5500.00, '1', '2025-04-11 04:49:20'),
(13, 27, 35, 'tournament', '2025-04-22', '23:41:12', 'paid', 'govt schools', 'efag', 'afeg', 30, 'efga', 6000.00, 5500.00, '1', '2025-04-11 05:00:07');

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
  `sport_id` int(11) DEFAULT NULL,
  `published_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sportnews`
--

INSERT INTO `sportnews` (`newsid`, `topic`, `content`, `sport_id`, `published_date`) VALUES
(1, 'Inter-Faculty Tournament Winners', 'The hockey team from the Faculty of Science emerged as champions in the inter-faculty hockey tournament. Their teamwork and dedication set a new benchmark for sportsmanship!', 3, '2025-02-10'),
(2, 'Hockey Tournament 2024', 'Congratulations to the Hockey team for an incredible performance! They clinched the title in this year’s Hockey Tournament, showcasing immense potential and talent.', 3, '2025-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `sports_captain`
--

CREATE TABLE `sports_captain` (
  `regno` varchar(15) NOT NULL,
  `sport_id` int(50) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `emp_no` varchar(50) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `appointment_date` date NOT NULL,
  `nic` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `phone` int(12) NOT NULL,
  `address` varchar(100) NOT NULL,
  `type` enum('ground','indoor','ped','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `emp_no`, `reg_no`, `designation`, `appointment_date`, `nic`, `dob`, `phone`, `address`, `type`) VALUES
('gs123', 'Sujan walgampaya', 'EMP8687', 'REG657567', 'Instructor', '2018-04-03', '12345678v', '1989-03-15', 778364878, 'bhfbskfbdkfbsef', 'ped'),
('jhfshdf', 'bhfjsgfiyefge', 'dsj43', 'fud43', 'hruifghuif', '2025-04-09', '54327893', '1989-03-15', 5436543, 'gnbdkjhgki', 'ground'),
('krfldf', 'jkghidfg', 'ghjk54', 'fbhjkg54', 'gdkghi', '2025-03-12', '463723455v', '1990-03-15', 234567897, 'nfjkhihfsf', 'indoor');

-- --------------------------------------------------------

--
-- Table structure for table `stafftodo`
--

CREATE TABLE `stafftodo` (
  `taskid` int(11) NOT NULL,
  `taskname` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deadline` datetime NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` enum('Pending','Overdue','Completed','Cancelled') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stafftodo`
--

INSERT INTO `stafftodo` (`taskid`, `taskname`, `date`, `time`, `deadline`, `description`, `status`) VALUES
(1, 'cut grass', '2025-04-11', '2025-04-11 06:30:38', '2025-04-18 11:33:47', 'cut the grass around the hockey court', 'Pending');

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
(1, 1, '678', 'practice balls ', 6, 2, 2, '2025-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `strengthhall`
--

CREATE TABLE `strengthhall` (
  `subscription` enum('annual','6 month','3 month') NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strengthhall`
--

INSERT INTO `strengthhall` (`subscription`, `price`) VALUES
('annual', 60000.00),
('6 month', 35000.00),
('3 month', 20000.00);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `userid` int(255) NOT NULL,
  `registrationnumber` varchar(15) DEFAULT NULL,
  `faculty` varchar(50) NOT NULL,
  `department` varchar(50) DEFAULT NULL,
  `id_start` date DEFAULT NULL,
  `id_end` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`userid`, `registrationnumber`, `faculty`, `department`, `id_start`, `id_end`) VALUES
(25, '2020is074', 'ucsc', 'IS', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transport_requests`
--

CREATE TABLE `transport_requests` (
  `request_id` int(255) NOT NULL,
  `no_of_members` int(255) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(255) NOT NULL,
  `time` time(6) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `sport_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport_requests`
--

INSERT INTO `transport_requests` (`request_id`, `no_of_members`, `date`, `location`, `time`, `reason`, `sport_id`) VALUES
(1, 5, '2025-04-25', 'uoc', '10:16:00.000000', 'tyghg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `upcomingevents`
--

CREATE TABLE `upcomingevents` (
  `event_id` int(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time(6) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `sport_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `upcomingevents`
--

INSERT INTO `upcomingevents` (`event_id`, `event_name`, `date`, `time`, `venue`, `sport_id`) VALUES
(1, 'Freshers Hockey Tournament', '2025-04-22', '08:00:00.000000', 'Ground', 3);

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
(32, 'ab saman', 'Male', '200212323456', 'umazz20023@gmail.com', '0000-00-00', '0112123456', 'abc adress', '', 'umazz20023@gmail.com', '$2y$10$OLP6PM5aN3CBca2ZULcqpuhDR6JBoNr..iSQfaTAON.lwDGJl4hFW', 'External User', '2024-12-02'),
(34, 'H A V Ranmini', 'Female', '200258502805', 'vidusharanmini@gmail.com', '0000-00-00', '0704232525', '499/C Kandeliyadda Paluwa Ragma ', '', 'vidusharanmini@gmail.com', '$2y$10$LR6p22l3jlX/Fj.mAkz/zOkyZLdimFqs/D3Fu4KPzuDCu4GNydnJK', 'Sports Captain', '2025-02-22'),
(35, 'H A S Sanodya', 'Female', '224354541908', 'sano@gmail.com', '2001-04-03', '0704389063', '456 Mahara Kadawatha', '', 'sano@gmail.com', 'Senethi@1234', 'GroundIndoorStaff', '2025-04-09');

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
  ADD PRIMARY KEY (`regno`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`date`,`regno`),
  ADD KEY `sport_id` (`sport_id`),
  ADD KEY `attendance_ibfk_3` (`regno`);

--
-- Indexes for table `attendance_excuse`
--
ALTER TABLE `attendance_excuse`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk_sport_id` (`sport_id`),
  ADD KEY `fk_sport_id2` (`reg_no`);

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
-- Indexes for table `coloursnight_forms`
--
ALTER TABLE `coloursnight_forms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk3_sport_id` (`sport_id`),
  ADD KEY `fk3_sport_id748` (`captain_regno`);

--
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`courtid`);

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
-- Indexes for table `groundcourts`
--
ALTER TABLE `groundcourts`
  ADD PRIMARY KEY (`courtid`,`event`,`duration`,`description`(255));

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
-- Indexes for table `hostal_facilities`
--
ALTER TABLE `hostal_facilities`
  ADD PRIMARY KEY (`hostalrequest_id`),
  ADD KEY `fk1_sport_id` (`sport_id`),
  ADD KEY `fk_sport_id26` (`reg_no`);

--
-- Indexes for table `indoorcourts`
--
ALTER TABLE `indoorcourts`
  ADD PRIMARY KEY (`courtid`,`event`,`duration`,`description`(255));

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
-- Indexes for table `pool_bookings`
--
ALTER TABLE `pool_bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pool_settings`
--
ALTER TABLE `pool_settings`
  ADD PRIMARY KEY (`setting_id`);

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
  ADD KEY `sport_id` (`sport_id`),
  ADD KEY `recruitments_ibfk_2` (`regno`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservationid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `courtid` (`courtid`);

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
  ADD PRIMARY KEY (`regno`),
  ADD KEY `captain_sport` (`sport_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `stafftodo`
--
ALTER TABLE `stafftodo`
  ADD PRIMARY KEY (`taskid`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockid`),
  ADD KEY `equipmentid` (`equipmentid`);

--
-- Indexes for table `strengthhall`
--
ALTER TABLE `strengthhall`
  ADD PRIMARY KEY (`subscription`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `registrationnumber` (`registrationnumber`);

--
-- Indexes for table `transport_requests`
--
ALTER TABLE `transport_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `fk2_sport_id` (`sport_id`);

--
-- Indexes for table `upcomingevents`
--
ALTER TABLE `upcomingevents`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `upcoming_idk1` (`sport_id`);

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
-- AUTO_INCREMENT for table `attendance_excuse`
--
ALTER TABLE `attendance_excuse`
  MODIFY `request_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coloursnight_forms`
--
ALTER TABLE `coloursnight_forms`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `courtid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `freshersid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gymequipments`
--
ALTER TABLE `gymequipments`
  MODIFY `gymequipmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `hostal_facilities`
--
ALTER TABLE `hostal_facilities`
  MODIFY `hostalrequest_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `interfacultyrecords`
--
ALTER TABLE `interfacultyrecords`
  MODIFY `interfacrecid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `interuniversityrecords`
--
ALTER TABLE `interuniversityrecords`
  MODIFY `interrecordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inventoryedit`
--
ALTER TABLE `inventoryedit`
  MODIFY `editid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventoryrequest`
--
ALTER TABLE `inventoryrequest`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `pool_bookings`
--
ALTER TABLE `pool_bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pool_settings`
--
ALTER TABLE `pool_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `practiceschedule`
--
ALTER TABLE `practiceschedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recruitments`
--
ALTER TABLE `recruitments`
  MODIFY `recruitmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `sport_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sportnews`
--
ALTER TABLE `sportnews`
  MODIFY `newsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stafftodo`
--
ALTER TABLE `stafftodo`
  MODIFY `taskid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transport_requests`
--
ALTER TABLE `transport_requests`
  MODIFY `request_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `upcomingevents`
--
ALTER TABLE `upcomingevents`
  MODIFY `event_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  ADD CONSTRAINT `attendance_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`regno`) REFERENCES `players` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `attendance_excuse`
--
ALTER TABLE `attendance_excuse`
  ADD CONSTRAINT `fk_sport_id` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sport_id2` FOREIGN KEY (`reg_no`) REFERENCES `attendance` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `coloursnight_forms`
--
ALTER TABLE `coloursnight_forms`
  ADD CONSTRAINT `fk3_sport_id` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk3_sport_id748` FOREIGN KEY (`captain_regno`) REFERENCES `sports_captain` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `hostal_facilities`
--
ALTER TABLE `hostal_facilities`
  ADD CONSTRAINT `fk1_sport_id` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sport_id26` FOREIGN KEY (`reg_no`) REFERENCES `players` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `indoorcourts`
--
ALTER TABLE `indoorcourts`
  ADD CONSTRAINT `indoorcourts_ibfk_1` FOREIGN KEY (`courtid`) REFERENCES `courts` (`courtid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interfacultyrecords`
--
ALTER TABLE `interfacultyrecords`
  ADD CONSTRAINT `interfacultyrecords_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`);

--
-- Constraints for table `interuniversityrecords`
--
ALTER TABLE `interuniversityrecords`
  ADD CONSTRAINT `interuniversityrecords_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `inventoryedit`
--
ALTER TABLE `inventoryedit`
  ADD CONSTRAINT `inventoryedit_ibfk_1` FOREIGN KEY (`equipmentid`) REFERENCES `equipments` (`equipmentid`);

--
-- Constraints for table `inventoryrequest`
--
ALTER TABLE `inventoryrequest`
  ADD CONSTRAINT `fk_inventoryrequest_equipment` FOREIGN KEY (`equipmentid`) REFERENCES `equipments` (`equipmentid`),
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
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `playerstudent_reg` FOREIGN KEY (`regno`) REFERENCES `student` (`registrationnumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pool_bookings`
--
ALTER TABLE `pool_bookings`
  ADD CONSTRAINT `pool_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`userid`);

--
-- Constraints for table `practiceschedule`
--
ALTER TABLE `practiceschedule`
  ADD CONSTRAINT `practiceschedule_ibfk_1` FOREIGN KEY (`sportid`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `recruitments`
--
ALTER TABLE `recruitments`
  ADD CONSTRAINT `recruitments_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`),
  ADD CONSTRAINT `recruitments_ibfk_2` FOREIGN KEY (`regno`) REFERENCES `student` (`registrationnumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sportnews`
--
ALTER TABLE `sportnews`
  ADD CONSTRAINT `sportnews_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `sports_captain`
--
ALTER TABLE `sports_captain`
  ADD CONSTRAINT `captain_sport` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`),
  ADD CONSTRAINT `captainregplayers` FOREIGN KEY (`regno`) REFERENCES `players` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `transport_requests`
--
ALTER TABLE `transport_requests`
  ADD CONSTRAINT `fk2_sport_id` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `upcomingevents`
--
ALTER TABLE `upcomingevents`
  ADD CONSTRAINT `upcoming_idk1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
