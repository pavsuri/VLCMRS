-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2015 at 03:03 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coliban`
--
CREATE DATABASE IF NOT EXISTS `coliban` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `coliban`;

-- --------------------------------------------------------

--
-- Table structure for table `field_attributes`
--

CREATE TABLE IF NOT EXISTS `field_attributes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `field_type_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `identifier` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `field_attributes_field_type_id_foreign` (`field_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `field_attributes`
--

INSERT INTO `field_attributes` (`id`, `field_type_id`, `name`, `label`, `value`, `identifier`) VALUES
(16, 1, 'firstname', 'Firstname', 'fname', 23926),
(17, 1, 'lastname', 'LastName', 'lname', 28535),
(18, 3, 'Country', 'Country', 'country', 26596),
(19, 7, 'Submit', 'Submit', 'Submit', 25677),
(21, 6, 'India', 'India', 'india', 29225),
(22, 6, 'USA', 'USA', 'usa', 18862);

-- --------------------------------------------------------

--
-- Table structure for table `field_types`
--

CREATE TABLE IF NOT EXISTS `field_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `field_types`
--

INSERT INTO `field_types` (`id`, `name`, `status`) VALUES
(1, 'textbox', 1),
(2, 'textarea', 1),
(3, 'selectbox', 1),
(4, 'checkbox', 1),
(5, 'container', 1),
(6, 'option', 1),
(7, 'submit', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=124 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `name`, `type_id`, `created_at`, `updated_at`) VALUES
(56, 'System Maintenancesaidd', 1, '2015-06-04 01:36:31', '2015-06-04 01:38:29'),
(58, 'System Maintenancesaiddtryrty', 1, '2015-06-04 01:38:22', '2015-06-04 01:38:29'),
(59, 'fsdfsdfsd', 1, '2015-06-04 01:39:09', '2015-06-04 01:39:09'),
(60, 'fsdfsdfsdgg', 1, '2015-06-04 01:40:14', '2015-06-04 01:40:14'),
(61, 'fsdfsdfsdggss', 1, '2015-06-04 01:40:45', '2015-06-04 01:40:45'),
(62, 'fsdfsdfsdggssss', 1, '2015-06-04 01:40:51', '2015-06-04 01:40:51'),
(63, 'fsdfsdfsdggssssssss', 1, '2015-06-04 01:41:07', '2015-06-04 01:41:07'),
(64, 'fsdfsdfsdggssxxx', 1, '2015-06-04 01:41:56', '2015-06-04 01:41:56'),
(67, 'fsdfsdfsdggssxxxsddd', 1, '2015-06-04 01:43:30', '2015-06-04 01:43:30'),
(68, 'fsdfsdfsdggssxxxsddddddddddd', 1, '2015-06-04 01:44:31', '2015-06-04 01:44:31'),
(69, 'fsdfsdfsdggssxxxsddddddddddddd', 1, '2015-06-04 01:44:54', '2015-06-04 01:44:54'),
(70, 'sgdfgdf', 1, '2015-06-04 01:47:10', '2015-06-04 01:47:10'),
(71, 'System Maintenancegdfgdfg', 1, '2015-06-04 01:48:53', '2015-06-04 01:48:53'),
(73, 'kkkkkk', 1, '2015-06-04 01:51:46', '2015-06-04 01:51:51'),
(74, 'form1', 1, '2015-06-04 01:59:25', '2015-06-04 01:59:25'),
(75, 'form2', 1, '2015-06-04 02:10:00', '2015-06-04 02:10:00'),
(76, 'form3', 1, '2015-06-04 02:10:27', '2015-06-04 02:10:27'),
(77, 'form4', 2, '2015-06-04 02:56:56', '2015-06-04 02:56:56'),
(78, 'form44', 2, '2015-06-04 02:57:54', '2015-06-04 02:57:54'),
(79, 'form443', 2, '2015-06-04 03:20:08', '2015-06-04 03:20:08'),
(80, 'System Maintenanceddddddd', 2, '2015-06-04 03:20:35', '2015-06-04 03:20:35'),
(81, 'form443f', 2, '2015-06-04 03:42:02', '2015-06-04 03:42:02'),
(82, 'form443fdgfd', 2, '2015-06-04 03:42:50', '2015-06-04 03:42:50'),
(83, 'form443fdgfdgh', 2, '2015-06-04 03:43:21', '2015-06-04 03:43:21'),
(84, 'fsdfs', 1, '2015-06-04 05:24:03', '2015-06-04 05:24:03'),
(85, 'fsdfsdfgdf', 1, '2015-06-04 05:39:22', '2015-06-04 05:39:22'),
(86, 'System Maintenancegfdgd', 0, '2015-06-04 05:39:37', '2015-06-04 05:39:37'),
(87, 'fsdfsdfgdfcvbcvb', 1, '2015-06-04 05:40:22', '2015-06-04 05:40:22'),
(88, 'fsdfsdfgdfcvbcvbff', 1, '2015-06-04 05:43:54', '2015-06-04 05:43:54'),
(90, 'fsdfsdfgdfcvbcvbffgdfg', 1, '2015-06-04 05:45:40', '2015-06-04 05:45:40'),
(91, 'fsdfsdfgdfcvbcvbffgdfggdfg', 1, '2015-06-04 05:46:23', '2015-06-04 05:46:23'),
(92, 'fsdfsdfgdfcvbcvbffgdfggdfghfghgf', 1, '2015-06-04 05:50:24', '2015-06-04 05:50:24'),
(93, 'dfgdfgdfg', 1, '2015-06-04 05:51:12', '2015-06-04 05:51:12'),
(94, 'dfgdfgdfgfff', 1, '2015-06-04 05:52:13', '2015-06-04 05:52:13'),
(95, 'dfgdfgdfgfffxcgfsdg', 1, '2015-06-04 05:55:03', '2015-06-04 05:55:03'),
(96, 'dfgdfgdfgfffxcgfsdgdf', 1, '2015-06-04 05:56:29', '2015-06-04 05:56:29'),
(97, 'dfgdfgdfgfffxcgfsdgdffgdg', 1, '2015-06-04 05:56:46', '2015-06-04 05:56:46'),
(98, 'dfgdfgdfgfffxcgfsdgdffgdgf', 1, '2015-06-04 06:00:01', '2015-06-04 06:00:01'),
(99, 'cgf', 1, '2015-06-04 06:00:25', '2015-06-04 06:00:25'),
(100, 'cgfgfd', 1, '2015-06-04 06:01:01', '2015-06-04 06:01:01'),
(101, 'cgfgfddd', 1, '2015-06-04 06:02:56', '2015-06-04 06:02:56'),
(102, 'cgfgfdddsdfsdf', 1, '2015-06-04 06:04:10', '2015-06-04 06:04:10'),
(103, 'cgfgfdddsdfsdffdsf', 1, '2015-06-04 06:04:45', '2015-06-04 06:04:45'),
(104, 'cgfgfdddsdfsdffdsfxfgdf', 1, '2015-06-04 06:12:05', '2015-06-04 06:12:05'),
(105, 'gdfgdf', 1, '2015-06-04 06:20:27', '2015-06-04 06:20:27'),
(106, 'gdfgdfc', 1, '2015-06-04 06:21:17', '2015-06-04 06:21:17'),
(107, 'form443fdgfdghdsfsdfcd', 2, '2015-06-04 06:24:38', '2015-06-04 06:24:38'),
(108, 'form443fdgfdghdsfsdfcdfff', 2, '2015-06-04 06:25:47', '2015-06-04 06:25:47'),
(109, 'form443fdgfdghdsfsdfcdfffhfghfg', 2, '2015-06-04 06:32:42', '2015-06-04 06:32:42'),
(110, 'form443fdgfdghdsfsdfcdfffhffsdfsghfg', 2, '2015-06-04 06:33:51', '2015-06-04 06:33:51'),
(111, 'form443fdgfdghdsfsdfcdfffffhffsdfsghfg', 2, '2015-06-04 06:35:28', '2015-06-04 06:35:28'),
(112, 'form443fdgfdghdsfsdfcvcdfffffhffsdfsghfg', 2, '2015-06-04 06:43:26', '2015-06-04 06:43:26'),
(113, 'form443fdgfdghdsfsdfcvcdffffffhffsdfsghfg', 2, '2015-06-04 06:43:52', '2015-06-04 06:43:52'),
(114, 'form443fdgfdghdfgdsfsdfcvcdffffffhffsdfsghfg', 2, '2015-06-04 06:44:19', '2015-06-04 06:44:19'),
(115, 'form443fdgfdghdfgdgdfgdfsfsdfcvcdffffffhffsdfsghfg', 2, '2015-06-04 06:44:54', '2015-06-04 06:44:54'),
(116, 'form443fdgf', 2, '2015-06-04 06:47:42', '2015-06-04 06:47:42'),
(117, 'form443fdgff', 2, '2015-06-04 06:48:08', '2015-06-04 06:48:08'),
(118, 'form443fdgffgdf', 2, '2015-06-04 06:55:11', '2015-06-04 06:55:11'),
(119, 'form443fdgffgdfgfg', 2, '2015-06-04 06:58:59', '2015-06-04 06:58:59'),
(120, 'form443fdgffgdfgfgghjg', 2, '2015-06-04 06:59:17', '2015-06-04 06:59:17'),
(121, 'form443fdgffgdfgfgghjggdfgdf', 2, '2015-06-04 07:00:00', '2015-06-04 07:00:00'),
(122, 'form443fdgffgdfgdfggfgghjggdfgdf', 2, '2015-06-04 07:00:57', '2015-06-04 07:00:57'),
(123, 'form443fdgffgdfgdfggfggfsdgdfhjggdfgdf', 2, '2015-06-04 07:05:42', '2015-06-04 07:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `form_types`
--

CREATE TABLE IF NOT EXISTS `form_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `form_type` varchar(256) NOT NULL,
  `status` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `form_types`
--

INSERT INTO `form_types` (`id`, `form_type`, `status`) VALUES
(1, 'survey', '0000-00-00'),
(2, 'maintenance', '0000-00-00'),
(3, 'machinery', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `structure`
--

CREATE TABLE IF NOT EXISTS `structure` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(10) unsigned NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `field_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `structure_form_id_foreign` (`form_id`),
  KEY `structure_field_id_foreign` (`field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '0',
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `is_active`, `updated_at`, `created_at`) VALUES
(1, 'sai.kethamreddy@valuelabs.net', '$2y$10$/CAwWGC2SJrqypYJzDAx3u/wsDO7yYJC65rJ3VyNW1pcx291NLxHG', 'kishore', 1, '2015-06-04', '2015-06-04'),
(2, 'sai@gmail.com', 'rewr', 'rwer', 0, '2015-06-10', '2015-06-10');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `field_attributes`
--
ALTER TABLE `field_attributes`
  ADD CONSTRAINT `field_attributes_field_type_id_foreign` FOREIGN KEY (`field_type_id`) REFERENCES `field_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `structure`
--
ALTER TABLE `structure`
  ADD CONSTRAINT `structure_field_id_foreign` FOREIGN KEY (`field_id`) REFERENCES `field_attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `structure_form_id_foreign` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
