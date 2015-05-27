-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2015 at 06:20 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coliban`
--

-- --------------------------------------------------------

--
-- Table structure for table `field_attributes`
--

CREATE TABLE IF NOT EXISTS `field_attributes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `field_type_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `label` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `identifier` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `identifier` (`identifier`),
  UNIQUE KEY `name` (`name`),
  KEY `field_type_id` (`field_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `field_attributes`
--

INSERT INTO `field_attributes` (`id`, `field_type_id`, `name`, `label`, `value`, `identifier`) VALUES
(3, 2, 'description', 'Description', 'Please enter your comments', 2222),
(4, 1, 'firstname', 'FirstName', 'Please enter your name', 27983),
(5, 1, 'lastname', 'LastName', 'lastname', 19676),
(6, 1, 'education', 'Graduation', 'please enter your education details', 12528),
(8, 1, 'company', 'Company', 'company', 26191),
(9, 1, 'gfg', 'dfgdf', 'gdf', 2286);

-- --------------------------------------------------------

--
-- Table structure for table `field_types`
--

CREATE TABLE IF NOT EXISTS `field_types` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `status` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `field_types`
--

INSERT INTO `field_types` (`id`, `name`, `status`) VALUES
(1, 'textbox', 1),
(2, 'textarea', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `name`, `type_id`, `created_at`, `updated_at`) VALUES
(2, 'gdfgdf', 54423535, '2015-05-20', '0000-00-00'),
(16, 'sai', 123, '2015-05-25', '2015-05-25'),
(17, 'form1', 123, '2015-05-25', '2015-05-25'),
(18, 'form 3', 3, '2015-05-25', '2015-05-25'),
(20, 'form5', 5, '2015-05-25', '2015-05-25'),
(21, 'dfgdgd', 4, '2015-05-25', '2015-05-25'),
(22, 'NewForm', 1234, '2015-05-27', '2015-05-27'),
(24, 'NewForm2', 1234, '2015-05-27', '2015-05-27'),
(25, 'NewForm3', 1234, '2015-05-27', '2015-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `form_values`
--

CREATE TABLE IF NOT EXISTS `form_values` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `form_id` int(10) NOT NULL,
  `form_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `structure`
--

CREATE TABLE IF NOT EXISTS `structure` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `form_id` int(10) NOT NULL,
  `parent_id` int(10) NOT NULL,
  `field_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `form_id` (`form_id`),
  KEY `field_id` (`field_id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `structure`
--

INSERT INTO `structure` (`id`, `form_id`, `parent_id`, `field_id`) VALUES
(1, 16, 0, 4),
(2, 16, 0, 5),
(3, 16, 0, 6),
(5, 16, 0, 8),
(11, 16, 0, 9),
(12, 16, 0, 3),
(13, 17, 0, 9);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `field_attributes`
--
ALTER TABLE `field_attributes`
  ADD CONSTRAINT `field_attributes_ibfk_1` FOREIGN KEY (`field_type_id`) REFERENCES `field_types` (`id`);

--
-- Constraints for table `structure`
--
ALTER TABLE `structure`
  ADD CONSTRAINT `structure_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`),
  ADD CONSTRAINT `structure_ibfk_2` FOREIGN KEY (`field_id`) REFERENCES `field_attributes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
