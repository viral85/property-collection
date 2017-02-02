-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2017 at 02:51 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `property_collection`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2017_02_01_114315_create_property_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_property`
--

CREATE TABLE `tbl_property` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(10) UNSIGNED DEFAULT NULL,
  `bedroom` int(10) UNSIGNED DEFAULT NULL,
  `bathroom` int(10) UNSIGNED DEFAULT NULL,
  `store` int(10) UNSIGNED DEFAULT NULL,
  `garage` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbl_property`
--

INSERT INTO `tbl_property` (`id`, `name`, `price`, `bedroom`, `bathroom`, `store`, `garage`, `created_at`, `updated_at`) VALUES
(1, 'The Victoria', 374662, 4, 2, 2, 2, '2017-02-02 08:21:07', '2017-02-02 08:21:07'),
(2, 'The Xavier', 513268, 4, 2, 1, 2, '2017-02-02 08:21:07', '2017-02-02 08:21:07'),
(3, 'The Como', 454990, 4, 3, 2, 3, '2017-02-02 08:21:07', '2017-02-02 08:21:07'),
(4, 'The Aspen', 384356, 4, 2, 2, 2, '2017-02-02 08:21:07', '2017-02-02 08:21:07'),
(5, 'The Lucretia', 572002, 4, 3, 2, 2, '2017-02-02 08:21:07', '2017-02-02 08:21:07'),
(6, 'The Toorak', 521951, 5, 2, 1, 2, '2017-02-02 08:21:07', '2017-02-02 08:21:07'),
(7, 'The Skyscape', 263604, 3, 2, 2, 2, '2017-02-02 08:21:07', '2017-02-02 08:21:07'),
(8, 'The Clifton', 386103, 3, 2, 1, 1, '2017-02-02 08:21:08', '2017-02-02 08:21:08'),
(9, 'The Geneva', 390600, 4, 3, 2, 2, '2017-02-02 08:21:08', '2017-02-02 08:21:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_property`
--
ALTER TABLE `tbl_property`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_property`
--
ALTER TABLE `tbl_property`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
