-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql_docker
-- Generation Time: Dec 01, 2019 at 03:57 PM
-- Server version: 5.7.28
-- PHP Version: 7.2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mob-doc`
--

-- --------------------------------------------------------

--
-- Table structure for table `body_disease`
--

CREATE TABLE `body_disease` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `prescription` text COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body_organs` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `body_disease`
--

INSERT INTO `body_disease` (`id`, `name`, `description`, `prescription`, `image_path`, `body_organs`) VALUES
(1, 'Mouth Ulcer', 'Mouth Ulcer is caused by the Excessive heat in the body', 'Use the B-Complex tablets', 'images/mouth-ulcer.jpeg', 3),
(2, 'Tooth ace', 'Tooth ace is caused by excessive bacteria in the mouth', 'Use the  clove oil or the rinse your mouth using the salt water', 'images/tooth-ache.jpeg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `body_organs`
--

CREATE TABLE `body_organs` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body_parts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `body_organs`
--

INSERT INTO `body_organs` (`id`, `name`, `image_path`, `body_parts`) VALUES
(1, 'Eyes', 'images/eyes.jpeg', 1),
(3, 'Mouth', 'images/mouth.jpeg', 1),
(4, 'Nose', 'images/nose.jpeg', 1),
(5, 'Ears', 'images/ears.jpeg', 1),
(6, 'Shoulder', 'images/shoulder.jpeg', 3),
(7, 'Elbow', 'images/elbow.jpeg', 3),
(8, 'Chest', 'images/chest.jpeg', 4),
(9, 'stomach', 'images/stomach.jpeg', 4),
(10, 'Knee', 'images/knees.jpeg', 2),
(11, 'Anklet', 'images/anklet.jpeg', 2),
(12, 'Thighs', 'images/thighs.jpeg', 2),
(13, 'Heels', 'images/heels.jpeg', 2),
(14, 'Wrist', 'images/wrist.jpeg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `body_parts`
--

CREATE TABLE `body_parts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `body_parts`
--

INSERT INTO `body_parts` (`id`, `name`) VALUES
(3, 'Arms'),
(4, 'Body'),
(1, 'Head'),
(2, 'Leg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT '',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `first_name`, `last_name`) VALUES
(1, 'admin@admin.com', '$2y$10$4y4DVaxQGA1HRrE8vAvXwOW4EvHDXYD4asoJ0FabqFDLAeJPJuZyK', 'admin', 'admin'),
(9, 'adm@adm.com', '$2y$10$rS/cXVlJ2OClDq/0z0PK..O1RMCqTt/3hwk8PxKwLknFiDnF3yAGa', 'aasd', 'asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `body_disease`
--
ALTER TABLE `body_disease`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `body_organs`
--
ALTER TABLE `body_organs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk_body_parts` (`body_parts`);

--
-- Indexes for table `body_parts`
--
ALTER TABLE `body_parts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `body_disease`
--
ALTER TABLE `body_disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `body_organs`
--
ALTER TABLE `body_organs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `body_parts`
--
ALTER TABLE `body_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `body_organs`
--
ALTER TABLE `body_organs`
  ADD CONSTRAINT `fk_body_parts` FOREIGN KEY (`body_parts`) REFERENCES `body_parts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
