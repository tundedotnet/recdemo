-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: deeprec.cabr5j0idph8.ap-southeast-1.rds.amazonaws.com
-- Generation Time: Nov 06, 2018 at 06:54 AM
-- Server version: 5.6.10
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rec_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `genre_cate`
--

CREATE TABLE `genre_cate` (
  `gc_id` int(11) NOT NULL,
  `gc_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gc_crt_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `gc_mod_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `genre_cate`
--

INSERT INTO `genre_cate` (`gc_id`, `gc_title`, `gc_crt_time`, `gc_mod_time`) VALUES
(1, 'Action', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(2, 'Adventure', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(3, 'Animation', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(4, 'Children\'s', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(5, 'Comedy', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(6, 'Crime', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(7, 'Documentary', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(8, 'Drama', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(9, 'Fantasy', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(10, 'Film-Noir', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(11, 'Horror', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(12, 'Musical', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(13, 'Mystery', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(14, 'Romance', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(15, 'Sci-Fi', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(16, 'Thriller', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(17, 'War', '2018-09-05 07:07:49', '2018-09-05 07:07:49'),
(18, 'Western', '2018-09-05 07:07:49', '2018-09-05 07:07:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `genre_cate`
--
ALTER TABLE `genre_cate`
  ADD PRIMARY KEY (`gc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `genre_cate`
--
ALTER TABLE `genre_cate`
  MODIFY `gc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
