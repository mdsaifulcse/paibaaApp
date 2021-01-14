-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2021 at 05:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paibaaco_dev`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_post`
--

CREATE TABLE `ad_post` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lang` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(10,2) DEFAULT 0.00,
  `is_negotiable` tinyint(3) UNSIGNED NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=Fixed',
  `tag` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` tinyint(3) UNSIGNED NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=Pending,3=No',
  `deliverable` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Yes deliverable, 2=No deliverable',
  `delivery_fee` float(8,2) DEFAULT 0.00,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `visitor` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `published_till` datetime DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_post`
--

INSERT INTO `ad_post` (`id`, `user_id`, `category_id`, `title`, `lang`, `address`, `contact`, `price`, `is_negotiable`, `tag`, `link`, `description`, `is_approved`, `deliverable`, `delivery_fee`, `status`, `visitor`, `approved_by`, `published_till`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(55, 1, 1, 'Title update', NULL, 'Dhaka', NULL, 1000.00, 2, 'good,Good Food,new Tag', 'title-update-1-200719171812', '<p>Description Description Description Description&nbsp;</p>', 1, 1, 160.00, 1, NULL, NULL, NULL, 1, 1, '2020-07-16 01:22:39', '2020-07-19 11:18:12'),
(56, 1, 1, 'New Post', NULL, 'Nawqbgonj', NULL, 1500.00, 2, 'Good Price,Best electronic', 'new-post-1-200720114441', '<p>post Descriptionpost Descriptionpost Descriptionpost Descriptionpost Description</p>', 1, 1, 200.00, 1, NULL, NULL, NULL, 1, 1, '2020-07-20 05:42:50', '2020-07-20 05:44:41'),
(57, 1, 2, 'Mobile Sale needed', NULL, 'Narayengonj', NULL, 16000.00, 2, 'Mobile,Best Mobile,Second Hand Mobile', 'mobile-sale-needed-1-200724220535', '<p>Mobile Description&nbsp;Mobile Description&nbsp;Mobile Description</p>', 1, 1, 350.00, 1, NULL, NULL, NULL, 1, 1, '2020-07-20 05:48:12', '2020-07-24 16:05:35'),
(63, 1, 3, 'House rent', NULL, 'Dhaka Mirpur', NULL, 2500.00, 2, 'Good Rome,Nice House', 'house-rent-1-200725085548', '<p>House Rent House Rent Dhaka, Dhaka House Rent</p>', 1, 2, NULL, 1, NULL, NULL, NULL, 1, 1, '2020-07-25 02:55:02', '2020-07-25 02:55:48'),
(64, 1, 5, 'Which are Brone Removing Best Creame?', 'English', NULL, NULL, 0.00, 2, 'Beauti care,Beauti matter', 'which-are-brone-removing-best--1-200808171741', '<p><span style=\"font-family: Lato;\">Founder Kelly Kovack provides a fresh voice to the beauty industry with content from her perspective, and through her lens. BeautyMatter also publishes highly curated news and exclusive original pieces by thought leaders and beauty insiders.</span></p>', 1, 2, 0.00, 1, NULL, NULL, NULL, 1, 1, '2020-07-29 04:32:57', '2020-08-08 11:17:41'),
(65, 8, 4, 'Service Ads', NULL, 'Ddhanmondi, Dhaka', NULL, 1500.00, 2, 'Best Service,Quality Service,Unique Service', 'service-ads-8-201021070535', '<p>Some Content about my Service</p>', 2, 2, NULL, 1, NULL, NULL, NULL, 8, 8, '2020-10-21 00:59:09', '2020-10-21 01:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `ad_post_areas`
--

CREATE TABLE `ad_post_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ad_post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ad_post_comments`
--

CREATE TABLE `ad_post_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ad_post_id` bigint(20) UNSIGNED NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT '1=Active, 2=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_post_comments`
--

INSERT INTO `ad_post_comments` (`id`, `user_id`, `ad_post_id`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(8, 1, 64, 'Good One', 0, '2020-07-29 10:43:10', '2020-07-29 10:43:10'),
(9, 1, 64, 'hjytrrsf', 0, '2020-09-05 16:35:44', '2020-09-05 16:35:44'),
(10, 1, 64, 'Good', 0, '2020-09-05 18:26:33', '2020-09-05 18:26:33'),
(11, 1, 64, 'new comment', 0, '2020-09-07 10:18:44', '2020-09-07 10:18:44');

-- --------------------------------------------------------

--
-- Table structure for table `ad_post_locations`
--

CREATE TABLE `ad_post_locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_post_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_post_locations`
--

INSERT INTO `ad_post_locations` (`id`, `ad_post_id`, `category_id`, `location_id`, `created_at`, `updated_at`) VALUES
(74, 55, 1, 2, '2020-07-19 11:18:12', '2020-07-19 11:18:12'),
(75, 55, 1, 7, '2020-07-19 11:18:12', '2020-07-19 11:18:12'),
(76, 55, 1, 9, '2020-07-19 11:18:12', '2020-07-19 11:18:12'),
(83, 56, 1, 2, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(84, 56, 1, 10, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(85, 56, 1, 11, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(92, 57, 2, 12, '2020-07-24 16:05:35', '2020-07-24 16:05:35'),
(93, 57, 2, 13, '2020-07-24 16:05:35', '2020-07-24 16:05:35'),
(94, 57, 2, 14, '2020-07-24 16:05:35', '2020-07-24 16:05:35'),
(97, 63, 3, 19, '2020-07-25 02:55:48', '2020-07-25 02:55:48'),
(98, 63, 3, 2, '2020-07-25 02:55:48', '2020-07-25 02:55:48'),
(123, 64, 5, 2, '2020-08-08 11:17:41', '2020-08-08 11:17:41'),
(124, 64, 5, 20, '2020-08-08 11:17:41', '2020-08-08 11:17:41'),
(131, 65, 4, 21, '2020-10-21 01:05:35', '2020-10-21 01:05:35'),
(132, 65, 4, 22, '2020-10-21 01:05:35', '2020-10-21 01:05:35'),
(133, 65, 4, 23, '2020-10-21 01:05:35', '2020-10-21 01:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `ad_post_prices`
--

CREATE TABLE `ad_post_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_post_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `is_negotiable` tinyint(3) UNSIGNED NOT NULL DEFAULT 2 COMMENT '1=Yes, 2=Fixed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_post_prices`
--

INSERT INTO `ad_post_prices` (`id`, `ad_post_id`, `category_id`, `sub_category_id`, `price_title`, `price`, `is_negotiable`, `created_at`, `updated_at`) VALUES
(204, 55, 1, 2, 'Peice Tk', 1000.00, 2, '2020-07-19 11:18:12', '2020-07-19 11:18:12'),
(205, 55, 1, 2, 'Peice Tk 1', 1500.00, 2, '2020-07-19 11:18:12', '2020-07-19 11:18:12'),
(206, 55, 1, 2, 'update price', 200.00, 2, '2020-07-19 11:18:12', '2020-07-19 11:18:12'),
(231, 56, 1, 45, 'First Price', 1500.00, 2, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(232, 56, 1, 45, 'Last Price', 1400.00, 2, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(233, 56, 1, 45, 'Second Price', 1450.00, 2, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(258, 57, 2, 47, 'Ac Buss', 16000.00, 2, '2020-07-24 16:05:35', '2020-07-24 16:05:35'),
(259, 57, 2, 47, 'First Price', 18000.00, 2, '2020-07-24 16:05:35', '2020-07-24 16:05:35'),
(260, 57, 2, 47, 'Second Price', 17500.00, 2, '2020-07-24 16:05:35', '2020-07-24 16:05:35'),
(287, 63, 3, 59, 'Monthly', 2500.00, 2, '2020-07-25 02:55:48', '2020-07-25 02:55:48'),
(288, 63, 3, 59, 'Quarterly', 7000.00, 2, '2020-07-25 02:55:48', '2020-07-25 02:55:48'),
(295, 65, 4, 62, 'One Month', 1500.00, 2, '2020-10-21 01:05:35', '2020-10-21 01:05:35'),
(296, 65, 4, 62, 'Tow Month', 2800.00, 2, '2020-10-21 01:05:35', '2020-10-21 01:05:35'),
(297, 65, 4, 62, 'Four Month', 5000.00, 2, '2020-10-21 01:05:35', '2020-10-21 01:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `ad_post_sub_category`
--

CREATE TABLE `ad_post_sub_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_post_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ad_post_sub_category`
--

INSERT INTO `ad_post_sub_category` (`id`, `ad_post_id`, `category_id`, `sub_category_id`, `created_at`, `updated_at`) VALUES
(82, 55, 1, 1, '2020-07-19 11:18:12', '2020-07-19 11:18:12'),
(83, 55, 1, 43, '2020-07-19 11:18:12', '2020-07-19 11:18:12'),
(84, 55, 1, 2, '2020-07-19 11:18:12', '2020-07-19 11:18:12'),
(91, 56, 1, 44, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(92, 56, 1, 2, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(93, 56, 1, 45, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(100, 57, 2, 7, '2020-07-24 16:05:35', '2020-07-24 16:05:35'),
(101, 57, 2, 46, '2020-07-24 16:05:35', '2020-07-24 16:05:35'),
(102, 57, 2, 47, '2020-07-24 16:05:35', '2020-07-24 16:05:35'),
(115, 63, 3, 58, '2020-07-25 02:55:48', '2020-07-25 02:55:48'),
(116, 63, 3, 59, '2020-07-25 02:55:48', '2020-07-25 02:55:48'),
(148, 64, 5, 60, '2020-08-08 11:17:41', '2020-08-08 11:17:41'),
(149, 64, 5, 61, '2020-08-08 11:17:41', '2020-08-08 11:17:41'),
(152, 65, 4, 62, '2020-10-21 01:05:35', '2020-10-21 01:05:35');

-- --------------------------------------------------------

--
-- Table structure for table `answer_replays`
--

CREATE TABLE `answer_replays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ad_post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `answer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `replay` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=Active, 2=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answer_replays`
--

INSERT INTO `answer_replays` (`id`, `user_id`, `ad_post_id`, `answer_id`, `replay`, `status`, `created_at`, `updated_at`) VALUES
(14, 1, 64, 1, 'Good Answer', 1, '2020-09-07 11:05:51', '2020-09-07 11:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_town_id` bigint(20) UNSIGNED NOT NULL,
  `area_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_name_bn` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_num` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `division_town_id`, `area_name`, `area_name_bn`, `serial_num`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'Bagerhat', NULL, 1, 1, '2020-02-16 15:02:42', '2020-02-16 15:02:42'),
(2, 5, 'Paltan', NULL, 1, 1, '2020-02-18 06:40:25', '2020-02-18 06:40:25'),
(3, 5, 'Jatrabari', NULL, 1, 1, '2020-02-18 06:40:25', '2020-02-18 06:40:25'),
(4, 4, 'Mirpur', NULL, 1, 1, '2020-02-18 06:41:12', '2020-02-18 06:41:12'),
(5, 4, 'Mohammadpur', NULL, 1, 1, '2020-02-18 06:41:12', '2020-02-18 06:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `blog_answers`
--

CREATE TABLE `blog_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ad_post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1=Active, 2=Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_answers`
--

INSERT INTO `blog_answers` (`id`, `user_id`, `ad_post_id`, `answer`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 64, '<p><span style=\"color: #7b7b7b; font-family: Lato; font-size: 16px;\">Kelly 0 Kovack provides a fresh voice to the beauty industry with content from her perspective, and through her lens. BeautyMatter also publishes highly curated news and exclusive original pieces by thought leaders and beauty insider&nbsp;</span></p>', 1, '2020-07-29 16:48:37', '2020-09-04 04:46:05');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_name_bn` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_num` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_label` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_num` tinyint(4) NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon_class` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Business, 2=Product',
  `post_type` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=Normal, 2=Special',
  `ad_view_type` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_name_bn`, `order_label`, `serial_num`, `short_description`, `icon_photo`, `icon_class`, `link`, `type`, `post_type`, `ad_view_type`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Need', NULL, 'Apply', 1, 'dfdfg', 'images/categories/2019/12/06/b06-12-201900-26-04.jpg', 'fa fa-desktop', 'need', 1, 1, 2, 1, 1, 1, '2019-12-05 17:39:14', '2020-07-01 01:52:06'),
(2, 'SALE', NULL, 'Order', 2, 'Sale', 'images/categories/2019/12/06/dashboard-m19-09-201912-18-4506-12-201916-00-09.png', NULL, 'sale', 1, 1, 1, 1, 1, 1, '2019-12-06 09:59:37', '2020-07-25 10:30:52'),
(3, 'RENT', NULL, 'Request', 3, NULL, 'images/categories/2019/12/08/dashboard-m19-09-201912-18-4508-12-201923-08-17.png', NULL, 'rent', 1, 1, 1, 1, 1, 1, '2019-12-08 17:08:17', '2020-07-25 10:31:06'),
(4, 'SERVICE', NULL, 'Order', 4, NULL, 'images/categories/2019/12/08/dashboard-m19-09-201912-18-4508-12-201923-08-37.png', NULL, 'service', 1, 1, 1, 1, 1, 1, '2019-12-08 17:08:37', '2020-07-01 01:52:27'),
(5, 'Write/Ask', NULL, 'Request', 5, NULL, 'images/categories/2019/12/08/users08-12-201923-08-55.png', NULL, 'write-ask', 1, 2, 2, 1, 1, 1, '2019-12-08 17:08:55', '2020-07-25 10:31:51');

-- --------------------------------------------------------

--
-- Table structure for table `category_wise_ad_counts`
--

CREATE TABLE `category_wise_ad_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_ad` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_wise_ad_counts`
--

INSERT INTO `category_wise_ad_counts` (`id`, `category_id`, `total_ad`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '2020-07-19 11:02:08', '2020-07-20 05:44:41'),
(2, 2, 1, '2020-07-20 05:49:55', '2020-07-20 05:49:55'),
(3, 3, 1, '2020-07-25 02:55:48', '2020-07-25 02:55:48'),
(12, 5, 1, '2020-07-29 04:55:56', '2020-07-29 04:56:59'),
(13, 4, 1, '2020-10-21 01:02:48', '2020-10-21 01:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `designation` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `designation_bn` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district_bn` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_num` int(10) UNSIGNED DEFAULT NULL,
  `show_at_home` tinyint(3) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_bn` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_num` int(10) UNSIGNED DEFAULT NULL,
  `show_at_home` tinyint(3) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `division_towns`
--

CREATE TABLE `division_towns` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `division_town` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `division_town_bn` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1=Division, 2=Town',
  `serial_num` int(10) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `division_towns`
--

INSERT INTO `division_towns` (`id`, `division_town`, `division_town_bn`, `link`, `type`, `serial_num`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dhaka', NULL, 'dhaka', 1, 1, 1, '2020-02-16 15:01:35', '2020-02-16 15:01:35'),
(2, 'Rajshahi', NULL, 'rajshahi', 1, 1, 1, '2020-02-16 15:01:35', '2020-02-16 15:01:35'),
(3, 'Khulna', NULL, 'khulna', 1, 1, 1, '2020-02-16 15:01:35', '2020-02-16 15:01:35'),
(4, 'Dhaka North City', NULL, 'dhaka-north-city', 2, 2, 1, '2020-02-18 06:37:49', '2020-02-18 06:37:49'),
(5, 'Dhaka South City', NULL, 'dhaka-south-city', 2, 2, 1, '2020-02-18 06:37:49', '2020-02-18 06:37:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location_name_bn` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `location_name`, `location_name_bn`, `url`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'Dhaka', NULL, 'dhaka', 1, 1, NULL, '2020-07-05 10:33:49', '2020-07-05 11:11:30'),
(7, 'kholna', NULL, 'kholna', 1, NULL, NULL, '2020-07-15 05:30:50', '2020-07-15 05:30:50'),
(8, 'Barishal', NULL, 'barishal', 1, NULL, NULL, '2020-07-15 16:43:48', '2020-07-15 16:43:48'),
(9, 'new onea', NULL, 'new-onea', 1, NULL, NULL, '2020-07-17 00:21:05', '2020-07-17 00:21:05'),
(10, 'Chadpur', NULL, 'chadpur', 1, NULL, NULL, '2020-07-20 05:42:50', '2020-07-20 05:42:50'),
(11, 'Nawabgonj', NULL, 'nawabgonj', 1, NULL, NULL, '2020-07-20 05:42:50', '2020-07-20 05:42:50'),
(12, 'Narayengonj', NULL, 'narayengonj', 1, NULL, NULL, '2020-07-20 05:48:12', '2020-07-20 05:48:12'),
(13, 'Rupgonj', NULL, 'rupgonj', 1, NULL, NULL, '2020-07-20 05:48:12', '2020-07-20 05:48:12'),
(14, 'Sonarga', NULL, 'sonarga', 1, NULL, NULL, '2020-07-20 05:48:12', '2020-07-20 05:48:12'),
(19, 'Mirpur', NULL, 'mirpur', 1, NULL, NULL, '2020-07-25 02:55:02', '2020-07-25 03:08:36'),
(20, 'Dhanmondi', NULL, 'dhanmondi', 1, NULL, NULL, '2020-07-29 04:32:57', '2020-07-29 04:32:57'),
(21, 'Sholla', NULL, 'sholla', 1, NULL, NULL, '2020-10-21 00:59:09', '2020-10-21 00:59:09'),
(22, 'Nawab', NULL, 'nawab', 1, NULL, NULL, '2020-10-21 00:59:09', '2020-10-21 00:59:09'),
(23, 'Dohar', NULL, 'dohar', 1, NULL, NULL, '2020-10-21 00:59:09', '2020-10-21 00:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `location_wise_ad_counts`
--

CREATE TABLE `location_wise_ad_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_ad` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_wise_ad_counts`
--

INSERT INTO `location_wise_ad_counts` (`id`, `location_id`, `total_ad`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2020-07-19 11:02:08', '2020-07-29 04:56:59'),
(2, 7, 1, '2020-07-19 11:02:08', '2020-07-19 11:18:12'),
(3, 9, 1, '2020-07-19 11:02:08', '2020-07-19 11:18:12'),
(4, 10, 1, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(5, 11, 1, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(6, 12, 1, '2020-07-20 05:49:55', '2020-07-20 05:49:55'),
(7, 13, 1, '2020-07-20 05:49:55', '2020-07-20 05:49:55'),
(8, 14, 1, '2020-07-20 05:49:55', '2020-07-20 05:49:55'),
(9, 19, 1, '2020-07-25 02:55:48', '2020-07-25 02:55:48'),
(13, 20, 1, '2020-07-29 04:55:56', '2020-07-29 04:56:59'),
(14, 21, 1, '2020-10-21 01:02:48', '2020-10-21 01:02:48'),
(15, 22, 1, '2020-10-21 01:02:48', '2020-10-21 01:02:48'),
(16, 23, 1, '2020-10-21 01:02:48', '2020-10-21 01:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `serial_num` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `name_bn`, `url`, `icon_class`, `slug`, `icon`, `big_icon`, `status`, `serial_num`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Setting', NULL, '#', 'fa fa-config', '[\"setting\"]', 'images/menu/icon/2019/12/06/setting06-12-201909-59-03.png', 'images/menu/big-icon/2019/12/06/setting06-12-201909-59-03.png', 1, 4, 1, '2019-12-06 03:59:03', '2020-02-02 22:58:26'),
(2, 'Set Up', NULL, '#', 'fa fa-setup', '[\"set-up\"]', 'images/menu/icon/2019/12/06/setting06-12-201910-02-01.png', 'images/menu/big-icon/2019/12/06/setting06-12-201910-02-01.png', 1, 4, 1, '2019-12-06 04:02:01', '2020-02-02 22:58:12'),
(3, 'Pending Ads', NULL, 'manage-ad', 'fa fa-folder', '[\"manage-ad.view\",\"manage-ad.create\",\"manage-ad.update\",\"manage-ad.delete\"]', 'images/menu/icon/2019/12/25/information25-12-201922-24-34.png', 'images/menu/big-icon/2019/12/25/information25-12-201922-24-34.png', 1, 1, 1, '2019-12-25 16:24:34', '2020-02-02 22:56:21'),
(4, 'All Approve Ads', NULL, 'all-ads', 'fa fa-folder', '[\"manage-ad.view\"]', 'images/menu/icon/2019/12/25/information25-12-201922-25-39.png', 'images/menu/big-icon/2019/12/25/information25-12-201922-25-39.png', 1, 2, 1, '2019-12-25 16:25:39', '2020-02-02 22:56:46'),
(5, 'All Admin Users', NULL, 'all-users', 'fa fa', '[\"admin-users\"]', 'images/menu/icon/2020/02/02/information25-12-201922-25-3902-02-202023-09-49.png', 'images/menu/big-icon/2020/02/02/information25-12-201922-25-3902-02-202023-09-49.png', 1, 3, 1, '2020-02-02 22:09:49', '2020-02-02 22:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_12_20_100001_create_permissions_table', 1),
(4, '2015_12_20_100002_create_roles_table', 1),
(5, '2015_12_20_100003_create_permission_role_table', 1),
(6, '2015_12_20_100004_create_role_user_table', 1),
(7, '2018_12_08_225702_create_divisions_table', 1),
(8, '2018_12_09_173537_create_districts_table', 1),
(9, '2018_12_09_180420_create_thana_upazilas_table', 1),
(10, '2019_05_19_224359_create_designations_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(13, '2019_11_07_123603_create_primary_info_table', 1),
(14, '2019_11_07_172733_create_menu_table', 1),
(15, '2019_11_07_173956_create_sub_menu_table', 1),
(16, '2019_11_07_174703_create_sub_sub_menu_table', 1),
(17, '2019_11_08_090748_create_page_table', 1),
(18, '2019_11_08_091123_create_page_photo_table', 1),
(19, '2019_11_15_123151_add_address_image_users_table', 1),
(21, '2019_11_02_100237_create_categories_table', 2),
(22, '2018_12_10_102736_create_division_towns_table', 3),
(23, '2018_12_11_103448_create_areas_table', 3),
(24, '2018_12_10_104034_create_brands_table', 4),
(25, '2019_12_05_110517_create_post_files_table', 5),
(28, '2019_11_02_120849_create_sub_category_table', 6),
(29, '2019_12_05_123613_create_sub_category_wise_brands_table', 7),
(30, '2019_12_05_124015_create_sub_category_wise_field_table', 8),
(31, '2019_12_05_152247_create_ad_post_table', 9),
(32, '2019_12_05_154250_create_post_field_value_table', 10),
(33, '2019_12_05_154642_create_post_wise_number_table', 11),
(34, '2019_12_05_155010_create_post_photos_table', 12),
(35, '2019_12_07_093627_create_change_table_post_files_to_post_fields_table', 13),
(36, '2019_11_16_064126_create_user_infos_table', 14),
(37, '2019_12_31_210655_create_price_negotiations_table', 15),
(39, '2020_01_16_152918_create_ad_post_comments_table', 16),
(40, '2019_11_05_154604_create_locations_table', 17),
(41, '2019_12_06_002020_create_ad_post_areas_table', 20),
(43, '2020_07_06_100249_create_ad_post_locations_table', 22),
(44, '2020_07_06_100607_create_ad_post_prices_table', 22),
(45, '2019_12_06_095445_create_ad_post_sub_categories_table', 23),
(46, '2020_07_15_093557_create_location_wise_ad_counts_table', 24),
(47, '2020_07_15_093841_create_category_wise_ad_counts_table', 24),
(48, '2020_07_15_093904_create_sub_category_wise_ad_counts_table', 24),
(51, '2020_07_29_171902_create_blog_answers_table', 25),
(52, '2020_07_29_172415_create_answer_replays_table', 25),
(53, '2020_09_30_101129_create_orders_table', 26),
(54, '2020_09_30_103535_create_order_prices_table', 26),
(55, '2020_10_25_001838_create_jobs_table', 27);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_post_id` bigint(20) UNSIGNED DEFAULT NULL,
  `customer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `post_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `booking_date_start` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'for rend and service',
  `booking_date_end` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'for rend and service',
  `booking_time_start` time DEFAULT NULL COMMENT 'for rend and service',
  `booking_time_end` time DEFAULT NULL COMMENT 'for rend and service',
  `txt_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attach_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'for need',
  `delivery_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'for sale',
  `total_amount` double(10,1) NOT NULL DEFAULT 0.0,
  `service_meet_up` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'for service',
  `status` tinyint(3) UNSIGNED NOT NULL COMMENT '0=new order,1=view, 2=delivered,3=reject',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ad_post_id`, `customer_id`, `post_user_id`, `category_id`, `booking_date_start`, `booking_date_end`, `booking_time_start`, `booking_time_end`, `txt_message`, `attach_file`, `delivery_address`, `total_amount`, `service_meet_up`, `status`, `created_at`, `updated_at`) VALUES
(1, 63, 8, 1, 3, '2020-10-21', '2020-10-23', '01:00:00', '01:01:00', 'dfdff', NULL, NULL, 0.0, NULL, 0, '2020-10-21 04:38:47', '2020-10-21 04:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `order_prices`
--

CREATE TABLE `order_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(10,1) NOT NULL DEFAULT 0.0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_prices`
--

INSERT INTO `order_prices` (`id`, `order_id`, `price_title`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 'Monthly', 0.0, '2020-10-21 04:38:47', '2020-10-21 04:38:47'),
(2, 1, 'Quarterly', 0.0, '2020-10-21 04:38:47', '2020-10-21 04:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ban` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `serial_num` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `name_bn`, `title`, `title_bn`, `description`, `description_ban`, `link`, `file`, `status`, `serial_num`, `created_at`, `updated_at`) VALUES
(1, 'Term & Condition', NULL, 'Our Term & Condition', NULL, '<p>Our Term &amp; Condition<br></p><p>Our Term &amp; Condition<br></p><p>Our Term &amp; Condition<br></p><p><br></p>', NULL, 'term-&-condition', NULL, 1, 1, '2020-01-30 11:26:04', '2020-01-30 11:26:04'),
(2, 'FAQ', NULL, 'FAQ', NULL, '<p>faq..</p>', NULL, 'faq', NULL, 1, 2, '2020-02-02 09:53:28', '2020-02-02 09:54:15'),
(3, 'Advertise with Paibaa', NULL, 'Advertise with Paibaa', NULL, '<p><a target=\"_blank\" rel=\"nofollow\" href=\"https://docs.google.com/forms/d/e/1FAIpQLSfvf0QhCsl4Jp72Kp5a_JIx-KakSPUKJJhYlDj2TcZh5sdnqg/viewform\">https://docs.google.com/forms/d/e/1FAIpQLSfvf0QhCsl4Jp72Kp5a_JIx-KakSPUKJJhYlDj2TcZh5sdnqg/viewform</a> <br></p>', NULL, 'advertise-with-paibaa', NULL, 1, 3, '2020-02-02 09:56:01', '2020-02-02 09:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `page_photo`
--

CREATE TABLE `page_photo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_page_id` bigint(20) UNSIGNED NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resource` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'System',
  `system` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `resource`, `system`, `created_at`, `updated_at`) VALUES
(1, 'Primary Info', 'primary-info', '', 1, NULL, NULL),
(2, 'Admin Users', 'admin-users', '', 1, NULL, '2020-02-02 22:07:19'),
(3, 'ACL', 'acl', '', 1, NULL, NULL),
(4, 'Others', 'others', '', 1, NULL, NULL),
(5, 'Menu', 'menu', '', 1, NULL, NULL),
(7, 'Setting', 'setting', '', 1, '2019-12-06 03:58:14', '2019-12-06 03:58:14'),
(8, 'Set Up', 'set-up', '', 1, '2019-12-06 04:01:19', '2019-12-06 04:01:19'),
(9, 'category', 'category', '', 1, '2019-12-06 04:02:52', '2019-12-06 04:02:52'),
(10, 'Brand', 'brand', '', 1, '2019-12-07 03:16:18', '2020-02-02 22:27:21'),
(12, 'division-town', 'division-town', '', 1, '2019-12-08 16:54:36', '2019-12-08 16:54:36'),
(13, 'View Manage-ad', 'manage-ad.view', 'Manage-ad', 1, '2019-12-23 06:31:39', '2019-12-23 06:31:39'),
(14, 'Create Manage-ad', 'manage-ad.create', 'Manage-ad', 1, '2019-12-23 06:31:39', '2019-12-23 06:31:39'),
(15, 'Update Manage-ad', 'manage-ad.update', 'Manage-ad', 1, '2019-12-23 06:31:39', '2019-12-23 06:31:39'),
(16, 'Delete Manage-ad', 'manage-ad.delete', 'Manage-ad', 1, '2019-12-23 06:31:39', '2019-12-23 06:31:39'),
(17, 'Alla Approve Ads', 'all-approve-ads', '', 1, '2020-02-02 22:25:15', '2020-02-02 22:25:55'),
(18, 'area', 'area', '', 1, '2020-02-02 22:26:27', '2020-02-02 22:26:27'),
(19, 'Sub Category', 'sub-category', '', 1, '2020-02-02 22:26:58', '2020-02-02 22:26:58'),
(20, 'Pages', 'pages', '', 1, '2020-02-02 22:28:52', '2020-02-02 22:28:52'),
(21, 'location', 'location', '', 1, '2020-07-25 10:26:15', '2020-07-25 10:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(203, 13, 1, NULL, NULL),
(204, 14, 1, NULL, NULL),
(205, 15, 1, NULL, NULL),
(206, 16, 1, NULL, NULL),
(207, 1, 1, NULL, NULL),
(208, 2, 1, NULL, NULL),
(209, 3, 1, NULL, NULL),
(210, 4, 1, NULL, NULL),
(211, 5, 1, NULL, NULL),
(212, 7, 1, NULL, NULL),
(213, 8, 1, NULL, NULL),
(214, 9, 1, NULL, NULL),
(215, 10, 1, NULL, NULL),
(216, 12, 1, NULL, NULL),
(217, 17, 1, NULL, NULL),
(218, 18, 1, NULL, NULL),
(219, 19, 1, NULL, NULL),
(220, 20, 1, NULL, NULL),
(221, 21, 1, NULL, NULL),
(222, 13, 2, NULL, NULL),
(223, 14, 2, NULL, NULL),
(224, 15, 2, NULL, NULL),
(225, 16, 2, NULL, NULL),
(226, 1, 2, NULL, NULL),
(227, 2, 2, NULL, NULL),
(228, 8, 2, NULL, NULL),
(229, 9, 2, NULL, NULL),
(230, 10, 2, NULL, NULL),
(231, 12, 2, NULL, NULL),
(232, 17, 2, NULL, NULL),
(233, 18, 2, NULL, NULL),
(234, 19, 2, NULL, NULL),
(235, 20, 2, NULL, NULL),
(236, 21, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post_photos`
--

CREATE TABLE `post_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_post_id` bigint(20) UNSIGNED NOT NULL,
  `photo_one` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_two` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_three` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_four` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_five` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_photos`
--

INSERT INTO `post_photos` (`id`, `ad_post_id`, `photo_one`, `photo_two`, `photo_three`, `photo_four`, `photo_five`, `created_at`, `updated_at`) VALUES
(12, 55, '2020/07/16/16331087507-8dbd6304cf-b16-07-202007-22-39.jpg', '2020/07/16/gt16-07-202007-22-39.jpg', '', '', NULL, '2020-07-16 01:22:40', '2020-07-16 01:22:40'),
(13, 56, '2020/07/20/gt20-07-202011-42-50.jpg', '2020/07/20/gt20-07-202011-42-50.jpg', '', '', NULL, '2020-07-20 05:42:50', '2020-07-20 05:42:50'),
(14, 57, '2020/07/20/gt20-07-202011-48-12.jpg', '2020/07/20/gt20-07-202011-48-12.jpg', '', '', NULL, '2020-07-20 05:48:12', '2020-07-20 05:48:12'),
(15, 63, '2020/07/25/gt25-07-202008-55-02.jpg', '2020/07/25/gt25-07-202008-55-02.jpg', '2020/07/25/gt25-07-202008-55-02.jpg', '', NULL, '2020-07-25 02:55:02', '2020-07-25 02:55:02'),
(16, 64, '2020/07/29/244-kiss-skin-woes-good-bye-homemade-face-packs-with-besan-569264845-624x70229-07-202010-32-57.jpg', '', '', '', NULL, '2020-07-29 04:32:58', '2020-07-29 04:32:58'),
(17, 65, '2020/10/21/demo-logo21-10-202006-59-09.png', '2020/10/21/gt21-10-202006-59-09.jpg', '2020/10/21/server-client-list21-10-202006-59-09.PNG', '2020/10/21/16331087507-8dbd6304cf-b21-10-202006-59-09.jpg', NULL, '2020-10-21 00:59:09', '2020-10-21 00:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `post_wise_number`
--

CREATE TABLE `post_wise_number` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_post_id` bigint(20) UNSIGNED NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `price_negotiations`
--

CREATE TABLE `price_negotiations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ad_post_id` bigint(20) UNSIGNED NOT NULL,
  `request_by` bigint(20) UNSIGNED NOT NULL,
  `request_to` bigint(20) UNSIGNED NOT NULL,
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `request_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `offer` tinyint(3) UNSIGNED NOT NULL COMMENT '1=Offer, 2=Replay',
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `price_negotiations`
--

INSERT INTO `price_negotiations` (`id`, `user_id`, `ad_post_id`, `request_by`, `request_to`, `price`, `request_message`, `price_message`, `offer`, `status`, `created_at`, `updated_at`) VALUES
(6, NULL, 63, 8, 1, 9500.00, 'Good News', 'Monthly : 2500,Quarterly : 7000,', 1, 0, '2020-10-21 02:09:06', '2020-10-21 02:09:06'),
(7, 1, 63, 8, 1, 0.00, 'Good', NULL, 1, 0, '2020-10-21 03:07:26', '2020-10-21 03:07:26'),
(8, 1, 63, 8, 1, 0.00, 'cxcx', NULL, 1, 0, '2020-10-21 04:03:13', '2020-10-21 04:03:13'),
(9, 1, 63, 8, 1, 0.00, 'fdg', NULL, 1, 0, '2020-10-21 04:05:19', '2020-10-21 04:05:19');

-- --------------------------------------------------------

--
-- Table structure for table `primary_info`
--

CREATE TABLE `primary_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name_ban` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address_ban` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no_ban` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(120) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL COMMENT '1=Group of Company, 2=Single Company',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description_ban` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description_ban` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `primary_info`
--

INSERT INTO `primary_info` (`id`, `company_name`, `company_name_ban`, `logo`, `favicon`, `address`, `address_ban`, `mobile_no`, `mobile_no_ban`, `phone`, `email`, `type`, `description`, `description_ban`, `meta_description`, `meta_description_ban`, `created_at`, `updated_at`) VALUES
(1, 'paibaa | khujlei paibaa', NULL, 'images/default/logo.png', 'images/logo/favicon.png', 'Dhaka, Bangladesh', NULL, '01640008633', NULL, NULL, 'candy@paibaa.com', 1, NULL, NULL, NULL, NULL, NULL, '2020-02-03 06:42:33');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `description`, `system`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 'developer', 'Developer Mode', 1, NULL, NULL),
(2, 'Super Admin', 'super-admin', 'Super Admins', 1, NULL, NULL),
(3, 'Admin', 'admin', 'Admin role', 1, NULL, NULL),
(4, 'Client', 'client', 'Whose Post ads', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(5, 2, 6, NULL, NULL),
(6, 4, 7, NULL, NULL),
(7, 4, 8, NULL, NULL),
(8, 4, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_category_name_bn` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `serial_num` tinyint(3) UNSIGNED DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `category_id`, `sub_category_name`, `sub_category_name_bn`, `description`, `serial_num`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Product', NULL, 'Sub Category of Need', 1, 1, 1, 1, '2019-12-06 04:35:56', '2019-12-08 17:11:35'),
(2, 1, 'Man Power', NULL, 'Sub Category 2 for Need', 2, 1, 1, 1, '2019-12-06 09:27:45', '2019-12-08 17:11:15'),
(3, 1, 'Rent', NULL, NULL, 3, 1, 1, NULL, '2019-12-08 17:11:49', '2019-12-08 17:11:49'),
(4, 1, 'Tutor', NULL, NULL, 4, 1, 1, NULL, '2019-12-08 17:12:07', '2019-12-08 17:12:07'),
(5, 2, 'Fashion', NULL, NULL, 1, 1, 1, NULL, '2019-12-08 17:13:00', '2019-12-08 17:13:00'),
(6, 2, 'Education', NULL, NULL, 2, 1, 1, NULL, '2019-12-08 17:13:08', '2019-12-08 17:13:08'),
(7, 2, 'Electronics', NULL, NULL, 3, 1, 1, 1, '2019-12-08 17:13:21', '2020-07-01 01:25:01'),
(8, 2, 'Course', NULL, NULL, 4, 1, 1, NULL, '2019-12-08 17:13:29', '2019-12-08 17:13:29'),
(9, 2, 'Food', NULL, NULL, 5, 1, 1, NULL, '2019-12-08 17:13:35', '2019-12-08 17:13:35'),
(10, 3, 'Property', NULL, NULL, 1, 1, 1, NULL, '2019-12-08 17:14:07', '2019-12-08 17:14:07'),
(11, 3, 'Transport', NULL, NULL, 2, 1, 1, NULL, '2019-12-08 17:17:41', '2019-12-08 17:17:41'),
(12, 3, 'Camera', NULL, NULL, 3, 1, 1, NULL, '2019-12-08 17:18:12', '2019-12-08 17:18:12'),
(13, 4, 'IT', NULL, NULL, 1, 1, 1, NULL, '2019-12-08 17:18:57', '2019-12-08 17:18:57'),
(14, 4, 'Macanics', NULL, NULL, 2, 1, 1, NULL, '2019-12-08 17:19:16', '2019-12-08 17:19:16'),
(15, 4, 'Cleaning', NULL, NULL, 3, 1, 1, NULL, '2019-12-08 17:19:26', '2019-12-08 17:19:26'),
(16, 4, 'Tuition', NULL, NULL, 4, 1, 1, NULL, '2019-12-08 17:19:32', '2019-12-08 17:19:32'),
(17, 4, 'Mechanical', NULL, NULL, 5, 1, 1, NULL, '2019-12-08 17:19:50', '2019-12-08 17:19:50'),
(18, 4, 'Media', NULL, NULL, 6, 1, 1, NULL, '2019-12-08 17:19:59', '2019-12-08 17:19:59'),
(19, 5, 'Fashion', NULL, NULL, 1, 1, 1, NULL, '2019-12-08 17:24:27', '2019-12-08 17:24:27'),
(20, 5, 'Product', NULL, NULL, 2, 1, 1, NULL, '2019-12-08 17:24:42', '2019-12-08 17:24:42'),
(21, 5, 'Rent', NULL, NULL, 3, 1, 1, NULL, '2019-12-08 17:24:50', '2019-12-08 17:24:50'),
(22, 5, 'Manpower', NULL, NULL, 4, 1, 1, NULL, '2019-12-08 17:25:00', '2019-12-08 17:25:00'),
(25, 2, 'Dhakadfs', NULL, NULL, NULL, 1, NULL, NULL, '2020-07-10 02:15:51', '2020-07-10 02:15:51'),
(38, 1, 'd', NULL, NULL, 5, 1, NULL, 1, '2020-07-11 10:36:55', '2020-07-25 10:20:53'),
(43, 1, 'demo-sub', NULL, NULL, 6, 1, NULL, 1, '2020-07-15 05:30:50', '2020-07-25 10:21:00'),
(44, 1, 'Fashion', NULL, NULL, 7, 1, NULL, 1, '2020-07-20 05:42:50', '2020-07-25 10:21:07'),
(45, 1, 'Electronic', NULL, NULL, 8, 1, NULL, 1, '2020-07-20 05:42:50', '2020-07-25 10:21:14'),
(46, 2, 'Mobile', NULL, NULL, NULL, 1, NULL, NULL, '2020-07-20 05:48:12', '2020-07-20 05:48:12'),
(47, 2, 'Mobile Phone', NULL, NULL, NULL, 1, NULL, NULL, '2020-07-20 05:48:12', '2020-07-20 05:48:12'),
(58, 3, 'Rent', NULL, NULL, NULL, 1, NULL, NULL, '2020-07-25 02:55:02', '2020-07-25 02:55:02'),
(59, 3, 'House Rent', NULL, NULL, NULL, 1, NULL, NULL, '2020-07-25 02:55:02', '2020-07-25 02:55:02'),
(60, 5, 'Face care', NULL, NULL, NULL, 1, NULL, NULL, '2020-07-29 04:32:57', '2020-07-29 04:32:57'),
(61, 5, 'Beauti expert', NULL, NULL, NULL, 1, NULL, NULL, '2020-07-29 04:32:57', '2020-07-29 04:32:57'),
(62, 4, 'Sub Category', NULL, NULL, NULL, 1, NULL, NULL, '2020-10-21 00:59:09', '2020-10-21 00:59:09');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category_wise_ad_counts`
--

CREATE TABLE `sub_category_wise_ad_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `total_ad` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_category_wise_ad_counts`
--

INSERT INTO `sub_category_wise_ad_counts` (`id`, `sub_category_id`, `total_ad`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-07-19 11:02:08', '2020-07-19 11:18:12'),
(2, 43, 1, '2020-07-19 11:02:08', '2020-07-19 11:18:12'),
(3, 2, 2, '2020-07-19 11:02:08', '2020-07-20 05:44:41'),
(4, 44, 1, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(5, 45, 1, '2020-07-20 05:44:41', '2020-07-20 05:44:41'),
(6, 7, 1, '2020-07-20 05:49:55', '2020-07-20 05:49:55'),
(7, 46, 1, '2020-07-20 05:49:55', '2020-07-20 05:49:55'),
(8, 47, 1, '2020-07-20 05:49:55', '2020-07-20 05:49:55'),
(9, 58, 1, '2020-07-25 02:55:48', '2020-07-25 02:55:48'),
(10, 59, 1, '2020-07-25 02:55:48', '2020-07-25 02:55:48'),
(24, 60, 1, '2020-07-29 04:55:56', '2020-07-29 04:56:59'),
(25, 61, 1, '2020-07-29 04:55:56', '2020-07-29 04:56:59'),
(26, 62, 1, '2020-10-21 01:02:48', '2020-10-21 01:02:48');

-- --------------------------------------------------------

--
-- Table structure for table `sub_menu`
--

CREATE TABLE `sub_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `serial_num` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_menu`
--

INSERT INTO `sub_menu` (`id`, `fk_menu_id`, `name`, `name_bn`, `url`, `icon_class`, `slug`, `icon`, `big_icon`, `status`, `serial_num`, `type`, `created_at`, `updated_at`) VALUES
(1, 1, 'Menu Setting', NULL, 'menu', NULL, '[\"menu\"]', 'images/menu/sub-menu/icon/2019/12/06/information06-12-201910-00-27.png', 'images/menu/sub-menu/big-icon/2019/12/06/information06-12-201910-00-27.png', 1, 1, 1, '2019-12-06 04:00:27', '2019-12-06 04:00:27'),
(2, 2, 'Categories', NULL, 'category', NULL, '[\"category\"]', 'images/menu/sub-menu/icon/2019/12/06/courses05-09-201917-14-3106-12-201910-03-26.png', 'images/menu/sub-menu/big-icon/2019/12/06/courses05-09-201917-14-3106-12-201910-03-26.png', 1, 1, 1, '2019-12-06 04:03:26', '2019-12-06 04:04:00'),
(5, 2, 'Location', NULL, 'location', NULL, '[\"location\"]', 'images/menu/sub-menu/icon/2019/12/08/courses05-09-201917-14-3108-12-201922-55-17.png', 'images/menu/sub-menu/big-icon/2019/12/08/courses05-09-201917-14-3108-12-201922-55-17.png', 1, 4, 1, '2019-12-08 16:55:17', '2020-07-25 10:26:58'),
(6, 1, 'Acl Role', NULL, 'acl-role', NULL, '[\"acl\"]', 'images/menu/sub-menu/icon/2019/12/13/courses05-09-201917-14-3113-12-201918-52-03.png', 'images/menu/sub-menu/big-icon/2019/12/13/courses05-09-201917-14-3113-12-201918-52-03.png', 1, 2, 1, '2019-12-13 12:52:03', '2019-12-13 12:52:03'),
(7, 2, 'Pages', NULL, 'pages', NULL, '[\"set-up\"]', NULL, NULL, 1, 5, 1, '2020-01-30 11:58:40', '2020-01-30 11:58:53'),
(8, 2, 'Company Info', NULL, 'primary-info', NULL, '[\"primary-info\"]', 'images/menu/sub-menu/icon/2020/02/02/icon-white02-02-202023-55-08.png', 'images/menu/sub-menu/big-icon/2020/02/02/icon-white02-02-202023-55-08.png', 1, 6, 1, '2020-02-02 22:55:08', '2020-02-02 22:55:08');

-- --------------------------------------------------------

--
-- Table structure for table `sub_sub_menu`
--

CREATE TABLE `sub_sub_menu` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fk_menu_id` bigint(20) UNSIGNED NOT NULL,
  `fk_sub_menu_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_bn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon_class` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `big_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `serial_num` tinyint(3) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thana_upazilas`
--

CREATE TABLE `thana_upazilas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `thana_upazila` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thana_upazila_bn` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `serial_num` int(10) UNSIGNED DEFAULT NULL,
  `show_at_home` tinyint(3) UNSIGNED DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `social_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT 3 COMMENT '1=System/Super Admin,2= Admin, 3=General User',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '1=Active,0= Inactive',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_name`, `email`, `social_id`, `mobile`, `email_verified_at`, `password`, `address`, `image`, `type`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 'developer', 'dev@gmail.com', NULL, '01829655974', NULL, '$2y$10$B3xARGCh6W7zCU6u0Fh8a.C2L/P.nIgmCg2gwCPUVk/1pdJ2RLZ5C', 'Dhakas', 'images/users/2019/11/22/logo22-11-201900-01-34.png', 1, 1, NULL, '2019-11-20 18:00:00', '2019-12-10 03:01:23'),
(6, 'mehedi kennedy', 'mehedicandy', 'mehedikennedy@gmail.com', NULL, '01640008633', NULL, '$2y$10$7ak3mnWS64LNgzyq/0anPeHnChoN6aUcH0K4XPB7w9.wp91IzEn6K', 'Mirpur 12, Dhaka, Bangladesh\r\ni\'m freelance camera man..', 'images/users/2019/12/13/78456041-1018369261830642-1651569106047991808-o13-12-201917-10-46.jpg', 1, 1, NULL, '2019-12-13 11:10:46', '2020-02-16 23:05:40'),
(7, 'Elisa Spark', 'elisaspark7', 'geogatedproject70@gmail.com', '1002088015602', NULL, NULL, NULL, NULL, 'https://graph.facebook.com/v3.3/1002088015602/picture?type=normal', 3, 0, 'wPwdgoYaOwS54UfmVwXZDSMienO1PiuxOcuujX2e5BjoArnKAfYqE80bFvXg', '2020-02-18 01:02:32', '2020-02-18 01:02:32'),
(8, 'Demo', 'demo8', 'demo@gmail.com', NULL, '01829655975', NULL, '$2y$10$tztWZJtPz2YQaggzfJdjouYcF/WnfGYyxLvfQZ4kqPHOZ1erkNXP.', 'Dhaka', 'images/users/2020/10/20/demo-logo20-10-202016-50-35.png', 3, 1, NULL, '2020-10-20 10:47:00', '2020-10-20 10:50:35'),
(9, 'Saiful Islam', 'saifulislam9', NULL, '2482235418717584', NULL, NULL, NULL, NULL, 'https://graph.facebook.com/v3.3/2482235418717584/picture?type=normal', 3, 0, 'pAC04IjGztoa5V1b3RTRRVU5S92tcQxijFN383XpPRzCyjwaulrXsV6goTQ9', '2020-11-06 16:22:27', '2020-11-06 16:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

CREATE TABLE `user_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `location_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_infos`
--

INSERT INTO `user_infos` (`id`, `user_id`, `location_id`, `created_at`, `updated_at`) VALUES
(18, 1, 2, '2020-07-15 16:44:06', '2020-07-15 16:44:06'),
(19, 1, 7, '2020-07-15 16:44:06', '2020-07-15 16:44:06'),
(20, 1, 8, '2020-07-15 16:44:06', '2020-07-15 16:44:06'),
(21, 8, 2, '2020-10-20 10:50:35', '2020-10-20 10:50:35'),
(22, 8, 20, '2020-10-20 10:50:35', '2020-10-20 10:50:35'),
(23, 8, 10, '2020-10-20 10:50:35', '2020-10-20 10:50:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_post`
--
ALTER TABLE `ad_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_post_approved_by_foreign` (`approved_by`),
  ADD KEY `ad_post_created_by_foreign` (`created_by`),
  ADD KEY `ad_post_updated_by_foreign` (`updated_by`),
  ADD KEY `ad_post_user_id_foreign` (`user_id`),
  ADD KEY `ad_post_category_id_foreign` (`category_id`);

--
-- Indexes for table `ad_post_areas`
--
ALTER TABLE `ad_post_areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_post_areas_area_id_foreign` (`area_id`),
  ADD KEY `ad_post_areas_ad_post_id_foreign` (`ad_post_id`);

--
-- Indexes for table `ad_post_comments`
--
ALTER TABLE `ad_post_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_post_comments_user_id_foreign` (`user_id`),
  ADD KEY `ad_post_comments_ad_post_id_foreign` (`ad_post_id`);

--
-- Indexes for table `ad_post_locations`
--
ALTER TABLE `ad_post_locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_post_locations_ad_post_id_foreign` (`ad_post_id`),
  ADD KEY `ad_post_locations_location_id_foreign` (`location_id`),
  ADD KEY `ad_post_locations_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `ad_post_prices`
--
ALTER TABLE `ad_post_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_post_prices_ad_post_id_foreign` (`ad_post_id`),
  ADD KEY `ad_post_prices_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `ad_post_sub_category`
--
ALTER TABLE `ad_post_sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ad_post_sub_categories_ad_post_id_foreign` (`ad_post_id`),
  ADD KEY `ad_post_sub_categories_category_id_foreign` (`category_id`),
  ADD KEY `ad_post_sub_categories_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `answer_replays`
--
ALTER TABLE `answer_replays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answer_replays_user_id_foreign` (`user_id`),
  ADD KEY `answer_replays_ad_post_id_foreign` (`ad_post_id`),
  ADD KEY `answer_replays_answer_id_foreign` (`answer_id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_division_town_id_foreign` (`division_town_id`);

--
-- Indexes for table `blog_answers`
--
ALTER TABLE `blog_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_answers_user_id_foreign` (`user_id`),
  ADD KEY `blog_answers_ad_post_id_foreign` (`ad_post_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brands_created_by_foreign` (`created_by`),
  ADD KEY `brands_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_created_by_foreign` (`created_by`),
  ADD KEY `categories_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `category_wise_ad_counts`
--
ALTER TABLE `category_wise_ad_counts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_wise_ad_counts_category_id_foreign` (`category_id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `designations_created_by_foreign` (`created_by`),
  ADD KEY `designations_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `districts_district_unique` (`district`),
  ADD UNIQUE KEY `districts_district_bn_unique` (`district_bn`),
  ADD KEY `districts_division_id_foreign` (`division_id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `divisions_division_unique` (`division`),
  ADD UNIQUE KEY `divisions_division_bn_unique` (`division_bn`);

--
-- Indexes for table `division_towns`
--
ALTER TABLE `division_towns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locations_created_by_foreign` (`created_by`),
  ADD KEY `locations_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `location_wise_ad_counts`
--
ALTER TABLE `location_wise_ad_counts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_wise_ad_counts_location_id_foreign` (`location_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_ad_post_id_foreign` (`ad_post_id`),
  ADD KEY `orders_customer_id_foreign` (`customer_id`),
  ADD KEY `orders_post_user_id_foreign` (`post_user_id`),
  ADD KEY `orders_category_id_foreign` (`category_id`);

--
-- Indexes for table `order_prices`
--
ALTER TABLE `order_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_prices_order_id_foreign` (`order_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_photo`
--
ALTER TABLE `page_photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_photo_fk_page_id_foreign` (`fk_page_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Indexes for table `post_photos`
--
ALTER TABLE `post_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_photos_ad_post_id_foreign` (`ad_post_id`);

--
-- Indexes for table `post_wise_number`
--
ALTER TABLE `post_wise_number`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_wise_number_ad_post_id_foreign` (`ad_post_id`);

--
-- Indexes for table `price_negotiations`
--
ALTER TABLE `price_negotiations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_negotiations_ad_post_id_foreign` (`ad_post_id`),
  ADD KEY `price_negotiations_request_by_foreign` (`request_by`),
  ADD KEY `price_negotiations_request_to_foreign` (`request_to`);

--
-- Indexes for table `primary_info`
--
ALTER TABLE `primary_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_index` (`role_id`),
  ADD KEY `role_user_user_id_index` (`user_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_category_category_id_foreign` (`category_id`),
  ADD KEY `sub_category_created_by_foreign` (`created_by`),
  ADD KEY `sub_category_updated_by_foreign` (`updated_by`);

--
-- Indexes for table `sub_category_wise_ad_counts`
--
ALTER TABLE `sub_category_wise_ad_counts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_category_wise_ad_counts_sub_category_id_foreign` (`sub_category_id`);

--
-- Indexes for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_menu_fk_menu_id_foreign` (`fk_menu_id`);

--
-- Indexes for table `sub_sub_menu`
--
ALTER TABLE `sub_sub_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_sub_menu_fk_menu_id_foreign` (`fk_menu_id`),
  ADD KEY `sub_sub_menu_fk_sub_menu_id_foreign` (`fk_sub_menu_id`);

--
-- Indexes for table `thana_upazilas`
--
ALTER TABLE `thana_upazilas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `thana_upazilas_thana_upazila_unique` (`thana_upazila`),
  ADD UNIQUE KEY `thana_upazilas_thana_upazila_bn_unique` (`thana_upazila_bn`),
  ADD KEY `thana_upazilas_district_id_foreign` (`district_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_infos_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_post`
--
ALTER TABLE `ad_post`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `ad_post_areas`
--
ALTER TABLE `ad_post_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ad_post_comments`
--
ALTER TABLE `ad_post_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ad_post_locations`
--
ALTER TABLE `ad_post_locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `ad_post_prices`
--
ALTER TABLE `ad_post_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `ad_post_sub_category`
--
ALTER TABLE `ad_post_sub_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT for table `answer_replays`
--
ALTER TABLE `answer_replays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_answers`
--
ALTER TABLE `blog_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category_wise_ad_counts`
--
ALTER TABLE `category_wise_ad_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `division_towns`
--
ALTER TABLE `division_towns`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `location_wise_ad_counts`
--
ALTER TABLE `location_wise_ad_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_prices`
--
ALTER TABLE `order_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page_photo`
--
ALTER TABLE `page_photo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `post_photos`
--
ALTER TABLE `post_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `post_wise_number`
--
ALTER TABLE `post_wise_number`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price_negotiations`
--
ALTER TABLE `price_negotiations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `primary_info`
--
ALTER TABLE `primary_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `sub_category_wise_ad_counts`
--
ALTER TABLE `sub_category_wise_ad_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sub_menu`
--
ALTER TABLE `sub_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sub_sub_menu`
--
ALTER TABLE `sub_sub_menu`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thana_upazilas`
--
ALTER TABLE `thana_upazilas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ad_post`
--
ALTER TABLE `ad_post`
  ADD CONSTRAINT `ad_post_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ad_post_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `ad_post_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ad_post_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `ad_post_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ad_post_areas`
--
ALTER TABLE `ad_post_areas`
  ADD CONSTRAINT `ad_post_areas_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`),
  ADD CONSTRAINT `ad_post_areas_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`);

--
-- Constraints for table `ad_post_comments`
--
ALTER TABLE `ad_post_comments`
  ADD CONSTRAINT `ad_post_comments_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`),
  ADD CONSTRAINT `ad_post_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ad_post_locations`
--
ALTER TABLE `ad_post_locations`
  ADD CONSTRAINT `ad_post_locations_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`),
  ADD CONSTRAINT `ad_post_locations_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `ad_post_locations_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `ad_post_prices`
--
ALTER TABLE `ad_post_prices`
  ADD CONSTRAINT `ad_post_prices_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`),
  ADD CONSTRAINT `ad_post_prices_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `ad_post_sub_category`
--
ALTER TABLE `ad_post_sub_category`
  ADD CONSTRAINT `ad_post_sub_categories_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`),
  ADD CONSTRAINT `ad_post_sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `ad_post_sub_categories_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`);

--
-- Constraints for table `answer_replays`
--
ALTER TABLE `answer_replays`
  ADD CONSTRAINT `answer_replays_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`),
  ADD CONSTRAINT `answer_replays_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `blog_answers` (`id`),
  ADD CONSTRAINT `answer_replays_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_division_town_id_foreign` FOREIGN KEY (`division_town_id`) REFERENCES `division_towns` (`id`);

--
-- Constraints for table `blog_answers`
--
ALTER TABLE `blog_answers`
  ADD CONSTRAINT `blog_answers_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`),
  ADD CONSTRAINT `blog_answers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `brands`
--
ALTER TABLE `brands`
  ADD CONSTRAINT `brands_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `brands_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `category_wise_ad_counts`
--
ALTER TABLE `category_wise_ad_counts`
  ADD CONSTRAINT `category_wise_ad_counts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `designations`
--
ALTER TABLE `designations`
  ADD CONSTRAINT `designations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `designations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_division_id_foreign` FOREIGN KEY (`division_id`) REFERENCES `divisions` (`id`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `locations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `location_wise_ad_counts`
--
ALTER TABLE `location_wise_ad_counts`
  ADD CONSTRAINT `location_wise_ad_counts_location_id_foreign` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`),
  ADD CONSTRAINT `orders_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `orders_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_post_user_id_foreign` FOREIGN KEY (`post_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_prices`
--
ALTER TABLE `order_prices`
  ADD CONSTRAINT `order_prices_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `page_photo`
--
ALTER TABLE `page_photo`
  ADD CONSTRAINT `page_photo_fk_page_id_foreign` FOREIGN KEY (`fk_page_id`) REFERENCES `page` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_photos`
--
ALTER TABLE `post_photos`
  ADD CONSTRAINT `post_photos_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`);

--
-- Constraints for table `post_wise_number`
--
ALTER TABLE `post_wise_number`
  ADD CONSTRAINT `post_wise_number_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`);

--
-- Constraints for table `price_negotiations`
--
ALTER TABLE `price_negotiations`
  ADD CONSTRAINT `price_negotiations_ad_post_id_foreign` FOREIGN KEY (`ad_post_id`) REFERENCES `ad_post` (`id`),
  ADD CONSTRAINT `price_negotiations_request_by_foreign` FOREIGN KEY (`request_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `price_negotiations_request_to_foreign` FOREIGN KEY (`request_to`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `sub_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sub_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `sub_category_wise_ad_counts`
--
ALTER TABLE `sub_category_wise_ad_counts`
  ADD CONSTRAINT `sub_category_wise_ad_counts_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_category` (`id`);

--
-- Constraints for table `sub_menu`
--
ALTER TABLE `sub_menu`
  ADD CONSTRAINT `sub_menu_fk_menu_id_foreign` FOREIGN KEY (`fk_menu_id`) REFERENCES `menu` (`id`);

--
-- Constraints for table `sub_sub_menu`
--
ALTER TABLE `sub_sub_menu`
  ADD CONSTRAINT `sub_sub_menu_fk_menu_id_foreign` FOREIGN KEY (`fk_menu_id`) REFERENCES `menu` (`id`),
  ADD CONSTRAINT `sub_sub_menu_fk_sub_menu_id_foreign` FOREIGN KEY (`fk_sub_menu_id`) REFERENCES `sub_menu` (`id`);

--
-- Constraints for table `thana_upazilas`
--
ALTER TABLE `thana_upazilas`
  ADD CONSTRAINT `thana_upazilas_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`);

--
-- Constraints for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD CONSTRAINT `user_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
