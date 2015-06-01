-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2015 at 02:47 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `field_attributes`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `forms`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--


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

--
-- Dumping data for table `structure`
--
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
