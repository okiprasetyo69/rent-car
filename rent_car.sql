-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 26, 2024 at 10:41 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rent_car`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow_cars`
--

CREATE TABLE `borrow_cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `borrow_cars`
--

INSERT INTO `borrow_cars` (`id`, `user_id`, `car_id`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(3, 6, 1, '2024-01-30', '2024-01-31', '2024-01-25 11:16:15', '2024-01-25 11:16:15');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plat_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_rent` int(11) DEFAULT NULL,
  `is_available` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `brand_name`, `model`, `plat_number`, `price_rent`, `is_available`, `created_at`, `updated_at`) VALUES
(1, 'Honda', 'Jazz', 'D 1234 ABC', 500000, 0, '2024-01-25 08:40:11', '2024-01-25 11:16:15'),
(2, 'Toyota', 'Kijang', 'D 5678 ABC', 400000, 1, '2024-01-25 09:03:21', '2024-01-25 20:26:34'),
(3, 'Mitsubishi', 'Pajero Sport', 'D 91234 ABC', 1000000, 1, '2024-01-25 09:03:58', '2024-01-25 20:26:14'),
(4, 'Suzuki', 'APV', 'D 5673 ABC', 600000, 1, '2024-01-25 09:04:38', '2024-01-25 09:04:38'),
(5, 'Yamaha', 'Centrin', 'Z 1234 ABC', 500000, 1, '2024-01-25 09:05:07', '2024-01-25 20:09:18'),
(6, 'Toyota', 'Mercy', 'B 1234 ABC', 900000, 0, '2024-01-25 09:12:37', '2024-01-25 10:55:44'),
(7, 'Suzuki', 'APV', 'B 1122 ABC', 90000, 0, '2024-01-25 09:16:33', '2024-01-25 09:16:33');

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
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(11, '2014_10_12_000000_create_users_table', 1),
(12, '2014_10_12_100000_create_password_resets_table', 1),
(13, '2019_08_19_000000_create_failed_jobs_table', 1),
(14, '2024_01_25_141057_create_cars_table', 2),
(15, '2024_01_25_162246_create_borrow_cars_table', 3),
(17, '2024_01_25_181757_create_return_cars_table', 4);

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
-- Table structure for table `return_cars`
--

CREATE TABLE `return_cars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `car_id` bigint(20) UNSIGNED DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `total_day_rent` int(11) DEFAULT NULL,
  `total_price_rent` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `return_cars`
--

INSERT INTO `return_cars` (`id`, `user_id`, `car_id`, `return_date`, `total_day_rent`, `total_price_rent`, `created_at`, `updated_at`) VALUES
(4, 7, 5, '2024-01-26', 3, 1500000, '2024-01-25 20:09:18', '2024-01-25 20:09:18'),
(5, 7, 2, '2024-01-26', 10, 4000000, '2024-01-25 20:23:07', '2024-01-25 20:23:07'),
(6, 7, 3, '2024-01-26', 1, 600000, '2024-01-25 20:26:14', '2024-01-25 20:26:14'),
(7, 7, 2, '2024-01-26', 1, 500000, '2024-01-25 20:26:34', '2024-01-25 20:26:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('superadmin','consumer') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `address`, `phone_number`, `license_number`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@test.com', NULL, '081312345678', NULL, 'superadmin', NULL, '$2y$10$VziKwa6oso5K94BA7BwMleX1BOx8fJdXA620fdY3N8JdAbSJsQRZK', NULL, '2024-01-25 03:11:18', '2024-01-25 03:11:18'),
(2, 'Consumer', 'consumer@test.com', NULL, '088912345678', NULL, 'consumer', NULL, '$2y$10$rrjjuCcTE9sSrYmTp9JOjehJ2TQXbPERhoUNxKZXp.ST4rFPaHWRm', NULL, '2024-01-25 03:11:18', '2024-01-25 03:11:18'),
(6, 'Yuni', 'Ayunisri0195@gmail.com', 'Cianjur', '089772345678', '1234ASDF5678', 'consumer', NULL, '$2y$10$Vmf1MeWurzZ3ZMoBiQddb.2vSjDZiga/8MHQUhEo.nt7sebsnMep.', NULL, '2024-01-25 07:07:23', '2024-01-25 07:07:23'),
(7, 'Oki Prasetyo', 'oki.prasetyo45@gmail.com', 'Bandung', '085720542849', 'A11223BCD', 'consumer', NULL, '$2y$10$Vmf1MeWurzZ3ZMoBiQddb.2vSjDZiga/8MHQUhEo.nt7sebsnMep.', NULL, '2024-01-25 09:21:30', '2024-01-25 09:21:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow_cars`
--
ALTER TABLE `borrow_cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `return_cars`
--
ALTER TABLE `return_cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow_cars`
--
ALTER TABLE `borrow_cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `return_cars`
--
ALTER TABLE `return_cars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
