-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2015 at 03:02 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

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
-- Table structure for table `assigned_forms`
--

CREATE TABLE IF NOT EXISTS `assigned_forms` (
`id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `form_type_id` int(10) NOT NULL,
  `assigned_form_id` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned_forms`
--

INSERT INTO `assigned_forms` (`id`, `user_id`, `form_type_id`, `assigned_form_id`, `updated_at`, `created_at`) VALUES
(53, 2, 1, '81', '2015-07-02 03:18:21', '2015-07-02 03:18:21'),
(54, 2, 2, '76,77,78', '2015-07-02 03:18:21', '2015-07-02 03:18:21'),
(55, 2, 3, '79', '2015-07-02 03:18:21', '2015-07-02 03:18:21'),
(60, 1, 1, '81,82', '2015-07-02 03:18:52', '2015-07-02 03:18:52'),
(61, 1, 3, '79,80,84', '2015-07-02 03:18:52', '2015-07-02 03:18:52'),
(62, 3, 2, '76,78', '2015-07-02 03:19:00', '2015-07-02 03:19:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_forms`
--
ALTER TABLE `assigned_forms`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_forms`
--
ALTER TABLE `assigned_forms`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=63;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
