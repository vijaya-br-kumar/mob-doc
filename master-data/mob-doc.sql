-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql_docker
-- Generation Time: Nov 17, 2019 at 02:15 PM
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
-- Database: `test`
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
(1, 'Mouth Ulcer', 'Mouth Ulcer is caused by the Excessive heat in the body', 'Use the B-Complex tablets', '/images/mouthUlcer.jpg', 3);

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
(1, 'Eyes', '/images/eyes.jpg', 1),
(3, 'Mouth', '/images/mouth.jpg', 1),
(4, 'Nose', '/images/nose.jpg', 1),
(5, 'Ears', '/images/ears.jpg', 1);

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
(1, 'Head'),
(2, 'Leg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(250) NOT NULL DEFAULT '',
  `password` varchar(200) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'admin@admin.com', '$2y$10$4y4DVaxQGA1HRrE8vAvXwOW4EvHDXYD4asoJ0FabqFDLAeJPJuZyK'),
(2, 'email123@email.com', '$2y$10$4y4DVaxQGA1HRrE8vAvXwOW4EvHDXYD4asoJ0FabqFDLAeJPJuZyK'),
(3, 'test', '$2y$10$TZZWc65VgklBR9pmfUdBg.4lLQuL7BjGO22cpcS0XdKIBsHiQZd4a');

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `body_disease`
--
ALTER TABLE `body_disease`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `body_organs`
--
ALTER TABLE `body_organs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `body_parts`
--
ALTER TABLE `body_parts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
