-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2019 at 08:58 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.3.10-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stock_db`
--

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
(2, '2014_10_12_100000_create_password_resets_table', 1);

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `active`, `create_at`) VALUES
(1, 'root level', 1, '2019-10-18 16:30:11'),
(2, 'administrator', 1, '2019-10-18 16:30:11'),
(3, 'Receptionist', 1, '2019-10-23 16:40:00'),
(5, 'Bookeeper', 1, '2019-10-23 16:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.png',
  `role_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `photo`, `role_id`, `remember_token`, `created_at`, `updated_at`, `active`) VALUES
(1, 'administrator', 'admin', 'admin@gmail.com', NULL, '$2y$10$cNJjIJDsIvXfxlrHOY2GfecwigRxqB/Br1sOVJj0VknEOJTs046ZO', 'images/images/user.png', 2, NULL, NULL, NULL, 1),
(2, 'buntheoun sok', 'buntheoun', 'buntheounsok@gmail.com', NULL, '$2y$10$cNJjIJDsIvXfxlrHOY2GfecwigRxqB/Br1sOVJj0VknEOJTs046ZO', 'default.png', 1, NULL, NULL, NULL, 1),
(3, 'dara', 'dara1', 'dara1@mystocks.in', NULL, '$2y$10$CRh5zR3MzunmomfNzkd9P.OZ5nwAfuQWnPiMT4jwoVhKrdI85Plk2', 'uploads/users/mFi7X4QMySE6zni5CwZRgihLWqUQBMkAcfhANn4F.png', 1, NULL, NULL, NULL, 0),
(4, 'sok', 'sok123', 'sok@gmail.com', NULL, '$2y$10$YN5XmhJGw/7Av2e829igBux3hyPKhfagzmZRgXcEwdVtKHteGab/u', 'uploads/users/5QfapvWqyg2NNYe8mIDV77X4erpekoMqnIsuhtjN.png', 1, NULL, NULL, NULL, 0),
(5, 'kheng Sok', 'kheng12', 'sokkheng12@gmail.com', NULL, '$2y$10$P/9fLqbywx8k0bAznX9Ipuxo7Rd22t6X0pPAKVdCZRck/aJP2NXam', 'uploads/users/64yY6HPnWrmLkr0LwYfqnuaxOS50Kv8wjt8bv7I4.png', 1, NULL, NULL, NULL, 1),
(6, 'Ly Neng', 'neng123', 'lyneng@mystocks.in', NULL, '$2y$10$qr7mwTw5KMoX3fiv2OEGqOcN4kWNE34PsjhmSpLDOM8sN0s8JdO5S', 'uploads/users/2N3kRD1JccGXJW56cpiH8G7kgPnLR7he93lPhJIN.png', 1, NULL, NULL, NULL, 1),
(7, 'Mora Ny', 'mora', 'mora@gmail.com', NULL, '$2y$10$PEZY0x5cqw0QvISKWhjlt.dfjdOSKTJ6DICUGbaYM19jjxjrpotMy', 'uploads/users/MipSjGoTbAbeGlXFxeJvIk7lGw1GojIJjRqIpw1l.jpeg', 1, NULL, NULL, NULL, 1),
(8, 'Deng mong', 'dengM12', 'dengmong12@gmail.com', NULL, '$2y$10$TEWjDd/gK0GXPDYkz69nNefcRJojnRdtPhSoSYpq7j1qWdN9DNv.q', 'uploads/users/zamxobcEiEIRuUItB4pXy4DwQaYZi1ouIxlwTSYu.png', 1, NULL, NULL, NULL, 1),
(9, 'sokbuntheoun vai', 'ffffffff', 'buntheoun.developer27@gmail.com', NULL, '$2y$10$AR5AMvVBpRE2zmszKSfsguItNakp1mDU9/KogqHhaPMzD0epqXtyK', 'uploads/users/ZjtZpF5de5zo9zfcmZTr4OepUzIpsHRVExR4Y7pQ.jpeg', 2, NULL, NULL, NULL, 0),
(11, 'sokbuntheoun vai', 'admin123', 'buntheoun.developer123@gmail.com', NULL, '$2y$10$KvtMTzv36MA4VXK46RNsFuzRgo3fvPW9L78IbqEleK23IB5ZTRQhC', 'uploads/users/ZOxE8ittfTb877iM5EvhIjsJlLDuM7bLGCFw1UTE.jpeg', 2, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
