-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 20, 2019 at 02:14 PM
-- Server version: 10.1.37-MariaDB-3
-- PHP Version: 7.2.4-1+b2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SCHEDULER`
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
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2014_10_12_100000_create_password_resets_table', 1),
(33, '2019_03_07_044748_create_tasks_table', 1);

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
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `dependancy_task` int(11) DEFAULT NULL,
  `dependancy_condition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dependancy_days` int(11) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `start_date`, `end_date`, `duration`, `dependancy_task`, `dependancy_condition`, `dependancy_days`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SRS_CREATION', '2019-01-01', NULL, 12, NULL, NULL, NULL, 'description_1', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(2, 'WIREFRAMING', NULL, NULL, 12, 1, 'start', 4, 'description_2', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(3, 'UX_DESIGN', NULL, NULL, 12, 1, 'end', NULL, 'description_3', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(4, 'UI_HTML', NULL, NULL, 12, 3, 'start', 4, 'description_4', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(5, 'ALGORITHM_design', NULL, NULL, 12, 3, 'end', NULL, 'description_5', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(6, 'CONCEPT_SIGNOFF', NULL, NULL, 3, 5, 'end', 4, 'description_6', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(7, 'DATABASE_SCHEMA_DESIGN', NULL, NULL, 12, 1, 'end', NULL, 'description_7', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(8, 'SOFTWARE DESIGN PATTERN FINALIZATION', NULL, NULL, 5, NULL, NULL, NULL, 'description_8', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(9, 'CREATING MODEL REPRESENTATIONS IN DATA MAPPER PATTERN', NULL, NULL, 7, 7, 'start', 4, 'description_9', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(10, 'ROUTING DEFINITIONS', NULL, NULL, 12, 8, 'end', NULL, 'description_10', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(11, 'MODULE DEVELOPMENT', NULL, NULL, 35, 10, 'start', 4, 'description_11', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(12, 'UNIT TEST DEVELOPMENT', NULL, NULL, 35, 12, 'start', NULL, 'description_12', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23'),
(13, 'BUILD CREATION', NULL, NULL, 2, 13, 'end', NULL, 'description_13', 'seed', '2019-03-08 10:57:23', '2019-03-08 10:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
