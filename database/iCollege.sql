-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 27, 2021 at 11:14 AM
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
-- Database: `iCollege`
--

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_admin`
--

CREATE TABLE `iCollege_admin` (
  `id` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `iCollege_admin`
--

INSERT INTO `iCollege_admin` (`id`, `email`, `password`) VALUES
('a69681bcf334ae130217fea4505fd3c994f5683f', 'sysadmin@iCollege.org', 'adcd7048512e64b48da55b027577886ee5a36350');

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_courses`
--

CREATE TABLE `iCollege_courses` (
  `id` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `hod` varchar(200) NOT NULL,
  `details` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_enrollments`
--

CREATE TABLE `iCollege_enrollments` (
  `id` varchar(200) NOT NULL,
  `std_regno` varchar(200) NOT NULL,
  `std_name` varchar(200) NOT NULL,
  `unit_code` varchar(200) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `semester_enrolled` varchar(200) NOT NULL,
  `academic_year_enrolled` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_exammarks`
--

CREATE TABLE `iCollege_exammarks` (
  `id` varchar(200) NOT NULL,
  `course_id` varchar(200) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `unit_code` varchar(200) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `std_regno` varchar(200) NOT NULL,
  `std_name` varchar(200) NOT NULL,
  `semester_enrolled` varchar(200) NOT NULL,
  `academic_year` varchar(200) NOT NULL,
  `marks` varchar(200) NOT NULL,
  `created_at` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_fees_payments`
--

CREATE TABLE `iCollege_fees_payments` (
  `id` varchar(200) NOT NULL,
  `std_regno` varchar(200) NOT NULL,
  `std_name` varchar(200) NOT NULL,
  `amt_billed` varchar(200) NOT NULL,
  `amt_paid` varchar(200) NOT NULL,
  `payment_means` varchar(200) NOT NULL,
  `payment_code` varchar(200) NOT NULL,
  `date_paid` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_lecturers`
--

CREATE TABLE `iCollege_lecturers` (
  `id` varchar(200) NOT NULL,
  `number` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `idno` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `dpic` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_students`
--

CREATE TABLE `iCollege_students` (
  `id` varchar(200) NOT NULL,
  `admno` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `idno` varchar(200) NOT NULL,
  `adr` varchar(200) NOT NULL,
  `sex` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `dpic` varchar(200) NOT NULL,
  `course_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_timetable`
--

CREATE TABLE `iCollege_timetable` (
  `id` varchar(200) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `unit_code` varchar(200) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `lec_name` varchar(200) NOT NULL,
  `day` varchar(200) NOT NULL,
  `time` varchar(200) NOT NULL,
  `room` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_units`
--

CREATE TABLE `iCollege_units` (
  `id` varchar(200) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `iCollege_units_allocation`
--

CREATE TABLE `iCollege_units_allocation` (
  `id` varchar(200) NOT NULL,
  `unit_code` varchar(200) NOT NULL,
  `unit_name` varchar(200) NOT NULL,
  `lec_number` varchar(200) NOT NULL,
  `lec_name` varchar(200) NOT NULL,
  `date_allocated` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iCollege_admin`
--
ALTER TABLE `iCollege_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_courses`
--
ALTER TABLE `iCollege_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_enrollments`
--
ALTER TABLE `iCollege_enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_exammarks`
--
ALTER TABLE `iCollege_exammarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_fees_payments`
--
ALTER TABLE `iCollege_fees_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_lecturers`
--
ALTER TABLE `iCollege_lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_students`
--
ALTER TABLE `iCollege_students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_timetable`
--
ALTER TABLE `iCollege_timetable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_units`
--
ALTER TABLE `iCollege_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iCollege_units_allocation`
--
ALTER TABLE `iCollege_units_allocation`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
