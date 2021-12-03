-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2021 at 04:31 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_v_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message`, `image`, `seen`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'hi', NULL, 0, NULL, NULL),
(2, 2, 1, 'hlw', NULL, 0, NULL, NULL),
(3, 1, 5, 'whats up', NULL, 1, NULL, '2021-03-08 07:17:47'),
(4, 4, 1, 'jhihihi', 'image_gallery/2021011605254248.jpg', 1, '2021-01-15 23:25:43', '2021-03-08 10:08:13'),
(9, 2, 1, 'fdgdg', NULL, 0, '2021-03-03 06:30:07', '2021-03-03 06:30:07'),
(10, 2, 1, 'dfgfdgfdg', NULL, 0, '2021-03-03 06:43:45', '2021-03-03 06:43:45'),
(11, 4, 1, 'sdfsf', NULL, 1, '2021-03-03 06:49:14', '2021-03-08 10:08:13'),
(13, 5, 1, 'jaru sewnd', NULL, 1, '2021-03-08 06:34:23', '2021-03-08 07:17:47'),
(14, 1, 5, 'ki', NULL, 1, '2021-03-08 06:39:09', '2021-03-08 07:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2020_12_30_062419_create_menus_table', 2),
(10, '2021_01_14_124333_create_diseases_table', 3),
(11, '2021_01_14_124530_create_treatments_table', 3),
(12, '2021_01_15_185647_create_messages_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `title` tinytext DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `description`, `image`, `created_at`, `updated_at`) VALUES
(1, 2, 'back pain', 'ftghf htrhg h dghdghghg', NULL, '2021-09-13 03:16:42', '2021-09-13 03:16:42'),
(2, 1, 'fffff', 'fdf  df df dfd', NULL, '2021-09-20 12:48:35', '2021-09-20 12:48:35'),
(3, 1, 'hhhh', 'hhhhh', NULL, '2021-12-03 14:45:12', '2021-12-03 14:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `doctor` tinyint(4) NOT NULL DEFAULT 0,
  `approve` tinyint(4) NOT NULL DEFAULT 0,
  `reg_no` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone_no`, `email_verified_at`, `image`, `password`, `admin`, `doctor`, `approve`, `reg_no`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '01234567891', NULL, NULL, '$2y$10$A/SOfeJc0Hs34678h3WpRe9zmYkFTnNZ6nHLoPq2H3Ez8e5Avyf2e', 1, 0, 0, NULL, NULL, '2020-12-30 07:31:44', '2020-12-30 07:31:44'),
(2, 'hi2', 'dd@gmail.com', '01234568433', NULL, NULL, '$2y$10$vuziTmKJM/y3UpdLELGASeZGLW2AgCesMtVnT1wgTEH7.7BmoSjne', 0, 1, 1, NULL, NULL, '2020-12-29 23:59:13', '2021-12-03 14:27:27'),
(4, 'Hassan ', 'zahidhassanshaikot1@gmail.com', '12345678913', NULL, NULL, '$2y$10$NdfJjXKSERfL5wFVT.lR6.kOtiIXUVdIs0qMAilikz3bf3pMSOgsq', 0, 0, 0, NULL, NULL, '2021-02-08 23:42:57', '2021-02-08 23:42:57'),
(5, 'Raju', 'admin23@admin.com', '12345678916', NULL, NULL, '$2y$10$Klk/4SXkqugUXB61x5ol7ejHBgoA34evK./6H.SfkbdCBOvzLJpSu', 0, 1, 1, NULL, NULL, '2021-02-09 05:30:05', '2021-10-03 17:30:15'),
(6, 'zagid', 'admin3@admin.com', '12345678914', NULL, NULL, '$2y$10$ikG3gOYwGc01ZTpKlZD0h.BqUHf2YgAHOrS8s.grZnevqSSg1bBYK', 0, 0, 0, NULL, NULL, '2021-03-16 04:07:12', '2021-03-16 04:07:12'),
(7, 'dddd', 'addd@gmail.com', '12345678915', NULL, NULL, '$2y$10$hxWpu580TPnr5XPYijEaseRtNER0KUij8RrBnE5ZVg9g1WoWCQ9tS', 0, 0, 0, NULL, NULL, '2021-09-13 04:38:08', '2021-09-13 04:38:08'),
(9, 'dddd', 'addd@gmail.com', '01234561891', NULL, NULL, '$2y$10$o73xSnOXR/xcBJRkcAJkze06Vp8.1VKXdfBRbxYIXb/jcj.hbz5Yi', 0, 1, 0, 545, NULL, '2021-09-20 05:40:55', '2021-09-20 05:40:55'),
(10, 'dddd', 'a@gmail.com', '01738525638', NULL, NULL, '$2y$10$I1T6bMMNrhninJnoul/u../NIWFtpHNtFEXoPCIVrfSzZnl9ZgLqO', 0, 1, 0, 545, NULL, '2021-10-20 03:10:07', '2021-10-20 03:10:07'),
(11, 'dddd', 'a@gmail.com', '01738525637', NULL, NULL, '$2y$10$teKsIUcLl6PDCuXM4S8q4.3/bAHF4aVXu/4NYp43FJ5b148qeKWua', 0, 0, 0, 545, NULL, '2021-10-20 03:11:55', '2021-10-20 03:11:55'),
(12, 'dddd', 'a@gmail.com', '01738525636', NULL, NULL, '$2y$10$.fd0L6L0okwoEvfyFngu1OhRCTnOSaMgWbadZ0jU6J9ZVaU4l.uX6', 0, 0, 0, 545, NULL, '2021-10-20 03:17:18', '2021-10-20 03:17:18'),
(13, 'Soyeb', 'a1@gmail.com', '01738525630', NULL, NULL, '$2y$10$5ihZmP2mZRPP4nwWZ1G1kOymtHntQSrjM3u8sqLc/iLf/nRwAGm0i', 0, 1, 1, 5455, NULL, '2021-10-20 07:19:45', '2021-10-20 10:36:10'),
(14, 'Soyeb', 'a1@gmail.com', '01738525631', NULL, NULL, '$2y$10$Fo72uJgb7ggPNFWzpEwd6ufLjde0YQIjwgBQLdrs9jlh1JX.61mMy', 0, 0, 0, NULL, NULL, '2021-10-23 13:58:31', '2021-10-23 13:58:31'),
(15, 'Soyeb', 'a1@gmail.com', '01738525621', NULL, NULL, '$2y$10$7S4Kpe468lQ7NsaydkiHe.R76MBDqRZmtnYpl4q2q54DFminSNa/K', 0, 0, 0, NULL, NULL, '2021-10-23 13:58:57', '2021-10-23 13:58:57'),
(16, 'dddd', 'addd@gmail.com', '01738525600', NULL, NULL, '$2y$10$FP1Ozxi0K4vYVxWTPdnxRu/VbxcDQfB1Rs/zGplhLvqLIl6yijjpq', 0, 1, 1, 545, NULL, '2021-11-05 08:13:16', '2021-11-05 08:14:30'),
(17, 'dddd', 'addd@gmail.com', '01738525601', NULL, NULL, '$2y$10$Hu4vlwdwKZUfAXrK8PvFOejRFnYBRYuW9I46vf9OYsarJbxIduiRe', 0, 1, 0, 545, NULL, '2021-11-05 08:20:08', '2021-11-05 08:20:08'),
(18, 'dddd', 'addd@gmail.com', '01738525602', NULL, NULL, '$2y$10$6bTj2mbp.AeliQ2VUShWgukeKyDL/9HpIZ9mHZSh9lC3MdQ4GtSIq', 0, 1, 0, NULL, NULL, '2021-11-05 08:36:52', '2021-11-05 08:36:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_sender_id_foreign` (`sender_id`),
  ADD KEY `messages_receiver_id_foreign` (`receiver_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
