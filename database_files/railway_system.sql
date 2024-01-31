-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2023 at 06:43 PM
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
-- Database: `train_ticket_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `maintenance`
--

CREATE TABLE `maintenance` (
  `maintenance_id` int(11) NOT NULL,
  `train_id` int(11) DEFAULT NULL,
  `maintenance_date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance`
--

INSERT INTO `maintenance` (`maintenance_id`, `train_id`, `maintenance_date`, `description`) VALUES
(5001, 101, '2023-07-01', 'Regular maintenance check'),
(5002, 102, '2023-07-02', 'Repairing air conditioning system'),
(5003, 103, '2023-07-03', 'Replacing broken windows'),
(5004, 104, '2023-07-04', 'Engine overhaul'),
(5005, 105, '2023-07-05', 'Cleaning and sanitation'),
(5006, 106, '2023-07-06', 'Electrical system inspection'),
(5007, 107, '2023-07-07', 'Interior refurbishment'),
(5008, 108, '2023-07-08', 'Brake system repair'),
(5009, 109, '2023-07-09', 'Wheel alignment'),
(5010, 110, '2023-07-10', 'Exterior painting');

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `passenger_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`passenger_id`, `name`, `contact_number`) VALUES
(1101, 'John Doe', '+8801897665432'),
(1102, 'Jane Smith', '+8801600865123'),
(1103, 'Michael Johnson', '+8801598765431'),
(1104, 'Emily Davis', '+8801965432176'),
(1105, 'Robert Wilson', '+8801943216555'),
(1106, 'Sarah Khan', '+8801644432158'),
(1107, 'Ahmed Rahman', '+8801845342312'),
(1108, 'Jennifer Lee', '+8801587653423'),
(1109, 'David Chen', '+8801745387654'),
(1110, 'Laura Miller', '+8801376598764'),
(1112, 'Paromita Saha Zuhi', '+8801234567890');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `train_id` int(11) DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `train_id`, `departure_time`, `arrival_time`) VALUES
(201, 101, '08:00:00', '15:30:00'),
(202, 102, '09:30:00', '17:45:00'),
(203, 103, '10:00:00', '17:30:00'),
(204, 104, '13:15:00', '21:45:00'),
(205, 105, '16:45:00', '23:15:00'),
(206, 106, '07:30:00', '14:45:00'),
(207, 107, '11:00:00', '19:30:00'),
(208, 108, '08:45:00', '16:00:00'),
(209, 109, '12:30:00', '20:15:00'),
(210, 110, '09:15:00', '16:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `station`
--

CREATE TABLE `station` (
  `station_id` int(11) NOT NULL,
  `station_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `station`
--

INSERT INTO `station` (`station_id`, `station_name`, `location`, `contact_number`) VALUES
(1, 'Dhaka Central', 'Dhaka', '+8801946789543'),
(2, 'Chittagong', 'Chittagong', '+8801987645679'),
(3, 'Rajshahi', 'Rajshahi', '+8801800987654'),
(4, 'Khulna', 'Khulna', '+8801790087765'),
(5, 'Sylhet', 'Sylhet', '+8801788765543'),
(6, 'Barishal', 'Barishal', '+8801844456678'),
(7, 'Rangpur', 'Rangpur', '+8801944355566'),
(8, 'Comilla', 'Comilla', '+8801788643214'),
(9, 'Mymensingh', 'Mymensingh', '+8801587654333'),
(10, 'Cox\'s Bazar', 'Cox\'s Bazar', '+8801577632187');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `passenger_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `seat_number` varchar(10) DEFAULT NULL,
  `ticket_price` decimal(10,2) DEFAULT NULL,
  `journey_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `passenger_id`, `schedule_id`, `seat_number`, `ticket_price`, `journey_date`) VALUES
(1501, 1101, 201, 'A12', 1200.00, '2023-07-15'),
(1502, 1102, 202, 'B5', 950.00, '2023-07-16'),
(1503, 1103, 203, 'C7', 800.00, '2023-07-17'),
(1504, 1104, 204, 'D15', 1100.00, '2023-07-18'),
(1505, 1105, 205, 'E3', 900.00, '2023-07-19'),
(1506, 1106, 206, 'F8', 750.00, '2023-07-20'),
(1507, 1107, 207, 'G11', 1000.00, '2023-07-21'),
(1508, 1108, 208, 'H2', 850.00, '2023-07-22'),
(1509, 1109, 209, 'I19', 950.00, '2023-07-23'),
(1510, 1110, 210, 'J14', 1200.00, '2023-07-24');

-- --------------------------------------------------------

--
-- Table structure for table `train`
--

CREATE TABLE `train` (
  `train_id` int(11) NOT NULL,
  `train_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `train`
--

INSERT INTO `train` (`train_id`, `train_name`) VALUES
(101, 'Padma Express'),
(102, 'Subarna Express'),
(103, 'Mahanagar Godhuli'),
(104, 'Silk City Express'),
(105, 'Parabat Express'),
(106, 'Turna Express'),
(107, 'Sundarban Express'),
(108, 'Paharika Express'),
(109, 'Uddyan Express'),
(110, 'Mohanagar Provati');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD PRIMARY KEY (`maintenance_id`),
  ADD KEY `train_id` (`train_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`passenger_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `train_id` (`train_id`);

--
-- Indexes for table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`station_id`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `passenger_id` (`passenger_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `train`
--
ALTER TABLE `train`
  ADD PRIMARY KEY (`train_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `maintenance`
--
ALTER TABLE `maintenance`
  ADD CONSTRAINT `maintenance_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`train_id`) REFERENCES `train` (`train_id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`passenger_id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `schedule` (`schedule_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
