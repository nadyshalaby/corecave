-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2016 at 08:40 AM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zakaa`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` text NOT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `seen` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `from`, `to`, `subject`, `body`, `attachment`, `seen`, `created_at`, `updated_at`) VALUES
(5, 'nady shalaby', 'nady80878@gmail.com', 'me', 'FeedBack', 'pjoi xcjiv jcxiom iocxjiojio', NULL, 1, '2016-08-29 14:52:48', '2016-08-30 02:23:20'),
(6, 'nady shalaby', 'nady80878@gmail.com', 'me', 'FeedBack', 'okpokppkp', NULL, 1, '2016-08-29 14:53:58', '2016-08-30 02:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `social_number` varchar(45) NOT NULL,
  `plan` varchar(45) NOT NULL,
  `tel` varchar(45) NOT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `address_1` varchar(100) NOT NULL,
  `address_2` varchar(100) DEFAULT NULL,
  `country` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `seen` tinyint(4) NOT NULL,
  `rejected` tinyint(4) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `project_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `attachment` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `firstname`, `lastname`, `social_number`, `plan`, `tel`, `mobile`, `address_1`, `address_2`, `country`, `state`, `city`, `email`, `seen`, `rejected`, `website`, `project_name`, `description`, `attachment`, `created_at`, `updated_at`) VALUES
(4, 'nady', 'shalaby', '12345678945612', 'Basic Plan', '01017572762', '01017572762', 'menoufia', '', 'Bahamas', 'Kemps Bay', 'ouhuihu', 'nady80878@gmail.com', 1, 0, 'http://localhost/zakaa/', 'ijoijiojiojoi@sdff.vsv', 'pkmimklklmk', 'sweetalert-master.zip', '2016-08-29 16:30:16', '2016-08-30 00:32:36'),
(3, 'nady', 'shalaby', '12345678945612', 'Pro Plan', '01017572762', '01017572762', 'Menoufiya, Menouf , Barhim , Al-Abayda ST', 'menouf/barhim', 'Bahamas', 'Kemps Bay', 'ibuiih', 'nady80878@gmail.com', 1, 0, 'http://localhost/zakaa/', 'ijoijiojiojoi@sdff.vsv', 'kndoijcioxmoxjoi', 'freeziana admin_89083.rar', '2016-08-29 16:07:18', '2016-08-30 00:32:02'),
(7, 'Hadeer', 'shalaby', '12345678945612', 'Pro Plan', '01017572762', '01017572762', 'Menoufiya, Menouf , Barhim , Al-Abayda ST', 'menouf/barhim', 'Egypt', 'Giza', 'menoufia', 'hadeer@gmail.com', 1, 0, NULL, 'cxjoijcxjocjx', 'cxojoicxjiocxjioxcj', NULL, '2016-08-29 22:41:38', '2016-08-30 00:32:02'),
(8, 'hadeer', 'shalaby', '12345678945612', 'Economic Plan', '01017572762', '01017572762', 'Menoufiya, Menouf , Barhim , Al-Abayda ST', 'menouf/barhim', 'Egypt', 'Helwan', 'Menoufiya', 'nady80878@gmail.com', 1, 0, NULL, 'جال', 'pmmpompom', NULL, '2016-08-29 22:43:53', '2016-08-30 00:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'super'),
(2, 'admin'),
(3, 'editor'),
(4, 'viewer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(100) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `gender` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `role` smallint(6) NOT NULL,
  `hash` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `hash_UNIQUE` (`hash`),
  UNIQUE KEY `user_tel` (`tel`),
  UNIQUE KEY `user_mobile` (`mobile`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `tel`, `mobile`, `address`, `gender`, `email`, `password`, `active`, `role`, `hash`, `created_at`, `updated_at`) VALUES
(1, 'Nady shalaby', '0483677552', '01017572762', 'Menofiya/Menouf', 'female', 'nady80878@gmail.com', '$2y$10$8BveUMUqACreo1MfbJkoo.clGm2DxdCdiDTHcxN8Cmx55E/k.WwgK', 1, 1, 'NMVzNCU3o5aWRqUVRrUHdSMDNUZmVw', '2016-08-24 21:21:10', '2016-08-30 06:13:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
