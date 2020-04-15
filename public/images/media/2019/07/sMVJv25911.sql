-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2018 at 01:12 PM
-- Server version: 5.6.41
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ioniceco_demo0`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_types`
--

CREATE TABLE `admin_types` (
  `user_types_id` int(100) NOT NULL,
  `admin_type_name` varchar(255) NOT NULL,
  `created_at` int(30) DEFAULT NULL,
  `updated_at` int(30) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;



-- --------------------------------------------------------

--
-- Table structure for table `manage_role`
--

CREATE TABLE `manage_role` (
  `manage_role_id` int(100) NOT NULL,
  `user_types_id` tinyint(1) NOT NULL DEFAULT '0',
  `dashboard_view` tinyint(1) NOT NULL DEFAULT '0',
  `manufacturer_view` tinyint(1) NOT NULL DEFAULT '0',
  `manufacturer_create` tinyint(1) NOT NULL DEFAULT '0',
  `manufacturer_update` tinyint(1) NOT NULL DEFAULT '0',
  `manufacturer_delete` tinyint(1) NOT NULL DEFAULT '0',
  `categories_view` tinyint(1) NOT NULL DEFAULT '0',
  `categories_create` tinyint(1) NOT NULL DEFAULT '0',
  `categories_update` tinyint(1) NOT NULL DEFAULT '0',
  `categories_delete` tinyint(1) NOT NULL DEFAULT '0',
  `products_view` tinyint(1) NOT NULL DEFAULT '0',
  `products_create` tinyint(1) NOT NULL DEFAULT '0',
  `products_update` tinyint(1) NOT NULL DEFAULT '0',
  `products_delete` tinyint(1) NOT NULL DEFAULT '0',
  `news_view` tinyint(1) NOT NULL DEFAULT '0',
  `news_create` tinyint(1) NOT NULL DEFAULT '0',
  `news_update` tinyint(1) NOT NULL DEFAULT '0',
  `news_delete` tinyint(1) NOT NULL DEFAULT '0',
  `customers_view` tinyint(1) NOT NULL DEFAULT '0',
  `customers_create` tinyint(1) NOT NULL DEFAULT '0',
  `customers_update` tinyint(1) NOT NULL DEFAULT '0',
  `customers_delete` tinyint(1) NOT NULL DEFAULT '0',
  `tax_location_view` tinyint(1) NOT NULL DEFAULT '0',
  `tax_location_create` tinyint(1) NOT NULL DEFAULT '0',
  `tax_location_update` tinyint(1) NOT NULL DEFAULT '0',
  `tax_location_delete` tinyint(1) NOT NULL DEFAULT '0',
  `coupons_view` tinyint(1) NOT NULL DEFAULT '0',
  `coupons_create` tinyint(1) NOT NULL DEFAULT '0',
  `coupons_update` tinyint(1) NOT NULL DEFAULT '0',
  `coupons_delete` tinyint(1) NOT NULL DEFAULT '0',
  `notifications_view` tinyint(1) NOT NULL DEFAULT '0',
  `notifications_send` tinyint(1) NOT NULL DEFAULT '0',
  `orders_view` tinyint(1) NOT NULL DEFAULT '0',
  `orders_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_methods_view` tinyint(1) NOT NULL DEFAULT '0',
  `shipping_methods_update` tinyint(1) NOT NULL DEFAULT '0',
  `payment_methods_view` tinyint(1) NOT NULL DEFAULT '0',
  `payment_methods_update` tinyint(1) NOT NULL DEFAULT '0',
  `reports_view` tinyint(1) NOT NULL DEFAULT '0',
  `website_setting_view` tinyint(1) NOT NULL DEFAULT '0',
  `website_setting_update` tinyint(1) NOT NULL DEFAULT '0',
  `application_setting_view` tinyint(1) NOT NULL DEFAULT '0',
  `application_setting_update` tinyint(1) NOT NULL DEFAULT '0',
  `general_setting_view` tinyint(1) NOT NULL DEFAULT '0',
  `general_setting_update` tinyint(1) NOT NULL DEFAULT '0',
  `manage_admins_view` tinyint(1) NOT NULL DEFAULT '0',
  `manage_admins_create` tinyint(1) NOT NULL DEFAULT '0',
  `manage_admins_update` tinyint(1) NOT NULL DEFAULT '0',
  `manage_admins_delete` tinyint(1) NOT NULL DEFAULT '0',
  `language_view` tinyint(1) NOT NULL DEFAULT '0',
  `language_create` tinyint(1) NOT NULL DEFAULT '0',
  `language_update` tinyint(1) NOT NULL DEFAULT '0',
  `language_delete` tinyint(1) NOT NULL DEFAULT '0',
  `profile_view` tinyint(1) NOT NULL DEFAULT '0',
  `profile_update` tinyint(1) NOT NULL DEFAULT '0',
  `admintype_view` tinyint(1) NOT NULL DEFAULT '0',
  `admintype_create` tinyint(1) NOT NULL DEFAULT '0',
  `admintype_update` tinyint(1) NOT NULL DEFAULT '0',
  `admintype_delete` tinyint(1) NOT NULL DEFAULT '0',
  `manage_admins_role` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_types`
--
ALTER TABLE `admin_types`
  ADD PRIMARY KEY (`user_types_id`);


--
-- Indexes for table `manage_role`
--
ALTER TABLE `manage_role`
  ADD PRIMARY KEY (`manage_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_types`
--
ALTER TABLE `admin_types`
  MODIFY `user_types_id` int(100) NOT NULL AUTO_INCREMENT;


-- --------------------------------------------------------

--
-- Table structure for table `constant_banners`
--

CREATE TABLE `constant_banners` (
  `banners_id` int(100) NOT NULL,
  `banners_title` varchar(255) NOT NULL,
  `banners_url` mediumtext NOT NULL,
  `banners_image` mediumtext NOT NULL,
  `date_added` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `languages_id` int(11) NOT NULL,
  `type` varchar(55) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


--
-- Indexes for table `constant_banners`
--
ALTER TABLE `constant_banners`
  ADD PRIMARY KEY (`banners_id`);

-- --------------------------------------------------------

--
-- Table structure for table `flash_sale`
--

CREATE TABLE `flash_sale` (
  `flash_sale_id` int(100) NOT NULL,
  `products_id` int(100) NOT NULL,
  `flash_sale_products_price` decimal(15,2) NOT NULL,
  `flash_sale_date_added` int(100) NOT NULL,
  `flash_sale_last_modified` int(100) NOT NULL,
  `flash_start_date` int(100) NOT NULL,
  `flash_expires_date` int(100) NOT NULL,
  `flash_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for table `flash_sale`
--
ALTER TABLE `flash_sale`
  ADD PRIMARY KEY (`flash_sale_id`),
  ADD KEY `products_id` (`products_id`);


--
-- AUTO_INCREMENT for table `constant_banners`
--
ALTER TABLE `constant_banners`
  MODIFY `banners_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `flash_sale`
--
ALTER TABLE `flash_sale`
  MODIFY `flash_sale_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manage_role`
--
ALTER TABLE `manage_role`
  MODIFY `manage_role_id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `products_options_descriptions` (
  `products_options_descriptions_id` int(100) NOT NULL,
  `language_id` int(11) NOT NULL,
  `options_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `products_options_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `products_options_values_descriptions`
--

CREATE TABLE `products_options_values_descriptions` (
  `products_options_values_descriptions_id` int(100) NOT NULL,
  `language_id` int(100) NOT NULL,
  `options_values_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `products_options_values_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products_options_descriptions`
--
ALTER TABLE `products_options_descriptions`
  ADD PRIMARY KEY (`products_options_descriptions_id`);

--
-- Indexes for table `products_options_values_descriptions`
--
ALTER TABLE `products_options_values_descriptions`
  ADD PRIMARY KEY (`products_options_values_descriptions_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products_options_descriptions`
--
ALTER TABLE `products_options_descriptions`
  MODIFY `products_options_descriptions_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_options_values_descriptions`
--
ALTER TABLE `products_options_values_descriptions`
  MODIFY `products_options_values_descriptions_id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;




CREATE TABLE `categories_role` (
  `categories_role_id` int(11) NOT NULL,
  `categories_ids` mediumtext NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_ref_id` int(100) NOT NULL,
  `admin_id` int(1) NOT NULL,
  `added_date` int(100) NOT NULL,
  `reference_code` varchar(255) NOT NULL,
  `stock` int(100) NOT NULL,
  `products_id` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventory_ref_id`, `admin_id`, `added_date`, `reference_code`, `stock`, `products_id`) VALUES
(1, 1, 1534415708, '', 30, 81),
(2, 1, 1534415744, '', 15, 81),
(3, 1, 1534501126, '', 15, 83),
(4, 1, 1534504561, 'testing', 10, 81),
(5, 1, 1534504653, '', 20, 81),
(6, 1, 1534513188, '', 30, 82),
(7, 1, 1534513229, '', 30, 82),
(8, 1, 1534514990, '', 40, 83),
(9, 1, 1534523669, '', 30, 80),
(10, 9, 1536315486, 'testing', 15, 74),
(11, 1, 1536657515, '', 25, 81),
(12, 1, 1536657876, '', 15, 81),
(13, 1, 1536660316, '', 25, 81),
(14, 1, 1536660335, '', 40, 81),
(15, 1, 1536660346, '', 50, 81),
(16, 9, 1537359606, '', 100, 86),
(17, 9, 1537362619, '', 100, 85),
(18, 9, 1539266812, '', 15, 98),
(19, 9, 1539353337, '', 100, 102),
(20, 9, 1539353345, '', 50, 102),
(21, 9, 1539353355, '', 150, 102),
(22, 9, 1539353362, '', 200, 102),
(23, 8, 1541596208, '', 100, 78),
(24, 8, 1541606253, '', 100, 73),
(25, 8, 1541676338, '', 100, 76),
(26, 8, 1541938765, '', 100, 77),
(27, 8, 1541938779, '', 20, 77),
(28, 8, 1541938790, '', 20, 77),
(29, 8, 1541950369, '', 20, 77),
(30, 8, 1541950380, '', 30, 77),
(31, 8, 1541950387, '', 40, 77),
(32, 8, 1541950395, '', 35, 77),
(33, 8, 1541950403, '', 40, 77),
(34, 8, 1541950412, '', 15, 77),
(35, 8, 1542198916, '', 100, 75),
(36, 8, 1542198925, '', 10, 75),
(37, 8, 1542198934, '', 40, 75),
(38, 8, 1542198960, '', 10, 75),
(39, 8, 1542615824, '35', 300, 81),
(40, 8, 1542615915, '35', 300, 80),
(41, 8, 1542616096, '35', 300, 79),
(42, 8, 1542616113, '35', 300, 79),
(43, 8, 1542616124, '35', 300, 79),
(44, 8, 1542616146, '35', 300, 79),
(45, 8, 1542616184, '35', 300, 79),
(46, 8, 1542616251, '35', 300, 78),
(47, 8, 1542616312, '35', 300, 77),
(48, 8, 1542616389, '35', 300, 76),
(49, 8, 1542616447, '35', 300, 75),
(50, 8, 1542616560, '35', 300, 74),
(51, 8, 1542616658, '35', 300, 73),
(52, 8, 1542616689, '35', 300, 72),
(53, 8, 1542616722, '35', 300, 71),
(54, 8, 1542616748, '35', 300, 70),
(55, 8, 1542628641, '35', 300, 69),
(56, 8, 1542628692, '35', 300, 68),
(57, 8, 1542628726, '35', 300, 67),
(58, 8, 1542628773, '35', 300, 66),
(59, 8, 1542628799, '35', 300, 65),
(60, 8, 1542628825, '35', 300, 64),
(61, 8, 1542628883, '35', 300, 63),
(62, 8, 1542628912, '35', 300, 62),
(63, 8, 1542628943, '35', 300, 61),
(64, 8, 1542628994, '35', 300, 60),
(65, 8, 1542629050, '35', 300, 59),
(66, 8, 1542629073, '35', 300, 58),
(67, 8, 1542629135, '35', 300, 57),
(68, 8, 1542629168, '35', 300, 56),
(69, 8, 1542629193, '35', 300, 55),
(70, 8, 1542629303, '35', 300, 54),
(71, 8, 1542629324, '35', 300, 53),
(72, 8, 1542629346, '35', 300, 52),
(73, 8, 1542629370, '35', 300, 51),
(74, 8, 1542629396, '35', 300, 50),
(75, 8, 1542629455, '35', 300, 49),
(76, 8, 1542629478, '35', 300, 48),
(77, 8, 1542629500, '35', 300, 47),
(78, 8, 1542629527, '35', 300, 46),
(79, 8, 1542629556, '35', 300, 45),
(80, 8, 1542629970, '35', 300, 44),
(81, 8, 1542629996, '35', 300, 43),
(82, 8, 1542630019, '35', 300, 42),
(83, 8, 1542630040, '35', 300, 41),
(84, 8, 1542630062, '35', 300, 40),
(85, 8, 1542630116, '35', 300, 39),
(86, 8, 1542630141, '35', 300, 38),
(87, 8, 1542630164, '35', 300, 37),
(88, 8, 1542630194, '35', 300, 36),
(89, 8, 1542630218, '35', 300, 35),
(90, 8, 1542632161, '35', 300, 34),
(91, 8, 1542632264, '35', 300, 33),
(92, 8, 1542632295, '35', 300, 32),
(93, 8, 1542632322, '35', 300, 31),
(94, 8, 1542632471, '35', 300, 30),
(95, 8, 1542632553, '35', 300, 29),
(96, 8, 1542632775, '35', 300, 28),
(97, 8, 1542632817, '35', 300, 27),
(98, 8, 1542632855, '35', 300, 26),
(99, 8, 1542632903, '35', 300, 25),
(100, 8, 1542632956, '35', 300, 24),
(101, 8, 1542633009, '35', 300, 23),
(102, 8, 1542633245, '35', 300, 22),
(103, 8, 1542633278, '35', 300, 21),
(104, 8, 1542633313, '35', 300, 20),
(105, 8, 1542633581, '35', 300, 19),
(106, 8, 1542633608, '35', 300, 18),
(107, 8, 1542633638, '35', 300, 17),
(108, 8, 1542633673, '35', 300, 16),
(109, 8, 1542633713, '35', 300, 15),
(110, 8, 1542633910, '35', 300, 14),
(111, 8, 1542633934, '35', 300, 13),
(112, 8, 1542633970, '35', 300, 12),
(113, 8, 1542633991, '35', 300, 11),
(114, 8, 1542634012, '35', 300, 10),
(115, 8, 1542634082, '35', 300, 9),
(116, 8, 1542634103, '35', 300, 8),
(117, 8, 1542634137, '35', 300, 7),
(118, 8, 1542634160, '35', 300, 6),
(119, 8, 1542634183, '35', 300, 5),
(120, 8, 1542634204, '35', 300, 4),
(121, 8, 1542634242, '35', 300, 2),
(122, 8, 1542634266, '35', 300, 1),
(123, 8, 1542635223, '35', 300, 97),
(124, 8, 1542635348, '35', 300, 97),
(125, 8, 1542638229, '35', 300, 98),
(126, 8, 1542638371, '35', 300, 99),
(127, 8, 1542702404, '35', 300, 97),
(128, 8, 1542703703, '35', 300, 98),
(129, 8, 1542874196, '35', 300, 99),
(130, 8, 1543244174, '', 100, 70);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_detail`
--

CREATE TABLE `inventory_detail` (
  `inventory_ref_id` int(100) NOT NULL,
  `products_id` int(100) NOT NULL,
  `attribute_id` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_detail`
--

INSERT INTO `inventory_detail` (`inventory_ref_id`, `products_id`, `attribute_id`) VALUES
(1, 81, 423),
(1, 81, 425),
(1, 81, 426),
(2, 81, 423),
(2, 81, 425),
(4, 81, 424),
(4, 81, 425),
(5, 81, 424),
(5, 81, 425),
(9, 80, 430),
(10, 74, 443),
(11, 81, 424),
(11, 81, 444),
(11, 81, 425),
(13, 81, 1),
(13, 81, 3),
(14, 81, 1),
(14, 81, 4),
(15, 81, 1),
(15, 81, 6),
(19, 102, 10),
(19, 102, 15),
(20, 102, 10),
(20, 102, 16),
(21, 102, 14),
(21, 102, 15),
(22, 102, 14),
(22, 102, 16),
(26, 77, 5),
(26, 77, 6),
(27, 77, 5),
(27, 77, 7),
(28, 77, 9),
(28, 77, 6),
(29, 77, 10),
(29, 77, 12),
(30, 77, 10),
(30, 77, 13),
(31, 77, 10),
(31, 77, 14),
(32, 77, 11),
(32, 77, 12),
(33, 77, 11),
(33, 77, 13),
(34, 77, 11),
(34, 77, 14),
(35, 75, 15),
(35, 75, 17),
(36, 75, 15),
(36, 75, 18),
(37, 75, 16),
(37, 75, 17),
(38, 75, 16),
(38, 75, 18),
(40, 80, 1),
(40, 80, 3),
(47, 77, 10),
(47, 77, 12),
(49, 75, 15),
(49, 75, 17),
(125, 98, 19),
(128, 98, 19),
(128, 98, 20),
(129, 99, 21);

-- --------------------------------------------------------

--
-- Table structure for table `manage_min_max`
--

CREATE TABLE `manage_min_max` (
  `min_max_id` int(100) NOT NULL,
  `min_level` int(100) NOT NULL,
  `max_level` int(100) NOT NULL,
  `products_id` int(100) NOT NULL,
  `inventory_ref_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manage_min_max`
--

INSERT INTO `manage_min_max` (`min_max_id`, `min_level`, `max_level`, `products_id`, `inventory_ref_id`) VALUES
(1, 10, 50, 81, '4,5'),
(4, 5, 30, 82, '0'),
(5, 55, 100, 83, '0'),
(6, 15, 50, 80, '9'),
(7, 5, 100, 81, '11'),
(8, 5, 25, 81, '13'),
(9, 10, 50, 81, '0'),
(10, 1, 10, 78, '0'),
(11, 1, 10, 77, '29,47'),
(12, 1, 10, 76, '0'),
(13, 1, 10, 75, '35,49'),
(14, 1, 10, 73, '0'),
(15, 1, 10, 72, '0'),
(16, 1, 10, 71, '0'),
(17, 1, 10, 70, '0'),
(18, 1, 10, 69, '0'),
(19, 1, 10, 68, '0'),
(20, 1, 10, 67, '0'),
(21, 1, 10, 66, '0'),
(22, 1, 10, 65, '0'),
(23, 1, 10, 64, '0'),
(24, 1, 10, 63, '0'),
(25, 1, 10, 62, '0'),
(26, 1, 10, 61, '0'),
(27, 1, 10, 60, '0'),
(28, 1, 10, 59, '0'),
(29, 1, 10, 58, '0'),
(30, 1, 10, 57, '0'),
(31, 1, 10, 56, '0'),
(32, 1, 10, 55, '0'),
(33, 1, 10, 54, '0'),
(34, 1, 10, 53, '0'),
(35, 1, 10, 52, '0'),
(36, 1, 10, 51, '0'),
(37, 1, 10, 50, '0'),
(38, 1, 10, 49, '0'),
(39, 1, 10, 48, '0'),
(40, 1, 10, 47, '0'),
(41, 1, 10, 46, '0'),
(42, 1, 10, 45, '0'),
(43, 1, 10, 44, '0'),
(44, 1, 10, 43, '0'),
(45, 1, 10, 42, '0'),
(46, 1, 10, 41, '0'),
(47, 1, 10, 40, '0'),
(48, 1, 10, 39, '0'),
(49, 1, 10, 38, '0'),
(50, 1, 10, 37, '0'),
(51, 1, 10, 36, '0'),
(52, 1, 10, 35, '0'),
(53, 1, 10, 34, '0'),
(54, 1, 10, 33, '0'),
(55, 1, 10, 32, '0'),
(56, 1, 10, 31, '0'),
(57, 1, 10, 30, '0'),
(58, 1, 10, 29, '0'),
(59, 1, 10, 28, '0'),
(60, 1, 10, 27, '0'),
(61, 1, 10, 26, '0'),
(62, 1, 10, 25, '0'),
(63, 1, 10, 24, '0'),
(64, 1, 10, 23, '0'),
(65, 1, 10, 22, '0'),
(66, 1, 10, 21, '0'),
(67, 1, 10, 20, '0'),
(68, 1, 10, 19, '0'),
(69, 1, 10, 18, '0'),
(70, 1, 10, 17, '0'),
(71, 1, 10, 16, '0'),
(72, 1, 10, 15, '0'),
(73, 1, 10, 14, '0'),
(74, 1, 10, 13, '0'),
(75, 1, 10, 12, '0'),
(76, 1, 10, 11, '0'),
(77, 1, 10, 10, '0'),
(78, 1, 10, 9, '0'),
(79, 1, 10, 8, '0'),
(80, 1, 10, 7, '0'),
(81, 1, 10, 6, '0'),
(82, 1, 10, 5, '0'),
(83, 1, 10, 4, '0'),
(84, 1, 10, 2, '0'),
(85, 1, 10, 1, '0'),
(86, 1, 10, 97, '0'),
(87, 0, 0, 98, '125'),
(88, 0, 0, 99, '129'),
(89, 1, 10, 98, '128'),
(90, 0, 0, 99, '129');

-- --------------------------------------------------------



-- --------------------------------------------------------

--
-- Table structure for table `products_shipping_rates`
--

CREATE TABLE `products_shipping_rates` (
  `products_shipping_rates_id` int(100) NOT NULL,
  `weight_from` varchar(100) DEFAULT NULL,
  `weight_to` varchar(100) DEFAULT NULL,
  `weight_price` int(100) NOT NULL,
  `unit_id` int(100) NOT NULL,
  `products_shipping_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_shipping_rates`
--

INSERT INTO `products_shipping_rates` (`products_shipping_rates_id`, `weight_from`, `weight_to`, `weight_price`, `unit_id`, `products_shipping_status`) VALUES
(1, '0', '20', 10, 1, 1),
(2, '21', '40', 20, 1, 1),
(3, '41', '60', 30, 1, 1),
(4, '61', '80', 40, 1, 1),
(5, '81', '100000', 0, 1, 1);

--
-- Indexes for dumped tables
--


--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/*settings update */;

INSERT INTO `settings` (`id`, `name`, `value`, `created_at`, `updated_at`) VALUES (NULL, 'sitename_logo', 'name', NULL, NULL), (NULL, 'website_name', '<strong>E</strong>COMMERCE', NULL, NULL), (NULL, 'web_home_pages_style', 'two', NULL, NULL), (NULL, 'web_color_style', 'app', NULL, NULL), (NULL, 'free_shipping_limit', '400', NULL, NULL), (NULL, 'app_icon_image', 'icon', NULL, NULL);

ALTER TABLE `products_description` ADD `products_left_banner` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, ADD `products_left_banner_start_date` INT(30) NULL DEFAULT NULL, ADD `products_right_banner` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, ADD `products_left_banner_expire_date` INT(30) NULL DEFAULT NULL, ADD `products_right_banner_start_date` INT(30) NULL DEFAULT NULL, ADD `products_right_banner_expire_date` INT(30) NULL DEFAULT NULL; 

ALTER TABLE `products_options`
  DROP `language_id`,
  DROP `categories_id`,
  DROP `session_regenerate_id`;
  

/*ALTER TABLE `products_options_values` DROP `language_id`; */




INSERT INTO `shipping_methods` (`shipping_methods_id`, `methods_type_link`, `isDefault`, `status`, `table_name`) VALUES (NULL, 'shippingByWeight', '0', '1', 'shipping_by_weight');

INSERT INTO `shipping_description` (`id`, `name`, `language_id`, `table_name`, `sub_labels`) VALUES (NULL, 'Shipping Price', '1', '', 'shipping_by_weight'), (NULL, 'Shipping Price', '2', '', 'shipping_by_weight'), (NULL, 'الشحن عن طريق الوزن', '4', '', 'shipping_by_weight');



insert into `payment_description` SET `name` = 'Instamojo';
insert into `payment_description` SET `name` = 'Instamojo';
insert into `payment_description` SET `name` = 'Instamojo'; 
insert into `payment_description` SET `name` = 'Cybersoure'; 
insert into `payment_description` SET `name` = 'Cybersoure'; 
insert into `payment_description` SET `name` = 'Hyperpay'; 
insert into `payment_description` SET `name` = 'Hyperpay';

/*insert into `shipping_methods` SET `table_name` = 'shipping_by_weight';

insert into `shipping_description` SET `table_name` = 'shipping_by_weight'; 
insert into `shipping_description` SET `table_name` = 'shipping_by_weight';*/

/*ALTER TABLE `products`  ADD `products_type` TINYINT(1) NOT NULL DEFAULT '0'  AFTER `is_feature`,  ADD `products_min_order` INT(100) NOT NULL DEFAULT '1'  AFTER `products_type`,  ADD `products_max_stock` INT(100) NULL DEFAULT NULL  AFTER `products_min_order`;

alter table `products` add `products_type` TINYINT(1) NOT NULL DEFAULT '0', add `products_min_order` INT(100) NOT NULL DEFAULT '1', add `products_max_stock` INT(100) NULL DEFAULT NULL;

ALTER TABLE `products_description` add `products_left_banner` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, add `products_left_banner_start_date` INT(30) NULL DEFAULT NULL, add `products_left_banner_expire_date` INT(30) NULL DEFAULT NULL, add `products_right_banner` MEDIUMTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL, add `products_right_banner_start_date` INT(30) NULL DEFAULT NULL, add  `products_right_banner_expire_date` INT(30) NULL DEFAULT NULL;*/


--
--this table already exist
--

--
-- Indexes for table `categories_role`
--
ALTER TABLE `categories_role`
  ADD PRIMARY KEY (`categories_role_id`);



--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories_role`
--
ALTER TABLE `categories_role`
  MODIFY `categories_role_id` int(11) NOT NULL AUTO_INCREMENT;


--
-- AUTO_INCREMENT for table `manage_min_max`
--
ALTER TABLE `manage_min_max`
  MODIFY `min_max_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `orders_status_description`
--
ALTER TABLE `orders_status_description`
  MODIFY `orders_status_description_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products_shipping_rates`



--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_ref_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;


ALTER TABLE `payments_setting` ADD `instamojo_enviroment` TINYINT(1) NOT NULL, add `instamojo_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `instamojo_api_key` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `instamojo_auth_token` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `instamojo_client_id` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `instamojo_client_secret` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `instamojo_active` TINYINT(1) NOT NULL DEFAULT '0', add `cybersource_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `cybersource_status` TINYINT(1) NOT NULL DEFAULT '0', add `hyperpay_enviroment` TINYINT(1) NOT NULL DEFAULT '0', add `hyperpay_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `hyperpay_active` TINYINT(1) NOT NULL DEFAULT '0', add `hyperpay_userid` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add  `hyperpay_password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `hyperpay_entityid` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `cybersource_enviroment` TINYINT(1) NOT NULL DEFAULT '0';

update `payments_setting` set `instamojo_enviroment`=0, `instamojo_name` = 'Instamojo', `instamojo_api_key`='c5a348bd5fcb4c866074c48e9c77c6c4', `instamojo_auth_token`='99448897defb4423b921fe47e0851b86', `instamojo_client_id`='test_9l7MW8I7c2bwIw7q0koc6B1j5NrvzyhasQh' , `instamojo_client_secret`='test_m9Ey3Jqp9AfmyWKmUMktt4K3g1uMIdapledVRRYJha7WinxOsBVV5900QMlwvv3l2zRmzcYDEOKPh1cvnVedkAKtHOFFpJbqcoNCNrjx1FtZhtDMkEJFv9MJuXD', `instamojo_active`=0, `cybersource_name`='cybersource', `cybersource_status`=0,  `hyperpay_enviroment` = 0, `hyperpay_name`= 'hyperpay', `hyperpay_active` = 0, `hyperpay_userid`= '8a82941865340dc8016537cdac1e0841', `hyperpay_password`='sXrYy8pnsf', `hyperpay_entityid`= '8a82941865340dc8016537ce08db0845'






CREATE TABLE `shipping_description` (
  `id` int(100) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `language_id` int(11) NOT NULL,
  `table_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sub_labels` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_description`
--
--
--this table already exist
--

INSERT INTO `shipping_description` (`id`, `name`, `language_id`, `table_name`, `sub_labels`) VALUES
(1, 'Free Shipping', 1, 'free_shipping', ''),
(2, 'Kostenloser Versand', 2, 'free_shipping', ''),
(3, 'الشحن مجانا', 4, 'free_shipping', ''),
(4, 'Local Pickup', 1, 'local_pickup', ''),
(5, 'Lokale Aufnahme', 2, 'local_pickup', ''),
(6, 'شاحنة محلية', 4, 'local_pickup', ''),
(7, 'Flat Rate', 1, 'flate_rate', ''),
(8, 'Flatrate', 2, 'flate_rate', ''),
(9, 'معدل', 4, 'flate_rate', ''),
(10, 'UPS Shipping', 1, 'ups_shipping', '{\"nextDayAir\":\"Next Day Air\",\"secondDayAir\":\"2nd Day Air\",\"ground\":\"Ground\",\"threeDaySelect\":\"3 Day Select\",\"nextDayAirSaver\":\"Next Day AirSaver\",\"nextDayAirEarlyAM\":\"Next Day Air Early A.M.\",\"secondndDayAirAM\":\"2nd Day Air A.M.\"}'),
(11, 'UPS Versand', 2, 'ups_shipping', '{\"nextDayAir\":\"Luft am n\\u00e4chsten Tag\",\"secondDayAir\":\"2Tag Luft\",\"ground\":\"Boden\",\"threeDaySelect\":\"3 Day Select\",\"nextDayAirSaver\":\"3 Tage ausw\\u00e4hlen\",\"nextDayAirEarlyAM\":\"N\\u00e4chster Tag Luft Fr\\u00fch A.M.\",\"secondndDayAirAM\":\"2. Tag Luft A.M.\"}'),
(12, 'يو بي إس الشحن', 4, 'ups_shipping', '{\"nextDayAir\":\"\\u0627\\u0644\\u0647\\u0648\\u0627\\u0621 \\u0627\\u0644\\u064a\\u0648\\u0645 \\u0627\\u0644\\u062a\\u0627\\u0644\\u064a\",\"secondDayAir\":\"\\u0627\\u0644\\u064a\\u0648\\u0645 \\u0627\\u0644\\u062b\\u0627\\u0646\\u064a \\u0644\\u0644\\u0637\\u064a\\u0631\\u0627\\u0646\",\"ground\":\"\\u0623\\u0631\\u0636\",\"threeDaySelect\":\"\\u0627\\u062e\\u062a\\u064a\\u0627\\u0631 3 \\u0623\\u064a\\u0627\\u0645\",\"nextDayAirSaver\":\"\\u0627\\u0644\\u064a\\u0648\\u0645 \\u0627\\u0644\\u062a\\u0627\\u0644\\u064a \\u062a\\u0648\\u0641\\u064a\\u0631 \\u0627\\u0644\\u0647\\u0648\\u0627\\u0621\",\"nextDayAirEarlyAM\":\"\\u0627\\u0644\\u064a\\u0648\\u0645 \\u0627\\u0644\\u062a\\u0627\\u0644\\u064a\",\"secondndDayAirAM\":\"\\u0627\\u0644\\u064a\\u0648\\u0645 \\u0627\\u0644\\u062b\\u0627\\u0646\\u064a \\u0644\\u0644\\u0637\\u064a\\u0631\\u0627\\u0646\"}'),
(13, 'Shipping Price', 1, '', 'shipping_by_weight'),
(14, 'Shipping Price', 2, '', 'shipping_by_weight'),
(15, 'الشحن عن طريق الوزن', 4, '', 'shipping_by_weight');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shipping_description`
--
ALTER TABLE `shipping_description`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shipping_description`
--
ALTER TABLE `shipping_description`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

--
-- Table structure for table `orders_status_description`
--

CREATE TABLE `orders_status_description` (
  `orders_status_description_id` int(100) NOT NULL,
  `orders_status_id` int(100) NOT NULL,
  `orders_status_name` varchar(255) NOT NULL,
  `language_id` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_ref_id`);

--
-- Indexes for table `manage_min_max`
--
ALTER TABLE `manage_min_max`
  ADD PRIMARY KEY (`min_max_id`);

--
-- Indexes for table `orders_status_description`
--
ALTER TABLE `orders_status_description`
  ADD PRIMARY KEY (`orders_status_description_id`);

--
-- Indexes for table `products_shipping_rates`
--
ALTER TABLE `products_shipping_rates`
  ADD PRIMARY KEY (`products_shipping_rates_id`);
  
  ALTER TABLE `products_shipping_rates`
  MODIFY `products_shipping_rates_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

ALTER TABLE `products_options_values` ADD `products_options_id` INT(11) NOT NULL AFTER `products_options_values_id`; 

ALTER TABLE `products` ADD `products_max_stock` `products_max_stock` INT(100) NULL DEFAULT NULL;

ALTER TABLE `payments_setting` add `hyperpay_enviroment` TINYINT(1) NOT NULL DEFAULT '0', add `hyperpay_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `hyperpay_userid` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `hyperpay_password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, add `hyperpay_entityid` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL;