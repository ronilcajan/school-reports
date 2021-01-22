-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2021 at 11:54 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school-reports`
--

-- --------------------------------------------------------

--
-- Table structure for table `calculation`
--

CREATE TABLE `calculation` (
  `history_id` int(11) NOT NULL,
  `id_admission` varchar(100) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `etab` varchar(50) DEFAULT NULL,
  `formation` varchar(50) DEFAULT NULL,
  `promo` varchar(100) DEFAULT NULL,
  `a` varchar(100) DEFAULT NULL,
  `b` varchar(100) DEFAULT NULL,
  `c` varchar(50) DEFAULT NULL,
  `d` varchar(50) DEFAULT NULL,
  `z` varchar(50) DEFAULT NULL,
  `vhr` varchar(50) DEFAULT NULL,
  `vha` varchar(50) DEFAULT NULL,
  `percent` varchar(50) DEFAULT NULL,
  `notes` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user` varchar(50) DEFAULT NULL,
  `periode` varchar(50) DEFAULT NULL,
  `nature` varchar(50) DEFAULT NULL,
  `etab` varchar(50) DEFAULT NULL,
  `promo` varchar(50) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL,
  `intervalle` varchar(100) DEFAULT NULL,
  `pdf` varchar(100) DEFAULT NULL,
  `excel` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `percent_a` int(11) NOT NULL,
  `percent_b` int(11) NOT NULL,
  `notes` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`percent_a`, `percent_b`, `notes`) VALUES
(0, 1, '20.00'),
(1, 2, '19.00'),
(2, 3, '18.00'),
(3, 4, '17.00'),
(4, 5, '16.00'),
(5, 6, '15.00'),
(6, 7, '14.00'),
(7, 9, '13.00'),
(9, 11, '12.00'),
(11, 13, '11.00'),
(13, 15, '10.00'),
(15, 17, '9.50'),
(17, 19, '9.00'),
(19, 21, '8.50'),
(21, 23, '8.00'),
(23, 25, '7.50'),
(25, 30, '7.00'),
(30, 40, '6.00'),
(40, 50, '5.00'),
(50, 60, '4.00'),
(60, 70, '3.00'),
(70, 80, '2.00'),
(80, 90, '1.00'),
(90, 100, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `id_admission` varchar(100) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `etab` varchar(50) DEFAULT NULL,
  `formation` varchar(50) DEFAULT NULL,
  `promo` varchar(50) DEFAULT NULL,
  `seance` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `debut` varchar(50) DEFAULT NULL,
  `fin` varchar(50) DEFAULT NULL,
  `duree` varchar(50) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `heure_pointage` varchar(50) DEFAULT NULL,
  `categorie` varchar(50) DEFAULT NULL,
  `enseig` varchar(50) DEFAULT NULL,
  `cat_fusionee` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `username` text DEFAULT NULL,
  `activity` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `user_type`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `username` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `profile_img` varchar(100) DEFAULT NULL,
  `education` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `contact_no` int(11) DEFAULT NULL,
  `notes` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calculation`
--
ALTER TABLE `calculation`
  ADD KEY `history_id` (`history_id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calculation`
--
ALTER TABLE `calculation`
  ADD CONSTRAINT `calculation_ibfk_1` FOREIGN KEY (`history_id`) REFERENCES `history` (`id`);

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `history_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`username`);

--
-- Constraints for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
