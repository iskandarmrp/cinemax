-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 08:48 PM
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
-- Database: `gotix`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-12-12-172316', 'App\\Database\\Migrations\\Payment', 'default', 'App', 1702920909, 1),
(2, '2023-12-12-174616', 'App\\Database\\Migrations\\Ticket', 'default', 'App', 1702921352, 2),
(3, '2023-12-18-173051', 'App\\Database\\Migrations\\Users', 'default', 'App', 1702921352, 2);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `paymentId` int(11) UNSIGNED NOT NULL,
  `paymentDate` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  `totalPrice` decimal(10,2) NOT NULL,
  `paymentMethod` varchar(255) NOT NULL,
  `movieName` varchar(255) NOT NULL,
  `showtime` datetime NOT NULL,
  `seats` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`seats`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`paymentId`, `paymentDate`, `email`, `totalPrice`, `paymentMethod`, `movieName`, `showtime`, `seats`) VALUES
(1, '2023-12-18 17:43:17', 'budi@gmail.com', 300.00, 'ovo', 'Hamilton', '2024-06-01 10:00:00', '[\"A1\",\"B1\",\"C1\"]');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticketId` int(11) UNSIGNED NOT NULL,
  `movieId` int(11) NOT NULL,
  `movieName` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `time` datetime NOT NULL,
  `seats` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `paymentId` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketId`, `movieId`, `movieName`, `date`, `time`, `seats`, `price`, `paymentId`) VALUES
(1, 1, 'Hamilton', '2023-12-18 17:43:22', '2024-06-01 10:00:00', 'A1', 100.00, 1),
(2, 1, 'Hamilton', '2023-12-18 17:43:22', '2024-06-01 10:00:00', 'B1', 100.00, 1),
(3, 1, 'Hamilton', '2023-12-18 17:43:22', '2024-06-01 10:00:00', 'C1', 100.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `password`, `name`) VALUES
('budi@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Budi Hartono'),
('james@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'James Harden'),
('tony@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 'Tony Montana');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticketId`),
  ADD KEY `ticket_paymentId_foreign` (`paymentId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `paymentId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticketId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_paymentId_foreign` FOREIGN KEY (`paymentId`) REFERENCES `payment` (`paymentId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
