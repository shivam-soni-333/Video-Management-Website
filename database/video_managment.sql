-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2023 at 05:57 PM
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
-- Database: `video_managment`
--

-- --------------------------------------------------------

--
-- Table structure for table `base_folder`
--

CREATE TABLE `base_folder` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `folder_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `base_folder`
--

INSERT INTO `base_folder` (`id`, `user_id`, `folder_name`) VALUES
(1, 16, 'test_123_16'),
(2, 17, 'kartik_17_17'),
(3, 18, 'the_premsoni_18'),
(4, 19, 'shiv_123_19');

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `id` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `process`
--

INSERT INTO `process` (`id`, `vid`, `status`, `timestamp`) VALUES
(14, 5, 'done', '2023-02-24 05:04:40'),
(15, 6, 'done', '2023-02-24 05:04:40'),
(16, 7, 'done', '2023-02-24 05:04:40'),
(17, 8, 'done', '2023-02-24 05:04:40'),
(18, 9, 'done', '2023-02-24 05:04:40'),
(19, 10, 'done', '2023-02-24 05:04:40'),
(20, 11, 'converting', '2023-02-24 05:04:40'),
(21, 12, 'done', '2023-02-24 05:04:40'),
(22, 13, 'done', '2023-02-24 08:00:32'),
(23, 14, 'done', '2023-02-24 08:01:22'),
(24, 15, 'done', '2023-02-24 08:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sessionid` varchar(100) NOT NULL,
  `expire` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `sessionid`, `expire`, `timestamp`) VALUES
(15, 17, '5c8032eb2d332ca9bb2c6ecf5bcad6bd', '-1', '2023-02-24 05:05:22'),
(16, 14, '4c7b8a3067087d3c3c16de5c607e24f2', '-1', '2023-02-24 05:05:22'),
(17, 16, '4a974a1340ce23f0ef549aeeb4ea042b', '1677047874', '2023-02-24 05:05:22'),
(18, 17, '209caa82b96b1b467af771eca4125472', '1677077634', '2023-02-24 05:05:22'),
(19, 17, 'f479132c748ba9aa2155f65a08a860c8', '-1', '2023-02-24 05:05:22'),
(20, 14, 'd4dd7fd93614f74112b012485ab721b5', '-1', '2023-02-24 05:05:22'),
(21, 16, '186d55b69607bc7754ee3c77bb417159', '1677094403', '2023-02-24 05:05:22'),
(22, 17, '1e5ecbebc9fcaf34229c0f405773b060', '1677097600', '2023-02-24 05:05:22'),
(23, 17, '51881e2f04cb4323857bb53dd1cca18c', '1677131339', '2023-02-24 05:05:22'),
(24, 18, '1e35e45e352756d115ef1bef9d4c19a8', '-1', '2023-02-24 05:05:22'),
(25, 18, 'dd51dd24e2d1506a2991272a666c8a82', '1677156752', '2023-02-24 05:05:22'),
(26, 17, '678dcf7fa38a423d588f61ed0204322b', '1677218367', '2023-02-24 05:05:22'),
(27, 19, '7c3d7a5571a8aeaba71ecd1fafaf2ea0', '-1', '2023-02-24 08:09:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  `username` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `username`, `timestamp`) VALUES
(14, 'shivam soni', 'shivam_soni_333', 'shivam', 'admin', 'shivam_soni_333', '2023-02-24 05:04:08'),
(16, 'test', 'test@tet.com', '1234', 'user', 'test_123', '2023-02-24 05:04:08'),
(17, 'kartik', 'kartik@gm.com', '1234', 'user', 'kartik_17', '2023-02-24 05:04:08'),
(18, 'prem soni', 'prem@test.com', '1234', 'user', 'the_premsoni', '2023-02-24 05:04:08'),
(19, 'shivam soni', 'shiv@shiv.com', '1234', 'user', 'shiv_123', '2023-02-24 07:58:12');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `thumbnail_nm` varchar(100) NOT NULL,
  `gif_nm` varchar(100) NOT NULL,
  `video_nm` varchar(100) NOT NULL,
  `is_converted` int(11) NOT NULL,
  `is_watermarked` int(11) NOT NULL DEFAULT 0,
  `watermark_text` varchar(50) NOT NULL,
  `watermark_video_nm` varchar(100) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `title`, `user_id`, `folder_id`, `thumbnail_nm`, `gif_nm`, `video_nm`, `is_converted`, `is_watermarked`, `watermark_text`, `watermark_video_nm`, `timestamp`) VALUES
(5, 'test', 16, 1, './default_thumbnail.jpg', '16_test_123_video_1677048291.gif', '16_test_123_video_1677048291.mp4', 1, 0, '', '', '2023-02-24 05:03:23'),
(6, 'kartik&#039;s video', 17, 2, './default_thumbnail.jpg', '17_kartik_17_video_1677074055.gif', '17_kartik_17_video_1677074055.mp4', 1, 0, 'kartik\'s watermark', './uploads/video/kartik_17_17/17_kartik_17_video_1677074055_watermarked_1677223817.mp4', '2023-02-24 07:39:37'),
(7, 'this is second tes', 17, 2, './default_thumbnail.jpg', '17_kartik_17_video_1677084698.gif', '17_kartik_17_video_1677084698.mp4', 1, 0, 'this is watermark', './uploads/video/kartik_17_17/17_kartik_17_video_1677084698_watermarked_1677223967.mp4', '2023-02-24 07:39:40'),
(8, 'tsdfsf', 17, 2, './default_thumbnail.jpg', '17_kartik_17_video_1677088511.gif', '17_kartik_17_video_1677088511.mp4', 1, 0, 'sdf', './uploads/video/kartik_17_17/17_kartik_17_video_1677088511_watermarked_1677224115.mp4', '2023-02-24 07:39:42'),
(9, 'adsakd', 16, 1, './default_thumbnail.jpg', '16_test_123_video_1677090814.gif', '16_test_123_video_1677090814.mp4', 1, 0, '', '', '2023-02-24 05:03:23'),
(10, 'tes', 17, 2, './default_thumbnail.jpg', '17_kartik_17_video_1677090817.gif', '17_kartik_17_video_1677090817.mp4', 1, 0, 'watermark watermark watermark ', './uploads/video/kartik_17_17/17_kartik_17_video_1677090817_watermarked_1677224001.mp4', '2023-02-24 07:39:44'),
(11, 'Chup Chup Ke', 18, 3, 'Screenshot (156).png', '18_the_premsoni_video_1677151217.gif', '18_the_premsoni_video_1677151217.mp4', 1, 0, '', '', '2023-02-24 08:01:33'),
(12, 'test', 18, 3, 'Screenshot (156).png', '18_the_premsoni_video_1677152633.gif', '18_the_premsoni_video_1677152633.mp4', 1, 0, '', '', '2023-02-24 05:03:23'),
(13, 'this is my video new 24/2/23', 19, 4, 'Work Hard.png', '19_shiv_123_video_1677225546.gif', '19_shiv_123_video_1677225546.mp4', 1, 1, 'this is my watermark shiv_123', './uploads/video/shiv_123_19/19_shiv_123_video_1677225546_watermarked_1677225750.mp4', '2023-02-24 08:02:34'),
(14, 'ttt2', 19, 4, './default_thumbnail.jpg', '19_shiv_123_video_1677225654.gif', '19_shiv_123_video_1677225654.mp4', 1, 1, 't222', './uploads/video/shiv_123_19/19_shiv_123_video_1677225654_watermarked_1677225778.mp4', '2023-02-24 08:03:54'),
(15, 'adasd', 19, 4, './default_thumbnail.jpg', '19_shiv_123_video_1677225841.gif', '19_shiv_123_video_1677225841.mp4', 1, 0, '', '', '2023-02-24 08:06:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `base_folder`
--
ALTER TABLE `base_folder`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `base_folder`
--
ALTER TABLE `base_folder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
