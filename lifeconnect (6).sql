-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 07:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lifeconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` text NOT NULL,
  `password` varchar(100) NOT NULL,
  `donor_id` int(100) NOT NULL,
  `healthcare_professional_id` int(100) NOT NULL,
  `patient_id` int(100) NOT NULL,
  `transplant_center_id` int(100) NOT NULL,
  `notification_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `donor`
--

CREATE TABLE `donor` (
  `donor_id` int(100) NOT NULL,
  `patient_id` int(100) NOT NULL,
  `healthcare_professional_id` int(100) NOT NULL,
  `transplant_center_id` int(100) NOT NULL,
  `notification_id` int(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('Male','Female','Other','') NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `blood_group` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `healthcare_professional`
--

CREATE TABLE `healthcare_professional` (
  `healthcare_professional_id` int(100) NOT NULL,
  `patient_id` int(100) NOT NULL,
  `donor_id` int(100) NOT NULL,
  `transplant_center_id` int(100) NOT NULL,
  `notification_id` int(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `year_of_experience` varchar(100) NOT NULL,
  `medical_license_id` int(100) NOT NULL,
  `transplant_center` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(100) NOT NULL,
  `healthcare_professional_id` int(100) NOT NULL,
  `donor_id` int(100) NOT NULL,
  `patient_id` int(100) NOT NULL,
  `transplant_center_id` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(100) NOT NULL,
  `donor_id` int(100) NOT NULL,
  `healthcare_professional_id` int(100) NOT NULL,
  `transplant_center_id` int(100) NOT NULL,
  `notification_id` int(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone_number` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `blood_group` varchar(100) NOT NULL,
  `gender` enum('Male','Female','Others','') NOT NULL,
  `urgency_rate` enum('Emergency','Urgent','Non-Urgent','') NOT NULL,
  `emergency_full_name` varchar(100) NOT NULL,
  `emergency_email` varchar(100) NOT NULL,
  `emergency_address` varchar(100) NOT NULL,
  `emergency_relationship` varchar(100) NOT NULL,
  `emergency_phone_number` varchar(100) NOT NULL,
  `emergency_city` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transplant_center`
--

CREATE TABLE `transplant_center` (
  `transplant_center_id` int(100) NOT NULL,
  `healthcare_professional_id` int(100) NOT NULL,
  `donor_id` int(100) NOT NULL,
  `patient_id` int(100) NOT NULL,
  `notification_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD KEY `donor_id` (`donor_id`),
  ADD KEY `healthcare_professional_id` (`healthcare_professional_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `transplant_center_id` (`transplant_center_id`),
  ADD KEY `notification_id` (`notification_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `donor`
--
ALTER TABLE `donor`
  ADD PRIMARY KEY (`donor_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `healthcare_professional_id` (`healthcare_professional_id`),
  ADD KEY `transplant_center_id` (`transplant_center_id`),
  ADD KEY `notification_id` (`notification_id`);

--
-- Indexes for table `healthcare_professional`
--
ALTER TABLE `healthcare_professional`
  ADD PRIMARY KEY (`healthcare_professional_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `donor_id` (`donor_id`),
  ADD KEY `transplant_center_id` (`transplant_center_id`),
  ADD KEY `notification_id` (`notification_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `healthcare_professional_id` (`healthcare_professional_id`),
  ADD KEY `donor_id` (`donor_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `transplant_center_id` (`transplant_center_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `doner_id` (`donor_id`),
  ADD KEY `healthcare_professional_id` (`healthcare_professional_id`),
  ADD KEY `transplant_center_id` (`transplant_center_id`),
  ADD KEY `notification_id` (`notification_id`);

--
-- Indexes for table `transplant_center`
--
ALTER TABLE `transplant_center`
  ADD PRIMARY KEY (`transplant_center_id`),
  ADD KEY `healthcare_professional_id` (`healthcare_professional_id`),
  ADD KEY `donor_id` (`donor_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `notification_id` (`notification_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `donor`
--
ALTER TABLE `donor`
  MODIFY `donor_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`donor_id`),
  ADD CONSTRAINT `admin_ibfk_3` FOREIGN KEY (`healthcare_professional_id`) REFERENCES `healthcare_professional` (`healthcare_professional_id`),
  ADD CONSTRAINT `admin_ibfk_4` FOREIGN KEY (`transplant_center_id`) REFERENCES `transplant_center` (`transplant_center_id`),
  ADD CONSTRAINT `admin_ibfk_5` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `admin_ibfk_6` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`);

--
-- Constraints for table `donor`
--
ALTER TABLE `donor`
  ADD CONSTRAINT `donor_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `donor_ibfk_2` FOREIGN KEY (`healthcare_professional_id`) REFERENCES `healthcare_professional` (`healthcare_professional_id`),
  ADD CONSTRAINT `donor_ibfk_3` FOREIGN KEY (`transplant_center_id`) REFERENCES `transplant_center` (`transplant_center_id`),
  ADD CONSTRAINT `donor_ibfk_4` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`);

--
-- Constraints for table `healthcare_professional`
--
ALTER TABLE `healthcare_professional`
  ADD CONSTRAINT `healthcare_professional_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`donor_id`),
  ADD CONSTRAINT `healthcare_professional_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `healthcare_professional_ibfk_3` FOREIGN KEY (`transplant_center_id`) REFERENCES `transplant_center` (`transplant_center_id`),
  ADD CONSTRAINT `healthcare_professional_ibfk_4` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`donor_id`),
  ADD CONSTRAINT `notification_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `notification_ibfk_3` FOREIGN KEY (`healthcare_professional_id`) REFERENCES `healthcare_professional` (`healthcare_professional_id`),
  ADD CONSTRAINT `notification_ibfk_4` FOREIGN KEY (`transplant_center_id`) REFERENCES `transplant_center` (`transplant_center_id`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`donor_id`),
  ADD CONSTRAINT `patient_ibfk_2` FOREIGN KEY (`healthcare_professional_id`) REFERENCES `healthcare_professional` (`healthcare_professional_id`),
  ADD CONSTRAINT `patient_ibfk_3` FOREIGN KEY (`transplant_center_id`) REFERENCES `transplant_center` (`transplant_center_id`),
  ADD CONSTRAINT `patient_ibfk_4` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`);

--
-- Constraints for table `transplant_center`
--
ALTER TABLE `transplant_center`
  ADD CONSTRAINT `transplant_center_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `donor` (`donor_id`),
  ADD CONSTRAINT `transplant_center_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`),
  ADD CONSTRAINT `transplant_center_ibfk_3` FOREIGN KEY (`healthcare_professional_id`) REFERENCES `healthcare_professional` (`healthcare_professional_id`),
  ADD CONSTRAINT `transplant_center_ibfk_4` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`notification_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
