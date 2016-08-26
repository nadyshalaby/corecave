-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2016 at 03:49 PM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `freeziana`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_count` int(11) NOT NULL DEFAULT '0',
  `sub_cat_count` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cat_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `code`, `name`, `product_count`, `sub_cat_count`, `created_at`, `updated_at`) VALUES
(1, 'CAT1', 'accessories', 6, 0, '2016-07-20 00:00:00', '2016-07-20 00:00:00'),
(2, 'CAT2', 'decoration', 4, 0, '2016-07-20 00:00:00', '2016-07-08 00:00:00'),
(3, 'CAT3', 'clothes', 1, 0, '2016-07-20 00:00:00', '2016-07-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
CREATE TABLE IF NOT EXISTS `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `attachment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `viewed` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_count` int(11) NOT NULL DEFAULT '0',
  `total` float NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orders_code_unique` (`code`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `status`, `code`, `product_count`, `total`, `created_at`, `updated_at`) VALUES
(14, 40, 'bending', 'ORD1', 2, 320.81, '2016-07-18 10:08:06', '2016-07-18 10:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE IF NOT EXISTS `order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`id`, `order_id`, `product_id`, `created_at`, `updated_at`) VALUES
(16, 14, 14, '2016-07-18 10:08:07', '2016-07-18 10:08:07'),
(17, 14, 12, '2016-07-18 10:08:07', '2016-07-18 10:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` float(10,2) DEFAULT NULL,
  `discount` float(10,2) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `stock` int(11) NOT NULL,
  `sold` int(11) DEFAULT NULL,
  `material` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight` float(10,2) DEFAULT NULL,
  `length` float(10,2) DEFAULT NULL,
  `width` float(10,2) DEFAULT NULL,
  `sex` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_code_unique` (`code`),
  UNIQUE KEY `product_slug_unique` (`slug`),
  KEY `cat_id` (`cat_id`),
  KEY `sub_cat_id` (`sub_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `code`, `name`, `description`, `price`, `discount`, `rate`, `stock`, `sold`, `material`, `slug`, `color`, `image`, `cat_id`, `sub_cat_id`, `size`, `weight`, `length`, `width`, `sex`, `created_at`, `updated_at`, `active`) VALUES
(12, 42, 'ITEM1', 'Ø®Ø§ØªÙ… Ø¯Ù‡Ø¨ÙŠ ', 'ØªÙ„Ø§Ù†ØªÙ‰Ù„Ø§Ù†ØªÙ‰Ù†Øª', 365.00, 20.00, NULL, 19, 1, 'Ø¯Ù‡Ø¨ ØµÙŠÙ†ÙŠ', 'khatm-d''hby', 'Ø¯Ù‡Ø¨ÙŠ', 'images/products/categories_30972.PNG', 1, 5, 'SM', 96.00, 36.00, 96.00, 'male', '2016-07-18 07:55:16', '2016-07-18 07:55:16', 1),
(13, 42, 'ITEM13', 'Ù†Ø§Ø¯ÙŠ ØµØ¨ÙŠØ­ Ø´Ù„Ø¨ÙŠ', 'mxzlkmlkmcxklmcxoijciomcoixmoicxoicxmoicxmoixcioj', 424.00, 60.00, NULL, 65, NULL, 'Ù‚Ø·Ù† Ù…ØµØ±ÙŠ', 'nady-sbyh-shlby', 'Ù†Ø¨ÙŠØªÙŠ', 'images/products/favorates.PNG', 1, 1, 'SM', 23.00, 20.00, 96.00, 'male', '2016-07-18 07:59:43', '2016-07-18 07:59:43', 1),
(14, 42, 'ITEM14', 'ahmed shalaby', 'lnxzlnlkxznlkmnxzlk', 43.00, 33.00, NULL, 34, 3, 'Ù‚Ø·Ù† Ù…ØµØ±ÙŠ', 'ahmed-shalaby', 'Ø¨Ø§Ù…Ø¨Ù‡', 'images/products/cats.PNG', 1, 5, 'SM', 0.00, 21.00, 18.00, 'male', '2016-07-18 08:01:36', '2016-07-18 08:01:36', 1),
(15, 40, 'ITEM15', 'Ø´Ù†Ø·Ù‡ Ù…Ø²Ø®Ø±ÙÙ‡', 'Ø´Ù†Ø·Ù‡ Ù…ØªØ¹Ø¯Ø¯Ù‡ Ø§Ù„Ø§Ø³ØªØ®Ø¯Ø§Ù… Ù…Ø´ØºÙˆÙ„Ù‡ Ø¨Ø§Ù„ÙŠØ¯', 55.00, 0.00, NULL, 2, NULL, 'ÙˆØ±Ù‚ Ù…Ù‚ÙˆÙŠ', 'shnth-mzkhrfh', 'Ù…ØªØ¹Ø¯Ø¯ Ø§Ù„Ø§Ù„ÙˆØ§Ù†', 'images/products/p2.jpg', 1, 1, 'MD', 12.00, 15.00, 30.00, 'female', '2016-07-18 11:04:08', '2016-07-18 11:04:08', 1),
(16, 40, 'ITEM16', 'Ø­Ø§Ù…Ù„ Ø§ÙƒÙˆØ§Ø¨', 'Ø­Ø§Ù…Ù„ Ø§ÙƒÙˆØ§Ø¨ ', 40.00, 0.00, NULL, 3, NULL, 'ÙØ®Ø§Ø±', 'haml-akwab', 'Ø§Ø­Ù…Ø±', 'images/products/p3.jpg', 1, 1, 'SM', 30.00, 5.00, 15.00, 'male', '2016-07-18 11:05:41', '2016-07-18 11:05:41', 1),
(17, 40, 'ITEM17', 'ØµÙ†Ø¯ÙˆÙ‚ Ù…Ù„ÙˆÙ† ', 'ØµÙ†Ø¯ÙˆÙ‚ Ù…Ù„ÙˆÙ† Ù‡Ø§Ù†Ø¯Ù…ÙŠØ¯ ', 60.00, 10.00, NULL, 5, NULL, 'Ø§Ù„Ø®Ø´Ø¨ ', 'sndwq-mlwn', 'Ø¨ÙŠÙ†ÙƒÙ‰ ', 'images/products/p5.jpg', 2, 3, 'LG', 20.00, 12.00, 13.00, 'female', '2016-07-18 11:07:43', '2016-07-18 11:07:43', 1),
(18, 40, 'ITEM18', 'Ø¹Ù„Ø¨Ø© Ù…Ù† Ø§Ù„Ø®Ø´Ø¨ Ø§Ù„Ù…Ù„ÙˆÙ† ', 'Ø¹Ù„Ø¨Ø© Ù…Ù† Ø§Ù„Ø®Ø´Ø¨ Ù„Ø­Ù…Ù„ Ø§Ù„Ø§Ø´ÙŠØ§Ø¡ ', 50.00, 30.00, NULL, 4, NULL, 'Ø®Ø´Ø¨ ', 'albh-mn-alkhshb-almlwn', 'Ù…Ø®ØªÙ„Ù Ø§Ù„Ø§Ù„ÙˆØ§Ù† ', 'images/products/p7.jpg', 2, 3, 'SM', 0.00, 13.00, 47.00, 'female', '2016-07-18 11:08:52', '2016-07-18 11:08:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE IF NOT EXISTS `shipping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shipping_tel_unique` (`tel`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`id`, `user_id`, `tel`, `address_1`, `address_2`, `city`, `state`, `country`, `zip`, `active`, `created_at`, `updated_at`) VALUES
(9, 40, '01017572762', 'Menoufiya, Menouf , Barhim , Al-Abayda ST', '', 'Menoufiya', 'menouf', 'Egypt', '32955', 0, '2016-07-17 05:03:09', '2016-07-17 05:03:09'),
(10, 40, '010175727628', 'menoufia', '', 'menoufia', 'Choose a state / province', 'Egypt', '13955', 1, '2016-07-17 05:03:36', '2016-07-17 05:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_count` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sub_cat_code_unique` (`code`),
  KEY `cat_id` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `code`, `product_count`, `cat_id`, `created_at`, `updated_at`) VALUES
(1, 'jewlloray', 'SCAT1', 3, 1, '2016-07-19 00:00:00', '2016-07-06 00:00:00'),
(2, 'dresses', 'SCAT2', 1, 3, '2016-07-21 00:00:00', '2016-07-15 00:00:00'),
(3, 'Zina', 'SCAT3', 4, 2, '2016-07-08 00:00:00', '2016-07-22 00:00:00'),
(4, 'tar7a', 'SCAT4', 0, 3, '2016-07-29 00:00:00', '2016-07-29 00:00:00'),
(5, 'rings', 'SCAT5', 3, 1, '2016-07-15 00:00:00', '2016-07-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sub_clients`
--

DROP TABLE IF EXISTS `sub_clients`;
CREATE TABLE IF NOT EXISTS `sub_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `craft` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cub_clients_email_unique` (`email`),
  UNIQUE KEY `cub_clients_tel_unique` (`tel`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_clients`
--

INSERT INTO `sub_clients` (`id`, `user_id`, `name`, `email`, `craft`, `avatar`, `address`, `tel`, `created_at`, `updated_at`) VALUES
(9, 40, 'Ù‡Ø¯ÙŠØ±', 'nady80878@gmail.com', 'Ø§ÙƒØ³ÙˆØ±Ø§Øª', 'images/avatars/1465695808_groups-02.png', 'Ø´Ù„Ø¨Ù‰ ', '01090056055', '2016-07-18 12:52:00', '2016-07-18 12:52:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_me` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '0',
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `national_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_slug_unique` (`slug`),
  UNIQUE KEY `remember_me_unique` (`remember_me`),
  UNIQUE KEY `email_unique` (`email`),
  UNIQUE KEY `national_id_unique` (`national_id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `email`, `pass`, `remember_me`, `active`, `avatar`, `national_id`, `slug`, `role`, `created_at`, `updated_at`) VALUES
(38, 'Ù‡Ø¯ÙŠØ±', 'shalaby', 'hadeer@gmail.com', '$2y$10$nY/6sCUK4nBxz.G5YD7HsOVv68.PDkDrj.8xhFPcKMHNT8xQtdEK2', 'pJSndValBHME85YzllcW9tb01ZRWVm', 1, 'images/avatars/categories.PNG', '96332222337463', 'ahmed-shalaby', 'normal', '2016-07-12 20:00:06', '2016-07-15 12:04:07'),
(40, 'nady', 'shalaby', 'nady80878@gmail.com', '$2y$10$9XCZ2EryPdQyuKDT7KNzNuDeRGV1dvHDWVB2qDTe1RgCXgD1N7ND2', 'J5eHhKUXhiQURzcWtObFVCMlZ5MHV2', 1, 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-xpa1/v/t1.0-1/s200x200/22211_988189037865688_7143331629579386976_n.jpg?oh=528362e232530e31c9c3d018e1228088&oe=5825DED1&__gda__=1475760642_d24f3be22f9ab73626a4a4e39ce82cd1', '00000001110000', 'nady-shalaby', 'boss', '2016-07-16 03:14:53', '2016-07-18 12:45:57'),
(41, 'soso', 'dodo', 'soso@gmail.com', '$2y$10$Hw4YvHo9Dlmh4RFRZxn6Wupg1icJMxUKN/vJaJFpYQ.jHblpUEe6u', 'dmZnczQVkuSW16TWV5TW5ORU1EU09P', 1, '', '12345678912345', 'soso-dodo', 'boss', '2016-07-17 06:05:44', '2016-07-17 06:13:53'),
(42, 'Ù‡Ø¯ÙŠØ±', 'Ø´Ù„Ø¨ÙŠ', 'dead@gmail.com', '$2y$10$ncpglcqCg8f9zRpWiLisuOlp3oO1ddioq5EKxzjQQwLVQ7YfWYjZG', 'NlR2EzbnhsN2Q4cXUzd1pOaUFaYy5h', 1, '', 'FoSzl1WDBpVFdyOEpvb1NpZkJDaU9X', 'hdyr-shlby', 'boss', '2016-07-17 12:12:32', '2016-07-17 14:06:17');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_product`
--
ALTER TABLE `order_product`
  ADD CONSTRAINT `order_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_product_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`sub_cat_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rates`
--
ALTER TABLE `rates`
  ADD CONSTRAINT `rates_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rates_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipping`
--
ALTER TABLE `shipping`
  ADD CONSTRAINT `shipping_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
