-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 08:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `isdefault` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `user_id`, `name`, `phone`, `address`, `city`, `country`, `zip`, `created_at`, `updated_at`, `isdefault`) VALUES
(2, 2, 'Marko Markovic', '066755333', 'Cetvrte proleterske BB', 'Podgorica', 'Crna Gora', '81101', '2025-03-03 14:04:13', '2025-03-03 14:04:13', 1),
(3, 3, 'Dragan Draganić', '064234155', 'Dimitrija Tucovica 23', 'Užice', 'Srbija', '31107', '2025-03-03 15:25:41', '2025-03-03 15:25:41', 1),
(4, 2, 'Milica Draganić', '0649982234', 'Muhameda Kantardžića 3', 'Sarajevo', 'Bosna i Hercegovina', '71000', '2025-03-17 10:42:39', '2025-03-17 10:42:39', 1),
(24, 3, 'Marija Elez', '0649847221', 'Vuka Karadžića 30', 'Pale', 'Bosna i Hercegovina', '71420', '2025-03-17 11:44:03', '2025-03-17 11:44:03', 1),
(25, 3, 'Dejana Borovina', '0662315589', 'Cara Lazara 42', 'Višegrad', 'Bosna i Hercegovina', '73240', '2025-03-17 11:48:04', '2025-03-17 11:48:04', 1),
(27, 4, 'Jovan Jovanović', '066821667', 'Svetozara Miletića 5', 'Bijeljina', 'Bosna i Hercegovina', '76000', '2025-03-26 15:07:09', '2025-03-26 15:07:09', 1),
(28, 2, 'Danijela Ilić', '066444333', 'Svetog Save 22', 'Foča', 'Bosna i Hercegovina', '73301', '2025-03-27 20:23:32', '2025-03-27 20:23:32', 1),
(29, 4, 'Jovan Jovanović', '066821667', 'Svetozara Miletića 5', 'Bijeljina', 'Bosna i Hercegovina', '76000', '2025-03-29 12:24:20', '2025-03-29 12:24:20', 1),
(30, 4, 'Jovan Jovanović', '066778443', 'Kralja Petra I Oslobodioca 15', 'Trebinje', 'Bosna i Hercegovina', '89101', '2025-04-03 14:28:52', '2025-04-03 14:28:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `created_at`, `updated_at`) VALUES
(2, 'Moncler', 'moncler', '1739707901.png', '2025-02-16 09:04:21', '2025-02-16 11:11:41'),
(3, 'Nordica', 'nordica', '1739708251.png', '2025-02-16 11:17:31', '2025-02-16 11:17:31'),
(4, 'Volkl', 'volkl', '1739708438.png', '2025-02-16 11:20:38', '2025-02-16 11:20:38'),
(5, 'Alpina', 'alpina', '1739708572.png', '2025-02-16 11:22:52', '2025-02-16 11:22:52'),
(6, 'Icepeak', 'icepeak', '1739708677.jpg', '2025-02-16 11:24:37', '2025-02-16 11:24:37'),
(7, 'Bogner', 'bogner', '1739708777.png', '2025-02-16 11:26:17', '2025-02-16 11:26:17'),
(9, 'Uvex', 'uvex', '1742813561.png', '2025-03-24 09:52:41', '2025-03-24 09:52:41'),
(10, 'Oakley', 'oakley', '1742821556.png', '2025-03-24 12:05:56', '2025-03-24 12:05:56'),
(11, 'Poivre Blanc', 'poivre-blanc', '1742823216.jpg', '2025-03-24 12:33:37', '2025-03-24 12:33:37'),
(12, 'Salomon', 'salomon', '1742844620.png', '2025-03-24 18:30:20', '2025-03-24 18:30:20'),
(13, 'Northwave', 'northwave-1', '1742847370.png', '2025-03-24 19:14:31', '2025-03-24 19:16:10'),
(14, 'Burton', 'burton', '1742905812.png', '2025-03-25 11:30:12', '2025-03-25 11:30:12');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('jovan16@gmail.com|127.0.0.1', 'i:1;', 1743697577),
('jovan16@gmail.com|127.0.0.1:timer', 'i:1743697577;', 1743697577),
('miki123@gmail.com|127.0.0.1', 'i:1;', 1744015944),
('miki123@gmail.com|127.0.0.1:timer', 'i:1744015944;', 1744015944);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `parent_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Skijaške jakne', 'skijaske-jakne', '1741688913.png', NULL, '2025-02-17 11:29:05', '2025-03-11 09:28:33'),
(2, 'Skije', 'skije', '1741688431.png', NULL, '2025-02-17 11:30:26', '2025-03-11 09:20:31'),
(5, 'Skijaške rukavice', 'skijaske-rukavice', '1741689114.png', NULL, '2025-02-20 09:33:58', '2025-03-11 09:31:54'),
(6, 'Pantalone', 'pantalone', '1740404307.png', NULL, '2025-02-24 12:38:27', '2025-02-24 12:38:27'),
(7, 'Naočare', 'naocare', '1741688656.png', NULL, '2025-03-11 09:23:10', '2025-03-11 09:24:16'),
(8, 'Kacige', 'kacige', '1742817145.jpg', NULL, '2025-03-24 10:52:26', '2025-03-24 10:52:26'),
(9, 'Pancerice', 'pancerice', '1742820679.png', NULL, '2025-03-24 11:51:20', '2025-03-24 11:51:20'),
(10, 'Snowboard', 'snowboard', '1742846232.png', NULL, '2025-03-24 18:57:13', '2025-03-24 18:57:13'),
(11, 'Vezice za snowboard', 'vezice-za-snowboard', '1742847145.png', NULL, '2025-03-24 19:12:25', '2025-03-24 19:12:25'),
(12, 'Ski štapovi', 'ski-stapovi', '1742848543.png', NULL, '2025-03-24 19:35:43', '2025-03-24 19:35:43');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `comment`, `created_at`, `updated_at`) VALUES
(1, 'Dragoslav Stanojevic', 'dragoslav.s@gmail.com', '0634567889', 'Prezadovoljan uslugom, isporučeno u roku od 2 dana.', '2025-03-11 12:53:41', '2025-03-11 12:53:41'),
(2, 'Katarina Pejic', 'katarinapejic@gmail.com', '065872344', 'Moze li popust za bivsu cimi??', '2025-04-07 06:49:01', '2025-04-07 06:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` enum('fixed','percent') NOT NULL,
  `value` decimal(8,2) NOT NULL,
  `cart_value` decimal(8,2) NOT NULL,
  `expiry_date` date NOT NULL DEFAULT cast(current_timestamp() as date),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `code`, `type`, `value`, `cart_value`, `expiry_date`, `created_at`, `updated_at`) VALUES
(2, 'THANKYOU20', 'percent', 20.00, 100.00, '2026-04-01', '2025-02-26 09:19:07', '2025-02-26 09:19:07'),
(3, 'OFF10', 'fixed', 10.00, 100.00, '2025-06-01', '2025-02-26 11:52:43', '2025-02-26 11:52:43'),
(4, 'OFF30', 'fixed', 30.00, 150.00, '2025-10-01', '2025-02-27 15:07:34', '2025-02-27 19:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(14, 2, 22, '2025-04-07 06:52:43', '2025-04-07 06:52:43');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '0001_01_01_000000_create_users_table', 1),
(8, '0001_01_01_000001_create_cache_table', 1),
(9, '0001_01_01_000002_create_jobs_table', 1),
(10, '2025_01_10_164157_create_brands_table', 2),
(11, '2025_02_17_105146_create_categories_table', 3),
(12, '2025_02_17_143343_create_products_table', 4),
(13, '2025_02_26_092250_create_coupons_table', 5),
(14, '2025_02_27_121139_create_orders_table', 6),
(15, '2025_02_27_121200_create_order_items_table', 6),
(16, '2025_02_27_121213_create_addresses_table', 6),
(17, '2025_02_27_121228_create_transactions_table', 6),
(18, '2025_02_27_140050_add_new_column_to_orders_table', 7),
(19, '2025_02_27_143004_add_isdefault_to_addresses_table', 8),
(20, '2025_03_10_090620_create_s_lides_table', 9),
(21, '2025_03_10_131025_create_month_names_table', 10),
(22, '2025_03_11_124304_create_contacts_table', 11),
(23, '2025_03_19_103127_add_pol_and_velicina_to_products_table', 12),
(24, '2025_03_19_105304_add_size_to_order_items_table', 13),
(25, '2025_03_19_114903_create_sizes_table', 14),
(26, '2025_03_19_115003_add_size_id_to_products_table', 15),
(27, '2025_03_20_142321_remove_size_from_products', 16),
(28, '2025_03_20_180904_create_favorites_table', 17),
(29, '2025_03_21_145844_add_has_sizes_to_products_table', 18);

-- --------------------------------------------------------

--
-- Table structure for table `month_names`
--

CREATE TABLE `month_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `month_names`
--

INSERT INTO `month_names` (`id`, `name`) VALUES
(1, 'January'),
(2, 'February'),
(3, 'March'),
(4, 'April'),
(5, 'May'),
(6, 'June'),
(7, 'July'),
(8, 'August'),
(9, 'September'),
(10, 'October'),
(11, 'November'),
(12, 'December');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` decimal(8,2) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `discount` decimal(8,2) NOT NULL DEFAULT 0.00,
  `tax` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `customer_note` text DEFAULT NULL,
  `status` enum('ordered','delivered','canceled') NOT NULL DEFAULT 'ordered',
  `delivered_date` date DEFAULT NULL,
  `canceled_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `coupon_code`, `discount`, `tax`, `total`, `name`, `phone`, `address`, `city`, `country`, `zip`, `customer_note`, `status`, `delivered_date`, `canceled_date`, `created_at`, `updated_at`, `email`) VALUES
(1, 2, 1425.00, NULL, 0.00, 242.25, 1667.25, 'Marko Markovic', '066755333', 'Cetvrte proleterske BB', 'Podgorica', 'Crna Gora', '81101', 'dostava do 16:00', 'delivered', '2025-03-06', NULL, '2025-03-03 14:04:13', '2025-03-06 13:40:23', 'miki@gmail.com'),
(2, 2, 3088.00, NULL, 0.00, 524.96, 3612.96, 'Marko Markovic', '066755333', 'Cetvrte proleterske BB', 'Podgorica', 'Crna Gora', '81101', NULL, 'canceled', NULL, '2025-03-06', '2025-03-03 15:09:18', '2025-03-06 13:40:47', 'miki@gmail.com'),
(4, 3, 4570.00, NULL, 0.00, 776.90, 5346.90, 'Dragan Draganić', '064234155', 'Dimitrija Tucovica 23', 'Užice', 'Srbija', '31107', 'isporuciti do 16:00 radnim danom', 'delivered', '2025-03-18', NULL, '2025-03-03 15:25:41', '2025-03-18 10:45:02', 'dragandd@yahoo.com'),
(7, 2, 4879.00, NULL, 0.00, 829.43, 5708.43, 'Marko Markovic', '066755333', 'Cetvrte proleterske BB', 'Podgorica', 'Crna Gora', '81101', NULL, 'delivered', '2025-03-18', NULL, '2025-03-06 10:23:42', '2025-03-18 10:09:22', 'miki@gmail.com'),
(8, 2, 4879.00, NULL, 0.00, 829.43, 5708.43, 'Marko Markovic', '066755333', 'Cetvrte proleterske BB', 'Podgorica', 'Crna Gora', '81101', NULL, 'delivered', '2025-03-26', NULL, '2025-03-06 10:24:59', '2025-03-26 15:12:45', 'miki@gmail.com'),
(10, 3, 64.00, NULL, 0.00, 10.88, 74.88, 'Dragan Draganić', '064234155', 'Dimitrija Tucovica 23', 'Užice', 'Srbija', '31107', NULL, 'ordered', NULL, NULL, '2025-03-17 10:12:12', '2025-03-17 10:12:12', 'dragandd@yahoo.com'),
(13, 3, 1425.00, NULL, 0.00, 242.25, 1667.25, 'Milica Draganić', '0649982234', 'Muhameda Kantardžića 3', 'Sarajevo', 'Bosna i Hercegovina', '71000', 'isporučiti u prijepodnevnim časovima', 'ordered', NULL, NULL, '2025-03-17 11:16:54', '2025-03-17 11:16:54', 'dragandd@yahoo.com'),
(14, 3, 3999.00, NULL, 0.00, 679.83, 4678.83, 'Marija Elez', '0649847221', 'Vuka Karadžića 30', 'Pale', 'Bosna i Hercegovina', '71420', 'dostaviti u ponedeljak', 'canceled', NULL, '2025-03-17', '2025-03-17 11:44:03', '2025-03-17 12:07:49', 'majae@yahoo.com'),
(17, 4, 585.95, 'THANKYOU20', 171.37, 99.53, 685.48, 'Jovan Jovanović', '066821667', 'Svetozara Miletića 5', 'Bijeljina', 'Bosna i Hercegovina', '76000', 'po potrebi pozvati na 055422844', 'delivered', '2025-04-03', NULL, '2025-03-26 15:07:09', '2025-04-03 12:55:55', 'jovan19@gmail.com'),
(18, 2, 622.06, 'THANKYOU20', 181.93, 105.66, 727.72, 'Danijela Ilić', '066444333', 'Svetog Save 22', 'Foča', 'Bosna i Hercegovina', '73301', 'isporučiti kod komšinice', 'delivered', '2025-03-27', NULL, '2025-03-27 20:23:32', '2025-03-27 20:27:49', 'dacailic@gmail.com'),
(19, 4, 86.89, 'OFF10', 10.00, 14.76, 101.65, 'Jovan Jovanović', '066821667', 'Svetozara Miletića 5', 'Bijeljina', 'Bosna i Hercegovina', '76000', NULL, 'ordered', NULL, NULL, '2025-03-29 12:24:20', '2025-03-29 12:24:20', 'jovan19@gmail.com'),
(20, 4, 173.65, 'OFF30', 30.00, 29.50, 203.15, 'Jovan Jovanović', '066778443', 'Kralja Petra I Oslobodioca 15', 'Trebinje', 'Bosna i Hercegovina', '89101', 'najaviti dostavu dan prije', 'ordered', NULL, NULL, '2025-04-03 14:28:52', '2025-04-03 14:28:52', 'jovanjov12@yahoo.com');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `size` enum('S','M','L','XL') DEFAULT NULL,
  `rStatus` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `order_id`, `price`, `quantity`, `size`, `rStatus`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1425.00, 1, NULL, 0, '2025-03-03 14:04:13', '2025-03-03 14:04:13'),
(2, 3, 2, 80.00, 2, NULL, 0, '2025-03-03 15:09:18', '2025-03-03 15:09:18'),
(3, 2, 2, 3700.00, 1, NULL, 0, '2025-03-03 15:09:18', '2025-03-03 15:09:18'),
(5, 4, 4, 880.00, 1, NULL, 0, '2025-03-03 15:25:41', '2025-03-03 15:25:41'),
(6, 2, 4, 3700.00, 1, NULL, 0, '2025-03-03 15:25:41', '2025-03-03 15:25:41'),
(9, 4, 7, 880.00, 1, NULL, 0, '2025-03-06 10:23:42', '2025-03-06 10:23:42'),
(10, 1, 7, 3999.00, 1, NULL, 0, '2025-03-06 10:23:42', '2025-03-06 10:23:42'),
(11, 4, 8, 880.00, 1, NULL, 0, '2025-03-06 10:24:59', '2025-03-06 10:24:59'),
(12, 1, 8, 3999.00, 1, NULL, 0, '2025-03-06 10:24:59', '2025-03-06 10:24:59'),
(13, 3, 10, 80.00, 1, NULL, 0, '2025-03-17 10:12:12', '2025-03-17 10:12:12'),
(20, 5, 13, 1425.00, 1, NULL, 0, '2025-03-17 11:16:54', '2025-03-17 11:16:54'),
(21, 1, 14, 3999.00, 1, NULL, 0, '2025-03-17 11:44:03', '2025-03-17 11:44:03'),
(23, 20, 17, 45.20, 1, NULL, 0, '2025-03-26 15:07:09', '2025-03-26 15:07:09'),
(24, 10, 17, 811.65, 1, NULL, 0, '2025-03-26 15:07:09', '2025-03-26 15:07:09'),
(25, 25, 18, 909.65, 1, NULL, 0, '2025-03-27 20:23:32', '2025-03-27 20:23:32'),
(26, 15, 19, 111.65, 1, NULL, 0, '2025-03-29 12:24:20', '2025-03-29 12:24:20'),
(27, 7, 20, 121.50, 1, NULL, 0, '2025-04-03 14:28:52', '2025-04-03 14:28:52'),
(28, 15, 20, 111.65, 1, NULL, 0, '2025-04-03 14:28:52', '2025-04-03 14:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `gender` enum('F','M','U') DEFAULT NULL,
  `has_sizes` tinyint(1) NOT NULL DEFAULT 0,
  `regular_price` decimal(8,2) NOT NULL,
  `sale_price` decimal(8,2) DEFAULT NULL,
  `SKU` varchar(255) NOT NULL,
  `stock_status` enum('da','ne') NOT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `quantity` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `image` varchar(255) DEFAULT NULL,
  `images` text DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `size_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `short_description`, `description`, `gender`, `has_sizes`, `regular_price`, `sale_price`, `SKU`, `stock_status`, `featured`, `quantity`, `image`, `images`, `category_id`, `brand_id`, `created_at`, `updated_at`, `size_id`) VALUES
(1, 'Lamoura kratka zenska jakna', 'lamoura-kratka-zenska-jakna', 'Kratka jakna u svijetlo plavoj boji.', 'Punjenje: perje.', 'F', 1, 4300.00, 3999.00, '123467291', 'ne', 0, 0, '1739882765.png', '1739977040-1.png,1739977040-2.png,1739977040-3.png,1739977040-4.jpg,1739977040-5.jpg', 1, 2, '2025-02-18 11:46:05', '2025-03-21 15:37:39', NULL),
(2, 'Ellya ženska jakna', 'ellya-zenska-jakna', 'Životinjski print čini moderan vrhunac dizajna.', 'Zahvaljujući toploj Thermore Ecodown podlozi napravljenoj od recikliranih tehničkih vlakana i svojim trajnim vodoodbojnim, vodootpornim i prozračnim svojstvima, Ellia ski jakna je siguran pogodak kao funkcionalna odeća za zimske sportove.', 'F', 1, 3700.00, 3300.00, '860003700308', 'da', 1, 4, '1739973999.png', '1739977006-1.png,1739977006-2.png', 1, 7, '2025-02-19 13:06:39', '2025-03-21 15:27:58', NULL),
(3, 'Harlingen rukavice', 'harlingen-rukavice', 'Rukavice namijenjene za muškarce i za žene.', 'Napravljene od prave kože, ove rukavice pružaju odlično prianjanje i izdržljivost. Postava od mekog flisa pruža ugodan osećaj, dok PrimaLoft izolacija pruža toplinu bez dodavanja zapremine.', 'M', 0, 90.00, 63.00, '344820183744', 'da', 1, 9, '1740047812.png', '1740047812-1.png', 5, 6, '2025-02-20 09:36:53', '2025-03-24 12:29:45', NULL),
(4, 'Marren ženske off-white ski pantalone', 'marren-zenske-off-white-ski-pantalone', 'Skijaške pantalone u normalnom kroju. Rubovi na nogavicama završeni patentnim zatvaračima, podstavljeni delovima od ripstop tkanine.', 'Od vodoodbojne, vodootporne i prozračne četvorosmerne rastezljive tkanine, ove Maren ski pantalone su izvanredan funkcionalan komad. Dodatno su poboljšani visokim mekanim pojasom sa logom. Comfortemp® podstava napravljena od tehničkih vlakana čini ih udobnim i toplim, dok unutrašnji štitnik od snega dovršava dizajn sa stilom.', 'F', 1, 880.00, 880.00, '743821234567', 'da', 1, 3, '1740404792.png', '1740404792-1.png,1740404792-2.png,1740404792-3.png', 6, 7, '2025-02-24 12:46:34', '2025-03-24 11:00:22', NULL),
(5, 'Skije RACETIGER SC Yell', 'skije-racetiger-sc-yell', 'RACETIGER SC 24/25 jedinstvene su skije u popularnoj Racetiger liniji s ekskluzivnim inovacijama i novom geometrijom za kraći slalomski zavoj.', 'Novi Racetiger modeli koriste novu Völkl tehnologiju s integriranim karbonom u vrhovima skije Tailored Carbon Tips i Titanal Band, kao i novi oblik bočnog zida, čime se jasno razlikuju od svojih prethodnika.\r\nTo ih čini savršenim izborom za iskusne skijaše koji cijene dinamičan i sportski stil skijanja, ali također žele uživati u cjelodnevnom skijanju.', 'U', 0, 1425.00, 1282.50, '7287123907600', 'da', 1, 9, '1740657691.jpg', '1740657691-1.png', 2, 4, '2025-02-27 10:57:56', '2025-03-25 10:47:59', NULL),
(6, 'Naočare Athletic LGL', 'naocare-athletic-lgl', 'Okvir napravljen za mogućnost nošenja preko naočara za vid.', 'Inspirisan ugaonim dizajnom naočara iz 80-ih, novi Uvex Athletic LGL su naočare za staze, parkove i mekani snijeg. Uvex inženjeri su razvili naočare koje ne samo da privlače pažnju svojim izgledom, već se takođe izdvajaju zahvaljujući velikom vidnom polju. Uvex Athletic LGL je konstruisan na takav način da ga njegov privlačan i funkcionalan dizajn okvira čini idealnim za širok izbor modela kaciga. Uvex Athletic LGL štiti od štetnih UVA, UVB i UVC zraka. Isproban i testiran Supravision premaz pouzdano spriječava zamagljivanje stakla u bilo kom vremenu. Silikonski print na kaišu za naočare obezbeđuju da naočare bezbedno stoje na kacigi i da ne klize.', 'U', 0, 85.00, 85.00, '5505222130', 'da', 1, 10, '1742815431.jpg', '1742815618-1.jpg,1742815618-2.jpg', 7, 9, '2025-03-24 09:57:12', '2025-03-24 10:26:58', NULL),
(7, 'DOWNHILL 2100 CV skijaške naočale, plave', 'downhill-2100-cv-skijaske-naocale-plave', 'Colorvision kontrastni filter poboljšava raspoznavanje okoline uz 100 % zaštitu od UVA, UVB i UVC zraka', 'Uvex Downhill 2100 CV skijaške naočale oduševljavaju svojim povećanim vidnim poljem, smanjenim okvirom i poboljšanim prilagođavanjem, posebno u dijelu oko nosa. Posebno dizajnirana leća na naočalama pruža vam pogled bez izobličenja i zahvaljujući Supravision tehnologiji, osigurava da će zamagljivanje biti stvar prošlosti. Inovativni filter boja i kontrasta Colorvision poboljšava percepciju..', 'U', 0, 151.65, 121.50, '4043197337814', 'da', 1, 8, '1742815045.jpg', '1742815045-1.jpg,1742815045-2.jpg', 7, 9, '2025-03-24 10:16:37', '2025-04-03 14:28:52', NULL),
(8, 'Alpina NAKISKA crne naočare', 'alpina-nakiska-crne-naocare', 'Naočale su primjerene za srednje velika lica, te ergonomski oblikovane da se optimalno prilagođavaju svakom obliku lica', 'Alpina Nakiska su skijaške naočare bez okvira s cilindričnom panoramskom lećom koja omogućuje neometan pogled. Naočare imaju Doubleflex leće koje povećavaju kontraste, otporne su na udarce i pružaju 100 % UV zaštitu. Naočare se odlikuju sofisticiranim dizajnom, iznimnom kvalitetom leća s izvrsnom ventilacijom zahvaljujući sistemu Airframe venting, troslojnom pjenom za dodatnu udobnost, Fog-Stop zaštitom protiv magljenja i udobnošću pri nošenju. Stepen zaštite S2.', 'U', 0, 77.60, 77.60, '4003692296818', 'da', 1, 8, '1742816925.png', '1742816611-1.png,1742816611-2.png', 7, 5, '2025-03-24 10:41:10', '2025-03-24 10:48:45', NULL),
(9, 'Kaciga Uvex ULTRA', 'kaciga-uvex-ultra', 'Hibridna tehnologija kombinuje moderan vrhunski dizajn sa jedinstvenom udobnošću nošenja i izvanrednom bezbednošću. Čvrsta je, lagana i super moderna.', 'Spoljna Inmould školjka na donjem dijelu kacige je ultra lagana, Hard shell školjka na gornjem dijelu kacige je posebno robusna i otporna na udarce. Između se nalazi EPS unutrašnja školjka koja upija udarce, koja u najgorem slučaju razvija svoj puni zaštitni efekat. Za maksimalnu udobnost, Uvex Ultra se isporučuje sa funkcionalnom unutrašnjošću i monomatskim zatvaračem kojim se može upravljati jednom rukom. Može se prilagoditi svakoj glavi sa milimetarskom preciznošću pomoću isprobanog i testiranog IAS sistema.', 'F', 1, 210.00, 198.45, '12881956648', 'da', 1, 15, '1742817578.png', '1742821131-1.png', 8, 9, '2025-03-24 10:59:38', '2025-03-24 11:58:51', NULL),
(10, 'Skije Dobermann SLR DC Fdt', 'skije-dobermann-slr-dc-fdt', 'Veličina/radius: 160/12.5m', 'Bez obzira da li ste na trkačkoj stazi ili daleko od nje, Nordicin Dobermann SLR DC žudi da se okrene. Sa apetitom za kratke, eksplozivne zaokrete, pruža maksimalnu snagu i preciznost. Potpuno nova Double Core konstrukcija Dobermann SLR DC sadrži jezgro od drveta i sloj elastomera između dva lista titanala. Dobermann SLR DC takođe prikazuje novu dvodelnu ploču napravljenu od cinka i aluminijuma. Ova ploča pojačava odziv za munjevito brze prelaze od ivice do ivice, dok dozvoljava skiji da se prirodno savija za optimalne performanse.', 'M', 0, 1159.90, 811.65, '92354112342', 'da', 1, 4, '1742819774.png', '1742819774-1.png,1742819774-2.png', 2, 3, '2025-03-24 11:36:15', '2025-03-26 15:07:09', NULL),
(11, 'NORDICA SPORTMACHINE 3 ST', 'nordica-sportmachine-3-st', 'Veličine: 270 (S), 280 (M), 285 (L) i 290 (XL)', 'Nordica Sportmachine kolekcija posvećena je skijašima koji provode svoj dan uživajući u cijeloj planini. Izgrađene sa širim last-om, ove ski cipele omogućavaju savršeni fit i širim stopalima. Primaloft izolacija obezbeđuje dodatnu toplinu, dok se gornji deo cipele može lako prilagoditi kako bi se omogućilo neutralniji položaj koji poboljšava ravnotežu i smanjuje umor.', 'M', 1, 304.00, 304.00, '4325870098553', 'da', 0, 12, '1742820925.jpg', '1742821359-1.png', 9, 3, '2025-03-24 11:55:25', '2025-03-24 12:02:40', NULL),
(12, 'Jakna OAKLEY TNP TBT', 'jakna-oakley-tnp-tbt', '100% Polyester Oxford Mechanical Stretch', 'Oakley TNP TBT izolovana jakna za snowbord karakteriše kreativni kolor blok dizajn – istovremeno pružajući maksimalnu pokrivenost vremenskim uslovima sa zaljepljenim šavovima i FN Dry™ 10K laminatom sa O-Protect DWR premazom. Ostanite topli u prohladnim jutrima u izolaciji od 80gr ili je prozračite do ručka kroz otvore za ventilaciju i podesive čičak manžetne. Sa Oakley-jevim 100% Polyester Oxford Mechanical Stretch, bićete spremni za performanse bez obzira na uslove.', 'M', 1, 381.35, 350.00, '9657912460004', 'da', 1, 15, '1742821936.jpg', '1742821936-1.png,1742821936-2.png', 1, 10, '2025-03-24 12:12:17', '2025-03-24 12:12:17', NULL),
(13, 'Icepeak EDGERTON, muška jakna, zelena', 'icepeak-edgerton-muska-jakna-zelena', 'Dizajnirana je s tehnologijom A.W.S. Active, koja je namijenjena ljudima koje neće zaustaviti ni najneugodniji vremenski uslovi.', 'Icepeak Edgerton je muška jakna koja je primjerena za skijanje i druge zimske aktivnosti. Izrađena je od dvoslojnog, vodoodbojnog materijala koji pomaže zaštititi od vremenskih nepogoda. Izolacija, koja oponaša karakteristike perja, brine za toplinu i udobnost u hladnijim uvjetima. Ima podesivu kapuljaču te vodoodbojni zatvarač. Jakna ima dva bočna džepa s patentnim zatvaračima, dva džepa na prsima s vodoodbojnim zatvaračima, unutarnji džep s patentnim zatvaračem te veći mrežasti džep na unutarnjoj strani. Rukavi završavaju unutarnjom manžetnom koja ima otvor za palac. U unutrašnjosti ima posebnu zaštitu koja sprječava prodiranje snijega u unutrašnjost', 'M', 1, 399.50, 279.65, '6561145331124', 'da', 1, 7, '1742822840.jpg', '1742822840-1.jpg,1742822840-2.jpg,1742822840-3.jpg', 1, 6, '2025-03-24 12:27:22', '2025-03-24 12:27:22', NULL),
(14, 'Ženske rukavice W22-1775-WO/A', 'zenske-rukavice-w22-1775-woa', 'Sastav: Shell: 95% Poliamid 5% Elastin, Shell 2 - 100% Poliester', 'Tanke rukavice od rastezljivog flisa imaju neverovatno mek flis unutra i pružaju vam visoku udobnost nošenja. Spolja je malo otporna na vetar i potpuno prozračna. Preporučujemo nošenje rukavica za svakodnevnu upotrebu po hladnom vremenu. To ih čini idealnim za šetnje i šetnje na niskim temperaturama.', 'F', 1, 45.00, 45.00, '295642214020', 'da', 0, 5, '1742823708.png', '1742823708-1.png', 5, 11, '2025-03-24 12:37:46', '2025-03-24 12:41:48', NULL),
(15, 'Icepeak FRANKFURT, muške skijaške hlače', 'icepeak-frankfurt-muske-skijaske-hlace', 'Pantalone su izrađene od softshell materijala, koji ima vodoodbojnu površinu.', 'Pantalone su izuzetno otporne čak i u ekstremnim vremenskim uslovima. Materijal omogućava da vlaga brzo ispari, obezbjeđujući suhoću i udobnost. Dizajnirane su sa A.W.S. Extreme tehnologijom, koja je namijenjena ljudima koje ne zaustavljaju ni najnepovoljniji vremenski uslovi. Odjevni predmet karakterišu strukturalni detalji i zaštitni materijali, koji štite u svim okolnostima, bez obzira na vremenske prilike. Materijal je elastičan u dva smjera i omogućava veliku slobodu kretanja. Na kraju nogavica imaju zaštitu od ulaska snijega i rajsferšlus. Džepovi se zatvaraju rajsferšlusom.', 'M', 1, 159.50, 111.65, '6570105424504', 'da', 1, 5, '1742824839.png', '1742824912-1.jpg,1742824912-2.jpg', 6, 6, '2025-03-24 13:00:40', '2025-04-03 14:28:52', NULL),
(16, 'Icepeak FLIPPIN, ženska crno-bijela jakna', 'icepeak-flippin-zenska-crno-bijela-jakna', 'Izrađena je od dvoslojnog umjetnog materijala koji pomaže zaštititi od vremenskih nepogoda. Materijal: 100 % poliester', 'Icepeak Flippin je ženska jakna koja je primjerena za skijanje i druge zimske aktivnosti u slobodno vrijeme. Po površini je obrađena vodoodbojnim premazom. Izolacija, koja oponaša karakteristike perja, brine za toplinu i udobnost u hladnijim uvjetima. Ima podesivu i uklonjivu kapuljaču te patentni zatvarač. Jakna ima dva bočna džepa, džep na rukavu, unutarnji džep s patentnim zatvaračem te veći mrežasti džep na unutarnjoj strani. Rukavi završavaju unutarnjom manžetom koja ima otvor za palac. U unutrašnjosti ima posebnu zaštitu koja sprječava prodiranje snijega u unutrašnjost. Po cijeloj površini je ukrašena atraktivnim grafičkim uzorkom.', 'F', 1, 339.50, 237.65, '6531255941747', 'da', 0, 11, '1742827354.jpg', '1742827354-1.jpg,1742827354-2.jpg,1742827354-3.jpg', 1, 6, '2025-03-24 13:42:36', '2025-03-24 13:42:36', NULL),
(17, 'S/PRO SUPRA BOA X90 ženske pancerice', 'spro-supra-boa-x90-zenske-pancerice', 'Pancerice su posebne po svom izgledu jer predstavljaju mješavinu inovativnosti i elegancije po kojoj ćete se istaknuti u masi. Veličina: 250/255.', 'Školjka je izrađena Custom shell HD tehnologijom koja omogućuje personalizirani dizajn prema anatomiji stopala uz pomoć termičke obrade školjke. Tehnologija koja omogućuje personalizirani donji dio školjke u samo deset minuta, dok sve ostale komponente približavaju stopalo školjki. Power Spine pruža snažnu potporu, progresivan odskok iz zavoja i savijanje prema naprijed bez obzira na uvjete. Integrirani Boa Fit sistem pruža uski osjećaj za još veću udobnost i kontrolu pri vođenju skije. Sistem Boa Fit pruža mikro podešavanje i precizno prilagođavanje za još bolje performanse u najtežim uslovima.', 'F', 0, 629.25, 629.25, '1958751672764', 'da', 0, 10, '1742845668.jpg', '1742845668-1.jpeg,1742845668-2.jpeg,1742845668-3.jpeg', 9, 12, '2025-03-24 18:47:50', '2025-03-24 18:47:50', NULL),
(18, 'Snowboard SALOMON W Lotus', 'snowboard-salomon-w-lotus', 'Namjenjen čak i početnicima u snoubordingu.', 'SALOMON Lotus snowboard sadrži lagano savijanje sa Flat Out Camber-om i Bite Free na ivicama za kreativnu vožnju sa malim posljedicama. Na taj način olakšava napredovanje i smanjuje posljedice za početnike. Ovo je pravi izbor za sve koji žele da istraže sve terene sa freestyle vožnjom.', 'F', 0, 676.00, 544.00, '4766070013565', 'da', 1, 4, '1742846622.png', '1742846622-1.png,1742846622-2.png', 10, 12, '2025-03-24 19:03:43', '2025-03-24 19:03:43', NULL),
(19, 'Vezovi NORTHWAVE King Sand/Black', 'vezovi-northwave-king-sandblack', 'Materijal: aluminijum i fiberglas', 'All mountain model, ima sve potrebne specifikacije za pristup vašem snowboardu i napredak u vašem snowboarding-u. Pristupačan i udoban, ovaj vez je napravljen za sve one koji su novi u snowboarding-u ili koji žele nastaviti napredovati. Delta je izvorni Drakeov koncept u svom najčišćem obliku. Sa prethodno zakrivljenom aluminijskom potpeticom izravno povezanom s baznom pločom od najlona/stakloplastike.', 'U', 1, 270.00, 270.00, '7123102467276', 'da', 0, 4, '1742847767.png', '1742847767-1.png,1742847767-2.png', 11, 13, '2025-03-24 19:22:48', '2025-03-24 19:22:48', NULL),
(20, 'Ski štapovi SALOMON Hacker Orange', 'ski-stapovi-salomon-hacker-orange', 'Materijal: aluminijum', 'Savršen dodatak vašim skijama, ovi štapovi vam pomažu da cijelu planinu učinite svojim igralištem.', 'U', 0, 45.20, 45.20, '4152530011066', 'da', 0, 19, '1742848661.png', '1742848661-1.png', 12, 12, '2025-03-24 19:37:41', '2025-03-26 15:07:09', NULL),
(21, 'Skije VOLKL DEACON 72 Blk 24+ RM3', 'skije-volkl-deacon-72-blk-24-rm3', 'Skije Volkl DEACON 72 su svestrane All Mountain/Piste skije s kojima možete kombinirati duge, srednje i kratke zavoje. Ako ste ambiciozni skijaš koji teži savršenom carving zavoju - ne tražite dalje.', 'S novom geometrijom, proširenim vrhom i skraćenim rocker profilom, ova skija svladava svaki radijus zavoja zahvaljujući dva milimetra užem struku. Uži struk pruža mnogo dinamičniju vožnju s brzim odzivom i vrlo preciznim promjenama rubova.\r\nDeacon 72 dolazi s Tailored Carbon Tips tehnologijom, a radi se o posebno dizajniranim i strateški smještenim isprepletenim karbonskim vlaknima na vrhovima skija. Čvrstoća i poseban položaj karbonskih vlakna daju ovim skijama još brži odaziv i veću agilnost s manjim utroškom energije, a bez gubitka preciznosti i kontrole.', 'U', 0, 800.00, 720.00, '3737721115558', 'da', 1, 5, '1742903131.png', '1742903131-1.png,1742903131-2.png,1742903131-3.png', 2, 4, '2025-03-25 10:45:32', '2025-03-25 10:45:32', NULL),
(22, 'Alpina Alto QV ski kaciga sa vizirom', 'alpina-alto-qv-ski-kaciga-sa-vizirom', 'Vizir je opremljen Quattro Varioflex sočivima koja su polarizovana – nude vizuelnu jasnoću prilagođavajući se promenljivim svetlosnim uslovima i smanjujući odsjaj sa snježnih površina.', 'Skijaška kaciga Alpina Alto QV sa vizirom je svestran komad opreme dizajniran za sve ljubitelje zimskih sportova. Ova uniseks skijaška kaciga kombinuje sigurnost i stil, nudeći naprednu zaštitu bez ugrožavanja udobnosti. Napravljena od EPS i hardshell tehnologije, kaciga osigurava robusnu otpornost na udarce. Uključivanje tehnologije Fidlock osigurava sigurno pričvršćivanje, dok Y-kvačica poboljšava stabilnost tokom upotrebe. Za personaliziranu udobnost, Airfit podstava se prilagođava obliku vaše glave, a integrirani grijač za vrat dodaje dodatnu toplinu u hladnim uslovima.', 'U', 1, 104.00, 104.00, '9388741234554', 'da', 1, 4, '1742904950.jpg', '1742904950-1.jpg,1742904950-2.jpg,1742904950-3.jpg,1742904950-4.jpg', 8, 5, '2025-03-25 11:15:52', '2025-03-25 11:15:52', NULL),
(23, 'Salomon - S/Race Carbon štapovi', 'salomon-srace-carbon-stapovi', 'Dužina: 130cm', 'S/Race Carbon pruža svu laganu i apsorpciju udaraca karbona, uz dodatnu izdržljivost oko gornje osovine, tako da možete ići punim gasom na stazi. Precizan hvat, lagana težina zamaha i optimalna krutost, ovaj štap je gladan brzine. Težina: 0.25 kg.', 'M', 0, 95.95, 95.95, '8837361235603', 'da', 0, 10, '1742905320.jpg', '1742905320-1.jpg', 12, 12, '2025-03-25 11:21:20', '2025-03-25 11:22:00', NULL),
(24, 'Blossom Camber Snowboard', 'blossom-camber-snowboard', 'Veličina: 162cm', 'Inspirisan izgledom erodiranog kamena sa kristalom u unutrašnjosti, timski vozač Niels Schack donosi svoj kreativni zaokret na Blossom dasku za zimu 25 sa grafikom gornjeg lista koja je promenjena vremenskim uslovima koja menja boje na niskim temperaturama i živopisnim, šarenim dizajnom osnove. Za zimu 26, Niels je upotpunio grafiku slobodnim stilom, sa vatreno crvenom palubom i palminom osnovom koja će iskočiti u parku, odajući počast kreativnoj energiji Blossom-a.', 'M', 0, 600.00, 600.00, '2645276223456', 'da', 1, 5, '1742905971.png', '1742906033-1.png,1742906033-2.png,1742906033-3.png', 10, 14, '2025-03-25 11:32:52', '2025-03-25 11:33:54', NULL),
(25, 'Nordica SPITFIRE TI + TP2 LT11 FDT, set all round skija', 'nordica-spitfire-ti-tp2-lt11-fdt-set-all-round-skija', 'Veličina: 156; Prečnik: 13.5; Težina: 2.78kg', 'Kao i svi modeli u porodici Spitfire, Ti je carving skije visokih performansi napravljeno za one koji vole skijaše. Ali budući da je napravljen od drvene jezgre i samo jednog lima, nije toliko zahtjevan, što ga čini idealnim za manje agresivne skijaše. Predimenzionirani oblik vrha skije omogućava brzo i jednostavno pokretanje okretanja, dok GS struk i rep omogućavaju sve, od velikih zaokreta do brzih lukova kratkog radijusa. A nova Race Plate omogućava glatko savijanje uz dodatnu stabilnost. Ako tražite svestranu carving skiju koja je razigrana i laka za okretanje, Spitfire Ti je upravo ono što vam treba.', 'U', 0, 909.65, 909.65, '6445535213241', 'da', 1, 5, '1742906558.png', '1742906558-1.png,1742906558-2.png,1742906558-3.png', 2, 3, '2025-03-25 11:42:41', '2025-03-27 20:23:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Xlz0VGwiEHRTjlfsCqpwoYdv2gvTCf754S8xQAMM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36 Edg/136.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibXBrRzBNWXl6QzVvb2I2M0hpV1JoQnRCb0VibU9DN1ZxMTlqQU9QbyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9sb2dpbiI7fX0=', 1746208724);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`) VALUES
(3, 'L'),
(2, 'M'),
(1, 'S'),
(4, 'XL');

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tagline` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subtitle` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`id`, `tagline`, `title`, `subtitle`, `link`, `image`, `status`, `created_at`, `updated_at`) VALUES
(2, 'ON SALE', 'Rasprodaja kolekcije 2024/25', 'od -10% do -50%', 'http://localhost:8000/shop/ellya-zenska-jakna', '1741608617.png', 1, '2025-03-10 11:00:52', '2025-03-10 11:16:35'),
(3, 'NEWS', 'Besplatna dostava', 'za sve narudžbe', 'http://localhost:8000/shop', '1741609680.png', 1, '2025-03-10 11:14:14', '2025-03-25 10:49:00'),
(4, 'SALEEEE', 'Sniženje Icepeak opreme', 'do kraja marta -30%', 'http://localhost:8000/shop', '1741610032.png', 1, '2025-03-10 11:33:52', '2025-03-25 10:52:12');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `mode` enum('cod','card','paypal') NOT NULL,
  `status` enum('pending','approved','declined','refunded') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `order_id`, `mode`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, 8, 'cod', 'approved', '2025-03-06 10:24:59', '2025-03-26 15:12:45'),
(2, 2, 7, 'cod', 'approved', '2025-03-06 10:23:42', '2025-03-18 10:09:22'),
(5, 3, 4, 'cod', 'approved', '2025-03-03 15:25:41', '2025-03-18 10:45:03'),
(7, 2, 2, 'cod', 'declined', '2025-03-03 15:09:18', '2025-03-06 13:40:47'),
(8, 2, 1, 'cod', 'approved', '2025-03-03 14:04:13', '2025-03-06 13:40:23'),
(9, 3, 10, 'cod', 'pending', '2025-03-17 10:12:12', '2025-03-17 10:12:12'),
(11, 3, 13, 'cod', 'pending', '2025-03-17 11:16:54', '2025-03-17 11:16:54'),
(12, 3, 14, 'cod', 'declined', '2025-03-17 11:44:04', '2025-03-17 12:07:49'),
(13, 4, 17, 'cod', 'approved', '2025-03-26 15:07:09', '2025-04-03 12:55:55'),
(14, 2, 18, 'cod', 'approved', '2025-03-27 20:23:32', '2025-03-27 20:27:22'),
(15, 4, 19, 'cod', 'pending', '2025-03-29 12:24:20', '2025-03-29 12:24:20'),
(16, 4, 20, 'cod', 'pending', '2025-04-03 14:28:52', '2025-04-03 14:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `utype` varchar(255) NOT NULL DEFAULT 'USR' COMMENT 'ADM for administrator, USR for customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `email_verified_at`, `password`, `utype`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Kristina Knežević', 'kristina@gmail.com', '0645671212', NULL, '$2y$12$ppDCx2P0Zzi9ZBvcV/CEIOJ7EONYyGoxZ6tpAVvBdSzxtsl77lA/q', 'ADM', NULL, '2025-01-10 15:13:09', '2025-01-10 15:13:09'),
(2, 'Marko Marković', 'miki@gmail.com', '0671234562', NULL, '$2y$12$CZxr3JaMxafNIPELns.7pOo7yifRXalEKySPcU5pwI9Mq6eJVXOWO', 'USR', NULL, '2025-01-10 15:15:29', '2025-03-27 19:05:13'),
(3, 'Dragan Draganić', 'dragandd@yahoo.com', '0667789941', NULL, '$2y$12$hADILmTUb3fucTr76tVTFO/I3mF1JgpQG1NCYt/4VGJhxXsLl5H9K', 'USR', NULL, '2025-03-03 15:21:16', '2025-03-03 15:21:16'),
(4, 'Jovan Jovanović', 'jovan19@gmail.com', '0634821667', NULL, '$2y$12$RaetoI38/HFmwhUuzQhyseWZEcQG8LlW17Hh2hRzw0htvcZV./DJW', 'USR', NULL, '2025-03-13 09:32:00', '2025-03-13 09:32:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_user_id_foreign` (`user_id`),
  ADD KEY `favorites_product_id_foreign` (`product_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `month_names`
--
ALTER TABLE `month_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_size_id_foreign` (`size_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sizes_name_unique` (`name`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`),
  ADD KEY `transactions_order_id_foreign` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `month_names`
--
ALTER TABLE `month_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
