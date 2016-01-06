-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2015 at 10:54 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `youtube`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocked_ip`
--

CREATE TABLE IF NOT EXISTS `blocked_ip` (
`id` int(11) NOT NULL,
  `ip` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `attempt` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocked_ip`
--

INSERT INTO `blocked_ip` (`id`, `ip`, `start_date`, `end_date`, `attempt`) VALUES
(3, '127.0.0.1', '2015-02-23 21:42:21', '2015-02-23 21:42:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
`id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `id_user`, `name`) VALUES
(1, 10, 'vasile'),
(3, 1, 'vasile'),
(4, 1, 'vali'),
(5, 1, ''),
(6, 1, 'ion'),
(7, 1, 'test'),
(8, 0, 'tudor'),
(9, 10, 'tud');

-- --------------------------------------------------------

--
-- Table structure for table `songs`
--

CREATE TABLE IF NOT EXISTS `songs` (
`id` int(11) NOT NULL,
  `name` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(225) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `songs`
--

INSERT INTO `songs` (`id`, `name`, `url`) VALUES
(1, 'melodieDeTest', 'sfsafas2sdfa'),
(2, 'safdafsafa', 'sdafasfdsafsafsafasdfsafas');

-- --------------------------------------------------------

--
-- Table structure for table `song_playlist`
--

CREATE TABLE IF NOT EXISTS `song_playlist` (
`id` int(11) NOT NULL,
  `id_playlist` int(11) NOT NULL,
  `id_song` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `song_playlist`
--

INSERT INTO `song_playlist` (`id`, `id_playlist`, `id_song`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `date_registration` datetime NOT NULL,
  `activated` tinyint(4) NOT NULL DEFAULT '0',
  `generated_token` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `date_registration`, `activated`, `generated_token`) VALUES
(7, 'vasile@gmail.com', '3ea48cfabe664dff8375a0cb6f3db844510fdea0', '2015-02-07 12:00:07', 0, NULL),
(10, 'valentin.bica@gmail.com', '3ea48cfabe664dff8375a0cb6f3db844510fdea0', '2015-02-08 15:53:47', 1, 'd746c92543a284851b50ca9ae3b695c651364628'),
(11, 'iknow.gabriel@gmail.com', '3ea48cfabe664dff8375a0cb6f3db844510fdea0', '2015-02-15 20:25:55', 0, 'b374928e6b397a337ae628941e42a3518f5f73e7'),
(12, 'sdfasfasfa@gmail.com', '3ea48cfabe664dff8375a0cb6f3db844510fdea0', '2015-02-15 20:32:27', 0, '723e4bbd14826c5055695bcb3139d6f77069816f'),
(13, 'vsafas@fdsafa.scom', '07e87d161603bad88c84f40d1bbebd1bb5b192c1', '2015-02-17 21:56:08', 0, '9c463bd854c622126e0b2d3627fb701b2e58e534'),
(14, 'vasile.vasile@gmail.com', '3ea48cfabe664dff8375a0cb6f3db844510fdea0', '2015-02-18 20:52:29', 0, '6737be9aaa74799db78757cdba358a2a9d7b5864'),
(15, 'valihaha@outlook.com', '236f1b22bdc1e3bed56f261354119b091e9f7174', '2015-03-01 09:53:43', 0, 'd87acc20a047aae702e47dcc424bcd932e0c5b0a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocked_ip`
--
ALTER TABLE `blocked_ip`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `songs`
--
ALTER TABLE `songs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `song_playlist`
--
ALTER TABLE `song_playlist`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocked_ip`
--
ALTER TABLE `blocked_ip`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `songs`
--
ALTER TABLE `songs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `song_playlist`
--
ALTER TABLE `song_playlist`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
