-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 10, 2021 at 01:03 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ParkingLotsReservations`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`) VALUES
('a69681bcf334ae130217fea4505fd3c994f5683f', 'Sys Admin', 'sysadmin@iparking.org', 'a69681bcf334ae130217fea4505fd3c994f5683f');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `car_regno` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `phone`, `email`, `password`, `car_regno`) VALUES
('80aa8ed192f7f2c46caaa1d25258d4e1a216997e97', 'Jane Frannkenstain Doe', '+90127690-90', 'janefdoe@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'KCA 127 G'),
('cbd9a3ba0b09693e4d6eb3e10621c8ffeb432113ee', 'Jane Doe', '90-127-0914000', 'janedoe@mail.com', 'a69681bcf334ae130217fea4505fd3c994f5683f', 'KCA 127C');

-- --------------------------------------------------------

--
-- Table structure for table `ip_cameras`
--

CREATE TABLE `ip_cameras` (
  `id` varchar(200) NOT NULL,
  `code` longtext NOT NULL,
  `stream_url` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ip_cameras`
--

INSERT INTO `ip_cameras` (`id`, `code`, `stream_url`) VALUES
('ad4deb7e15acc4d43a4d78528a3df1edea5d88bcf9', '9NP24-50463', 'https://www.youtube.com/watch?v=eggFrmG4LVY');

-- --------------------------------------------------------

--
-- Table structure for table `parking_lots`
--

CREATE TABLE `parking_lots` (
  `id` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `location` longtext NOT NULL,
  `parking_slots` varchar(200) NOT NULL,
  `price_per_slot` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parking_lots`
--

INSERT INTO `parking_lots` (`id`, `code`, `location`, `parking_slots`, `price_per_slot`) VALUES
('c2933a62ad64e053e39aa4423ddfc29af4051af423', 'ZTYBG-91573', 'Machakos - Town Center', '120', '250');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `amt` varchar(200) NOT NULL,
  `r_id` varchar(200) NOT NULL,
  `client_name` varchar(200) NOT NULL,
  `client_phone` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `code`, `amt`, `r_id`, `client_name`, `client_phone`, `created_at`) VALUES
('43f2ecd0b10099bbc4cb5f94320fc5f20f8496226f', 'P5WUHM74ZI', '250', '0e45b9d94996e35d89e5a9ec71bf79e37f4be40db7', 'Jane Frannkenstain Doe', '+90127690-90', '2021-02-10 11:51:53'),
('fa4606c09e14740f8a52ccc2c8606faf3e7e146a83', '5YS2COEPTW', '250', '5e60989e7db58fa54c6d6ec1cd0c4cfa8ebf8f372a', 'Jane Doe', '90-127-0914000', '2021-02-09 10:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `client_name` varchar(200) NOT NULL,
  `client_phone` varchar(200) NOT NULL,
  `car_regno` varchar(200) NOT NULL,
  `lot_number` varchar(200) NOT NULL,
  `parking_duration` varchar(200) NOT NULL,
  `parking_date` varchar(200) NOT NULL,
  `amt` varchar(200) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `code`, `client_name`, `client_phone`, `car_regno`, `lot_number`, `parking_duration`, `parking_date`, `amt`, `status`) VALUES
('0e45b9d94996e35d89e5a9ec71bf79e37f4be40db7', 'SQB8A-62704', 'Jane Frannkenstain Doe', '+90127690-90', 'KCA 127 G', 'ZTYBG-91573', '3', '10 Feb 2021 12:46pm', '250', 'Paid'),
('5e60989e7db58fa54c6d6ec1cd0c4cfa8ebf8f372a', 'TVP31-67539', 'Jane Doe', '90-127-0914000', 'KCA 127C', 'ZTYBG-91573', '2', '06 Feb 2021 11:05am', '250', 'Paid'),
('fa472956979ea4557bda193f925a813c319b34dd48', 'TH9XG-30645', 'Jane Doe', '90-127-0914000', 'KCA 127C', 'ZTYBG-91573', '5', '06 Feb 2021 11:25am', '250', 'Paid');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ip_cameras`
--
ALTER TABLE `ip_cameras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking_lots`
--
ALTER TABLE `parking_lots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
