-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2026 at 12:09 AM
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
  `post` varchar(50) NOT NULL,
  `year` year(4) NOT NULL
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
  `reason` varchar(255) DEFAULT NULL,
  `sport_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`date`, `regno`, `name`, `attendance`, `reason`, `sport_id`) VALUES
('2025-04-01', '2022is080', 'Vidusha Rnamini', 'Absent', 'Sick', 3),
('2025-04-02', '2022is117', 'Sanudi Yapa', 'Present', NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `attendance_excuse`
--

CREATE TABLE `attendance_excuse` (
  `request_id` int(255) NOT NULL,
  `faculty` int(20) NOT NULL,
  `sport_id` int(255) NOT NULL,
  `tournament_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reg_no` varchar(15) DEFAULT NULL,
  `submit_date` date NOT NULL,
  `status` enum('Pending','Accepted','Rejected','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_excuse_players`
--

CREATE TABLE `attendance_excuse_players` (
  `id` int(11) NOT NULL,
  `excuse_id` int(11) DEFAULT NULL,
  `reg_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificaterequest`
--

CREATE TABLE `certificaterequest` (
  `RequestID` int(11) NOT NULL,
  `tournament` varchar(100) NOT NULL,
  `RegistrationNumber` varchar(15) NOT NULL,
  `Year` int(11) NOT NULL,
  `Sport` int(20) NOT NULL,
  `date` date DEFAULT NULL,
  `UserID` int(11) NOT NULL,
  `status` enum('Pending','Accepted','Rejected','Ready') NOT NULL
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
(2, 'Nihal Silva', 'Coach', 'nihal@gmail.com', '+1122334455', '54632887342v', '789 Main St,Colombo', 3, 3),
(3, 'D.L Fernando', 'Instructor', 'lalan@gmail.com', '+2234567892', '83562346713v', '101 Main St,Colombo', 3, 3);

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
  `image` varchar(255) DEFAULT NULL,
  `sport_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courts`
--

INSERT INTO `courts` (`courtid`, `name`, `location`, `section`, `description`, `image`, `sport_id`) VALUES
(1, 'Badminton', 'indoor', 'A', 'An indoor court designed for professional and recreational badminton games.', 'http://localhost/PEAK/public/assets/images/uma/badminton.jpg', 0),
(2, 'Table tennis', 'indoor', 'A', 'A compact indoor area equipped with high-quality table tennis setups.', 'http://localhost/PEAK/public/assets/images/uma/tabletennis.jpg', 0),
(3, 'Volleyball', 'indoor', 'A', 'An indoor volleyball court with professional flooring and lighting.', 'http://localhost/PEAK/public/assets/images/uma/volleyballi.jpg', 0),
(4, 'Karate', 'indoor', 'A', 'A dojo-style indoor facility for karate training and competitions.', 'http://localhost/PEAK/public/assets/images/uma/karate.jpg', 0),
(5, 'Wrestling', 'indoor', 'A', 'An indoor wrestling arena with mats and safety equipment.', 'http://localhost/PEAK/public/assets/images/uma/wrestling.jpg', 0),
(6, 'Sportscenter', 'indoor', 'B', 'A multi-sport indoor complex featuring a variety of facilities.', 'http://localhost/PEAK/public/assets/images/uma/hall.jpg', 0),
(7, 'Baseball', 'ground', 'C', 'A standard outdoor baseball field with dugouts and bleachers.', 'http://localhost/PEAK/public/assets/images/uma/baseball.jpg', 0),
(8, 'Hockey', 'ground', 'C', 'An outdoor hockey field built to regulation size.', 'http://localhost/PEAK/public/assets/images/uma/hockey.jpg', 3),
(9, 'Cricket', 'ground', 'C', 'An expansive outdoor cricket ground with turf pitch.', 'http://localhost/PEAK/public/assets/images/uma/cricket.jpg', 0),
(10, 'Cricketturf', 'ground', 'C', 'A cricket practice area with synthetic turf.', 'http://localhost/PEAK/public/assets/images/uma/turf.jpg', 0),
(11, 'Elle', 'ground', 'C', 'A traditional outdoor elle court used for community games.', 'http://localhost/PEAK/public/assets/images/uma/cricket.jpg', 0),
(12, 'Basketball', 'ground', 'D', 'An outdoor basketball court with standard hoops and markings.', 'http://localhost/PEAK/public/assets/images/uma/basketball.jpg', 0),
(13, 'Football', 'ground', 'E', 'A large football field used for matches and practice.', 'http://localhost/PEAK/public/assets/images/uma/football.jpg', 0),
(14, 'Netball', 'ground', 'E', 'A netball court with clear boundaries and goal rings.', 'http://localhost/PEAK/public/assets/images/uma/netball.jpg', 0),
(15, 'Rugby', 'ground', 'E', 'A professionally maintained rugby ground for competitive matches.', 'http://localhost/PEAK/public/assets/images/uma/rugby.jpg', 0),
(16, 'Tennis', 'ground', 'F', 'A high-quality outdoor tennis court with fencing and seating.', 'http://localhost/PEAK/public/assets/images/uma/tennis.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `discount_id` int(11) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `discount` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`discount_id`, `usertype`, `discount`) VALUES
(6, 'universities', 0.25),
(7, 'clubs', 0.30),
(8, 'govt schools', 0.15),
(9, 'semi govt', 0.10),
(10, 'other', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `enhancement`
--

CREATE TABLE `enhancement` (
  `RequestID` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `registration_number` int(11) DEFAULT NULL,
  `sport` varchar(100) DEFAULT NULL,
  `achievement` varchar(100) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  `status` enum('Pending','Accepted','Rejected','') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enhancement`
--

INSERT INTO `enhancement` (`RequestID`, `name`, `registration_number`, `sport`, `achievement`, `userid`, `status`) VALUES
(17, 'Amar Abdulla', 2022, 'Hockey', 'Inter University 2024', 23, 'Pending');

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
  `description` text DEFAULT NULL,
  `brand` enum('Alfa','Nike','Adidas','Grays') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`equipmentid`, `sport_id`, `name`, `type`, `issued_amount`, `description`, `brand`) VALUES
(10, 3, 'Balls', 'Team', 0, 'Practice Balls', 'Alfa'),
(11, 7, 'Rackets', 'Team', 0, NULL, 'Nike'),
(13, 3, 'stick', 'Team', 0, 'carbon', 'Adidas'),
(14, 3, 'face mask', 'Team', 0, 'hdbj', 'Alfa'),
(15, 3, 'sticks', 'Team', 0, 'wooden', 'Adidas');

-- --------------------------------------------------------

--
-- Table structure for table `external_user`
--

CREATE TABLE `external_user` (
  `userid` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `external_user`
--

INSERT INTO `external_user` (`userid`, `company_name`) VALUES
(49, 'Car manufacturerss');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `facultyid` int(20) NOT NULL,
  `faculty_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`facultyid`, `faculty_name`) VALUES
(1, 'Arts'),
(2, 'Education'),
(3, 'Gradute Studies'),
(4, 'Indigenous Medicine'),
(5, 'Law'),
(6, 'Management'),
(7, 'Medicine'),
(8, 'Science'),
(9, 'Technology'),
(10, 'Nursing'),
(11, 'Sri Palee'),
(12, 'UCSC');

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
(7, 'practice', 'half', 'no', 17500.00),
(7, 'practice', 'full', 'no', 30000.00),
(7, 'tournament', 'half', 'no', 35000.00),
(7, 'tournament', 'full', 'no', 65000.00),
(8, 'practice', 'half', 'With marking', 27500.00),
(8, 'practice', 'half', 'Without marking', 20000.00),
(8, 'practice', 'full', 'With marking', 40000.00),
(8, 'practice', 'full', 'Without marking', 30000.00),
(8, 'practice', '2 hour', 'With marking', 17500.00),
(8, 'practice', '2 hour', 'Without marking', 10000.00),
(8, 'tournament', 'half', 'With marking', 40000.00),
(8, 'tournament', 'full', 'With marking', 70000.00),
(8, 'tournament', '2 hour', 'With marking', 27500.00),
(9, 'practice', 'half', 'Hard ball', 17500.00),
(9, 'practice', 'full', 'Hard ball', 30000.00),
(9, 'practice', '2 hour', 'Hard ball', 10000.00),
(9, 'practice', '2 hour', 'Soft ball', 4600.00),
(9, 'tournament', 'half', 'Hard ball', 20000.00),
(9, 'tournament', 'half', 'Softball', 65000.00),
(9, 'tournament', 'full', 'Hard ball', 35000.00),
(9, 'tournament', 'full', 'Softball', 115000.00),
(9, 'tournament', '4 hour', 'Softball', 13000.00),
(10, 'practice', '2 hour', 'no', 7000.00),
(11, 'tournament', 'half', 'no', 25000.00),
(11, 'tournament', 'full', 'no', 45000.00),
(12, 'practice', 'half', 'With light', 17500.00),
(12, 'practice', 'half', 'Without light', 12000.00),
(12, 'practice', 'full', 'Without light', 20000.00),
(12, 'practice', '2 hour', 'With light', 8000.00),
(12, 'practice', '2 hour', 'Without light', 6000.00),
(12, 'tournament', 'half', 'With light', 25000.00),
(12, 'tournament', 'half', 'Without light', 40000.00),
(12, 'tournament', 'full', 'With light', 12500.00),
(12, 'tournament', 'full', 'Without light', 40000.00),
(12, 'tournament', '2 hour', 'Without light', 10000.00),
(13, 'practice', 'half', 'With marking', 27500.00),
(13, 'practice', 'half', 'Without marking', 20000.00),
(13, 'practice', 'full', 'With marking', 40000.00),
(13, 'practice', 'full', 'Without marking', 30000.00),
(13, 'practice', '2 hour', 'With marking', 17500.00),
(13, 'practice', '2 hour', 'Without marking', 10000.00),
(13, 'tournament', 'half', 'With marking', 40000.00),
(13, 'tournament', 'full', 'With marking', 70000.00),
(13, 'tournament', '2 hour', 'With marking', 27500.00),
(14, 'practice', 'half', '1', 20000.00),
(14, 'practice', 'half', '2', 30000.00),
(14, 'practice', 'full', '1', 30000.00),
(14, 'practice', 'full', '2', 45000.00),
(14, 'practice', '2 hour', '1', 7000.00),
(14, 'practice', '2 hour', '2', 12000.00),
(14, 'tournament', 'half', '1', 20000.00),
(14, 'tournament', 'half', '2', 35000.00),
(14, 'tournament', 'full', '1', 35000.00),
(14, 'tournament', 'full', '2', 55000.00),
(14, 'tournament', '2 hour', '1', 10000.00),
(14, 'tournament', '2 hour', '2', 15000.00),
(15, 'practice', 'half', 'With marking', 32500.00),
(15, 'practice', 'half', 'Without marking', 25000.00),
(15, 'practice', 'full', 'With marking', 47500.00),
(15, 'practice', 'full', 'Without marking', 40000.00),
(15, 'practice', '2 hour', 'With marking', 22500.00),
(15, 'practice', '2 hour', 'Without marking', 15000.00),
(15, 'tournament', 'half', 'With marking', 50000.00),
(15, 'tournament', 'full', 'With marking', 80000.00),
(15, 'tournament', '2 hour', 'With marking', 37500.00),
(16, 'practice', '2 hour', 'no', 4000.00),
(16, 'tournament', 'half', 'no', 20000.00),
(16, 'tournament', 'full', 'no', 35000.00),
(16, 'tournament', '2 hour', 'no', 10000.00);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hostal_facilities`
--

INSERT INTO `hostal_facilities` (`hostalrequest_id`, `reg_no`, `priority`, `start_date`, `end_date`, `sport_id`) VALUES
(1, '2022is117', 'Medium', '2025-04-03', '2025-05-10', 3);

-- --------------------------------------------------------

--
-- Table structure for table `indoorcourts`
--

CREATE TABLE `indoorcourts` (
  `courtid` int(11) NOT NULL,
  `event` enum('practice','tournament') NOT NULL,
  `duration` enum('half','full','1 hour') NOT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `indoorcourts`
--

INSERT INTO `indoorcourts` (`courtid`, `event`, `duration`, `price`) VALUES
(1, 'practice', '1 hour', 3500.00),
(1, 'tournament', 'half', 4100.00),
(1, 'tournament', 'full', 59000.00),
(2, 'practice', '1 hour', 5600.00),
(2, 'tournament', 'half', 41000.00),
(2, 'tournament', 'full', 59000.00),
(3, 'practice', '1 hour', 5600.00),
(3, 'tournament', 'half', 46000.00),
(3, 'tournament', 'full', 69000.00),
(4, 'tournament', 'half', 41000.00),
(4, 'tournament', 'full', 59000.00),
(6, 'tournament', 'half', 26000.00),
(6, 'tournament', 'full', 39000.00);

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
(18, 'SLUG', '2025-04-09', '1', 'Rajarata University Ground', 18, NULL, 3, 'women');

-- --------------------------------------------------------

--
-- Table structure for table `interuni_player`
--

CREATE TABLE `interuni_player` (
  `interrecordid` int(11) NOT NULL,
  `regno` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `interuni_player`
--

INSERT INTO `interuni_player` (`interrecordid`, `regno`) VALUES
(18, '2022is080'),
(18, '2022is117');

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

-- --------------------------------------------------------

--
-- Table structure for table `medicalrequests`
--

CREATE TABLE `medicalrequests` (
  `RequestID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `RegistrationID` varchar(100) NOT NULL,
  `ReasonForMedical` text NOT NULL,
  `userid` int(11) NOT NULL,
  `status` enum('Pending','Accepted','Rejected','') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicalrequests`
--

INSERT INTO `medicalrequests` (`RequestID`, `Name`, `RegistrationID`, `ReasonForMedical`, `userid`, `status`) VALUES
(123, 'Amar', '22020022', 'Leg Injury', 23, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isread` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messageid`, `userid`, `content`, `date`, `time`, `isread`) VALUES
(23, 27, 'Can we book the ground tomorrow?', '2025-04-28', '2025-04-28 05:28:10', '1'),
(24, 48, 'Is th eground avaialble tommorw?', '2025-04-28', '2025-04-28 07:39:10', '0'),
(25, 27, 'is the ground availalbe?', '2025-04-28', '2025-04-28 07:40:37', '1');

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
  `visibility` enum('students','captains','amalgamated club','') NOT NULL,
  `userid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `noticeboard`
--

INSERT INTO `noticeboard` (`noticeid`, `title`, `content`, `publishdate`, `publishtime`, `visibility`, `userid`) VALUES
(54, 'AGM', 'AGM will be held on 3rd June', '2025-04-28', '11:57:00', 'captains', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `to_role` varchar(100) NOT NULL,
  `from_user_id` int(11) DEFAULT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `expiry_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notification_id`, `title`, `content`, `to_user_id`, `to_role`, `from_user_id`, `time`, `date`, `created_at`, `expiry_date`) VALUES
(28, 'Booking was rescheduled', 'a b external has rescheduled a booking to the new date 2025-04-29', 30, 'admin', 27, '07:20:44', '2025-04-28', '2025-04-28 01:50:44', '2025-05-12 00:00:00'),
(30, 'PED incharge replied to your message', 'Your reservation was rejected', 27, 'external_user', 30, '07:28:10', '2025-04-28', '2025-04-28 01:58:10', '2025-05-05 00:00:00'),
(31, 'Booking Cancellation', 'a b external has cancelled a booking ', 30, 'admin', 27, '09:22:06', '2025-04-28', '2025-04-28 03:52:06', '2025-05-12 00:00:00'),
(32, 'Booking was rescheduled', 'a b external has rescheduled a booking to the new date 2025-05-02', 30, 'admin', 27, '09:22:17', '2025-04-28', '2025-04-28 03:52:17', '2025-05-12 00:00:00'),
(33, 'PED incharge replied to your message', 'The ground is fully bookked tommorw', 27, 'external_user', 27, '09:40:37', '2025-04-28', '2025-04-28 04:10:37', '2025-05-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `othertournaments`
--
-- Error reading structure for table peak.othertournaments: #1932 - Table &#039;peak.othertournaments&#039; doesn&#039;t exist in engine
-- Error reading data for table peak.othertournaments: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near &#039;FROM `peak`.`othertournaments`&#039; at line 1

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paymentid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `reservationid` int(11) NOT NULL,
  `payment_proof` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paymentid`, `userid`, `reservationid`, `payment_proof`, `created_at`) VALUES
(11, 27, 63, 'uploads/payment_proofs/IS_22 (1).pdf', '2025-04-28 01:56:14'),
(12, 27, 63, 'uploads/payment_proofs/IS_22.pdf', '2025-04-28 03:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `regno` varchar(15) NOT NULL,
  `position` varchar(100) NOT NULL,
  `jerseyno` int(11) DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`regno`, `position`, `jerseyno`, `sport_id`) VALUES
('2022is074', 'half', 9, NULL),
('2022is080', 'back', 7, 3),
('2022is117', 'half', 5, 3);

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

-- --------------------------------------------------------

--
-- Table structure for table `practiceschedule`
--

CREATE TABLE `practiceschedule` (
  `scheduleid` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `category` enum('practice','match','','','') NOT NULL,
  `sport_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `practiceschedule`
--

INSERT INTO `practiceschedule` (`scheduleid`, `date`, `start_time`, `end_time`, `category`, `sport_id`) VALUES
(6, '2025-04-28', '16:00:00', '18:00:00', 'practice', 3);

-- --------------------------------------------------------

--
-- Table structure for table `recruitments`
--

CREATE TABLE `recruitments` (
  `recruitmentid` int(11) NOT NULL,
  `regno` varchar(15) NOT NULL,
  `faculty` int(20) NOT NULL,
  `reason` text DEFAULT NULL,
  `sport_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservationid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `courtid` int(11) NOT NULL,
  `event` enum('practice','tournament','other','') DEFAULT NULL,
  `duration` enum('full','half','1 hour','2 hour') NOT NULL,
  `date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `status` enum('pending','To pay','rejected','paid','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `usertype` enum('clubs','govt schools','semi govt schools','uoc faculties') DEFAULT NULL,
  `userdescription` text DEFAULT NULL,
  `userproof` varchar(255) DEFAULT NULL,
  `numberof_participants` int(11) DEFAULT NULL,
  `extradetails` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `discountedprice` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservationid`, `userid`, `courtid`, `event`, `duration`, `date`, `time`, `status`, `usertype`, `userdescription`, `userproof`, `numberof_participants`, `extradetails`, `price`, `discountedprice`, `created_at`) VALUES
(63, 27, 8, 'tournament', 'full', '2025-04-30', '08:00:00', 'confirmed', '', 'Visakha Vidyalaya', '', 30, 'Hockey Tournament', 70000.00, 52500.00, '2025-04-28 01:53:37'),
(66, 27, 7, 'practice', 'half', '2025-05-02', '13:00:00', 'To pay', 'govt schools', 'Visakha vidyalaya', '', 40, 'tournaments', 17500.00, 14875.00, '2025-04-28 03:16:51'),
(68, 27, 12, 'tournament', 'half', '2025-04-30', '08:00:00', 'confirmed', NULL, NULL, NULL, 12, '', 0.00, 0.00, '2025-04-28 07:25:25'),
(69, 48, 8, 'practice', 'half', '2025-05-09', NULL, 'confirmed', NULL, NULL, NULL, 5, NULL, 0.00, 0.00, '2025-04-28 07:28:47'),
(71, 30, 14, 'practice', '2 hour', '2025-04-30', '10:00:00', 'confirmed', NULL, NULL, NULL, 2, '', 0.00, 0.00, '2025-04-28 07:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `sport`
--

CREATE TABLE `sport` (
  `sport_id` int(20) NOT NULL,
  `sport_name` varchar(20) NOT NULL,
  `frontimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sport`
--

INSERT INTO `sport` (`sport_id`, `sport_name`, `frontimage`) VALUES
(1, 'Cricket', 'assets/images/ped_incharge/cricket.jpg'),
(2, 'Baseball', 'assets/images/ped_incharge/baseball.jpg'),
(3, 'Hockey', 'assets/images/ped_incharge/hockey.jpeg'),
(4, 'Football', 'assets/images/ped_incharge/football.jpg'),
(6, 'Carrom', 'assets/images/ped_incharge/680ba7cbd7e16.jpg'),
(7, 'Badminton', ''),
(8, 'Table Tennis', ''),
(9, 'Volleyball', ''),
(10, 'Karate', '');

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
  `userid` int(11) NOT NULL,
  `sport_id` int(50) NOT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `position` enum('captain','vice_captain','manager','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sports_captain`
--

INSERT INTO `sports_captain` (`regno`, `userid`, `sport_id`, `startdate`, `enddate`, `position`) VALUES
('2022is080', 48, 3, '2024-05-01', '2025-05-15', 'captain');

-- --------------------------------------------------------

--
-- Table structure for table `sport_players`
--

CREATE TABLE `sport_players` (
  `sport_id` int(20) NOT NULL,
  `regno` varchar(15) NOT NULL
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
  `type` enum('ground','indoor','ped','') NOT NULL,
  `userid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `name`, `emp_no`, `reg_no`, `designation`, `appointment_date`, `nic`, `dob`, `phone`, `address`, `type`, `userid`) VALUES
('gs123', 'Sujan walgampaya', 'EMP8687', 'REG657567', 'Instructor', '2018-04-03', '12345678v', '1989-03-15', 778364878, 'bhfbskfbdkfbsef', 'ped', ''),
('krfldf', 'jkghidfg', 'ghjk54', 'fbhjkg54', 'gdkghi', '2025-03-12', '463723455v', '1990-03-15', 234567897, 'nfjkhihfsf', 'indoor', ''),
('S25', 'bhfjsgfiyefge', 'dsj43', 'fud43', 'hruifghuif', '2025-04-09', '54327893', '1989-03-15', 5436543, 'gnbdkjhgki', 'ground', '21');

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
  `status` enum('Pending','Overdue','Completed','Cancelled') NOT NULL,
  `staffid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stafftodo`
--

INSERT INTO `stafftodo` (`taskid`, `taskname`, `date`, `time`, `deadline`, `description`, `status`, `staffid`) VALUES
(1, 'cut grass', '2025-04-11', '2025-04-25 18:17:47', '2025-04-18 11:33:47', 'cut the grass around the hockey court', 'Overdue', 'S25'),
(2, 'Drawing a hockey court', '2025-04-30', '2025-04-25 18:17:47', '2025-04-24 08:00:00', 'description', 'Overdue', 'S25'),
(3, 'h', '2025-04-25', '2025-04-26 23:03:45', '2025-04-26 23:43:00', 'h', 'Overdue', 'S25'),
(4, 'h', '2025-04-25', '2025-04-25 18:17:47', '2025-04-23 23:44:00', 'w', 'Overdue', 'krfldf'),
(5, 'hgj', '2025-04-27', '2025-04-27 05:23:56', '2025-04-02 06:12:00', 'j', 'Overdue', 'S25'),
(6, 'cut the grass', '2025-04-28', '2025-06-25 05:53:24', '2025-04-30 13:07:00', 'bshs', 'Overdue', 'S25');

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
(2, 10, '986', '', 6, 8, 2, '2024-02-15');

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
(43, '2022is002', 'ucsc', 'is', NULL, NULL),
(44, '2022m01', 'management', 'finance', NULL, NULL),
(45, '2022a02', 'arts', 'art', NULL, NULL),
(46, '2022is117', 'ucsc', 'is', NULL, NULL),
(47, '2022is074', 'ucsc', 'is', NULL, NULL),
(48, '2022is080', 'ucsc', 'is', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscription`
--

CREATE TABLE `subscription` (
  `subscriptionid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `subscription` enum('annual','6 month','3 month') NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_of_payment` date DEFAULT NULL,
  `subscription_end_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscription`
--

INSERT INTO `subscription` (`subscriptionid`, `userid`, `subscription`, `status`, `date_of_payment`, `subscription_end_date`) VALUES
(1, 27, 'annual', 'active', '2025-04-16', '2026-04-16');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptionpayments`
--

CREATE TABLE `subscriptionpayments` (
  `paymentid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `paymentproof` varchar(255) DEFAULT NULL,
  `subscriptionid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriptionpayments`
--

INSERT INTO `subscriptionpayments` (`paymentid`, `userid`, `payment_date`, `paymentproof`, `subscriptionid`) VALUES
(53, 27, '2025-04-16 09:58:07', 'uploads/payment_proofs/ground charges.pdf', 1);

-- --------------------------------------------------------

--
-- Table structure for table `temp_players`
--

CREATE TABLE `temp_players` (
  `temp_id` int(11) NOT NULL,
  `temp_tournamentid` int(11) NOT NULL,
  `reg_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_tournaments`
--

CREATE TABLE `temp_tournaments` (
  `tournament_id` int(11) NOT NULL,
  `year` year(4) NOT NULL,
  `tournament_name` enum('Inter Faculty','freshers','','') NOT NULL,
  `sport_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `category` enum('Men','Women','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tournaments_players`
--

CREATE TABLE `tournaments_players` (
  `place_id` int(11) NOT NULL,
  `reg_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournaments_players`
--

INSERT INTO `tournaments_players` (`place_id`, `reg_no`) VALUES
(9, '2022is117');

-- --------------------------------------------------------

--
-- Table structure for table `tournaments_records`
--

CREATE TABLE `tournaments_records` (
  `recordid` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `sport_id` int(20) NOT NULL,
  `tournament_name` enum('Inter Faculty','Freshers','','') NOT NULL,
  `category` enum('men','women','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournaments_records`
--

INSERT INTO `tournaments_records` (`recordid`, `year`, `sport_id`, `tournament_name`, `category`) VALUES
(4, 2024, 3, 'Inter Faculty', 'women');

-- --------------------------------------------------------

--
-- Table structure for table `tournament_place`
--

CREATE TABLE `tournament_place` (
  `placeid` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `place` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tournament_place`
--

INSERT INTO `tournament_place` (`placeid`, `tournament_id`, `faculty_id`, `place`) VALUES
(9, 4, 12, 1);

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
  `sport_id` int(255) NOT NULL,
  `status` enum('Pending','Approved','Rejected','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transport_requests`
--

INSERT INTO `transport_requests` (`request_id`, `no_of_members`, `date`, `location`, `time`, `reason`, `sport_id`, `status`) VALUES
(2, 12, '2025-05-01', 'Peradeniya University', '10:00:00.000000', 'Pera 6s tournament', 3, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `upcomingevents`
--

CREATE TABLE `upcomingevents` (
  `id` int(255) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `sport_id` int(255) NOT NULL
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
  `role` enum('Admin','Sports Captain','Amalgamated Club Executive','Internal User','External User','Gym Instructor','GroundIndoorStaff') NOT NULL,
  `createdate` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `gender`, `nic`, `email`, `date_of_birth`, `contact_number`, `address`, `image`, `username`, `password`, `role`, `createdate`) VALUES
(23, 'ab amal', 'Male', '200255401686', 'amalgamated@gmail.com', '0000-00-00', '0715691983', 'anderson flats', '', 'amalgamated@gmail.com', '$2y$10$W.2L2x11n4U4KdczgxnOIOpQe1vXrPgWWV0yHxdJVp7pyv1eodrRu', 'Amalgamated Club Executive', '2024-12-02'),
(27, 'a b external', 'Male', '200255401698', 'external@gmail.com', '0000-00-00', '0716835810', 'fdab', '27_1745817481.jpg', 'external@gmail.com', '$2y$10$p1TRib3mRVOcqkvETvhW6O3yGRMQrhcxPPQTLRsSYXv5Ftz./a7qy', 'External User', '2024-12-02'),
(30, 'Admin User', 'Male', '200224303240', 'a@gmail.com', '0000-00-00', '0787798230', 'Colombo', '', 'a@gmail.com', '$2y$10$bCXdwnvHU2HNZpzXekhCOucYd8dIOKdSfjCqAzVZcxWjqnhQOJSSe', 'Admin', '2024-12-02'),
(43, 'MLA  Abdulla', 'Male', '200218403097', 'amar@gmail.com', '0000-00-00', '0767839096', '789 Main St,Colombo', '', 'amar@gmail.com', '$2y$10$Q4k.90vqLvgaxc.f./Y99e3Gmoln3TD31XUhxxF4CDzf/wwi6TE2u', 'Internal User', '2025-04-28'),
(44, 'M A Perera', 'Male', '200212345678', 'perera@gmail.com', '0000-00-00', '0781234567', '789 Main St,Colombo', '', 'perera@gmail.com', '$2y$10$0ru61BieAV4CnucefcT9e.1Zmo/xgPF3yCXdHYXWoAqxcZYquqraO', 'Internal User', '2025-04-28'),
(45, 'K G Dharmarathne', 'Male', '200212343234', 'dharme@gmail.com', '0000-00-00', '0772343212', '789 Main St,Colombo', '', 'dharme@gmail.com', '$2y$10$pgdXHMEkekSXezoKns2mC.xWvslYErNJOdUHKMbVTi.Alrtx3gblK', 'Internal User', '2025-04-28'),
(46, 'S P Yapa', 'Female', '200286103526', 'sanu@gmail.com', '0000-00-00', '0770514493', '789 Main St,Colombo', '', 'sanu@gmail.com', '$2y$10$OJcGI93t6ik9qiiQYTQfYOdAlmyTtLwyzb0RUNdVeT2oI2zs/wOZ.', 'Internal User', '2025-04-28'),
(47, 'P U Piyumini', 'Female', '200255401680', 'piyu@gmail.com', '0000-00-00', '0770514495', '789 Main St,Colombo', '', 'piyu@gmail.com', '$2y$10$1xe5AcW6tbP8k5.VXpWbmOuPcs838X30frTzjI1l3spB3lbgskCxa', 'Internal User', '2025-04-28'),
(48, 'HAV Ranmini', 'Female', '200258502806', 'vidu@gmail.com', '0000-00-00', '0770232657', '789 Main St,Colombo', '', 'vidu@gmail.com', '$2y$10$YlX6rYbmL/qSjEyDrP1Kd.Pv.XGU9kjWfxFksZI8TFzV4PvoQ4GkW', 'Sports Captain', '2025-04-28'),
(49, 'Amantha Perera', 'Female', '200316113165', 'amantha@gmail.com', '0000-00-00', '0715691988', 'no 30, pererea lane', '', 'amantha@gmail.com', '$2y$10$Sg1GQTneXI.FqfKytTcIROqP.l84BBXa0kV7vfro6M5FJEs5Y/4HC', 'External User', '2025-04-28');

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
  ADD KEY `fk_sport_id2` (`reg_no`),
  ADD KEY `fk_sport_id3` (`faculty`);

--
-- Indexes for table `attendance_excuse_players`
--
ALTER TABLE `attendance_excuse_players`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attendance_excuse_players_ibfk_1` (`excuse_id`),
  ADD KEY `attendance_excuse_players_ibfk_2` (`reg_no`);

--
-- Indexes for table `certificaterequest`
--
ALTER TABLE `certificaterequest`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `cerrtfk1` (`UserID`),
  ADD KEY `cerrtfk2` (`RegistrationNumber`),
  ADD KEY `cerrtfk3` (`Sport`);

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
-- Indexes for table `courts`
--
ALTER TABLE `courts`
  ADD PRIMARY KEY (`courtid`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `enhancement`
--
ALTER TABLE `enhancement`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `fk_enhancement_userid` (`userid`);

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
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`facultyid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `groundcourts`
--
ALTER TABLE `groundcourts`
  ADD PRIMARY KEY (`courtid`,`event`,`duration`,`description`(255));

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
  ADD PRIMARY KEY (`courtid`,`event`,`duration`);

--
-- Indexes for table `interuniversityrecords`
--
ALTER TABLE `interuniversityrecords`
  ADD PRIMARY KEY (`interrecordid`),
  ADD KEY `sport_id` (`sport_id`);

--
-- Indexes for table `interuni_player`
--
ALTER TABLE `interuni_player`
  ADD PRIMARY KEY (`interrecordid`,`regno`),
  ADD KEY `interuniplayerfk2` (`regno`);

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
  ADD KEY `fk_inventoryrequest_sport` (`sport_id`),
  ADD KEY `requested_by` (`requested_by`);

--
-- Indexes for table `medicalrequests`
--
ALTER TABLE `medicalrequests`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `mdfk1` (`userid`),
  ADD KEY `mdfk2` (`RegistrationID`);

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
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `to_user_id` (`to_user_id`),
  ADD KEY `from_user_id` (`from_user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paymentid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `reservationid` (`reservationid`);

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
  ADD KEY `sportid` (`sport_id`);

--
-- Indexes for table `recruitments`
--
ALTER TABLE `recruitments`
  ADD PRIMARY KEY (`recruitmentid`),
  ADD KEY `sport_id` (`sport_id`),
  ADD KEY `recruitments_ibfk_2` (`regno`),
  ADD KEY `recruitments_ibfk_3` (`faculty`);

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
  ADD PRIMARY KEY (`regno`,`sport_id`,`position`),
  ADD KEY `captain_sport` (`sport_id`),
  ADD KEY `usercaptain` (`userid`);

--
-- Indexes for table `sport_players`
--
ALTER TABLE `sport_players`
  ADD PRIMARY KEY (`sport_id`,`regno`),
  ADD KEY `sportplayerfk2` (`regno`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `stafftodo`
--
ALTER TABLE `stafftodo`
  ADD PRIMARY KEY (`taskid`),
  ADD KEY `stafftodofk1` (`staffid`);

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
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`subscriptionid`),
  ADD KEY `subscription` (`subscription`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `subscriptionpayments`
--
ALTER TABLE `subscriptionpayments`
  ADD PRIMARY KEY (`paymentid`),
  ADD KEY `userid` (`userid`),
  ADD KEY `subscriptionid` (`subscriptionid`);

--
-- Indexes for table `temp_players`
--
ALTER TABLE `temp_players`
  ADD PRIMARY KEY (`temp_id`),
  ADD KEY `fk_temp_id` (`temp_tournamentid`);

--
-- Indexes for table `temp_tournaments`
--
ALTER TABLE `temp_tournaments`
  ADD PRIMARY KEY (`tournament_id`),
  ADD KEY `fk_sport_temp` (`sport_id`),
  ADD KEY `fk_faculty_temp` (`faculty_id`);

--
-- Indexes for table `tournaments_players`
--
ALTER TABLE `tournaments_players`
  ADD PRIMARY KEY (`place_id`,`reg_no`),
  ADD KEY `plytfk2` (`reg_no`);

--
-- Indexes for table `tournaments_records`
--
ALTER TABLE `tournaments_records`
  ADD PRIMARY KEY (`recordid`),
  ADD KEY `fk_sport_tour` (`sport_id`);

--
-- Indexes for table `tournament_place`
--
ALTER TABLE `tournament_place`
  ADD PRIMARY KEY (`placeid`),
  ADD KEY `fk_place_id` (`tournament_id`),
  ADD KEY `fk_faculty` (`faculty_id`);

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
  ADD PRIMARY KEY (`id`),
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_excuse`
--
ALTER TABLE `attendance_excuse`
  MODIFY `request_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attendance_excuse_players`
--
ALTER TABLE `attendance_excuse_players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `certificaterequest`
--
ALTER TABLE `certificaterequest`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coaches`
--
ALTER TABLE `coaches`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courts`
--
ALTER TABLE `courts`
  MODIFY `courtid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `enhancement`
--
ALTER TABLE `enhancement`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `equipmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `facultyid` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hostal_facilities`
--
ALTER TABLE `hostal_facilities`
  MODIFY `hostalrequest_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `interuniversityrecords`
--
ALTER TABLE `interuniversityrecords`
  MODIFY `interrecordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `inventoryedit`
--
ALTER TABLE `inventoryedit`
  MODIFY `editid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `inventoryrequest`
--
ALTER TABLE `inventoryrequest`
  MODIFY `requestid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `medicalrequests`
--
ALTER TABLE `medicalrequests`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `noticeboard`
--
ALTER TABLE `noticeboard`
  MODIFY `noticeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `recruitments`
--
ALTER TABLE `recruitments`
  MODIFY `recruitmentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `sport`
--
ALTER TABLE `sport`
  MODIFY `sport_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sportnews`
--
ALTER TABLE `sportnews`
  MODIFY `newsid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stafftodo`
--
ALTER TABLE `stafftodo`
  MODIFY `taskid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
  MODIFY `subscriptionid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subscriptionpayments`
--
ALTER TABLE `subscriptionpayments`
  MODIFY `paymentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `temp_players`
--
ALTER TABLE `temp_players`
  MODIFY `temp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `temp_tournaments`
--
ALTER TABLE `temp_tournaments`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tournaments_records`
--
ALTER TABLE `tournaments_records`
  MODIFY `recordid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tournament_place`
--
ALTER TABLE `tournament_place`
  MODIFY `placeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transport_requests`
--
ALTER TABLE `transport_requests`
  MODIFY `request_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upcomingevents`
--
ALTER TABLE `upcomingevents`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
  ADD CONSTRAINT `fk_sport_id2` FOREIGN KEY (`reg_no`) REFERENCES `attendance` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sport_id3` FOREIGN KEY (`faculty`) REFERENCES `faculties` (`facultyid`);

--
-- Constraints for table `attendance_excuse_players`
--
ALTER TABLE `attendance_excuse_players`
  ADD CONSTRAINT `exfk1` FOREIGN KEY (`excuse_id`) REFERENCES `attendance_excuse` (`request_id`),
  ADD CONSTRAINT `exfk2` FOREIGN KEY (`reg_no`) REFERENCES `student` (`registrationnumber`);

--
-- Constraints for table `certificaterequest`
--
ALTER TABLE `certificaterequest`
  ADD CONSTRAINT `cerrtfk1` FOREIGN KEY (`UserID`) REFERENCES `user` (`userid`),
  ADD CONSTRAINT `cerrtfk2` FOREIGN KEY (`RegistrationNumber`) REFERENCES `student` (`registrationnumber`),
  ADD CONSTRAINT `cerrtfk3` FOREIGN KEY (`Sport`) REFERENCES `sport` (`sport_id`);

--
-- Constraints for table `coaches`
--
ALTER TABLE `coaches`
  ADD CONSTRAINT `coaches_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `sportequipmentFK` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `groundcourts`
--
ALTER TABLE `groundcourts`
  ADD CONSTRAINT `gcfk1` FOREIGN KEY (`courtid`) REFERENCES `courts` (`courtid`);

--
-- Constraints for table `hostal_facilities`
--
ALTER TABLE `hostal_facilities`
  ADD CONSTRAINT `fk1_sport_id` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sport_id26` FOREIGN KEY (`reg_no`) REFERENCES `players` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `interuniversityrecords`
--
ALTER TABLE `interuniversityrecords`
  ADD CONSTRAINT `interuniversityrecords_ibfk_2` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `interuni_player`
--
ALTER TABLE `interuni_player`
  ADD CONSTRAINT `interuniplayerfk1` FOREIGN KEY (`interrecordid`) REFERENCES `interuniversityrecords` (`interrecordid`),
  ADD CONSTRAINT `interuniplayerfk2` FOREIGN KEY (`regno`) REFERENCES `players` (`regno`);

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
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`to_user_id`) REFERENCES `user` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`from_user_id`) REFERENCES `user` (`userid`) ON DELETE SET NULL;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`reservationid`) REFERENCES `reservations` (`reservationid`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `practiceschedule_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE;

--
-- Constraints for table `recruitments`
--
ALTER TABLE `recruitments`
  ADD CONSTRAINT `recruitments_ibfk_1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`),
  ADD CONSTRAINT `recruitments_ibfk_2` FOREIGN KEY (`regno`) REFERENCES `student` (`registrationnumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recruitments_ibfk_3` FOREIGN KEY (`faculty`) REFERENCES `faculties` (`facultyid`);

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `courtres` FOREIGN KEY (`courtid`) REFERENCES `courts` (`courtid`),
  ADD CONSTRAINT `userres` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

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
  ADD CONSTRAINT `captainregplayers` FOREIGN KEY (`regno`) REFERENCES `players` (`regno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usercaptain` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `sport_players`
--
ALTER TABLE `sport_players`
  ADD CONSTRAINT `sportplayerfk1` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`),
  ADD CONSTRAINT `sportplayerfk2` FOREIGN KEY (`regno`) REFERENCES `players` (`regno`);

--
-- Constraints for table `stafftodo`
--
ALTER TABLE `stafftodo`
  ADD CONSTRAINT `stafftodofk1` FOREIGN KEY (`staffid`) REFERENCES `staff` (`staff_id`);

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
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`subscription`) REFERENCES `strengthhall` (`subscription`),
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `subscriptionpayments`
--
ALTER TABLE `subscriptionpayments`
  ADD CONSTRAINT `subscriptionpayments_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `subscriptionpayments_ibfk_2` FOREIGN KEY (`subscriptionid`) REFERENCES `subscription` (`subscriptionid`);

--
-- Constraints for table `temp_players`
--
ALTER TABLE `temp_players`
  ADD CONSTRAINT `fk_temp_id` FOREIGN KEY (`temp_tournamentid`) REFERENCES `temp_tournaments` (`tournament_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `temp_tournaments`
--
ALTER TABLE `temp_tournaments`
  ADD CONSTRAINT `fk_faculty_temp` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`facultyid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sport_temp` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tournaments_players`
--
ALTER TABLE `tournaments_players`
  ADD CONSTRAINT `plytfk1` FOREIGN KEY (`place_id`) REFERENCES `tournament_place` (`placeid`),
  ADD CONSTRAINT `plytfk2` FOREIGN KEY (`reg_no`) REFERENCES `student` (`registrationnumber`);

--
-- Constraints for table `tournaments_records`
--
ALTER TABLE `tournaments_records`
  ADD CONSTRAINT `fk_sport_tour` FOREIGN KEY (`sport_id`) REFERENCES `sport` (`sport_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tournament_place`
--
ALTER TABLE `tournament_place`
  ADD CONSTRAINT `fk_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`facultyid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_place_id` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments_records` (`recordid`) ON DELETE CASCADE ON UPDATE CASCADE;

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
