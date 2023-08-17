-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2023 at 04:03 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lexis_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  `date_published` datetime DEFAULT NULL,
  `image_file` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `date_published`, `image_file`) VALUES
(29, 'Second Post', 'some content some content', '2023-06-23 20:42:00', 'newlogo.png'),
(30, 'Third Post', 'some content', '2023-06-21 17:44:00', NULL),
(31, 'Article 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam sed mauris accumsan posuere. Vestibulum dapibus vehicula quam, a sagittis lorem consequat et. Nullam ut vulputate urna', '2023-06-19 14:47:00', NULL),
(32, 'Article 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam sed mauris accumsan posuere. Vestibulum dapibus vehicula quam, a sagittis lorem consequat et. Nullam ut vulputate urna', '2023-06-21 14:48:00', NULL),
(33, 'Article 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam sed mauris accumsan posuere. Vestibulum dapibus vehicula quam, a sagittis lorem consequat et. Nullam ut vulputate urna', '2023-06-15 14:48:00', NULL),
(34, 'Article 4', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam sed mauris accumsan posuere. Vestibulum dapibus vehicula quam, a sagittis lorem consequat et. Nullam ut vulputate urna', '2023-06-22 14:48:00', NULL),
(35, 'Article 5', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam sed mauris accumsan posuere. Vestibulum dapibus vehicula quam, a sagittis lorem consequat et. Nullam ut vulputate urna', '2023-06-15 14:48:00', NULL),
(36, 'Article 6', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam sed mauris accumsan posuere. Vestibulum dapibus vehicula quam, a sagittis lorem consequat et. Nullam ut vulputate urna', '2023-06-20 14:49:00', NULL),
(37, 'Article 7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam sed mauris accumsan posuere. Vestibulum dapibus vehicula quam, a sagittis lorem consequat et. Nullam ut vulputate urna', NULL, NULL),
(38, 'Article 8', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam sed mauris accumsan posuere. Vestibulum dapibus vehicula quam, a sagittis lorem consequat et. Nullam ut vulputate urna', '2023-06-20 14:49:00', NULL),
(40, 'Article 10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam sed mauris accumsan posuere. Vestibulum dapibus vehicula quam, a sagittis lorem consequat et. Nullam ut vulputate urna', '2023-06-17 14:50:00', NULL),
(42, 'Article 11', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam sed mauris accumsan posuere. Vestibulum dapibus vehicula quam, a sagittis lorem consequat et. Nullam ut vulputate urna', '2023-06-20 14:51:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `article_category`
--

CREATE TABLE `article_category` (
  `article_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_category`
--

INSERT INTO `article_category` (`article_id`, `category_id`) VALUES
(31, 2),
(33, 3),
(38, 4),
(40, 4);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(3, 'education'),
(1, 'news'),
(4, 'products'),
(2, 'technology');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'lexiscode', '$2y$10$vn04UJ6BSfKJkeSgF60gf.aMvRsRlHz.mOHOE4qmFkSCnhkcg35QK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `article_category`
--
ALTER TABLE `article_category`
  ADD PRIMARY KEY (`article_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `article_category`
--
ALTER TABLE `article_category`
  ADD CONSTRAINT `article_category_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
