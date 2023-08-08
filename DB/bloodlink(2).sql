-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2023 at 12:27 PM
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
-- Database: `bloodlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `fullname`, `username`, `password`, `email`, `created_at`, `updated_at`) VALUES
(2, 'Admin', 'admin', 'admin1', 'admin@gmail.com', '2023-07-23 02:32:31', '2023-07-23 03:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `inquiries`
--

CREATE TABLE `inquiries` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` enum('Pending','Contacted') NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `requested_by` int(11) NOT NULL,
  `requested_to` int(11) NOT NULL,
  `requested_date` date NOT NULL,
  `status` enum('Pending','Accepted by Donor','Donated') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `requested_by`, `requested_to`, `requested_date`, `status`, `created_at`, `updated_at`) VALUES
(14, 14, 7, '2023-07-23', 'Donated', '2023-07-23 15:17:10', '2023-07-23 16:08:33'),
(15, 3, 14, '2023-07-23', 'Donated', '2023-07-23 15:18:04', '2023-07-23 16:04:38'),
(16, 3, 7, '2023-07-23', 'Donated', '2023-07-23 15:39:42', '2023-07-23 15:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `district` varchar(30) NOT NULL,
  `municipality` varchar(30) NOT NULL,
  `ward` int(11) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `blood` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `phone` varchar(20) NOT NULL,
  `lastdonation` date DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `role` enum('Receiver','Donor','Both') NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `province`, `district`, `municipality`, `ward`, `dob`, `gender`, `email`, `password`, `blood`, `phone`, `lastdonation`, `profile`, `role`, `status`, `token`, `created_at`, `updated_at`) VALUES
(3, 'Anil Sharma', 'Gandaki', 'Baglung', 'Kathekhola', 5, '2023-06-12', 'Male', 'anil@gmail.com', '$2y$10$Gt1DZLexK02HTze/5hsKiOYb4hoGkMvVYPDM0UnYeITJPp0sUWpcG', 'A+', '9861649811', '2023-06-12', '1690124777aaaa.jpg', 'Donor', 'Active', '0', '2023-06-14 15:01:11', '2023-07-23 15:14:58'),
(6, 'Girija Kandel', 'Bagmati', 'Chitwan', 'Bharatpur', 8, '2002-05-05', 'Male', 'kandelanil24@gmail.com', '$2y$10$zwAaWfiRC4jQmYdSlIOPp.dm.tFkwx/IGWdpDPlXc0U5pqY2k0lTC', 'O+', '9876545432', '2023-07-11', NULL, '', 'Active', '752bee7b760869943bf6360934f96c63', '2023-06-17 02:53:10', '2023-08-07 03:07:54'),
(7, 'Hari Kandel', 'Bagmati', 'Chitwan', 'Bharatpur', 9, '2000-01-01', 'Male', 'hari@gmail.com', 'harikandel', 'O+', '9876543434', '2023-01-03', NULL, 'Donor', 'Active', '0', '2023-06-29 15:11:45', '2023-06-29 15:11:45'),
(12, 'Test USer', 'Bagmati', 'Chitwan', 'Bharatpur', 10, '2023-07-05', 'Male', 'sadkandel00@gmail.com', '$2y$10$8cuXo6pRVGBDBinl5RMXCOrrD5kRgpGd9f637pslJtFb5OBuBx8/a', 'O+', '9861649811', '2023-07-05', '1688998859giri (2).png', 'Both', 'Active', NULL, '2023-07-10 14:19:31', '2023-07-10 14:20:59'),
(14, 'Gita Kandel', 'Bagmati', 'Chitwan', 'Bharatpur', 4, '2002-06-24', 'Female', 'gita@gmail.com', '$2y$10$0mln508g5HeqWIKPv9qUruFU/3cF4zUyia.7jdjkTFTXXs935kMbe', 'O+', '9812293325', '0000-00-00', '1690080486aaaa.jpg', 'Donor', 'Active', NULL, '2023-07-23 02:48:06', '2023-07-23 02:55:33'),
(16, 'Sita Sapkota', 'Bagmati', 'Chitwan', 'Bharatpur', 7, '2000-04-04', 'Female', 'sita@gmail.com', '$2y$10$uUqVdcc8Q39g7cuMfupbgekd/QNgnn49/dT61nGr1B6xDuAhay2tG', 'O+', '9817635245', '0000-00-00', '1691079795aaaa.jpg', 'Both', 'Active', NULL, '2023-08-03 16:23:15', '2023-08-03 16:23:15'),
(17, 'Anil Kandel', 'Bagmati', 'Chitwan', 'Bharatpur', 7, '2023-08-09', 'Male', 'anil@gmail.c', '$2y$10$NTyXZlvEMac6q2tTYKwUmexbEGSo3enyA40RcaEOzhwwi2iPIGUzG', 'AB-', '9812354566', '0000-00-00', '1691376222Frame 677 (1).png', 'Donor', 'Active', NULL, '2023-08-07 02:43:42', '2023-08-07 02:43:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inquiries`
--
ALTER TABLE `inquiries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requested_by` (`requested_by`),
  ADD KEY `requested_to` (`requested_to`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inquiries`
--
ALTER TABLE `inquiries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`requested_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`requested_to`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
