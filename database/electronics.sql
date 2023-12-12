-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 09:39 PM
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
(13, 'tirth', 'patel', 'tirth@gmail.com', '$2y$10$vBPbSDG57.qR8/kdG3NNBuDVARi.34UNzI1/olb4DJqQINV9zGqU2', '6565656565', '45 franklin rd', '3401', 'Waterloo', 'Ontario', 'N2J 3K2'),
(15, 'myra', 'patel', 'myra@gmail.com', '$2y$10$iVjGk/PUaB8RLHQdTNJVf.1vF8lwOVrFZrYd9vPNp.xkbZ9gEStyG', '8901234567', '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(16, 'janvi', 'Shah', 'Janvi@gmail.com', '$2y$10$Fq.6eOIXqmYvFlkNvNua8Ow0erwNwDqoHLIPJ7e9Kv14EtpECBTLa', '1234567890', '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(17, 'peter', 'peter', 'peter@gmail.com', '$2y$10$rYKKOmwUXSE26tSVmKwrb.1elLFb18x.gF2/dNM93zI/dEdmvKZVG', '1234567890', '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(18, 'jill', 'shah', 'jill@gmail.com', '$2y$10$or3.HY6Y8ArLZLdy3DCFOueRbwwew8bYONY1ag8BXgGi0oAJuKNgO', '4567890123', '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(19, 'SANJAY', 'PATEL', 'sanjay@gmail.com', '$2y$10$sTGNU9a7lSdlDko3piHi4uzcXc59ptt.blVSi6/9xrhR8pzZZ6TeG', '8901234567', '65 university Ave', '1108', 'Waterloo', 'On', 'N2K 4R5'),
(20, 'SJ', 'SINGH', '123@sjs.com', '', '+11231231236', 'sdfsdfsf', '', 'sfwsfwefwef', 'California', '21331'),
(22, 'SJ', 'SINGH', '101@ssdfw3242.com', '$2y$10$30x6SqCcUEtQ7gy7i/66f.Ea15eC/supmu8CCnvKZl3G5.J/7zwZW', '+11231231236', 'sdfsdfsf', '', 'sfwsfwefwef', 'California', '21331'),
(23, 'SATINDER', 'JEET', '112@gmail.com', '$2y$10$Fvb8S65mMHisF9mWAHDvFema0WHT5k014Om4hrHL3949k9/QnIGGy', '1231234444', '401', '140', 'cambridge', 'Ontario', '101'),
(24, 'SJ', 'SINGH', '123@ssdfw3242.com', '$2y$10$TiY5YIRfnpJT1p0Die9h/eFvgRSIxMzh.hp7fmYL7eDoXKzkw51q2', '+11231231236', 'sdfsdfsf', '123', 'sfwsfwefwef', 'California', '21331'),
(25, 'SJ', 'SINGH', '101@ssdfw@42.com', '$2y$10$8NnAdLpchaNfn2Xy5dZyL.F.qjoz6vB/YNsGNMWXiEvvikjDSg/ZC', '+11231231236', 'sdfsdfsf', '101', 'sfwsfwefwef', 'California', '21331'),
(26, 'JAY', 'PATEL', 'jpatel@conestoga.on', '$2y$10$kFpX67d50jkgF7S2.4U38.KXGKiQsABhD2.rR74aGmqtVnLya5E06', '8686868686', '1904-B 300 Regina Street North', '', 'Waterloo', 'ON', 'N2J4H2');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `unit_number` varchar(50) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(50) NOT NULL,
  `zip` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_address`
--

INSERT INTO `delivery_address` (`id`, `address`, `unit_number`, `city`, `province`, `zip`) VALUES
(50, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(51, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(52, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(53, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(54, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(55, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(56, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(57, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(58, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(59, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(60, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(61, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(62, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(63, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(64, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(65, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(66, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(67, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(68, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(69, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(70, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(71, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(72, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(73, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(74, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(75, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(76, '236 Carter Avenue', 'B', 'Waterloo', 'Ontario', 'N2J 3K2'),
(77, '176 king st', '4', 'Waterloo', 'ON', 'N2S 1S2'),
(78, 'sdfsdfsf', '122', 'sfwsfwefwef', 'California', '21331'),
(79, 'sdfsdfsf', '112', 'sfwsfwefwef', 'California', '21331'),
(80, 'sdfsdfsf', '112', 'sfwsfwefwef', 'California', '21331'),
(81, 'sdfsdfsf', '112', 'sfwsfwefwef', 'California', '21331'),
(82, 'sdfsdfsf', '112', 'sfwsfwefwef', 'California', '21331'),
(83, 'sdfsdfsf', '', 'sfwsfwefwef', 'California', '21331'),
(84, 'sjsj', '', 'cali', 'ON', '21334'),
(85, '101', '121', '1212', 'California', '21331'),
(86, 'sdfsdfsf', '', 'sfwsfwefwef', 'California', '21331'),
(87, 'sdfsdfsf', '', 'sfwsfwefwef', 'California', '21331'),
(88, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(89, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(90, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(91, '1904-B 300 Regina Street North', '', 'Waterloo', 'ON', 'N2J4H2'),
(92, '1904-B 300 Regina Street North', '', 'Waterloo', 'ON', 'N2J4H2'),
(93, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(94, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(95, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(96, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(97, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(98, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(99, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(100, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(101, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(102, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(103, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '5', 'AHMEDABAD', 'Gujarat', '380061'),
(104, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '6', 'AHMEDABAD', 'Gujarat', '380061'),
(105, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '2', 'AHMEDABAD', 'Gujarat', '380061'),
(106, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '3', 'AHMEDABAD', 'Gujarat', '380061'),
(107, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '4', 'AHMEDABAD', 'Gujarat', '380061'),
(108, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '9', 'AHMEDABAD', 'Gujarat', '380061'),
(109, '1904-B 300 Regina Street North', '8765', 'Waterloo', 'ON', 'N2J4H2'),
(110, 'D/27, KARMACHARINAGAR, OPP RANNAPARK, GHATLODIA', '1', 'AHMEDABAD', 'Gujarat', '380061');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `ID` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`ID`, `order_id`, `product_id`, `quantity`, `product_price`, `created_at`, `updated_at`) VALUES
(4, 18, 2, 1, 1600.00, '2023-11-02 03:28:44', '2023-11-02 03:28:44'),
(5, 18, 1, 1, 1500.50, '2023-11-02 03:28:44', '2023-11-02 03:28:44'),
(6, 19, 10, 2, 800.00, '2023-11-02 09:57:10', '2023-11-02 09:57:10'),
(7, 19, 2, 1, 1600.00, '2023-11-02 09:57:10', '2023-11-02 09:57:10'),
(8, 66, 6, 1, 700.00, '2023-12-11 19:06:46', '2023-12-11 19:06:46'),
(9, 67, 6, 1, 700.00, '2023-12-11 19:07:57', '2023-12-11 19:07:57'),
(10, 68, 6, 1, 700.00, '2023-12-11 19:09:11', '2023-12-11 19:09:11'),
(11, 69, 6, 1, 700.00, '2023-12-11 19:10:08', '2023-12-11 19:10:08'),
(12, 85, 4, 1, 900.00, '2023-12-11 19:16:36', '2023-12-11 19:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `ID` bigint(20) NOT NULL,
  `order_id_index` varchar(100) NOT NULL,
  `order_total_amount` double NOT NULL,
  `order_status` varchar(255) DEFAULT NULL,
  `order_date` datetime NOT NULL DEFAULT current_timestamp(),
  `delivery_address_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`ID`, `order_id_index`, `order_total_amount`, `order_status`, `order_date`, `delivery_address_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(5, 'd41c3090-790a-11ee-a661-54ab3ab52253', 2500, 'Approved', '2023-11-01 19:03:11', 63, 18, '2023-11-01 23:03:11', '2023-11-01 23:03:11'),
(6, 'd92e9db8-790a-11ee-a661-54ab3ab52253', 2500, 'In Process', '2023-11-01 19:03:19', 64, 18, '2023-11-01 23:03:19', '2023-11-01 23:03:19'),
(7, 'db33960d-790a-11ee-a661-54ab3ab52253', 2500, 'not approved', '2023-11-01 19:03:22', 65, 18, '2023-11-01 23:03:22', '2023-11-01 23:03:22'),
(8, '0fd752be-790b-11ee-a661-54ab3ab52253', 2500, 'Approved', '2023-11-01 19:04:51', 66, 18, '2023-11-01 23:04:51', '2023-11-01 23:04:51'),
(9, '19673e76-790b-11ee-a661-54ab3ab52253', 2500, 'Approved', '2023-11-01 19:05:07', 67, 18, '2023-11-01 23:05:07', '2023-11-01 23:05:07'),
(10, '2eedae41-790b-11ee-a661-54ab3ab52253', 2500, 'Approved', '2023-11-01 19:05:43', 68, 18, '2023-11-01 23:05:43', '2023-11-01 23:05:43'),
(12, 'a116f4a3-790b-11ee-a661-54ab3ab52253', 2500, 'Approved', '2023-11-01 19:08:54', 70, 18, '2023-11-01 23:08:54', '2023-11-01 23:08:54'),
(13, '0bfb07b7-790c-11ee-a661-54ab3ab52253', 2500, 'Approved', '2023-11-01 19:11:54', 71, 18, '2023-11-01 23:11:54', '2023-11-01 23:11:54'),
(14, '5dd2f35d-790c-11ee-a661-54ab3ab52253', 2500, 'Approved', '2023-11-01 19:14:11', 72, 18, '2023-11-01 23:14:11', '2023-11-01 23:14:11'),
(15, '051e3901-790d-11ee-a661-54ab3ab52253', 2500, 'not approved', '2023-11-01 19:18:52', 73, 18, '2023-11-01 23:18:52', '2023-11-01 23:18:52'),
(16, '1a0035c2-790d-11ee-a661-54ab3ab52253', 2500, 'Approved', '2023-11-01 19:19:27', 74, 18, '2023-11-01 23:19:27', '2023-11-01 23:19:27'),
(18, '6618f3d4-790e-11ee-a661-54ab3ab52253', 3100.5, 'Approved', '2023-11-01 19:28:44', 76, 18, '2023-11-01 23:28:44', '2023-11-01 23:28:44'),
(19, 'a95be9f3-7944-11ee-9d5f-54ab3ab52253', 3200, 'Approved', '2023-11-02 01:57:10', 77, 18, '2023-11-02 05:57:10', '2023-11-02 05:57:10'),
(21, 'f3de8cbb-8255-11ee-a811-20c19b1e3984', 900, 'Approved', '2023-11-13 13:52:06', 79, 23, '2023-11-13 18:52:06', '2023-11-13 18:52:06'),
(22, '6cf89f21-8257-11ee-a811-20c19b1e3984', 3200, 'Approved', '2023-11-13 14:02:39', 80, 23, '2023-11-13 19:02:39', '2023-11-13 19:02:39'),
(27, '9f0167e9-83fd-11ee-a811-20c19b1e3984', 3100.5, NULL, '2023-11-15 16:23:53', 85, 24, '2023-11-15 21:23:53', '2023-11-15 21:23:53'),
(29, 'f0aae58b-83fd-11ee-a811-20c19b1e3984', 3100.5, 'Approved', '2023-11-15 16:26:10', 87, 24, '2023-11-15 21:26:10', '2023-11-15 21:26:10'),
(30, 'pi_3OMCdfIfuNxYRy4K0bOPYGwM', 1017, 'Approved', '2023-12-11 11:53:36', 0, 1, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(31, 'pi_3OMCoBIfuNxYRy4K0evVZvxK', 1017, 'Approved', '2023-12-11 11:59:31', 0, 2, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(32, 'pi_3OMD01IfuNxYRy4K1g6WfdYA', 1017, 'Approved', '2023-12-11 12:11:47', 0, 3, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(33, 'pi_3OMD8gIfuNxYRy4K2Ak1QnUN', 1695.57, 'Approved', '2023-12-11 12:19:49', 0, 4, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(34, 'pi_3OMDHGIfuNxYRy4K1RX8EgYI', 1017, 'Approved', '2023-12-11 12:28:41', 0, 5, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(35, 'pi_3OME3LIfuNxYRy4K1z4xS0uX', 2486.57, 'Approved', '2023-12-11 13:18:18', 0, 6, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(36, 'pi_3OME4jIfuNxYRy4K0TN3pYyk', 904, 'Approved', '2023-12-11 13:19:46', 0, 7, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(37, 'pi_3OME9tIfuNxYRy4K1boj3WZe', 1695.57, 'Approved', '2023-12-11 13:25:27', 0, 8, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(38, 'pi_3OMEBfIfuNxYRy4K2UP14h4r', 1695.57, 'Approved', '2023-12-11 13:27:11', 0, 9, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(39, 'pi_3OMEDLIfuNxYRy4K1ruUPuM7', 1695.57, 'Approved', '2023-12-11 13:28:39', 0, 10, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(40, 'pi_3OMEFxIfuNxYRy4K0BLDsAgV', 791, 'Approved', '2023-12-11 13:31:22', 0, 11, '2023-12-11 18:47:02', '2023-12-11 18:47:02'),
(45, '6812e06d-9856-11ee-8194-5cbaef1f2c04', 900, NULL, '2023-12-11 13:52:17', 100, 0, '2023-12-11 18:52:17', '2023-12-11 18:52:17'),
(46, '92f3336b-9856-11ee-8194-5cbaef1f2c04', 900, 'Approved', '2023-12-11 13:53:29', 101, 0, '2023-12-11 18:53:29', '2023-12-11 18:53:29'),
(47, 'pi_3OMCdfIfuNxYRy4K0bOPYGwM', 1017, 'Approved', '2023-12-11 11:53:36', 0, 1, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(48, 'pi_3OMCoBIfuNxYRy4K0evVZvxK', 1017, 'Approved', '2023-12-11 11:59:31', 0, 2, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(49, 'pi_3OMD01IfuNxYRy4K1g6WfdYA', 1017, 'Approved', '2023-12-11 12:11:47', 0, 3, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(50, 'pi_3OMD8gIfuNxYRy4K2Ak1QnUN', 1695.57, 'Approved', '2023-12-11 12:19:49', 0, 4, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(51, 'pi_3OMDHGIfuNxYRy4K1RX8EgYI', 1017, 'Approved', '2023-12-11 12:28:41', 0, 5, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(52, 'pi_3OME3LIfuNxYRy4K1z4xS0uX', 2486.57, 'Approved', '2023-12-11 13:18:18', 0, 6, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(53, 'pi_3OME4jIfuNxYRy4K0TN3pYyk', 904, 'Approved', '2023-12-11 13:19:46', 0, 7, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(54, 'pi_3OME9tIfuNxYRy4K1boj3WZe', 1695.57, 'Approved', '2023-12-11 13:25:27', 0, 8, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(55, 'pi_3OMEBfIfuNxYRy4K2UP14h4r', 1695.57, 'Approved', '2023-12-11 13:27:11', 0, 9, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(56, 'pi_3OMEDLIfuNxYRy4K1ruUPuM7', 1695.57, 'Approved', '2023-12-11 13:28:39', 0, 10, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(57, 'pi_3OMEFxIfuNxYRy4K0BLDsAgV', 791, 'Approved', '2023-12-11 13:31:22', 0, 11, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(58, 'pi_3OMEbMIfuNxYRy4K2JF8dFDj', 1017, 'Approved', '2023-12-11 13:53:32', 0, 12, '2023-12-11 18:53:32', '2023-12-11 18:53:32'),
(62, '066844d7-9857-11ee-8194-5cbaef1f2c04', 900, NULL, '2023-12-11 13:56:43', 102, 0, '2023-12-11 18:56:43', '2023-12-11 18:56:43'),
(63, '44fbd28b-9857-11ee-8194-5cbaef1f2c04', 900, 'Approved', '2023-12-11 13:58:28', 103, 0, '2023-12-11 18:58:28', '2023-12-11 18:58:28'),
(64, 'a3930de9-9857-11ee-8194-5cbaef1f2c04', 700, NULL, '2023-12-11 14:01:06', 104, 0, '2023-12-11 19:01:06', '2023-12-11 19:01:06'),
(65, 'd3ac14e9-9857-11ee-8194-5cbaef1f2c04', 700, NULL, '2023-12-11 14:02:27', 105, 0, '2023-12-11 19:02:27', '2023-12-11 19:02:27'),
(66, '6df28342-9858-11ee-8194-5cbaef1f2c04', 700, NULL, '2023-12-11 14:06:46', 106, 0, '2023-12-11 19:06:46', '2023-12-11 19:06:46'),
(67, '981d04d6-9858-11ee-8194-5cbaef1f2c04', 700, NULL, '2023-12-11 14:07:57', 107, 0, '2023-12-11 19:07:57', '2023-12-11 19:07:57'),
(68, 'c4957143-9858-11ee-8194-5cbaef1f2c04', 700, NULL, '2023-12-11 14:09:11', 108, 0, '2023-12-11 19:09:11', '2023-12-11 19:09:11'),
(69, 'e69fb842-9858-11ee-8194-5cbaef1f2c04', 700, 'Approved', '2023-12-11 14:10:08', 109, 0, '2023-12-11 19:10:08', '2023-12-11 19:10:08'),
(70, 'pi_3OMCdfIfuNxYRy4K0bOPYGwM', 1017, 'Approved', '2023-12-11 11:53:36', 0, 1, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(71, 'pi_3OMCoBIfuNxYRy4K0evVZvxK', 1017, 'Approved', '2023-12-11 11:59:31', 0, 2, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(72, 'pi_3OMD01IfuNxYRy4K1g6WfdYA', 1017, 'Approved', '2023-12-11 12:11:47', 0, 3, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(73, 'pi_3OMD8gIfuNxYRy4K2Ak1QnUN', 1695.57, 'Approved', '2023-12-11 12:19:49', 0, 4, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(74, 'pi_3OMDHGIfuNxYRy4K1RX8EgYI', 1017, 'Approved', '2023-12-11 12:28:41', 0, 5, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(75, 'pi_3OME3LIfuNxYRy4K1z4xS0uX', 2486.57, 'Approved', '2023-12-11 13:18:18', 0, 6, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(76, 'pi_3OME4jIfuNxYRy4K0TN3pYyk', 904, 'Approved', '2023-12-11 13:19:46', 0, 7, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(77, 'pi_3OME9tIfuNxYRy4K1boj3WZe', 1695.57, 'Approved', '2023-12-11 13:25:27', 0, 8, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(78, 'pi_3OMEBfIfuNxYRy4K2UP14h4r', 1695.57, 'Approved', '2023-12-11 13:27:11', 0, 9, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(79, 'pi_3OMEDLIfuNxYRy4K1ruUPuM7', 1695.57, 'Approved', '2023-12-11 13:28:39', 0, 10, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(80, 'pi_3OMEFxIfuNxYRy4K0BLDsAgV', 791, 'Approved', '2023-12-11 13:31:22', 0, 11, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(81, 'pi_3OMEbMIfuNxYRy4K2JF8dFDj', 1017, 'Approved', '2023-12-11 13:53:32', 0, 12, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(82, 'pi_3OMEgCIfuNxYRy4K2TjdWLiK', 1017, 'Approved', '2023-12-11 13:58:30', 0, 13, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(83, 'pi_3OMErVIfuNxYRy4K2pUWP0U3', 791, 'Approved', '2023-12-11 14:10:15', 0, 14, '2023-12-11 19:11:28', '2023-12-11 19:11:28'),
(85, 'cdd45ce2-9859-11ee-8194-5cbaef1f2c04', 900, 'Approved', '2023-12-11 14:16:36', 110, 0, '2023-12-11 19:16:36', '2023-12-11 19:16:36'),
(86, 'pi_3OMCdfIfuNxYRy4K0bOPYGwM', 1017, 'Approved', '2023-12-11 11:53:36', 0, 1, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(87, 'pi_3OMCoBIfuNxYRy4K0evVZvxK', 1017, 'Approved', '2023-12-11 11:59:31', 0, 2, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(88, 'pi_3OMD01IfuNxYRy4K1g6WfdYA', 1017, 'Approved', '2023-12-11 12:11:47', 0, 3, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(89, 'pi_3OMD8gIfuNxYRy4K2Ak1QnUN', 1695.57, 'Approved', '2023-12-11 12:19:49', 0, 4, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(90, 'pi_3OMDHGIfuNxYRy4K1RX8EgYI', 1017, 'Approved', '2023-12-11 12:28:41', 0, 5, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(91, 'pi_3OME3LIfuNxYRy4K1z4xS0uX', 2486.57, 'Approved', '2023-12-11 13:18:18', 0, 6, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(92, 'pi_3OME4jIfuNxYRy4K0TN3pYyk', 904, 'Approved', '2023-12-11 13:19:46', 0, 7, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(93, 'pi_3OME9tIfuNxYRy4K1boj3WZe', 1695.57, 'Approved', '2023-12-11 13:25:27', 0, 8, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(94, 'pi_3OMEBfIfuNxYRy4K2UP14h4r', 1695.57, 'Approved', '2023-12-11 13:27:11', 0, 9, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(95, 'pi_3OMEDLIfuNxYRy4K1ruUPuM7', 1695.57, 'Approved', '2023-12-11 13:28:39', 0, 10, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(96, 'pi_3OMEFxIfuNxYRy4K0BLDsAgV', 791, 'Approved', '2023-12-11 13:31:22', 0, 11, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(97, 'pi_3OMEbMIfuNxYRy4K2JF8dFDj', 1017, 'Approved', '2023-12-11 13:53:32', 0, 12, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(98, 'pi_3OMEgCIfuNxYRy4K2TjdWLiK', 1017, 'Approved', '2023-12-11 13:58:30', 0, 13, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(99, 'pi_3OMErVIfuNxYRy4K2pUWP0U3', 791, 'Approved', '2023-12-11 14:10:15', 0, 14, '2023-12-11 19:16:39', '2023-12-11 19:16:39'),
(100, 'pi_3OMExiIfuNxYRy4K1Iom1ZkU', 1017, 'Approved', '2023-12-11 14:16:39', 0, 15, '2023-12-11 19:16:39', '2023-12-11 19:16:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_tax`
--

CREATE TABLE `order_tax` (
  `id` int(11) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `tax_amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_tax`
--

INSERT INTO `order_tax` (`id`, `order_id`, `tax_amount`, `created_at`, `updated_at`) VALUES
(1, 85, 117, '2023-12-11 19:16:36', '2023-12-11 19:16:36');

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
(1, 'Microsoft Surface Laptop Go 3 12.45\" Touchscreen Laptop - Platinum (Intel i5-1235U/256GB SSD/8GB RAM)', 'Complete all your daily tasks and consume media with ease on the Microsoft Surface Laptop Go 3. Its lightweight build, 12th generation Intel processor, and 12.4-inch touchscreen display make it the perfect laptop to take with you for productivity on the go. One Touch sign in, Fast Charging, and Miracast capability are added features that make everyday use much more convenient.', 'laptop1.jpg', 1500.50, 20, 1, '2023-10-11 23:28:29', '2023-10-11 23:28:29', 1),
(2, 'HP ENVY 17\" Touchscreen Laptop - Mineral Silver (Intel Core i7-1355U/1TB SSD/16GB RAM/GeForce RTX 3050/Win11)', 'Equipped with advanced features, the HP Envy 17\" touchscreen laptop is a worthy choice for content creators. Powered by a 10-core Intel processor and NVIDIA RTX graphics, it is ideal for multitasking, 4K media editing, and other intense workloads. This laptop also offers a 17\" FHD multitouch display to get better control in sketching, painting, and other graphic design operations.', 'laptop1.jpg', 1600.00, 20, 1, '2023-10-11 23:28:29', '2023-10-11 23:28:29', 1),
(3, 'Apple MacBook Air 13.6\" w/ Touch ID (2022) -Midnight (Apple M2 Chip/256GB SSD/8GB RAM) -Eng', 'Apple?s thinnest and lightest notebook gets supercharged with the Apple M2 chip. The M2 chip starts the next generation of Apple silicon, with even more of the speed and power efficiency of M1. So you can get more done faster with a more powerful 8?core CPU. Create captivating images and animations with up to a 8-core GPU and work with more streams of 4K and 8K ProRes video.', 'laptop3.jpg', 1900.00, 25, 1, '2023-10-11 23:28:29', '2023-10-11 23:28:29', 1),
(4, 'Samsung Galaxy S23 Ultra 256GB - Green', 'The next step is epic with the Samsung Galaxy S23 Ultra. With a 200MP camera and an impressive Night Mode powered by Nightography, capture life\'s most important moments ? no matter the lighting. Switch between gaming,\r\n        streaming, and creating through its incredibly large adaptive display,\r\n        together with fast processing and powerful battery life.', 'mobile1.jpg', 900.00, 30, 1, '2023-10-11 23:28:29', '2023-10-11 23:28:29', 2),
(5, 'Samsung Galaxy Z Flip4 5G 512GB - Pink Gold', 'Small but powerful the Galaxy Z Flip4 fits everything you need in one compact-sized smartphone. It features an ultra thin foldable full screen display that allows you to do more in one screen. Catch up with friends on the top screen while find a post-worthy selfie on the bottom. Plus,\r\n        it boasts the Flexcam feature that lets you take selfies hands-free so you\'re sure everybody\'s in the frame.', 'mobile2.jpg', 800.00, 45, 1, '2023-10-11 23:28:29', '2023-10-11 23:28:29', 2),
(6, 'Mobile Apple iPhone 14 Pro Max 128GB - Deep Purple', 'Experience iPhone in a whole new way with the iPhone 14 Pro Max. Enjoy peace of mind with groundbreaking emergency features that keep you safe and capture incredible detail in images and videos with the 48MP main camera. The Always-On display and Dynamic Island features help you interact with your phone more intuitively than before.', 'mobile3.jpg', 700.00, 23, 1, '2023-10-11 23:28:29', '2023-10-11 23:28:29', 2),
(7, 'LG NanoCell 65\" 4K UHD HDR LED webOS Smart TV (65NANO75UQA) - 2022 - Ashed Blue', 'Enjoy your favourite dramas, movies, and games in breathtaking quality with the LG NanoCell 65\" 4K smart TV. Powered by the a7 Gen 5 AI Processor 4K, the 65\" LED panel with Billion Rich Colours keeps you fascinated with vivid images and vibrant hues. The TruMotion 120 (native 60Hz) refresh rate ensures a smooth and uninterrupted viewing experience.', 'tv1.jpg', 600.00, 30, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 3),
(8, 'Sony X80K 75\" 4K UHD HDR LED Smart Google TV (KD75X80K) - 2022', 'Bring big screen entertainment to your home with this Sony 75\" 4K UHD HDR LED smart Google TV. With impressive sound and picture processing capabilities, this TV delivers 4K HDR content and lets you access movies, videos, shows and apps with Google TV in exceptional clarity and detail. Preloaded with YouTube, Netflix and Amazon Prime video, this TV offers instant and endless entertainment.', 'tv2.jpg', 400.00, 25, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 3),
(9, 'Samsung 43\" 4K UHD HDR LED Tizen Smart TV (UN43TU690TFXZC) - 2022', 'Improve your living room viewing experience with the Samsung 43\" smart TV. This television uses the Crystal Processor 4K system and other features to deliver the sharpest 4K Ultra HD picture, with MR120 motion enhancement for blur-free details. Connect to voice assistants to enable easy access to your favourite content.', 'tv3.jpg', 500.00, 20, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 3),
(10, 'JBL Tune 510BT Wireless On-Ear Bluetooth Headphones - Black', 'The Tune 510BT wireless headphones feature renowned JBL Pure Bass sound, which can be found in the most famous venues all around the world.\nWith Wireless Bluetooth 5.0 Streaming, you can stream wirelessly from your device and even switch between two devices so that you don?t miss a call.\nFor long-lasting fun, listen wirelessly for up to 40 hours and recharge the battery in as little as 2 hours with the convenient Type-C USB cable. A quick 5-minute recharge gives you 2 additional hours of music.\nEasily control your sound and manage your calls from your headphones with the convenient buttons on the ear-cup.\nSiri or Hey Google is just a button away: activate the voice assistant of your device by pushing the multi-function button.', 'headphone1.jpg', 800.00, 24, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 4),
(11, 'Skullcandy Hesh Evo Over-Ear Wireless Headphones, 36 Hr Battery, Microphone, Works with iPhone Android and Bluetooth Devices - Black', 'Supreme Audio - With powerful 40mm drivers and exceptional acoustics your favorite tunes will be crystal clear. For the affordable price of the Hesh Evo it reigns over the competition and provides the best sound quality in class.\n36 hours battery - Whether you\'re on the road and can\'t charge or you\'re on a 36 hour gaming session the Hesh Evo will have your back. Plus,\r\n         use rapid charge and a quick 10 minute charge will give you 3 hours of listening.\nSick Fit - Ames writes \'cushiony and plush. Has nice squish at the top of the headpiece and there\'s a lot of cushioning where it goes over your ears\' We couldn\'t have said it better! Don\'t forget the soft headband and noise isolating design.\nNever lost with Tile - With Tile tech, Skullcandy makes it super easy to track down either headphones and keep your gadgets safe! Download the Tile app and follow the instructions to activate.\nBuy with Confidence - 1 year CA warranty included.', 'headphone2.jpg', 460.00, 0, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 4),
(12, 'Sony WH-1000XM5 Wireless Industry Leading Noise Cancelling Headphones with Auto Noise Cancelling Optimizer, Crystal Clear Hands-Free Calling, and Alexa Voice Control, Silver', 'Industry Leading noise cancellation-two processors control 8 microphones for unprecedented noise cancellation. With Auto NC Optimizer, noise canceling is automatically optimized based on your wearing conditions and environment.\nMagnificent Sound, engineered to perfection with the new Integrated Processor V1. Supported Audio Format(s): SBC, AAC, LDAC. AMBIENT SOUND MODE: Yes\nCrystal clear hands-free calling with 4 beamforming microphones, precise voice pickup, and advanced audio signal processing.\nUp to 30-hour battery life with quick charging (3 min charge for 3 hours of playback)\nUltra-comfortable, lightweight design with soft fit leather', 'headphone3.jpg', 700.00, 0, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 4),
(13, 'HP DeskJet 2742e All-in-One Printer', 'simple setup. Simple printing. Get started fast with simple setup that guides you through each step, using HP Smart app.\nGet quick and easy printing directly at the control panel.\nThis printer is made from recycled printers and other electronics?more than 20% by weight of plastic.\net better range and faster, more reliable connections using dual-band Wi-Fi with selfreset.\nGet connected with Bluetooth and start printing fast from your smartphone or tablet ? easy setup', 'printer1.jpg', 560.00, 0, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 5),
(14, 'HP OfficeJet 8015e All-in-One Wireless Color Printer for Home Office, with Bonus 6 Months Free Instant Ink with HP+, Works with Alexa (228F5A) Grey', 'BEST FOR SMALL BUSINESSES AND HOME OFFICES ? Print professional-quality color documents like forms, reports, brochures and presentations\nKEY FEATURES ? Fast color print, copy, scan and fax, plus 2-sided printing, mobile and wireless printing, and an auto document feeder\nFREE INSTANT INK + DOUBLE THE WARRANTY WITH HP+ ? Activate HP+ to get 6 free months of ink via Instant Ink and an extra year of HP warranty coverage\n6 MONTHS OF FREE INK ? Print up to 700 pages a month free when you enroll in Instant Ink. Ink is delivered automatically before you run out at no extra cost. Credit card required; change or cancel anytime.\nThis printer is intended to work only with cartridges with original HP chips or circuitry and will block cartridges using non-HP chips or circuitry. Periodic firmware updates will maintain the effectiveness of these measures.', 'printer2.jpg', 750.00, 0, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 5),
(15, 'Epson EcoTank ET-2800 Wireless Color All-in-One Cartridge-Free Supertank Printer with Scan and Copy ? The Ideal Basic Home Printer - White', 'Innovative Cartridge-Free Printing ? High-capacity ink tanks mean no more tiny, expensive ink cartridges; Epson?s exclusive EcoFit ink bottles make filling easy and worry-free\nDramatic Savings on Replacement Ink ? Save up to 90% with replacement ink bottles vs. ink cartridges (1) ? that?s enough to print up to 4,500 pages black/7,500 color (2), equivalent to about 90 individual ink cartridges (3)\nStress-Free Printing ? Up to 2 years of ink in the box (4) ? and with every replacement ink set ? for fewer out of ink frustrations\nZero Cartridge Waste ? By using an EcoTank printer, you can help reduce the amount of cartridge waste ending up in landfills\nImpressive Print Quality ? Unique Micro Piezo Heat-Free Technology produces sharp text ? plus impressive color photos and graphics ? on virtually any paper type', 'printer3.jpg', 500.00, 0, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 5),
(16, 'Samsung Galaxy Watch5 44mm BT Graphite, Heart Monitor, Workout Tracking, Advanced Sleep Coaching, Body Composition Analyzer', 'This pre-owned product has been professionally inspected, tested and cleaned by Amazon-qualified suppliers.\n- This product is in \"Excellent condition\". No signs of cosmetic damage when held 30 centimetres away.\n- Products with batteries will exceed 80% capacity relative to new.\n- Accessories may not be original but will be compatible and fully functional. Product may come in generic box.\n- This product comes with a 90-day supplier-backed warranty.', 'sw1.jpg', 600.00, 0, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 6),
(17, 'Samsung Galaxy Gear Smartwatch - Jet Black', 'Compatible with Galaxy Note 3 and other Galaxy smartphones\n1.63 inch Super AMOLED screen and 1.9 Megapixel camera\nPlace calls and answer them directly from your Galaxy Gear\nEnjoy the S Voice personal assistant right on your wrist\nIncludes Samsung Galaxy Gear, wall charger, charging cradle, quick start guide', 'sw2.jpg', 600.00, 45, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 6),
(18, 'Apple Watch Series 9 [GPS 41mm] Smartwatch with Midnight Aluminium Case with Midnight Sport Band. Fitness Tracker, Blood Oxygen & ECG Apps, Water-Resistant - S/M', 'CARBON NEUTRAL ? An aluminum Apple Watch Series 9 paired with the latest Sport Loop is carbon-neutral. Learn more about Apple?s commitment to the environment at apple.com/ca/2030.\nWHY APPLE WATCH SERIES 9 ? Your essential companion for a healthy life is now even more powerful. The S9 chip enables a superbright display and a magical new way to quickly and easily interact with your Apple Watch without touching the screen. Advanced health, safety and activity features provide powerful insights and help when you need it. And redesigned apps in watchOS give you more information at a glance.\nADVANCED HEALTH FEATURES ? Keep an eye on your blood oxygen. Take an ECG anytime. Get notifications if you have an irregular heart rhythm. See how much time you spent in REM, Core or Deep sleep with sleep stages. Temperature sensing provides insights into overall wellbeing and cycle tracking. And take note of your state of mind to help build emotional awareness and resilience.\nA POWERFUL FITNESS PARTNER ? The Workout app gives you a range of ways to train plus advanced metrics for more insights about your workout performance. And Apple Watch comes with three months of Apple Fitness+ free.\nINNOVATIVE SAFETY FEATURES ? Fall Detection and Crash Detection can connect you with emergency services in the event of a hard fall or a severe car crash. And Emergency SOS lets you call for help with the press of a button.\nSIMPLY COMPATIBLE ? It works seamlessly with your Apple devices and services. Unlock your Mac automatically. Get approximate distance and directions to your iPhone with Precision Finding on supported iPhone models. Pay and send money with Apple Pay. Apple Watch requires iPhone XS or later with the latest iOS version.\nEASILY CUSTOMIZABLE ? With watch bands in a range of styles, materials and colours, and fully customizable watch faces, you can change your watch to fit your mood or the moment.', 'sw3.jpg', 700.00, 22, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 6),
(19, 'Echo (4th Gen) | With premium sound, smart home hub, and Alexa | Glacier White', 'New look, new sound ? Echo delivers clear highs, dynamic mids, and deep bass for rich, detailed sound that automatically adapts to any room.\nVoice control your entertainment ? Stream songs from Amazon Music, Apple Music, SiriusXM, Spotify, Deezer, and more. Plus listen to radio stations, podcasts, and Audible audiobooks.\nReady to help ? Ask Alexa to play music, answer questions, play the news, check the weather, set alarms, control compatible smart home devices, and more.\nSmart home made simple ? With the built-in hub, easily set up compatible Zigbee devices to voice control lights, locks, and sensors.\nFill your home with sound ? With multi-room music, play synchronized music across Echo devices in different rooms. You can also pair your Echo with compatible Fire TV devices to feel scenes come to life with home theater audio, or extend wifi coverage with a compatible eero network so you can say goodbye to drop-offs and buffering.\nConnect with others ? Call almost anyone hands-free. Instantly drop in on other rooms or announce to the whole house that dinner\'s ready.\nDesigned to protect your privacy ? Built with multiple layers of privacy protections and controls,\r\n         including a microphone off button that electronically disconnects the microphones.', 's1.jpg', 300.00, 21, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 7),
(20, 'JBL PartyBox 110 Portable Party Speaker with 160W Powerful Sound, Built - in Lights,\r\n         Up to 12 Hours of Playtime and IPX4 Splashproof Design - Black', 'POWERFUL JBL ORIGINAL PRO SOUND: Whether you?re at home or outdoors,\r\n         the JBL PartyBox 110 makes your music amazing with two levels of deep,\r\n         adjustable bass and powerful JBL Original Pro Sound.\nDYNAMIC LIGHT SHOW THAT SYNCS TO THE BEAT: Colors synched to the beat make you want to move your feet,\r\n         while customizable strobes and patterns dazzle your eyes. It?s a unique,\r\n         immersive audiovisual experience that transforms any party into a work of art.\n12 HOURS OF PLAYTIME: Power the party all day or all night. With 12 hours of playtime and a built-in rechargeable battery,\r\n         the beat will go on (and on)!\nIPX4 SPLASHPROOF: Whether your guests are dancing on the beach or sipping drinks by the pool,\r\n         the JBL PartyBox 110 is IPX4 splashproof so you never have to worry about the party getting too wet and wild.\nMIC AND GUITAR INPUTS: With mic and guitar inputs,\r\n         you can show your talents as you sing and play along. Not only will you sound great but you?ll look great,\r\n         too, with the perfect light show for rocking out ! ', ' s2 . jpg ', 200.00, 15, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 7),
(21, ' Bluetooth Speaker, MusiBaby Speaker, Outdoor, Portable, Waterproof, Speakers Bluetooth Wireless, Dual Pairing,\r\n         Bluetooth 5.0, Loud Stereo, Booming Bass,\r\n         1500 Mins Playtime for Home&Party Speaker Gifts(Black)', 'speaker small, Size only 4.9 * 2.9 in,\r\n         designed as speakers bluetooth wireless. With 1500 minutes playtime,\r\n         long enough for any outdoor activities. Special designed as portable speaker.It\'s Ideal gifts for men or women, also affordable gifts for her or him.  Stereo sound with full bass---the speaker delivers immersive sound with rich bass, mids and highs,dynamic sound.Even at maximum volume, in the same way as the live concert performance. You will like MusiBaby?s true 360?Stereo Sound portable speaker.It\'s Ideal gifts for women or men.', 's3.jpg', 900.00, 20, 1, '2023-10-11 23:30:39', '2023-10-11 23:30:39', 7),
(35, 'ttpot', 'here is the description for ttpot isnt it ', '', 99.90, 7, 0, '2023-11-13 18:48:00', '2023-11-13 18:48:00', 7);

-- --------------------------------------------------------

--
-- Table structure for table `stripe_payment`
--

CREATE TABLE `stripe_payment` (
  `id` int(11) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `item_description` varchar(250) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `transaction_id` varchar(50) NOT NULL,
  `payment_status` varchar(25) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stripe_payment`
--

INSERT INTO `stripe_payment` (`id`, `fullname`, `email`, `item_description`, `currency`, `amount`, `transaction_id`, `payment_status`, `created_at`) VALUES
(1, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1017.00, 'pi_3OMCdfIfuNxYRy4K0bOPYGwM', 'succeeded', '2023-12-11 11:53:36'),
(2, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1017.00, 'pi_3OMCoBIfuNxYRy4K0evVZvxK', 'succeeded', '2023-12-11 11:59:31'),
(3, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1017.00, 'pi_3OMD01IfuNxYRy4K1g6WfdYA', 'succeeded', '2023-12-11 12:11:47'),
(4, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1695.57, 'pi_3OMD8gIfuNxYRy4K2Ak1QnUN', 'succeeded', '2023-12-11 12:19:49'),
(5, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1017.00, 'pi_3OMDHGIfuNxYRy4K1RX8EgYI', 'succeeded', '2023-12-11 12:28:41'),
(6, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 2486.57, 'pi_3OME3LIfuNxYRy4K1z4xS0uX', 'succeeded', '2023-12-11 13:18:18'),
(7, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 904.00, 'pi_3OME4jIfuNxYRy4K0TN3pYyk', 'succeeded', '2023-12-11 13:19:46'),
(8, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1695.57, 'pi_3OME9tIfuNxYRy4K1boj3WZe', 'succeeded', '2023-12-11 13:25:27'),
(9, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1695.57, 'pi_3OMEBfIfuNxYRy4K2UP14h4r', 'succeeded', '2023-12-11 13:27:11'),
(10, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1695.57, 'pi_3OMEDLIfuNxYRy4K1ruUPuM7', 'succeeded', '2023-12-11 13:28:39'),
(11, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 791.00, 'pi_3OMEFxIfuNxYRy4K0BLDsAgV', 'succeeded', '2023-12-11 13:31:22'),
(12, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1017.00, 'pi_3OMEbMIfuNxYRy4K2JF8dFDj', 'succeeded', '2023-12-11 13:53:32'),
(13, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1017.00, 'pi_3OMEgCIfuNxYRy4K2TjdWLiK', 'succeeded', '2023-12-11 13:58:30'),
(14, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 791.00, 'pi_3OMErVIfuNxYRy4K2pUWP0U3', 'succeeded', '2023-12-11 14:10:15'),
(15, 'JAY PATEL', 'jpatel@conestoga.on', 'All Items Successfully Ordered', 'cad', 1017.00, 'pi_3OMExiIfuNxYRy4K1Iom1ZkU', 'succeeded', '2023-12-11 14:16:39');

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
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_order_items_order` (`order_id`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `order_tax`
--
ALTER TABLE `order_tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stripe_payment`
--
ALTER TABLE `stripe_payment`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `order_tax`
--
ALTER TABLE `order_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `stripe_payment`
--
ALTER TABLE `stripe_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_order_items_order` FOREIGN KEY (`order_id`) REFERENCES `order_table` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
