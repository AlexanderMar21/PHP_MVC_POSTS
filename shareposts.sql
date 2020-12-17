-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 17, 2020 at 03:43 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shareposts`
--
CREATE DATABASE IF NOT EXISTS `shareposts` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `shareposts`;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `body`, `create_at`) VALUES
(7, 4, 'The key of Success For Europe', 'The EU can only succeed if its efforts drive also the global transition to a just, climate-neutral, resource-efficient and circular economy. There is a growing need to advance discussions on defining a “Safe Operating Space’ whereby the use of various natural resources does not exceed certain local, regional or global thresholds and environmental impacts remain within planetary boundaries.', '2020-12-01 14:27:49'),
(8, 5, 'Greece in the EU', 'Greece has 11 representatives on the European Committee of the Regions, the EU&#39;s assembly of regional and local representatives. This advisory body is consulted on proposed laws, to ensure these laws take account of the perspective from each region of the EU.\r\nThe most important sectors of Greece’s economy in 2018 were wholesale and retail trade, transport, accommodation and food services (25.1%).', '2020-11-17 14:29:26'),
(9, 4, 'Choosing Vacations', 'Health & comfort measures Learn more about the procedures and protocols that have been put in place to keep you safe during your vacation, from beginning to end. Like, full exchange of cabin air with fresh, outdoor air and HEPA filtered air every 2-3 minutes. More about Southwest® Promise .\r\nOur Best Price &Service Guarantee Now in our 37th year, Vacations To Go is the largest cruise-selling company in the world.', '2020-12-10 14:31:08'),
(10, 6, 'Exploring Aurora', 'The word aurora is derived from the name of the Roman goddess of the dawn, Aurora, who travelled from east to west announcing the coming of the sun. Ancient Greek poets used the name metaphorically to refer to dawn, often mentioning its play of colours across the otherwise dark sky (e.g., rosy-fingered dawn.', '2020-11-10 14:32:32'),
(11, 5, 'Do you believe in Karma?', 'Karma , means action, work or deed; it also refers to the spiritual principle of cause and effect where intent and actions of an individual (cause) influence the future of that individual (effect). Good intent and good deeds contribute to good karma and happier rebirths, while bad intent and bad deeds contribute to bad karma and bad rebirths.', '2020-10-17 14:34:15'),
(12, 6, 'Have you ever felt a vertigo!?', 'Vertigo is a condition where a person has the sensation of moving or of surrounding objects moving when they are not. Often it feels like a spinning or swaying movement. This may be associated with nausea, vomiting, sweating, or difficulties walking. It is typically worse when the head is moved.Vertigo is the most common type of dizziness.', '2020-11-27 14:37:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(4, 'Alexander Margioni', 'margioni21@gmail.com', '$2y$10$7kmuhLbZiT3nxMEM/5CotOnkC1VSalxO1p.v0RAZ0B2CXwwL99o4u', '2020-12-15 16:23:52'),
(5, 'John Doe', 'johnd@gmail.com', '$2y$10$Pn1UL1eD78woYV1Lpf3z0u9E2GkLHM9yvSMJLXcDrcSziFG8u.0yO', '2020-12-16 11:54:29'),
(6, 'Emily Smith', 'emily@gmail.com', '$2y$10$dLsoPvkvYiFlF8BoNML7l.7SToPUlHoPSj2tAZn5Jl9/tWWTcPSTO', '2020-12-17 14:35:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
