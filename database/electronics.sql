-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 06:50 PM
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
  `is_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `category_parent`, `category_position`, `active`, `is_enabled`, `created_at`, `updated_at`) VALUES
(1, 'Laptops', 'Laptops', 'Laptops', 1, 1, 1, '2023-10-11 23:25:20', '2023-10-11 23:25:31'),
(2, 'CellPhones', 'CellPhones', 'CellPhones', 2, 1, 1, '2023-10-11 23:25:06', '2023-10-11 23:25:06'),
(3, 'TVs', 'TVs', 'TVs', 3, 1, 1, '2023-10-11 23:24:51', '2023-10-11 23:24:51'),
(4, 'Headphones', 'Headphones', 'Headphones', 4, 1, 1, '2023-10-11 23:24:34', '2023-10-11 23:24:34'),
(5, 'Printers', 'Printers', 'Printers', 5, 1, 1, '2023-10-11 23:24:01', '2023-10-11 23:24:01'),
(6, 'Smart Watch', 'Smart Watch', 'Smart Watch', 6, 1, 1, '2023-10-11 23:22:15', '2023-10-11 23:22:15'),
(7, 'Speakers', 'Speakers', 'Speakers', 7, 1, 0, '2023-10-11 23:23:28', '2023-10-11 23:23:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
