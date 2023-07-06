-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 05:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car rent`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

CREATE TABLE `agencies` (
  `agency_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `mail` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agencies`
--

INSERT INTO `agencies` (`agency_id`, `name`, `mail`, `password`, `time`) VALUES
(1, 'a1', 'a1@a1.in', '344fda1ad3d6cdd49ed126652aef27b76dac9bbe', '2023-01-22 14:58:52'),
(2, 'a2', 'a2@a2.in', '49d76bd94e46e59d575f399757c476a7dd22874b', '2023-01-22 15:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `customer_id` int(250) NOT NULL,
  `car_id` int(250) NOT NULL,
  `from_date` date NOT NULL,
  `days` int(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `customer_id`, `car_id`, `from_date`, `days`, `time`) VALUES
(1, 1, 9, '2023-01-25', 5, '2023-01-22 15:38:58'),
(2, 1, 7, '2023-01-27', 1, '2023-01-22 15:39:12'),
(3, 1, 1, '2023-01-23', 6, '2023-01-22 15:39:26'),
(4, 1, 13, '2023-02-05', 6, '2023-01-22 15:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(250) NOT NULL,
  `model` varchar(250) NOT NULL,
  `number` varchar(250) NOT NULL,
  `capacity` int(250) NOT NULL,
  `rent` int(250) NOT NULL,
  `agency_id` int(250) NOT NULL,
  `status` text NOT NULL DEFAULT 'available',
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `model`, `number`, `capacity`, `rent`, `agency_id`, `status`, `time`) VALUES
(1, 'q1', 'q1', 2, 39, 1, 'booked', '2023-01-22 14:59:20'),
(2, '1', '1', 2, 1, 1, 'available', '2023-01-22 15:05:21'),
(3, '1', '1', 2, 1, 1, 'available', '2023-01-22 15:05:33'),
(4, '2', '2', 2, 2, 1, 'available', '2023-01-22 15:06:04'),
(5, '3', '3', 3, 3, 1, 'available', '2023-01-22 15:06:11'),
(6, '4', '4', 4, 4, 1, 'available', '2023-01-22 15:06:18'),
(7, '5', '5', 5, 5, 1, 'booked', '2023-01-22 15:06:24'),
(8, 'w1', 'w1', 2, 1, 2, 'available', '2023-01-22 15:07:35'),
(9, '8', '8', 8, 8, 2, 'booked', '2023-01-22 15:27:20'),
(10, '9', '9', 9, 9, 2, 'available', '2023-01-22 15:27:26'),
(11, '10', '10', 10, 10, 2, 'available', '2023-01-22 15:32:37'),
(12, '11', '11', 11, 11, 2, 'available', '2023-01-22 15:32:43'),
(13, '12', '12', 12, 12, 2, 'booked', '2023-01-22 15:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `mail` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `name`, `mail`, `password`, `time`) VALUES
(1, 'c1', 'c1@c1.in', '344fda1ad3d6cdd49ed126652aef27b76dac9bbe', '2023-01-22 14:58:54'),
(2, 'c2', 'c2@c2.in', '49d76bd94e46e59d575f399757c476a7dd22874b', '2023-01-22 15:22:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agencies`
--
ALTER TABLE `agencies`
  ADD PRIMARY KEY (`agency_id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `agency_id` (`agency_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `mail` (`mail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agencies`
--
ALTER TABLE `agencies`
  MODIFY `agency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `cars_ibfk_1` FOREIGN KEY (`agency_id`) REFERENCES `agencies` (`agency_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
