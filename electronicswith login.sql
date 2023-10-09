-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2023 at 09:25 PM
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
-- Database: `electronics`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `category_parent` varchar(255) NOT NULL,
  `category_position` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_parent`, `category_position`, `active`, `created_at`, `updated_at`) VALUES
(1, 'mobile', 'Mobile', 'smartphone', 1, 1, '2023-10-05 20:33:16', '2023-10-05 20:33:16'),
(2, 'PC Desktop', 'pc-desktop', '', 2, 1, '2023-10-06 00:35:00', '2023-10-06 00:35:00'),
(3, 'Laptop', 'laptop', '', 3, 1, '2023-10-06 00:36:00', '2023-10-06 00:36:00'),
(4, 'Tablet', 'tablet', '', 4, 1, '2023-10-06 00:37:00', '2023-10-06 00:37:00');

-- --------------------------------------------------------


--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `unit_number` varchar(20) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `zip` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `address1`, `unit_number`, `city`, `province`, `zip`) VALUES
(1, 'foram', 'patel', 'foram@gmail.com', '123', '4567890123', '153 huber st', '', '', 'ON', 'N2J 3K2'),
(2, 'ravi', 'patel', 'ravi@gmail.com', 'ravi', '1234567890', '236 Carter Avenue', '', '', 'Ontario', 'N2J 3K2'),
(3, 'riya', 'shah', 'r@gmail.com', 'riya', '1234567890', '236 Carter Avenue', '', '', 'Ontario', 'N2J 3K2'),
(4, 'jiya', 'shah', 'j@gmail.com', 'jiya', '1234567890', '236 Carter Avenue', '', 'Waterloo', 'Ontario', 'N2J 3K2'),
(9, 'kane', 'george', 'kane@gmail.com', '', '2345678901', '236 Carter Avenue', '', 'Waterloo', 'Ontario', 'N2J 3K2'),
(10, 'jinal', 'shah', 'jinal@gmail.com', '', '0123456789', '56 bible st', '45', 'waterloo', 'on', 'n4t 6y8'),
(11, 'parth', 'vyas', 'p@gmail.com', '', '0987654321', '632 king st', '56', 'waterloo', 'on', 'n3j 1b8');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_desc` longtext NOT NULL,
  `prod_img` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `qty` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prod_name`, `prod_desc`, `prod_img`, `price`, `qty`, `active`, `created_at`, `updated_at`, `category_id`) VALUES
(24, 'charger', 'ert', '', 749.99, 0, 0, '2023-10-06 00:41:54', '2023-10-06 00:41:54', 2),
(25, 'charger', 'ty', '', 749.99, 0, 0, '2023-10-06 00:45:11', '2023-10-06 00:45:11', 3),
(26, 'charger', 'ferfhg', '', 749.99, 0, 0, '2023-10-06 00:45:54', '2023-10-06 00:45:54', 4),
(27, 'charger', 'hgjghk', '', 0.00, 0, 0, '2023-10-06 00:46:26', '2023-10-06 00:46:26', 5),
(29, 'nokia 2.1', 'nokia brand new phone on sell', '', 56.50, 6, 0, '2023-10-06 15:22:59', '2023-10-06 15:22:59', 1),
(30, 'nokia2.4', 'latest version', '', 75.90, 7, 0, '2023-10-06 16:01:39', '2023-10-06 16:01:39', 1),
(31, 'nokia3', 'latest version', '', 50.00, 0, 0, '2023-10-06 16:09:39', '2023-10-06 16:09:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `UserName`, `Password`) VALUES
(1, 'Admin101', '101');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
