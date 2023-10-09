-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2023 at 08:06 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `prod_name`, `prod_desc`, `prod_img`, `price`, `qty`, `active`, `created_at`, `updated_at`, `category_id`) VALUES
(24, 'charger', 'ert', '', 749.99, 5, 0, '2023-10-06 00:41:54', '2023-10-06 00:41:54', 4),
(25, 'charger', 'ty', '', 749.99, 4, 0, '2023-10-06 00:45:11', '2023-10-06 00:45:11', 3),
(26, 'charger', 'ferfhg', '', 749.99, 5, 0, '2023-10-06 00:45:54', '2023-10-06 00:45:54', 4),
(27, 'charger', 'hgjghk', '', 0.00, 0, 0, '2023-10-06 00:46:26', '2023-10-06 00:46:26', 5),
(29, 'nokia 2.1', 'nokia brand new phone on sell', '', 56.50, 2, 0, '2023-10-06 15:22:59', '2023-10-06 15:22:59', 1),
(30, 'nokia2.4', 'latest version', '', 75.99, 3, 0, '2023-10-06 16:01:39', '2023-10-06 16:01:39', 2),
(33, 'nokia6.2', 'working fine', '', 200.00, 4, 0, '2023-10-06 17:41:51', '2023-10-06 17:41:51', 1),
(34, 'NOKIA102', '102 LATEST TESTING', '', 102.00, 103, 0, '2023-10-06 20:00:49', '2023-10-06 20:00:49', 1),
(36, 'laptop', 'laptop category', '', 2323.00, 10, 0, '2023-10-08 16:36:33', '2023-10-08 16:36:33', 2),
(37, 'nokia7.1', 'this is the latest nokia handset', '', 275.99, 75, 0, '2023-10-08 17:05:04', '2023-10-08 17:05:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
