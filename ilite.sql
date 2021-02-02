-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2021 at 03:16 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ilite`
--

-- --------------------------------------------------------

--
-- Table structure for table `ilite_meta`
--

CREATE TABLE `ilite_meta` (
  `id` bigint(20) NOT NULL,
  `meta_type` varchar(255) NOT NULL,
  `meta_target_id` bigint(20) NOT NULL,
  `meta_name` varchar(255) NOT NULL,
  `meta_value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ilite_options`
--

CREATE TABLE `ilite_options` (
  `id` bigint(20) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `option_value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ilite_options`
--

INSERT INTO `ilite_options` (`id`, `option_name`, `option_value`) VALUES
(1, 'siteTitle', 'iLite - PHP Framework by Penobit'),
(2, 'language', 'en'),
(4, 'template', 'iLite');

-- --------------------------------------------------------

--
-- Table structure for table `ilite_posts`
--

CREATE TABLE `ilite_posts` (
  `id` bigint(20) NOT NULL,
  `post_type` varchar(255) NOT NULL DEFAULT 'article',
  `post_slug` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` bigint(20) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_modified` datetime DEFAULT NULL,
  `post_excerpt` mediumtext NOT NULL,
  `post_content` longtext NOT NULL,
  `post_photo` text DEFAULT NULL,
  `post_guid` varchar(255) NOT NULL,
  `post_category` bigint(20) DEFAULT NULL,
  `post_mimetype` varchar(255) NOT NULL DEFAULT 'text/html',
  `post_password` longtext DEFAULT NULL,
  `comments_count` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ilite_posts`
--

INSERT INTO `ilite_posts` (`id`, `post_type`, `post_slug`, `post_status`, `post_title`, `post_author`, `post_date`, `post_modified`, `post_excerpt`, `post_content`, `post_photo`, `post_guid`, `post_category`, `post_mimetype`, `post_password`, `comments_count`) VALUES
(1, 'article', 'hello-world', 'publish', 'Hello world!', 1, '2021-01-17 22:34:19', '2021-01-17 21:52:20', 'This is your first post on iLite, you can edit, delete or archive it from your admin panel.', '<h1>Hello world</h1>\r\n<p>This is your first post on iLite, you can edit, delete or archive it from your admin panel.</p>', '', '', NULL, 'text/html', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ilite_users`
--

CREATE TABLE `ilite_users` (
  `id` bigint(20) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_password` longtext NOT NULL,
  `user_fullname` mediumtext NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_mail` varchar(255) NOT NULL,
  `user_lastlogin` datetime NOT NULL,
  `user_registration_date` datetime NOT NULL,
  `user_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ilite_users`
--

INSERT INTO `ilite_users` (`id`, `user_username`, `user_password`, `user_fullname`, `user_phone`, `user_mail`, `user_lastlogin`, `user_registration_date`, `user_status`) VALUES
(1, 'admin', '$2y$10$sQ0Q.nfc2nMYPp2YJX8P.eTrLNqbyr2Eseks90D8xNgFIIv01z95u', 'R8 inFamous', '09024005345', 'info@ilite.ir', '2021-01-28 00:00:00', '2021-01-28 00:00:00', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ilite_meta`
--
ALTER TABLE `ilite_meta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ilite_options`
--
ALTER TABLE `ilite_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ilite_posts`
--
ALTER TABLE `ilite_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_slug` (`post_slug`),
  ADD KEY `post_slug_2` (`post_slug`),
  ADD KEY `post_type` (`post_type`),
  ADD KEY `post_author` (`post_author`);

--
-- Indexes for table `ilite_users`
--
ALTER TABLE `ilite_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ilite_meta`
--
ALTER TABLE `ilite_meta`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ilite_options`
--
ALTER TABLE `ilite_options`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ilite_posts`
--
ALTER TABLE `ilite_posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ilite_users`
--
ALTER TABLE `ilite_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
