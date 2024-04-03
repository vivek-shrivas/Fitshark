-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 05:43 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fitstart`
--

-- --------------------------------------------------------

--
-- Table structure for table `bag`
--

CREATE TABLE `bag` (
  `bag_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bag`
--

INSERT INTO `bag` (`bag_id`, `c_id`, `product_id`, `size_id`, `quantity`, `created_at`) VALUES
(55, 6, 21, 1, 1, '2023-10-14 06:11:27'),
(64, 2, 24, 1, 2, '2023-10-21 06:03:55'),
(65, 2, 122, 2, 1, '2023-10-21 06:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) DEFAULT NULL,
  `category_description` varchar(200) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `is_deleted`, `image`) VALUES
(10, 'WOMENS', '', 0, 'shop-women.jpg'),
(11, 'MENS', NULL, 0, 'shop-men.jpg\r\n'),
(12, 'ACCESSORIES', NULL, 0, 'shop-accessories.jpg'),
(13, 'M-short', NULL, 0, ''),
(14, 'M-tshirts & tops', NULL, 0, ''),
(15, 'sweatshirts', NULL, 0, ''),
(16, 'mens Joggers', NULL, 0, ''),
(17, 'MENS Hoodies', NULL, 0, ''),
(18, 'Mens tanks', NULL, 0, ''),
(19, 'Men stingers', NULL, 0, ''),
(20, 'slides', NULL, 0, ''),
(21, 'mens Sweatsuits', NULL, 0, ''),
(22, 'mens underwear', NULL, 0, ''),
(23, 'mens baselayers', NULL, 0, ''),
(24, 'men power', NULL, 0, ''),
(25, 'men crest', NULL, 0, ''),
(26, 'men apex', NULL, 0, ''),
(27, 'LEGACY', NULL, 0, ''),
(28, 'men sport', NULL, 0, ''),
(29, 'men breifs', NULL, 0, ''),
(30, 'men boxers', NULL, 0, ''),
(31, 'men vest', NULL, 0, ''),
(42, 'women matching sets', NULL, 0, ''),
(43, 'womens black leggings', NULL, 0, ''),
(46, 'womens fall essentials', NULL, 0, ''),
(48, 'womens oversized', NULL, 0, ''),
(49, 'womens tank tops', NULL, 0, ''),
(50, 'womens sports bra', NULL, 0, ''),
(51, 'womens sports accessories', NULL, 0, ''),
(53, 'Lifting Accessories', NULL, 0, ''),
(54, 'Bottel', NULL, 0, ''),
(55, 'Bags', NULL, 0, ''),
(56, 'Socks', NULL, 0, ''),
(57, 'cap', NULL, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(50) DEFAULT NULL,
  `c_email` varchar(100) DEFAULT NULL,
  `c_phone_no` varchar(15) DEFAULT NULL,
  `c_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `c_email`, `c_phone_no`, `c_password`) VALUES
(2, 'VIVEK SHRIVAS', 'VIVEKSHRIVAS347@GMAIL.COM', '6261582722', '1234'),
(3, 'sarang', 'sarang@gmail.com', '6261582722', '1234'),
(6, 'pushkar', 'pushkar@gmail.com', '6261582722', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `c_address`
--

CREATE TABLE `c_address` (
  `address_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `address_line1` varchar(255) NOT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_address`
--

INSERT INTO `c_address` (`address_id`, `c_id`, `address_line1`, `address_line2`, `city`, `state`, `postal_code`, `created_at`, `updated_at`) VALUES
(43, 2, 'NAUGAI , VIA SECL', 'NEAR COSMOS BANK', 'Bilaspur', 'CHHATTISGARH', '495006', '2023-10-13 18:14:10', '2023-10-13 18:14:10'),
(44, 6, 'Near magneto mall Bharat chowk road', 'Beside big boss saloon', 'Bilaspur', 'Chhattisgarh', '495001', '2023-10-14 06:07:41', '2023-10-14 06:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_percent` decimal(5,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `product_id`, `discount_percent`, `created_at`, `updated_at`) VALUES
(5, 9, 10.00, '2023-09-29 21:23:29', '2023-09-30 04:24:21'),
(6, 10, 50.00, '2023-09-29 21:25:15', '2023-09-29 21:25:15'),
(7, 11, 45.00, '2023-09-29 21:26:18', '2023-10-14 05:21:26'),
(8, 12, 60.00, '2023-09-29 21:27:26', '2023-09-29 21:27:26'),
(9, 13, 40.00, '2023-09-29 21:28:33', '2023-09-29 21:28:33'),
(10, 14, 30.00, '2023-09-29 21:29:50', '2023-10-14 05:21:13'),
(11, 15, 13.00, '2023-09-29 21:39:21', '2023-09-29 21:39:21'),
(12, 16, 15.00, '2023-09-29 21:40:25', '2023-09-29 21:40:25'),
(13, 17, 14.00, '2023-09-29 21:41:33', '2023-09-29 21:41:33'),
(14, 18, 17.00, '2023-09-29 21:42:33', '2023-09-29 21:42:33'),
(15, 19, 18.00, '2023-09-29 21:44:24', '2023-09-29 21:44:24'),
(16, 20, 9.00, '2023-09-29 21:45:38', '2023-10-14 05:20:48'),
(17, 21, 15.00, '2023-09-29 21:53:04', '2023-10-14 05:20:58'),
(18, 22, 17.00, '2023-09-29 21:57:45', '2023-09-29 21:57:45'),
(19, 23, 14.00, '2023-09-29 21:58:52', '2023-09-29 21:58:52'),
(20, 24, 13.00, '2023-09-29 22:00:10', '2023-09-29 22:00:10'),
(21, 25, 10.00, '2023-09-29 22:02:10', '2023-09-29 22:02:10'),
(22, 26, 20.00, '2023-09-29 22:03:37', '2023-10-14 05:20:22'),
(23, 27, 15.00, '2023-09-29 22:06:55', '2023-09-29 22:06:55'),
(24, 28, 60.00, '2023-09-29 22:07:41', '2023-09-29 22:07:41'),
(25, 29, 35.00, '2023-09-29 22:08:50', '2023-10-14 05:20:38'),
(26, 30, 66.00, '2023-09-29 22:10:27', '2023-09-29 22:10:27'),
(27, 31, 66.00, '2023-09-29 22:11:31', '2023-09-29 22:11:31'),
(28, 32, 56.00, '2023-09-29 22:12:49', '2023-09-29 22:12:49'),
(29, 33, 44.00, '2023-09-29 22:15:50', '2023-09-29 22:15:50'),
(30, 34, 66.00, '2023-09-29 22:18:24', '2023-09-29 22:18:24'),
(31, 35, 76.00, '2023-09-29 22:19:26', '2023-09-29 22:19:26'),
(32, 36, 20.00, '2023-09-29 22:20:29', '2023-10-14 05:21:53'),
(33, 37, 8.00, '2023-09-29 22:21:24', '2023-09-29 22:21:24'),
(34, 38, 66.00, '2023-09-29 22:22:39', '2023-09-29 22:22:39'),
(35, 39, 66.00, '2023-09-29 22:26:04', '2023-09-29 22:26:04'),
(36, 40, 67.00, '2023-09-29 22:26:42', '2023-09-29 22:26:42'),
(37, 41, 56.00, '2023-09-29 22:27:31', '2023-09-29 22:27:31'),
(38, 42, 56.00, '2023-09-29 22:28:21', '2023-09-29 22:28:21'),
(39, 43, 55.00, '2023-09-29 22:29:08', '2023-09-29 22:29:08'),
(40, 44, 56.00, '2023-09-29 22:30:18', '2023-09-29 22:30:18'),
(41, 45, 55.00, '2023-09-29 22:37:06', '2023-09-29 22:37:06'),
(42, 46, 55.00, '2023-09-29 22:39:19', '2023-09-29 22:39:19'),
(43, 47, 77.00, '2023-09-29 22:40:09', '2023-09-29 22:40:09'),
(44, 48, 77.00, '2023-09-29 22:41:12', '2023-09-29 22:41:12'),
(45, 49, 66.00, '2023-09-29 22:41:59', '2023-09-29 22:41:59'),
(46, 50, 77.00, '2023-09-29 22:42:48', '2023-09-29 22:42:48'),
(47, 51, 12.00, '2023-09-30 05:07:21', '2023-09-30 05:07:21'),
(48, 52, 5.00, '2023-09-30 05:09:06', '2023-09-30 05:09:06'),
(49, 53, 12.00, '2023-09-30 05:10:08', '2023-09-30 05:10:08'),
(50, 54, 15.00, '2023-09-30 05:11:19', '2023-09-30 05:11:19'),
(51, 55, 12.00, '2023-09-30 05:12:18', '2023-09-30 05:12:18'),
(52, 56, 11.00, '2023-10-12 17:26:53', '2023-10-12 17:26:53'),
(53, 57, 22.00, '2023-10-12 17:29:10', '2023-10-12 17:29:10'),
(54, 58, 4.00, '2023-10-12 17:30:11', '2023-10-12 17:30:11'),
(55, 59, 30.00, '2023-10-12 17:31:31', '2023-10-12 17:31:31'),
(56, 60, 32.00, '2023-10-12 17:32:37', '2023-10-12 17:32:37'),
(57, 61, 20.00, '2023-10-12 17:34:09', '2023-10-12 17:34:09'),
(58, 62, 9.00, '2023-10-12 17:36:26', '2023-10-12 17:36:26'),
(59, 63, 12.00, '2023-10-12 17:37:14', '2023-10-12 17:37:14'),
(60, 64, 5.00, '2023-10-12 17:38:57', '2023-10-12 17:38:57'),
(61, 65, 45.00, '2023-10-12 17:39:49', '2023-10-12 17:39:49'),
(62, 66, 9.00, '2023-10-12 17:40:38', '2023-10-12 17:40:38'),
(63, 67, 7.00, '2023-10-12 17:41:18', '2023-10-12 17:41:18'),
(64, 68, 25.00, '2023-10-12 17:42:56', '2023-10-12 17:42:56'),
(65, 69, 62.00, '2023-10-12 17:45:41', '2023-10-14 05:22:21'),
(66, 70, 8.00, '2023-10-12 17:46:28', '2023-10-12 17:46:28'),
(67, 71, 31.00, '2023-10-12 17:47:32', '2023-10-12 17:47:32'),
(68, 72, 7.00, '2023-10-12 17:48:24', '2023-10-12 17:48:24'),
(69, 73, 5.00, '2023-10-12 17:49:56', '2023-10-12 17:49:56'),
(70, 74, 56.00, '2023-10-12 17:51:05', '2023-10-12 17:51:05'),
(71, 75, 5.00, '2023-10-12 17:54:35', '2023-10-12 17:54:35'),
(72, 76, 5.00, '2023-10-12 17:55:30', '2023-10-12 17:55:30'),
(73, 77, 2.00, '2023-10-12 17:56:09', '2023-10-12 17:56:09'),
(74, 78, 9.00, '2023-10-12 17:57:30', '2023-10-12 17:57:30'),
(75, 79, 41.00, '2023-10-12 17:58:42', '2023-10-12 17:58:42'),
(76, 80, 9.00, '2023-10-12 17:59:50', '2023-10-12 17:59:50'),
(77, 81, 78.00, '2023-10-12 18:00:32', '2023-10-12 18:00:32'),
(78, 82, 12.00, '2023-10-12 18:03:48', '2023-10-12 18:03:48'),
(79, 83, 32.00, '2023-10-12 18:05:22', '2023-10-12 18:05:22'),
(80, 84, 1.00, '2023-10-12 18:07:17', '2023-10-12 18:07:17'),
(81, 85, 3.00, '2023-10-12 18:10:42', '2023-10-12 18:10:42'),
(82, 86, 6.00, '2023-10-12 18:11:53', '2023-10-12 18:11:53'),
(83, 87, 7.00, '2023-10-12 18:12:42', '2023-10-12 18:12:42'),
(84, 88, 9.00, '2023-10-12 18:13:30', '2023-10-12 18:13:30'),
(85, 89, 11.00, '2023-10-12 18:27:21', '2023-10-12 18:27:21'),
(86, 90, 2.00, '2023-10-12 18:28:06', '2023-10-12 18:28:06'),
(87, 91, 979.00, '2023-10-12 18:29:26', '2023-10-12 18:29:26'),
(88, 92, 5.00, '2023-10-12 18:30:04', '2023-10-12 18:30:04'),
(89, 93, 9.00, '2023-10-12 18:31:05', '2023-10-12 18:31:05'),
(90, 94, 2.00, '2023-10-12 18:31:53', '2023-10-12 18:31:53'),
(91, 95, 2.00, '2023-10-12 18:36:55', '2023-10-12 18:36:55'),
(92, 96, 9.00, '2023-10-12 18:37:35', '2023-10-12 18:37:35'),
(93, 97, 6.00, '2023-10-12 18:38:21', '2023-10-12 18:38:21'),
(94, 98, 6.00, '2023-10-12 18:39:17', '2023-10-12 18:39:17'),
(95, 99, 7.00, '2023-10-12 18:39:52', '2023-10-12 18:39:52'),
(96, 100, 7.00, '2023-10-12 18:40:45', '2023-10-12 18:40:45'),
(97, 101, 9.00, '2023-10-12 18:42:36', '2023-10-12 18:42:36'),
(98, 102, 61.00, '2023-10-12 18:43:32', '2023-10-12 18:43:32'),
(99, 103, 9.00, '2023-10-12 18:44:30', '2023-10-12 18:44:30'),
(100, 104, 29.00, '2023-10-12 18:45:31', '2023-10-12 18:45:31'),
(101, 105, 9.00, '2023-10-12 18:46:24', '2023-10-12 18:46:24'),
(102, 106, 6.00, '2023-10-12 18:47:32', '2023-10-12 18:47:32'),
(103, 107, 4.00, '2023-10-12 18:49:51', '2023-10-12 18:49:51'),
(104, 108, 1.00, '2023-10-12 18:53:50', '2023-10-12 18:53:50'),
(105, 109, 9.00, '2023-10-12 18:54:42', '2023-10-12 18:54:42'),
(106, 110, 3.00, '2023-10-12 18:55:31', '2023-10-12 18:55:31'),
(107, 111, 0.00, '2023-10-12 18:57:37', '2023-10-12 18:57:37'),
(108, 112, 2.00, '2023-10-12 18:58:26', '2023-10-12 18:58:26'),
(109, 113, 0.00, '2023-10-12 18:59:46', '2023-10-12 18:59:46'),
(110, 114, 20.00, '2023-10-12 19:00:34', '2023-10-12 19:00:34'),
(111, 115, 20.00, '2023-10-12 19:03:27', '2023-10-12 19:03:27'),
(112, 116, 21.00, '2023-10-12 19:24:00', '2023-10-12 19:24:00'),
(113, 117, 12.00, '2023-10-12 19:27:24', '2023-10-12 19:32:12'),
(114, 118, 2.00, '2023-10-12 19:37:25', '2023-10-12 19:37:25'),
(115, 119, 3.00, '2023-10-12 19:38:39', '2023-10-12 19:38:39'),
(117, 121, 12.00, '2023-10-12 19:42:41', '2023-10-12 19:42:41'),
(118, 122, 1.00, '2023-10-12 20:08:51', '2023-10-12 20:08:51'),
(119, 123, 4.00, '2023-10-12 20:09:56', '2023-10-12 20:09:56'),
(120, 124, 6.00, '2023-10-12 20:10:52', '2023-10-12 20:10:52'),
(121, 125, 8.00, '2023-10-12 20:12:26', '2023-10-12 20:12:26'),
(122, 126, 31.00, '2023-10-12 20:14:01', '2023-10-12 20:14:01'),
(123, 127, 4.00, '2023-10-12 20:15:45', '2023-10-12 20:15:45'),
(124, 128, 12.00, '2023-10-12 20:16:50', '2023-10-12 20:16:50'),
(125, 129, 63.00, '2023-10-12 20:17:57', '2023-10-12 20:17:57'),
(126, 130, 1.00, '2023-10-12 20:18:51', '2023-10-12 20:18:51'),
(127, 131, 1.00, '2023-10-12 20:19:43', '2023-10-12 20:19:43'),
(128, 132, 20.00, '2023-10-14 07:03:35', '2023-10-14 07:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `c_id`, `order_date`) VALUES
(107, 2, '2023-10-05 13:26:06'),
(108, 2, '2023-10-05 13:33:09'),
(109, 2, '2023-10-05 16:13:20'),
(110, 2, '2023-10-05 17:02:24'),
(111, 2, '2023-10-13 17:14:34'),
(112, 2, '2023-10-13 17:28:51'),
(113, 2, '2023-10-13 18:15:10'),
(114, 2, '2023-10-13 18:15:56'),
(115, 2, '2023-10-13 18:16:25'),
(116, 2, '2023-10-13 19:06:23'),
(117, 2, '2023-10-13 19:07:57'),
(118, 2, '2023-10-13 19:08:24'),
(119, 2, '2023-10-13 19:09:00'),
(120, 2, '2023-10-13 19:09:15'),
(121, 2, '2023-10-14 05:26:02'),
(122, 2, '2023-10-14 05:28:46'),
(123, 2, '2023-10-14 05:29:06'),
(124, 2, '2023-10-14 05:31:44'),
(125, 6, '2023-10-14 06:11:34'),
(126, 6, '2023-10-14 06:12:49'),
(127, 6, '2023-10-14 06:15:11'),
(128, 6, '2023-10-14 06:16:30'),
(129, 6, '2023-10-14 06:17:21'),
(130, 6, '2023-10-14 06:20:30'),
(131, 2, '2023-10-14 06:21:48'),
(132, 2, '2023-10-14 06:26:03'),
(133, 2, '2023-10-14 06:27:35'),
(134, 2, '2023-10-14 06:28:11'),
(135, 2, '2023-10-14 06:35:58'),
(136, 2, '2023-10-14 07:00:32'),
(137, 2, '2023-10-21 06:04:11'),
(138, 2, '2023-10-21 06:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT NULL,
  `mrp` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `size_id`, `order_date`, `status`, `mrp`, `discount`, `total`, `quantity`) VALUES
(160, 107, 9, 1, '2023-10-05 09:56:06', 'PAID', 1200.00, 10.00, 1080.00, 1),
(161, 108, 18, 4, '2023-10-05 10:03:09', 'PAID', 1700.00, 17.00, 1411.00, 1),
(162, 109, 51, 1, '2023-10-05 12:43:20', 'PAID', 1200.00, 12.00, 1056.00, 1),
(163, 109, 18, 4, '2023-10-05 12:43:20', 'PAID', 1700.00, 17.00, 1411.00, 1),
(164, 110, 18, 4, '2023-10-05 13:32:24', 'PAID', 1700.00, 17.00, 1411.00, 1),
(165, 110, 51, 1, '2023-10-05 13:32:24', 'PAID', 1200.00, 12.00, 1056.00, 1),
(166, 111, 18, 4, '2023-10-13 13:44:34', 'PAID', 1700.00, 17.00, 1411.00, 1),
(167, 111, 51, 1, '2023-10-13 13:44:34', 'PAID', 1200.00, 12.00, 1056.00, 1),
(168, 112, 18, 4, '2023-10-13 13:58:51', 'PAID', 1700.00, 17.00, 1411.00, 1),
(169, 112, 51, 1, '2023-10-13 13:58:51', 'PAID', 1200.00, 12.00, 1056.00, 1),
(170, 113, 18, 4, '2023-10-13 14:45:10', 'PAID', 1700.00, 17.00, 1411.00, 1),
(171, 113, 51, 1, '2023-10-13 14:45:10', 'PAID', 1200.00, 12.00, 1056.00, 1),
(172, 113, 126, 1, '2023-10-13 14:45:10', 'PAID', 763.00, 31.00, 526.47, 1),
(173, 114, 18, 4, '2023-10-13 14:45:56', 'PAID', 1700.00, 17.00, 1411.00, 1),
(174, 114, 51, 1, '2023-10-13 14:45:56', 'PAID', 1200.00, 12.00, 1056.00, 1),
(175, 114, 126, 1, '2023-10-13 14:45:56', 'PAID', 763.00, 31.00, 526.47, 1),
(176, 115, 18, 4, '2023-10-13 14:46:25', 'PAID', 1700.00, 17.00, 1411.00, 1),
(177, 115, 51, 1, '2023-10-13 14:46:25', 'PAID', 1200.00, 12.00, 1056.00, 1),
(178, 115, 126, 1, '2023-10-13 14:46:25', 'PAID', 763.00, 31.00, 526.47, 1),
(179, 116, 18, 4, '2023-10-13 15:36:23', 'PAID', 1700.00, 17.00, 1411.00, 1),
(180, 116, 51, 1, '2023-10-13 15:36:23', 'PAID', 1200.00, 12.00, 1056.00, 1),
(181, 116, 126, 1, '2023-10-13 15:36:23', 'PAID', 763.00, 31.00, 526.47, 1),
(182, 117, 18, 4, '2023-10-13 15:37:57', 'PAID', 1700.00, 17.00, 1411.00, 1),
(183, 117, 51, 1, '2023-10-13 15:37:57', 'PAID', 1200.00, 12.00, 1056.00, 1),
(184, 117, 126, 1, '2023-10-13 15:37:57', 'PAID', 763.00, 31.00, 526.47, 1),
(185, 118, 18, 4, '2023-10-13 15:38:24', 'PAID', 1700.00, 17.00, 1411.00, 1),
(186, 118, 51, 1, '2023-10-13 15:38:24', 'PAID', 1200.00, 12.00, 1056.00, 1),
(187, 118, 126, 1, '2023-10-13 15:38:24', 'PAID', 763.00, 31.00, 526.47, 1),
(188, 119, 18, 4, '2023-10-13 15:39:00', 'PAID', 1700.00, 17.00, 1411.00, 1),
(189, 119, 51, 1, '2023-10-13 15:39:00', 'PAID', 1200.00, 12.00, 1056.00, 1),
(190, 119, 126, 1, '2023-10-13 15:39:00', 'PAID', 763.00, 31.00, 526.47, 1),
(191, 120, 51, 1, '2023-10-13 15:39:15', 'PAID', 1200.00, 12.00, 1056.00, 1),
(192, 121, 18, 4, '2023-10-14 01:56:02', 'PAID', 1700.00, 17.00, 1411.00, 1),
(193, 121, 51, 1, '2023-10-14 01:56:02', 'PAID', 1200.00, 12.00, 1056.00, 1),
(194, 121, 126, 1, '2023-10-14 01:56:02', 'PAID', 763.00, 31.00, 526.47, 1),
(195, 122, 18, 4, '2023-10-14 01:58:46', 'PAID', 1700.00, 17.00, 1411.00, 1),
(196, 122, 51, 1, '2023-10-14 01:58:46', 'PAID', 1200.00, 12.00, 1056.00, 1),
(197, 123, 18, 4, '2023-10-14 01:59:06', 'PAID', 1700.00, 17.00, 1411.00, 1),
(198, 123, 51, 1, '2023-10-14 01:59:06', 'PAID', 1200.00, 12.00, 1056.00, 1),
(199, 123, 126, 1, '2023-10-14 01:59:06', 'PAID', 763.00, 31.00, 526.47, 1),
(200, 124, 18, 4, '2023-10-14 02:01:44', 'PAID', 1700.00, 17.00, 1411.00, 1),
(201, 124, 51, 1, '2023-10-14 02:01:44', 'PAID', 1200.00, 12.00, 1056.00, 1),
(202, 124, 126, 1, '2023-10-14 02:01:44', 'PAID', 763.00, 31.00, 526.47, 1),
(203, 125, 21, 1, '2023-10-14 02:41:34', 'PAID', 2600.00, 15.00, 2210.00, 1),
(204, 126, 21, 1, '2023-10-14 02:42:49', 'PAID', 2600.00, 15.00, 2210.00, 1),
(205, 127, 21, 1, '2023-10-14 02:45:11', 'PAID', 2600.00, 15.00, 2210.00, 1),
(206, 128, 21, 1, '2023-10-14 02:46:30', 'PAID', 2600.00, 15.00, 2210.00, 1),
(207, 129, 21, 1, '2023-10-14 02:47:21', 'PAID', 2600.00, 15.00, 2210.00, 1),
(208, 130, 21, 1, '2023-10-14 02:50:30', 'PAID', 2600.00, 15.00, 2210.00, 1),
(209, 131, 18, NULL, '2023-10-14 02:51:48', 'PAID', 1700.00, 17.00, -289.00, NULL),
(210, 131, 51, NULL, '2023-10-14 02:51:48', 'PAID', 1200.00, 12.00, -144.00, NULL),
(211, 131, 52, NULL, '2023-10-14 02:51:48', 'PAID', 1200.00, 5.00, -60.00, NULL),
(212, 132, 54, 1, '2023-10-14 02:56:03', 'PAID', 1400.00, 15.00, 1190.00, 1),
(213, 133, 54, 1, '2023-10-14 02:57:35', 'PAID', 1400.00, 15.00, 1190.00, 1),
(214, 134, 54, 1, '2023-10-14 02:58:11', 'PAID', 1400.00, 15.00, 1190.00, 1),
(215, 135, 54, 1, '2023-10-14 03:05:58', 'PAID', 1400.00, 15.00, 1190.00, 1),
(216, 136, 54, 1, '2023-10-14 03:30:32', 'PAID', 1400.00, 15.00, 1190.00, 1),
(217, 137, 24, 1, '2023-10-21 02:34:11', 'PAID', 1709.00, 13.00, 3195.83, 2),
(218, 138, 24, 1, '2023-10-21 02:34:39', 'PAID', 1709.00, 13.00, 3195.83, 2),
(219, 138, 122, 2, '2023-10-21 02:34:39', 'PAID', 321.00, 1.00, 317.79, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_description` varchar(200) DEFAULT NULL,
  `product_price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `sub_cat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_price`, `category_id`, `is_deleted`, `sub_cat_id`) VALUES
(9, 'SPORT SHORT', 'Introducing our Men\'s Summer Shorts', 1200.00, 13, 0, NULL),
(10, 'ARRIVAL SHORT', 'Premium Fabric: Crafted from a high-quality blend of cotton and polyester', 1300.00, 13, 0, NULL),
(11, 'STUDIO SHORT', 'SLIM FIT BLACK SHORT', 1500.00, 13, 0, NULL),
(12, 'REACT SHORT', 'REACT WILL NEVER LET YOU DOWN ', 1700.00, 13, 0, NULL),
(13, 'CREST SHORT', 'IF REST DAY WERE ARRANGED', 50000.00, 25, 0, NULL),
(14, 'ELEMENT SHORT', 'SUPPORTIVE FUNCTIONAL AND PHYSICAL ENHANCEMENT', 1500.00, 13, 0, NULL),
(15, 'MARL T-SHIRT', 'STAY COOL AND DRY WITH SWEAT WINCKING TECH ', 1500.00, 14, 0, NULL),
(16, 'INTRA GALACTIC ', 'COLLECTION IS TRULY OUT OF THIS WORLD', 1700.00, 14, 0, NULL),
(17, 'CREST LONG SLEEVE T-SHIRT', 'CONSISTENTLY COMFORTABLE AND CASUAL STYLING', 1899.00, 14, 0, NULL),
(18, 'GEO SEAMLESS T-SHIRT', 'ZERO DISTRACTION MAXIMUM FOCUS', 1700.00, 14, 0, NULL),
(19, 'ARRIVAL TSHIRT', 'THE ARRIVAL TSHIRT IS YOUR ADMISSION TO NEW PURPOSE', 1600.00, 14, 0, NULL),
(20, 'LEGACY TSHIRT', 'OLD SCHOOL STYLE MEETS NEW SCHOOL FUNCTIONALITIES', 1800.00, 14, 0, NULL),
(21, 'CREST SWEATSHIRT', 'REST DAY THE CREST WAY IS CONSISTENTLY COMFORTABLE AND CASUAL', 2600.00, 15, 0, NULL),
(22, 'COLGATE', 'DOES NOT CONTAIN SALT', 1700.00, 15, 0, NULL),
(23, 'POWER WASHED', 'WASHED HOODIE SWEATSHIRT', 50000.00, 15, 0, NULL),
(24, 'WASHED CLEAN HOODIE', 'CLEANEST HOODIE IN TOWN WASHED WITH NIRMA', 1709.00, 17, 0, NULL),
(25, 'GPH ', 'THE NAME IS ENOUGH', 1609.00, 15, 0, NULL),
(26, 'STING', 'GP ENERGY ALL DAY ALL NIGHT ', 1699.00, 15, 0, NULL),
(27, 'FITSHARK JOGGERS', 'FITTEST JOGGERS ', 130000.00, 16, 0, NULL),
(28, 'GLOBAL JOGGERS', 'GO GLOBAL ', 1500.00, 16, 0, NULL),
(29, 'LIFTING JOGGERS', 'LIFT UP YOUR POTENTIAL ', 99.00, 16, 0, NULL),
(30, 'OVERSIZED JOGGERS ', '1500', 1400.00, 16, 0, NULL),
(31, 'HYBREED JOGGERS', 'STEP UP ', 4567.00, 16, 0, NULL),
(32, 'WOVEN JOGGERS ', 'DESCRIPTION NOT AVAILABLE', 68.00, 16, 0, NULL),
(33, 'HOODIES', 'HOODIE FOR MEN', 330.00, 17, 0, NULL),
(34, 'LEGACY HOODIE', 'OLD SCHOOL STYLE ', 77.00, 17, 0, NULL),
(35, 'PUMP COVER HOODIE', 'COVER YOUR PUMP WITH STYLE ', 55.00, 17, 0, NULL),
(36, 'INTERGALACTIC HOODIE', 'SUMMON THE GALAXY', 97.00, 17, 0, NULL),
(37, 'POWER WASHED HOODIE', 'POWER THE WASH WITH THIS HOODIE', 550.00, 17, 0, NULL),
(38, 'RADIAL HOODIE', 'VERSATILE YOUR CLOSET', 770.00, 17, 0, NULL),
(39, 'SLIP ON', 'SLIP ON SLIDE ', 5500.00, 20, 0, NULL),
(40, 'POMA', 'POMA SLIDES', 7700.00, 20, 0, NULL),
(41, 'HULK POWER ', 'FEEL THE POWER OF HULK ', 6690.00, 20, 0, NULL),
(42, 'STAY GROUNDED', 'GROUND YOURSELF', 66.00, 20, 0, NULL),
(43, 'BTS', 'BEHIND THE SCENES', 65465.00, 20, 0, NULL),
(44, 'KURLA ', 'SPECIALLY MADE FOR GOATS', 565.00, 20, 0, NULL),
(45, 'MENS UNDERPANTS', 'FEEL THE AIR ', 5500.00, 22, 0, NULL),
(46, 'FITSHARK SIGNATURE UNDERPANTS', 'LIGHT AS FEATHER ', 4500.00, 22, 0, NULL),
(47, 'COMFORT ', 'LIGHT AS FEATHER', 5500.00, 22, 0, NULL),
(48, 'COLD NUTS', 'WARM UP YOUR PUMP ', 5500.00, 22, 0, NULL),
(49, 'PLAY HARD', 'HARD TO GET ', 7700.00, 22, 0, NULL),
(50, 'SNOW', 'WHITE AS SNOW ', 6600.00, 22, 0, NULL),
(51, 'LEGACY HOODIE', 'BE THE LEGACY', 1200.00, 27, 0, NULL),
(52, 'LEGIT HOODIE', 'BE THEN LEGACY', 1200.00, 27, 0, NULL),
(53, 'LEGACY SHORTS', 'FEEL THE COMFORT', 1300.00, 27, 0, NULL),
(54, 'LEGACY TSHIRT', 'LEGACY TSHIRTS', 1400.00, 11, 0, NULL),
(55, 'LEGACY TSHIRTS', 'FEEL THE LEGACY', 2500.00, 27, 0, NULL),
(56, 'cherbu ', 'fit shark women', 560.00, 42, 0, NULL),
(57, 'Halterneck', 'Reversible halterneck', 890.00, 42, 0, NULL),
(58, 'ruched Cords', 'co-ordinated sets', 9604.00, 42, 0, NULL),
(59, 'strappy Back', 'Takes your training staples', 7658.00, 42, 0, NULL),
(60, 'Contract cords', 'contract your style', 1132.00, 42, 0, NULL),
(61, 'legacy fashion', 'fashion ', 1562.00, 42, 0, NULL),
(62, 'Everyday simless leggings', 'comfort', 996.00, 43, 0, NULL),
(63, 'Training leggings', 'comfort', 956.00, 43, 0, NULL),
(64, 'Crossover leggings', 'comfort', 849.00, 43, 0, NULL),
(65, 'Whitle semless ', 'comfort', 656.00, 43, 0, NULL),
(66, 'Black leggings', 'comfort', 789.00, 43, 0, NULL),
(67, 'vital leggings', 'comfort', 123.00, 43, 0, NULL),
(68, 'Graphic Wear', 'Dulex product', 9654.00, 46, 0, NULL),
(69, 'Sports Tanks', 'Tanks ', 894.00, 49, 0, NULL),
(70, 'Everyday Tank Tops', 'Monday wear', 849.00, 49, 0, NULL),
(71, 'Tank wears', 'Wearable', 234.00, 49, 0, NULL),
(72, 'Wearable Legacy', 'Tanks wears for everday', 984.00, 49, 0, NULL),
(73, 'womens Leagacy', 'Legacy wear', 12.00, 49, 0, NULL),
(74, 'Antgant Tanks', 'Short Tanks', 8971.00, 49, 0, NULL),
(75, 'Oversized wearable', 'For the extreme comfort', 961.00, 48, 0, NULL),
(76, 'Plus wears', 'Extreme faxso', 965.00, 48, 0, NULL),
(77, 'Love ', 'For the Love', 591.00, 48, 0, NULL),
(78, 'Covered Oversized', 'Full Hand ', 597.00, 48, 0, NULL),
(79, 'Legacy wear', 'Beat the legacy', 1400.00, 48, 0, NULL),
(80, 'Go Green', 'Plant green', 599.00, 48, 0, NULL),
(81, 'Sky ', 'Go white', 5497.00, 48, 0, NULL),
(82, 'Minimal Sports bra', 'keep it Minimal', 2701.00, 50, 0, NULL),
(83, 'Legacy Bra', 'Legacy hold', 3100.00, 50, 0, NULL),
(84, 'Gant', 'The brand', 905.00, 51, 0, NULL),
(85, 'Touch Wood', 'To be grounded', 1810.00, 50, 0, NULL),
(86, 'Sports bra', 'fitness', 2003.00, 50, 0, NULL),
(87, 'Carry pro', 'Holds its', 3000.00, 50, 0, NULL),
(88, 'Snow Flakes', 'White ', 1506.00, 15, 0, NULL),
(89, 'Holding Grips', 'Strap', 897.00, 53, 0, NULL),
(90, 'Maroon', 'Colored belt', 800.00, 53, 0, NULL),
(91, 'Grey Heights', 'Lifting Essentials', 799.00, 53, 0, NULL),
(92, 'Advances Hold', 'Grip it up', 999.00, 53, 0, NULL),
(93, 'Purple holds', 'Holding It', 599.00, 53, 0, NULL),
(94, 'Knee Covers', 'Provides Support', 694.00, 53, 0, NULL),
(95, 'Gym bottel', '3 liters..', 450.00, 54, 0, NULL),
(96, 'Sippers', 'Blue Holds', 969.00, 54, 0, NULL),
(97, 'Black', '4 liters', 900.00, 54, 0, NULL),
(98, 'Aqua Blue', 'Keeps you Hydrated', 564.00, 54, 0, NULL),
(99, 'Skyblue sipper', 'Inspired', 897.00, 54, 0, NULL),
(100, 'Gant', 'Gant your drink', 894.00, 54, 0, NULL),
(101, 'Shark Bagpacks', 'Skin Colour', 789.00, 55, 0, NULL),
(102, 'Black Beast', 'Black colour', 7895.00, 55, 0, NULL),
(103, 'Unicorn', 'Baby pink', 789.00, 55, 0, NULL),
(104, 'Wide', 'Into the Woods', 9870.00, 55, 0, NULL),
(105, 'Attract ', 'Glow Orange', 795.00, 55, 0, NULL),
(106, 'Mud bag', 'Light Brown', 945.00, 55, 0, NULL),
(107, 'Snow White', 'White Colour ', 978.00, 56, 0, NULL),
(108, 'Blue bird', 'Blue ', 942.00, 56, 0, NULL),
(109, 'Skin Touch', 'Skinny ', 943.00, 56, 0, NULL),
(110, 'Set', 'set of 3', 982.00, 56, 0, NULL),
(111, 'Cords of 3', 'cordinated Socks ', 984.00, 56, 0, NULL),
(112, 'Snow Collection', 'White Pairs', 600.00, 56, 0, NULL),
(113, 'Black Head', 'Black colour', 499.00, 57, 0, NULL),
(114, 'Bts pack', 'BTS ', 900.00, 57, 0, NULL),
(115, 'Bean', 'Tree touch', 900.00, 57, 0, NULL),
(116, 'LEGACY TSHIRT', 'wearable', 999.00, 11, 0, NULL),
(117, 'Dark Cover', 'Hoodies', 2078.00, 11, 0, NULL),
(118, 'Go Green', 'Green ', 499.00, 11, 0, NULL),
(119, 'Shark wear', 'Beast Collections', 146.00, 11, 0, NULL),
(121, 'Disk Print', 'Printed wear', 899.00, 11, 1, NULL),
(122, 'LEGACY TSHIRT', 'Legacy', 321.00, 10, 0, NULL),
(123, 'Black bee', 'Colour:Black', 521.00, 10, 0, NULL),
(124, 'Printed', 'Round neck', 876.00, 10, 0, NULL),
(125, 'Black Tshirt', 'Colour:Black', 468.00, 10, 0, NULL),
(126, 'Coverd Tshirt', 'colour:Green', 763.00, 10, 0, NULL),
(127, 'Strap Hold', 'grip', 129.00, 12, 0, NULL),
(128, 'StrapOn', 'colour:purple', 873.00, 12, 0, NULL),
(129, 'black Cap', 'Knee Support', 7546.00, 12, 0, NULL),
(130, 'Holdit', 'Grip', 357.00, 12, 0, NULL),
(131, 'MudHold', 'Mud ', 763.00, 12, 0, NULL),
(132, 'SPORT SHORT', 'sd', 1235.00, 56, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_url` varchar(200) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`image_id`, `product_id`, `image_url`, `is_deleted`) VALUES
(23, 9, 'shorts_1.jpg', 0),
(24, 9, 'shorts_2.avif', 0),
(25, 9, 'shorts_3.jpg', 0),
(26, 9, 'shorts_4.jpg', 0),
(27, 9, 'shorts_5.jpg', 0),
(28, 10, 'shorts_6.avif', 0),
(29, 10, 'shorts_7.webp', 0),
(30, 10, 'shorts_8.avif', 0),
(31, 10, 'shorts_9.webp', 0),
(32, 10, 'shorts_10.webp', 0),
(33, 11, 'shorts_11.webp', 0),
(34, 11, 'shorts_12.avif', 0),
(35, 11, 'shorts_13.avif', 0),
(36, 11, 'shorts_14.avif', 0),
(37, 11, 'shorts_15.avif', 0),
(38, 12, 'shorts_16.webp', 0),
(39, 12, 'shorts_17.jpg', 0),
(40, 12, 'shorts_18.webp', 0),
(41, 12, 'shorts_19.avif', 0),
(42, 12, 'shorts_20.avif', 0),
(43, 13, 'shorts_21.webp', 0),
(44, 13, 'shorts_22.avif', 0),
(45, 13, 'shorts_23.avif', 0),
(46, 13, 'shorts_24.avif', 0),
(47, 13, 'shorts_25.webp', 0),
(48, 14, 'shorts_26.webp', 0),
(49, 14, 'shorts_27.avif', 0),
(50, 14, 'shorts_28.avif', 0),
(51, 14, 'shorts_29.webp', 0),
(52, 14, 'shorts_30.webp', 0),
(53, 15, 'T-shirt_1.webp', 0),
(54, 15, 'T-shirt_2.avif', 0),
(55, 15, 'T-shirt_3.avif', 0),
(56, 15, 'T-shirt_4.avif', 0),
(57, 15, 'T-shirt_5.webp', 0),
(58, 16, 'T-shirt_6.webp', 0),
(59, 16, 'T-shirt_7.webp', 0),
(60, 16, 'T-shirt_8.webp', 0),
(61, 16, 'T-shirt_9.avif', 0),
(62, 16, 'T-shirt_10.avif', 0),
(63, 17, 'T-shirt_11.avif', 0),
(64, 17, 'T-shirt_12.avif', 0),
(65, 17, 'T-shirt_13.avif', 0),
(66, 17, 'T-shirt_14.webp', 0),
(67, 17, 'T-shirt_15.jpg', 0),
(68, 18, 'T-shirt_16.webp', 0),
(69, 18, 'T-shirt_17.jpg', 0),
(70, 18, 'T-shirt_18.jpg', 0),
(71, 18, 'T-shirt_19.avif', 0),
(72, 18, 'T-shirt_20.webp', 0),
(73, 19, 'T-shirt_21.webp', 0),
(74, 19, 'T-shirt_22.avif', 0),
(75, 19, 'T-shirt_23.avif', 0),
(76, 19, 'T-shirt_24.avif', 0),
(77, 19, 'T-shirt_25.webp', 0),
(78, 20, 'T-shirt_26.webp', 0),
(79, 20, 'T-shirt_27.avif', 0),
(80, 20, 'T-shirt_28.avif', 0),
(81, 20, 'T-shirt_29.avif', 0),
(82, 20, 'T-shirt_30.webp', 0),
(83, 21, 'sweatshirt_1.webp', 0),
(84, 21, 'sweatshirt_2.avif', 0),
(85, 21, 'sweatshirt_3.avif', 0),
(86, 21, 'sweatshirt_4.webp', 0),
(87, 21, 'sweatshirt_5.jpg', 0),
(88, 22, 'sweatshirt_6.webp', 0),
(89, 22, 'sweatshirt_7.avif', 0),
(90, 22, 'sweatshirt_8.avif', 0),
(91, 22, 'sweatshirt_9.avif', 0),
(92, 22, 'sweatshirt_10.webp', 0),
(93, 23, 'sweatshirt_11.webp', 0),
(94, 23, 'sweatshirt_12.avif', 0),
(95, 23, 'sweatshirt_13.avif', 0),
(96, 23, 'sweatshirt_14.avif', 0),
(97, 23, 'sweatshirt_15.jpg', 0),
(98, 24, 'sweatshirt_16.webp', 0),
(99, 24, 'sweatshirt_17.avif', 0),
(100, 24, 'sweatshirt_18.avif', 0),
(101, 24, 'sweatshirt_19.avif', 0),
(102, 24, 'sweatshirt_20.jpg', 0),
(103, 25, 'sweatshirt_21.webp', 0),
(104, 25, 'sweatshirt_22.avif', 0),
(105, 25, 'sweatshirt_23.avif', 0),
(106, 25, 'sweatshirt_24.avif', 0),
(107, 25, 'sweatshirt_25.jpg', 0),
(108, 26, 'sweatshirt_26.webp', 0),
(109, 26, 'sweatshirt_27.avif', 0),
(110, 26, 'sweatshirt_28.avif', 0),
(111, 26, 'sweatshirt_29.avif', 0),
(112, 26, 'sweatshirt_30.jpg', 0),
(113, 27, 'joggers_1.webp', 0),
(114, 27, 'joggers_2.webp', 0),
(115, 27, 'joggers_3.avif', 0),
(116, 27, 'joggers_4.avif', 0),
(117, 27, 'joggers_5.avif', 0),
(118, 28, 'joggers_6.webp', 0),
(119, 28, 'joggers_7.avif', 0),
(121, 28, 'joggers_9.avif', 0),
(122, 28, 'joggers_10.webp', 0),
(123, 29, 'joggers_11.webp', 0),
(124, 29, 'joggers_12.avif', 0),
(125, 29, 'joggers_13.avif', 0),
(126, 29, 'joggers_14.avif', 0),
(127, 29, 'joggers_15.webp', 0),
(128, 30, 'joggers_16.webp', 0),
(129, 30, 'joggers_17.avif', 0),
(130, 30, 'joggers_18.avif', 0),
(131, 30, 'joggers_19.webp', 0),
(132, 30, 'joggers_20.webp', 0),
(133, 31, 'joggers_21.webp', 0),
(134, 31, 'joggers_22.avif', 0),
(135, 31, 'joggers_23.avif', 0),
(136, 31, 'joggers_24.jpg', 0),
(137, 31, 'joggers_25.jpg', 0),
(138, 32, 'joggers_26.webp', 0),
(139, 32, 'joggers_27.avif', 0),
(140, 32, 'joggers_28.avif', 0),
(141, 32, 'joggers_29.avif', 0),
(142, 32, 'joggers_30.webp', 0),
(143, 33, 'hoodies_1.webp', 0),
(144, 33, 'hoodies_2.avif', 0),
(145, 33, 'hoodies_3.avif', 0),
(146, 33, 'hoodies_4.avif', 0),
(147, 33, 'hoodies_5.webp', 0),
(148, 34, 'hoodies_6.webp', 0),
(149, 34, 'hoodies_7.avif', 0),
(150, 34, 'hoodies_8.avif', 0),
(151, 34, 'hoodies_9.avif', 0),
(152, 34, 'hoodies_10.webp', 0),
(153, 35, 'hoodies_11.webp', 0),
(154, 35, 'hoodies_12.avif', 0),
(155, 35, 'hoodies_13.avif', 0),
(156, 35, 'hoodies_14.avif', 0),
(157, 35, 'hoodies_15.jpg', 0),
(158, 36, 'hoodies_16.webp', 0),
(159, 36, 'hoodies_17.avif', 0),
(160, 36, 'hoodies_18.avif', 0),
(161, 36, 'hoodies_19.avif', 0),
(162, 36, 'hoodies_20.jpg', 0),
(163, 37, 'hoodies_21.webp', 0),
(164, 37, 'hoodies_22.avif', 0),
(165, 37, 'hoodies_23.avif', 0),
(166, 37, 'hoodies_24.avif', 0),
(167, 37, 'hoodies_25.jpg', 0),
(168, 38, 'hoodies_5.webp', 0),
(169, 38, 'hoodies_26.webp', 0),
(170, 38, 'hoodies_27.avif', 0),
(171, 38, 'hoodies_28.avif', 0),
(172, 38, 'hoodies_29.avif', 0),
(173, 38, 'hoodies_30.webp', 0),
(174, 39, 'slides_1.webp', 0),
(175, 39, 'slides_3.avif', 0),
(176, 39, 'slides_4.webp', 0),
(177, 39, 'slides_5.webp', 0),
(178, 40, 'slides_6.webp', 0),
(179, 40, 'slides_7.webp', 0),
(180, 40, 'slides_8.avif', 0),
(181, 40, 'slides_9.avif', 0),
(182, 40, 'slides_10.webp', 0),
(183, 41, 'slides_11.webp', 0),
(184, 41, 'slides_12.avif', 0),
(185, 41, 'slides_13.avif', 0),
(186, 41, 'slides_14.avif', 0),
(187, 41, 'slides_15.webp', 0),
(188, 42, 'slides_16.webp', 0),
(189, 42, 'slides_17.webp', 0),
(190, 42, 'slides_18.webp', 0),
(191, 42, 'slides_19.webp', 0),
(192, 42, 'slides_20.webp', 0),
(193, 43, 'slides_21.webp', 0),
(194, 43, 'slides_22.webp', 0),
(195, 43, 'slides_23.webp', 0),
(196, 43, 'slides_24.webp', 0),
(197, 43, 'slides_25.webp', 0),
(198, 44, 'slides_26.webp', 0),
(199, 44, 'slides_27.avif', 0),
(200, 44, 'slides_28.webp', 0),
(201, 44, 'slides_29.webp', 0),
(202, 44, 'slides_30.webp', 0),
(203, 45, 'underwears_1.webp', 0),
(204, 45, 'underwears_2.avif', 0),
(205, 45, 'underwears_3.avif', 0),
(206, 45, 'underwears_4.avif', 0),
(207, 45, 'underwears_5.webp', 0),
(208, 46, 'underwears_1.webp', 0),
(209, 46, 'underwears_2.avif', 0),
(210, 46, 'underwears_3.avif', 0),
(211, 46, 'underwears_4.avif', 0),
(212, 46, 'underwears_5.webp', 0),
(213, 47, 'underwears_6.webp', 0),
(214, 47, 'underwears_7.avif', 0),
(215, 47, 'underwears_8.avif', 0),
(216, 47, 'underwears_9.webp', 0),
(217, 47, 'underwears_10.webp', 0),
(218, 48, 'underwears_11.webp', 0),
(219, 48, 'underwears_12.webp', 0),
(220, 48, 'underwears_13.avif', 0),
(221, 48, 'underwears_14.avif', 0),
(222, 48, 'underwears_15.avif', 0),
(223, 49, 'underwears_16.avif', 0),
(224, 49, 'underwears_17.avif', 0),
(225, 49, 'underwears_18.webp', 0),
(226, 49, 'underwears_19.webp', 0),
(227, 49, 'underwears_20.webp', 0),
(228, 50, 'underwears_21.webp', 0),
(229, 50, 'underwears_22.webp', 0),
(230, 50, 'underwears_23.jpg', 0),
(231, 50, 'underwears_25.jpg', 0),
(232, 50, 'underwears_26.webp', 0),
(233, 51, 'hoodies_1.webp', 0),
(234, 51, 'hoodies_2.avif', 0),
(235, 51, 'hoodies_3.avif', 0),
(236, 51, 'hoodies_4.avif', 0),
(237, 51, 'hoodies_5.webp', 0),
(238, 52, 'hoodies_6.webp', 0),
(239, 52, 'hoodies_7.avif', 0),
(240, 52, 'hoodies_8.avif', 0),
(241, 52, 'hoodies_9.avif', 0),
(242, 52, 'hoodies_10.webp', 0),
(243, 53, 'shorts_1.jpg', 0),
(244, 53, 'shorts_2.avif', 0),
(245, 53, 'shorts_3.jpg', 0),
(246, 53, 'shorts_4.jpg', 0),
(247, 53, 'shorts_5.jpg', 0),
(248, 54, 'T-shirt_1.webp', 0),
(249, 54, 'T-shirt_2.avif', 0),
(250, 54, 'T-shirt_3.avif', 0),
(251, 54, 'T-shirt_4.avif', 0),
(252, 54, 'T-shirt_5.webp', 0),
(253, 55, 'T-shirt_6.webp', 0),
(254, 55, 'T-shirt_7.webp', 0),
(255, 55, 'T-shirt_8.webp', 0),
(256, 55, 'T-shirt_9.avif', 0),
(257, 55, 'T-shirt_10.avif', 0),
(258, 56, 'matchingsets_1.webp', 0),
(259, 56, 'matchingsets_2.avif', 0),
(260, 56, 'matchingsets_3.avif', 0),
(261, 56, 'matchingsets_4.avif', 0),
(262, 56, 'matchingsets_5.webp', 0),
(263, 57, 'matchingsets_6.webp', 0),
(264, 57, 'matchingsets_7.avif', 0),
(265, 57, 'matchingsets_8.avif', 0),
(266, 57, 'matchingsets_9.avif', 0),
(267, 57, 'matchingsets_10.webp', 0),
(268, 58, 'matchingsets_11.webp', 0),
(269, 58, 'matchingsets_12.avif', 0),
(270, 58, 'matchingsets_13.avif', 0),
(271, 58, 'matchingsets_14.avif', 0),
(272, 58, 'matchingsets_15.webp', 0),
(273, 59, 'matchingsets_16.webp', 0),
(274, 59, 'matchingsets_17.avif', 0),
(275, 59, 'matchingsets_18.avif', 0),
(276, 59, 'matchingsets_19.avif', 0),
(277, 59, 'matchingsets_20.webp', 0),
(278, 60, 'matchingsets_21.webp', 0),
(279, 60, 'matchingsets_22.avif', 0),
(280, 60, 'matchingsets_23.avif', 0),
(281, 60, 'matchingsets_24.avif', 0),
(282, 60, 'matchingsets_25.webp', 0),
(283, 61, 'matchingsets_26.webp', 0),
(284, 61, 'matchingsets_27.webp', 0),
(285, 61, 'matchingsets_28.avif', 0),
(286, 61, 'matchingsets_29.avif', 0),
(287, 61, 'matchingsets_30.avif', 0),
(288, 62, 'blackleggings_1.webp', 0),
(289, 62, 'blackleggings_2.webp', 0),
(290, 62, 'blackleggings_3.avif', 0),
(291, 62, 'blackleggings_4.avif', 0),
(292, 62, 'blackleggings_5.avif', 0),
(293, 63, 'blackleggings_6.webp', 0),
(294, 63, 'blackleggings_7.webp', 0),
(295, 63, 'blackleggings_8.avif', 0),
(296, 63, 'blackleggings_9.avif', 0),
(297, 63, 'blackleggings_10.avif', 0),
(298, 64, 'blackleggings_11.webp', 0),
(299, 64, 'blackleggings_12.webp', 0),
(300, 64, 'blackleggings_13.avif', 0),
(301, 64, 'blackleggings_14.avif', 0),
(302, 64, 'blackleggings_15.avif', 0),
(303, 65, 'blackleggings_17.webp', 0),
(304, 65, 'blackleggings_18.webp', 0),
(305, 65, 'blackleggings_19.avif', 0),
(306, 65, 'blackleggings_20.avif', 0),
(307, 65, 'blackleggings_21.webp', 0),
(308, 66, 'blackleggings_22.avif', 0),
(309, 66, 'blackleggings_23.avif', 0),
(310, 66, 'blackleggings_24.avif', 0),
(311, 66, 'blackleggings_25.webp', 0),
(312, 66, 'blackleggings_26.webp', 0),
(313, 67, 'blackleggings_27.avif', 0),
(314, 67, 'blackleggings_28.avif', 0),
(315, 67, 'blackleggings_29.avif', 0),
(316, 67, 'blackleggings_30.webp', 0),
(317, 68, 'tanktops_1.webp', 0),
(318, 68, 'tanktops_2.avif', 0),
(319, 68, 'tanktops_3.avif', 0),
(320, 68, 'tanktops_4.avif', 0),
(321, 68, 'tanktops_5.webp', 0),
(322, 69, 'tanktops_6.webp', 0),
(323, 69, 'tanktops_7.avif', 0),
(324, 69, 'tanktops_8.avif', 0),
(325, 69, 'tanktops_9.avif', 0),
(326, 69, 'tanktops_10.webp', 0),
(327, 70, 'tanktops_11.webp', 0),
(328, 70, 'tanktops_12.avif', 0),
(329, 70, 'tanktops_13.avif', 0),
(330, 70, 'tanktops_14.avif', 0),
(331, 70, 'tanktops_15.webp', 0),
(332, 71, 'tanktops_11.webp', 0),
(333, 71, 'tanktops_12.avif', 0),
(334, 71, 'tanktops_13.avif', 0),
(335, 71, 'tanktops_14.avif', 0),
(336, 71, 'tanktops_15.webp', 0),
(337, 72, 'tanktops_16.webp', 0),
(338, 72, 'tanktops_17.avif', 0),
(339, 72, 'tanktops_18.avif', 0),
(340, 72, 'tanktops_19.avif', 0),
(341, 72, 'tanktops_20.webp', 0),
(342, 73, 'tanktops_21.avif', 0),
(343, 73, 'tanktops_22.webp', 0),
(344, 73, 'tanktops_23.avif', 0),
(345, 73, 'tanktops_24.avif', 0),
(346, 73, 'tanktops_25.avif', 0),
(347, 74, 'tanktops_26.avif', 0),
(348, 74, 'tanktops_27.avif', 0),
(349, 74, 'tanktops_28.avif', 0),
(350, 74, 'tanktops_29.webp', 0),
(351, 74, 'tanktops_30.webp', 0),
(352, 75, 'oversized_1.webp', 0),
(353, 75, 'oversized_2.avif', 0),
(354, 75, 'oversized_3.avif', 0),
(355, 75, 'oversized_4.avif', 0),
(356, 75, 'oversized_5.jpg', 0),
(357, 76, 'oversized_6.webp', 0),
(358, 76, 'oversized_7.webp', 0),
(359, 76, 'oversized_8.avif', 0),
(360, 76, 'oversized_9.avif', 0),
(361, 76, 'oversized_10.avif', 0),
(362, 77, 'oversized_11.webp', 0),
(363, 77, 'oversized_12.webp', 0),
(364, 77, 'oversized_13.avif', 0),
(365, 77, 'oversized_14.avif', 0),
(366, 77, 'oversized_15.avif', 0),
(367, 78, 'oversized_11.webp', 0),
(368, 78, 'oversized_12.webp', 0),
(369, 78, 'oversized_13.avif', 0),
(370, 78, 'oversized_14.avif', 0),
(371, 78, 'oversized_15.avif', 0),
(372, 79, 'oversized_26.webp', 0),
(373, 79, 'oversized_27.avif', 0),
(374, 79, 'oversized_28.avif', 0),
(375, 79, 'oversized_29.avif', 0),
(376, 79, 'oversized_30.jpg', 0),
(377, 80, 'oversized_22.webp', 0),
(378, 80, 'oversized_23.avif', 0),
(379, 80, 'oversized_24.avif', 0),
(380, 80, 'oversized_25.avif', 0),
(381, 81, 'oversized_16.webp', 0),
(382, 81, 'oversized_17.avif', 0),
(383, 81, 'oversized_18.avif', 0),
(384, 81, 'oversized_19.avif', 0),
(385, 81, 'oversized_20.webp', 0),
(386, 82, 'sportbra_1.webp', 0),
(387, 82, 'sportbra_2.webp', 0),
(388, 82, 'sportbra_3.avif', 0),
(389, 82, 'sportbra_4.avif', 0),
(390, 82, 'sportbra_5.avif', 0),
(391, 83, 'sportbra_6.webp', 0),
(392, 83, 'sportbra_7.webp', 0),
(393, 83, 'sportbra_8.webp', 0),
(394, 83, 'sportbra_9.webp', 0),
(395, 83, 'sportbra_10.webp', 0),
(396, 84, 'sportbra_11.webp', 0),
(397, 84, 'sportbra_12.avif', 0),
(398, 84, 'sportbra_13.avif', 0),
(399, 84, 'sportbra_14.avif', 0),
(400, 84, 'sportbra_15.webp', 0),
(401, 85, 'sportbra_11.webp', 0),
(402, 85, 'sportbra_12.avif', 0),
(403, 85, 'sportbra_13.avif', 0),
(404, 85, 'sportbra_14.avif', 0),
(405, 85, 'sportbra_15.webp', 0),
(406, 86, 'sportbra_16.webp', 0),
(407, 86, 'sportbra_17.avif', 0),
(408, 86, 'sportbra_18.avif', 0),
(409, 86, 'sportbra_19.avif', 0),
(410, 86, 'sportbra_20.jpg', 0),
(411, 87, 'sportbra_21.webp', 0),
(412, 87, 'sportbra_22.avif', 0),
(413, 87, 'sportbra_23.avif', 0),
(414, 87, 'sportbra_24.avif', 0),
(415, 87, 'sportbra_25.webp', 0),
(416, 88, 'sportbra_26.webp', 0),
(417, 88, 'sportbra_27.avif', 0),
(418, 88, 'sportbra_28.avif', 0),
(419, 88, 'sportbra_29.avif', 0),
(420, 88, 'sportbra_30.webp', 0),
(421, 89, 'liftingacc_1.webp', 0),
(422, 89, 'liftingacc_2.webp', 0),
(423, 89, 'liftingacc_3.webp', 0),
(424, 90, 'liftingacc_4.webp', 0),
(425, 90, 'liftingacc_5.webp', 0),
(426, 90, 'liftingacc_6.webp', 0),
(427, 91, 'liftingacc_7.webp', 0),
(428, 91, 'liftingacc_8.webp', 0),
(429, 91, 'liftingacc_9.webp', 0),
(430, 92, 'liftingacc_10.webp', 0),
(431, 92, 'liftingacc_11.webp', 0),
(432, 92, 'liftingacc_12.webp', 0),
(433, 93, 'liftingacc_13.webp', 0),
(434, 93, 'liftingacc_14.webp', 0),
(435, 93, 'liftingacc_15.webp', 0),
(436, 94, 'liftingacc_16.webp', 0),
(437, 94, 'liftingacc_17.avif', 0),
(438, 94, 'liftingacc_18.avif', 0),
(439, 95, 'bottels_1.webp', 0),
(440, 95, 'bottels_2.webp', 0),
(441, 95, 'bottels_3.webp', 0),
(442, 96, 'bottels_4.webp', 0),
(443, 96, 'bottels_5.webp', 0),
(444, 96, 'bottels_6.webp', 0),
(445, 97, 'bottels_7.webp', 0),
(446, 97, 'bottels_8.webp', 0),
(447, 97, 'bottels_9.webp', 0),
(448, 98, 'bottels_10.webp', 0),
(449, 98, 'bottels_11.webp', 0),
(450, 98, 'bottels_12.webp', 0),
(451, 99, 'bottels_13.webp', 0),
(452, 99, 'bottels_14.webp', 0),
(453, 99, 'bottels_15.webp', 0),
(454, 100, 'bottels_16.webp', 0),
(455, 100, 'bottels_17.webp', 0),
(456, 100, 'bottels_18.webp', 0),
(457, 101, 'bags_1.webp', 0),
(458, 101, 'bags_2.webp', 0),
(459, 101, 'bags_3.avif', 0),
(460, 102, 'bags_3.avif', 0),
(461, 102, 'bags_4.webp', 0),
(462, 102, 'bags_6.webp', 0),
(463, 103, 'bags_7.webp', 0),
(464, 103, 'bags_8.webp', 0),
(465, 103, 'bags_9.webp', 0),
(466, 104, 'bags_10.webp', 0),
(467, 104, 'bags_11.avif', 0),
(468, 104, 'bags_12.webp', 0),
(469, 105, 'bags_13.webp', 0),
(470, 105, 'bags_14.webp', 0),
(471, 105, 'bags_15.webp', 0),
(472, 106, 'bags_16.webp', 0),
(473, 106, 'bags_17.webp', 0),
(474, 106, 'bags_18.jpg', 0),
(475, 107, 'socks_1.webp', 0),
(476, 107, 'socks_2.webp', 0),
(477, 107, 'socks_3.webp', 0),
(478, 108, 'socks_4.webp', 0),
(479, 108, 'socks_5.webp', 0),
(480, 108, 'socks_6.webp', 0),
(481, 109, 'socks_7.webp', 0),
(482, 109, 'socks_8.webp', 0),
(483, 109, 'socks_9.webp', 0),
(484, 110, 'socks_10.webp', 0),
(485, 110, 'socks_11.webp', 0),
(486, 110, 'socks_12.webp', 0),
(487, 111, 'socks_13.webp', 0),
(488, 111, 'socks_14.webp', 0),
(489, 111, 'socks_15.webp', 0),
(490, 112, 'socks_16.webp', 0),
(491, 112, 'socks_17.webp', 0),
(492, 112, 'socks_18.webp', 0),
(493, 113, 'headwear_1.webp', 0),
(494, 113, 'headwear_2.webp', 0),
(495, 113, 'headwear_3.webp', 0),
(496, 114, 'headwear_4.webp', 0),
(497, 114, 'headwear_5.webp', 0),
(498, 114, 'headwear_6.avif', 0),
(499, 115, 'headwear_16.webp', 0),
(500, 115, 'headwear_17.webp', 0),
(501, 115, 'headwear_18.webp', 0),
(502, 116, 'T-shirt_1.webp', 0),
(503, 116, 'T-shirt_2.avif', 0),
(504, 116, 'T-shirt_3.avif', 0),
(505, 116, 'T-shirt_4.avif', 0),
(506, 116, 'T-shirt_5.webp', 0),
(507, 117, 'hoodies_1.webp', 0),
(508, 117, 'hoodies_2.avif', 0),
(509, 117, 'hoodies_3.avif', 0),
(510, 117, 'hoodies_4.avif', 0),
(511, 117, 'hoodies_5.webp', 0),
(512, 118, 'sweatshirt_1.webp', 0),
(513, 118, 'sweatshirt_2.avif', 0),
(514, 118, 'sweatshirt_3.avif', 0),
(515, 118, 'sweatshirt_4.webp', 0),
(516, 118, 'sweatshirt_5.jpg', 0),
(517, 119, 'sweatshirt_11.webp', 0),
(518, 119, 'sweatshirt_12.avif', 0),
(519, 119, 'sweatshirt_13.avif', 0),
(520, 119, 'sweatshirt_14.avif', 0),
(521, 119, 'sweatshirt_15.jpg', 0),
(527, 121, 'hoodies_26.webp', 0),
(528, 121, 'hoodies_27.avif', 0),
(529, 121, 'hoodies_28.avif', 0),
(530, 121, 'hoodies_29.avif', 0),
(531, 121, 'hoodies_30.webp', 0),
(532, 122, 'oversized_1.webp', 0),
(533, 122, 'oversized_2.avif', 0),
(534, 122, 'oversized_3.avif', 0),
(535, 122, 'oversized_4.avif', 0),
(536, 122, 'oversized_5.jpg', 0),
(537, 123, 'oversized_6.webp', 0),
(538, 123, 'oversized_7.webp', 0),
(539, 123, 'oversized_8.avif', 0),
(540, 123, 'oversized_9.avif', 0),
(541, 123, 'oversized_10.avif', 0),
(542, 124, 'oversized_11.webp', 0),
(543, 124, 'oversized_12.webp', 0),
(544, 124, 'oversized_13.avif', 0),
(545, 124, 'oversized_14.avif', 0),
(546, 124, 'oversized_15.avif', 0),
(547, 125, 'oversized_27.avif', 0),
(548, 125, 'oversized_28.avif', 0),
(549, 125, 'oversized_29.avif', 0),
(550, 125, 'oversized_30.jpg', 0),
(551, 126, 'oversized_21.webp', 0),
(552, 126, 'oversized_22.webp', 0),
(553, 126, 'oversized_23.avif', 0),
(554, 126, 'oversized_24.avif', 0),
(555, 127, 'liftingacc_1.webp', 0),
(556, 127, 'liftingacc_2.webp', 0),
(557, 127, 'liftingacc_3.webp', 0),
(558, 127, 'liftingacc_7.webp', 0),
(559, 128, 'liftingacc_13.webp', 0),
(560, 128, 'liftingacc_14.webp', 0),
(561, 128, 'liftingacc_15.webp', 0),
(562, 129, 'liftingacc_16.webp', 0),
(563, 129, 'liftingacc_17.avif', 0),
(564, 129, 'liftingacc_18.avif', 0),
(565, 130, 'liftingacc_10.webp', 0),
(566, 130, 'liftingacc_11.webp', 0),
(567, 130, 'liftingacc_12.webp', 0),
(568, 131, 'liftingacc_7.webp', 0),
(569, 131, 'liftingacc_8.webp', 0),
(570, 131, 'liftingacc_9.webp', 0),
(571, 132, 'oversized_21.webp', 0),
(572, 132, 'oversized_22.webp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `product_size_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`product_size_id`, `product_id`, `size_id`) VALUES
(19, 9, 1),
(20, 9, 2),
(21, 10, 2),
(22, 10, 4),
(23, 11, 1),
(24, 11, 3),
(25, 12, 2),
(26, 12, 4),
(27, 13, 1),
(28, 13, 2),
(29, 13, 3),
(30, 13, 4),
(31, 13, 5),
(32, 14, 1),
(33, 14, 2),
(34, 14, 3),
(35, 15, 1),
(36, 15, 2),
(37, 15, 3),
(38, 16, 1),
(39, 16, 2),
(40, 16, 3),
(41, 17, 1),
(42, 17, 2),
(43, 17, 3),
(44, 18, 2),
(45, 18, 3),
(46, 18, 4),
(47, 19, 1),
(48, 19, 2),
(49, 19, 3),
(50, 20, 1),
(51, 20, 2),
(52, 20, 3),
(53, 20, 4),
(54, 21, 1),
(55, 21, 2),
(56, 22, 1),
(57, 22, 2),
(58, 22, 3),
(59, 22, 4),
(60, 23, 1),
(61, 23, 2),
(62, 24, 1),
(63, 24, 2),
(64, 24, 3),
(65, 25, 1),
(66, 25, 2),
(67, 26, 2),
(68, 26, 3),
(69, 26, 5),
(70, 27, 1),
(71, 27, 2),
(72, 27, 3),
(73, 27, 4),
(74, 28, 1),
(75, 28, 2),
(76, 28, 3),
(77, 28, 4),
(78, 29, 1),
(79, 29, 2),
(80, 29, 3),
(81, 30, 1),
(82, 30, 2),
(83, 31, 1),
(84, 32, 1),
(85, 32, 2),
(86, 33, 1),
(87, 33, 2),
(88, 34, 2),
(89, 34, 3),
(90, 35, 1),
(91, 35, 3),
(92, 36, 1),
(93, 36, 2),
(94, 37, 1),
(95, 37, 2),
(96, 38, 1),
(97, 38, 2),
(98, 38, 3),
(99, 40, 1),
(100, 40, 2),
(101, 40, 3),
(102, 41, 2),
(103, 41, 4),
(104, 45, 1),
(105, 45, 2),
(106, 45, 3),
(107, 45, 4),
(108, 46, 1),
(109, 46, 2),
(110, 47, 1),
(111, 47, 2),
(112, 48, 2),
(113, 48, 3),
(114, 49, 1),
(115, 49, 2),
(116, 50, 1),
(117, 50, 2),
(118, 51, 1),
(119, 51, 2),
(120, 52, 1),
(121, 52, 2),
(122, 53, 1),
(123, 53, 2),
(124, 54, 1),
(125, 54, 2),
(126, 54, 3),
(127, 55, 1),
(128, 56, 1),
(129, 56, 3),
(130, 56, 5),
(131, 57, 2),
(132, 57, 3),
(133, 57, 5),
(134, 58, 2),
(135, 58, 3),
(136, 58, 5),
(137, 59, 1),
(138, 59, 3),
(139, 59, 4),
(140, 59, 5),
(141, 60, 2),
(142, 60, 5),
(143, 61, 1),
(144, 61, 2),
(145, 61, 5),
(146, 62, 3),
(147, 62, 4),
(148, 63, 1),
(149, 63, 3),
(150, 64, 2),
(151, 64, 3),
(152, 65, 2),
(153, 65, 4),
(154, 66, 1),
(155, 66, 3),
(156, 66, 5),
(157, 67, 1),
(158, 67, 2),
(159, 67, 3),
(160, 67, 4),
(161, 67, 5),
(162, 68, 1),
(163, 68, 2),
(164, 68, 3),
(165, 69, 2),
(166, 69, 3),
(167, 69, 4),
(168, 70, 2),
(169, 70, 3),
(170, 70, 5),
(171, 71, 1),
(172, 71, 2),
(173, 71, 3),
(174, 71, 4),
(175, 71, 5),
(176, 72, 1),
(177, 72, 3),
(178, 72, 4),
(179, 73, 1),
(180, 73, 3),
(181, 73, 4),
(182, 74, 1),
(183, 74, 2),
(184, 74, 5),
(185, 75, 1),
(186, 75, 2),
(187, 75, 3),
(188, 75, 4),
(189, 75, 5),
(190, 76, 1),
(191, 76, 3),
(192, 76, 4),
(193, 76, 5),
(194, 77, 1),
(195, 77, 4),
(196, 77, 5),
(197, 78, 1),
(198, 78, 4),
(199, 78, 5),
(200, 79, 2),
(201, 79, 3),
(202, 79, 5),
(203, 80, 1),
(204, 80, 3),
(205, 80, 5),
(206, 81, 1),
(207, 81, 2),
(208, 81, 4),
(209, 82, 1),
(210, 82, 2),
(211, 82, 3),
(212, 82, 4),
(213, 82, 5),
(214, 83, 1),
(215, 83, 2),
(216, 83, 3),
(217, 84, 1),
(218, 84, 3),
(219, 85, 2),
(220, 85, 3),
(221, 85, 5),
(222, 86, 1),
(223, 86, 2),
(224, 86, 3),
(225, 86, 4),
(226, 86, 5),
(227, 87, 1),
(228, 87, 4),
(229, 87, 5),
(230, 88, 1),
(231, 88, 2),
(232, 88, 5),
(233, 89, 1),
(234, 89, 2),
(235, 89, 3),
(236, 90, 3),
(237, 90, 5),
(238, 91, 2),
(239, 91, 5),
(240, 92, 1),
(241, 92, 3),
(242, 92, 5),
(243, 93, 1),
(244, 93, 5),
(245, 94, 2),
(246, 94, 4),
(247, 94, 5),
(248, 95, 1),
(249, 96, 1),
(250, 97, 2),
(251, 98, 1),
(252, 98, 2),
(253, 98, 3),
(254, 98, 4),
(255, 98, 5),
(256, 99, 1),
(257, 99, 5),
(258, 100, 3),
(259, 101, 2),
(260, 101, 5),
(261, 102, 2),
(262, 102, 5),
(263, 103, 3),
(264, 104, 1),
(265, 104, 2),
(266, 105, 1),
(267, 105, 3),
(268, 106, 3),
(269, 107, 1),
(270, 107, 2),
(271, 107, 3),
(272, 107, 4),
(273, 107, 5),
(274, 108, 1),
(275, 108, 5),
(276, 109, 1),
(277, 109, 3),
(278, 109, 5),
(279, 110, 2),
(280, 110, 5),
(281, 111, 2),
(282, 111, 3),
(283, 111, 5),
(284, 112, 2),
(285, 112, 5),
(286, 113, 1),
(287, 113, 2),
(288, 114, 2),
(289, 114, 3),
(290, 115, 1),
(291, 115, 2),
(292, 116, 1),
(293, 116, 2),
(294, 116, 3),
(295, 116, 4),
(296, 116, 5),
(297, 117, 1),
(298, 117, 2),
(299, 117, 3),
(300, 117, 4),
(301, 117, 5),
(302, 118, 2),
(303, 118, 5),
(304, 119, 1),
(305, 119, 5),
(308, 121, 2),
(309, 121, 4),
(310, 122, 2),
(311, 122, 5),
(312, 123, 1),
(313, 123, 3),
(314, 124, 2),
(315, 124, 3),
(316, 124, 4),
(317, 125, 1),
(318, 125, 3),
(319, 126, 1),
(320, 126, 2),
(321, 126, 3),
(322, 126, 4),
(323, 126, 5),
(324, 127, 2),
(325, 127, 5),
(326, 128, 2),
(327, 128, 5),
(328, 129, 2),
(329, 130, 1),
(330, 130, 3),
(331, 130, 5),
(332, 131, 1),
(333, 131, 2),
(334, 131, 3),
(335, 131, 4),
(336, 131, 5),
(337, 132, 1),
(338, 132, 2);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_name`) VALUES
(1, 'S'),
(2, 'L'),
(3, 'M'),
(4, 'XL'),
(5, 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `sub_cat_id` int(11) NOT NULL,
  `sub_cat_name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `c_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bag`
--
ALTER TABLE `bag`
  ADD PRIMARY KEY (`bag_id`),
  ADD KEY `customer_id` (`c_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `c_address`
--
ALTER TABLE `c_address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `c_id` (`c_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_size_id` (`size_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`product_size_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`sub_cat_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bag`
--
ALTER TABLE `bag`
  MODIFY `bag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `c_address`
--
ALTER TABLE `c_address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=573;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `product_size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=339;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bag`
--
ALTER TABLE `bag`
  ADD CONSTRAINT `bag_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`),
  ADD CONSTRAINT `bag_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `bag_ibfk_3` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

--
-- Constraints for table `c_address`
--
ALTER TABLE `c_address`
  ADD CONSTRAINT `c_address_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);

--
-- Constraints for table `discount`
--
ALTER TABLE `discount`
  ADD CONSTRAINT `discount_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `fk_size_id` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`),
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`);

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `product_image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
  ADD CONSTRAINT `product_sizes_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`);

--
-- Constraints for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD CONSTRAINT `subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
