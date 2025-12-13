-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 08:36 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `properties-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = Admin, 1 = Landlords',
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = Inactive, 1 = Active',
  `address` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `phone`, `role`, `image`, `status`, `address`, `gender`, `dob`, `nid`, `payment_method`, `bank_name`, `branch_name`, `account_name`, `account_number`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@example.com', '1234567890', 0, 'admin/T9IkgxAnk5iIiQzZkY9fAcllM0zNa9EAZKoctlBc.jpg', 1, '123 Admin Street', 'male', '1990-01-01', '123456789', 'Bank', 'Admin Bank', 'Main Branch', 'Admin Account', '9876543210', '2025-07-05 09:01:22', '$2y$12$dyqV6UEZervFEyu0xxxrwedBRr/7Nh81nBnDfsiUQe9bwkfoRk3xy', 'vl0jHa9qd98vinJ48UMuaJBXr22w5KBPIXVcGQVDoTXTz0KboMTPYKCYICbY', '2025-07-05 09:01:22', '2025-10-19 00:45:07'),
(4, 'Emmanuel Josh Velo', 'joshua27emmanuel30@gmail.com', '09123456789', 1, 'admin/TsvqVRL6FbEjsugFxIbMH9kGCbrbcPY4tdwq3r9w.jpg', 1, 'San Vicente', 'male', '2001-12-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$Oi/HfsEhINHvhG.OcPTLG./8nWSM9.sbj8UMmEtN0pKQUjn1wEQCK', NULL, '2025-10-18 23:32:48', '2025-10-20 02:42:40'),
(5, 'ERLIE GOZUM DABU', 'erlie@gmail.com', '09632172649', 1, NULL, 1, NULL, 'female', '1968-07-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$QPEvVB4ToiYy6a9vi37YeO1iUArXZayu6aCj.LTRvSeOzfvMQtMxG', NULL, '2025-10-20 13:35:52', '2025-10-20 13:35:52'),
(6, 'Salcedo Apartment', 'salcedo@gmail.com', '09217243843', 1, NULL, 1, NULL, 'male', '1964-05-14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$p9O.Tjb/Igp.uzhSdp84Y.hG.tiOfZNakM9EOkBPV/3DnzpRz/r2.', NULL, '2025-10-22 06:57:45', '2025-10-22 06:57:45'),
(7, 'GUIAO APARTMENT', 'guiao@gmail.com', '09473202386', 1, NULL, 1, NULL, 'female', '1977-03-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$12$9fSbtN0UjDhyh2c85tkRGenfwrK1ma21Pj2DaBfbNAGn8jiCoHtBC', NULL, '2025-10-22 07:10:29', '2025-10-22 07:10:29');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) DEFAULT NULL,
  `region` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `adults` tinyint(3) UNSIGNED NOT NULL,
  `kids` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `property_id`, `user_id`, `fname`, `lname`, `email`, `phone`, `address`, `country`, `city`, `state`, `region`, `zip_code`, `checkin`, `checkout`, `adults`, `kids`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 'emmanuel josh', 'velo', 'joshua27emmanuel30@gmail.com', '09752162057', 'San Vicente, Pampanga', 'Philippines', 'Lubao', NULL, 'III', '2005', '2025-11-07', '2025-11-08', 2, 0, '2025-11-05 16:11:58', '2025-11-05 16:11:58'),
(2, 2, 2, 'Josh', 'Bilu', 'sadkjsdk@gmail.com', '09893289332', 'sduiwuiw@gmail.com', 'Philippines', 'ksldgsd', NULL, '3', '2001', '2025-11-10', '2025-11-11', 1, 0, '2025-11-06 13:57:18', '2025-11-06 13:57:18'),
(3, 1, 3, 'David', 'Roxas', 'david@gmail.com', '09246810112', 'esem, babo robot, pampanga', 'Philippines', 'babo robot', NULL, 'III', '2002', '2025-11-08', '2025-11-09', 1, 0, '2025-11-06 15:06:28', '2025-11-06 15:06:28'),
(4, 2, 5, 'Kimberly', 'Manalili', 'kim@gmail.com', '09324234234', 'Zone 1 purok 2', 'Philippines', 'Sasmuan', NULL, 'III', '2003', '2025-11-28', '2025-11-29', 1, 0, '2025-11-27 15:32:34', '2025-11-27 15:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('d56b699830e77ba53855679cb1d252da', 'i:1;', 1764286092),
('d56b699830e77ba53855679cb1d252da:timer', 'i:1764286092;', 1764286092);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_06_165606_add_two_factor_columns_to_users_table', 1),
(5, '2024_06_06_165649_create_personal_access_tokens_table', 1),
(6, '2024_06_14_041425_create_admins_table', 1),
(7, '2024_06_14_065511_create_properties_table', 1),
(8, '2024_06_14_085100_create_property_galleries_table', 1),
(9, '2024_06_15_155104_create_bookings_table', 1),
(10, '2024_06_15_164747_create_payments_table', 1),
(11, '2024_06_15_212420_create_user_details_table', 1),
(12, '2024_06_17_182507_create_withdraws_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `amount` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `api_response` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `user_id`, `email`, `payment_method`, `transaction_id`, `currency`, `amount`, `status`, `api_response`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'Stripe', NULL, 'USD', '6000', 'paid', NULL, '2025-11-05 16:11:58', '2025-11-05 16:11:58'),
(2, 2, 2, NULL, 'Stripe', NULL, 'USD', '8000', 'paid', NULL, '2025-11-06 13:57:18', '2025-11-06 13:57:18'),
(3, 3, 3, NULL, 'Stripe', NULL, 'USD', '5000', 'paid', NULL, '2025-11-06 15:06:28', '2025-11-06 15:06:28'),
(4, 4, 5, NULL, 'Stripe', NULL, 'USD', '8000', 'paid', NULL, '2025-11-27 15:32:34', '2025-11-27 15:32:34');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landlord_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 = Inactive, 1 = Active',
  `location` varchar(255) NOT NULL,
  `bedroom` varchar(255) NOT NULL,
  `bathroom` varchar(255) NOT NULL,
  `garage` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = no, 1 = yes',
  `floor` varchar(255) NOT NULL,
  `accommodation` int(11) NOT NULL,
  `pet_friendly` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = no, 1 = yes',
  `type` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `facility` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `landlord_id`, `name`, `description`, `address`, `price`, `status`, `location`, `bedroom`, `bathroom`, `garage`, `floor`, `accommodation`, `pet_friendly`, `type`, `thumbnail`, `facility`, `created_at`, `updated_at`) VALUES
(1, 5, 'GOZUM APARTMENT', 'Late night party is not allowed due to curfew so observe silence', 'SAN JUAN NEPOMUCENO', '5000', 1, 'San Juan Nepomuceno', '2', '2', 1, '2', 2, 0, 'Apartment', 'properties/XmbmbLGciiBYLDnqyZLhwkVg6VrB46K3NDBydrTR.jpg', 'Parking,Restaurant,Free WiFi', '2025-10-20 13:44:22', '2025-10-23 02:47:21'),
(2, 6, 'Salcedo Apartment', 'pet is not allowed since the neighborhood are allergic to animals', 'SAN MIGUEL BETIS', '8000', 1, 'San Miguel', '4', '1', 1, '2', 4, 1, 'Apartment', 'properties/AMTYMDx9PhN99nHG9pAW976xbceiKCGLlWPXQyY8.jpg', 'Parking,Convenience Store,Church,Town Plaza,School', '2025-10-22 07:03:09', '2025-10-22 07:03:09'),
(3, 7, 'GUIAO APARTMENT', 'dsfexwxfwe', 'San Juan Bautista', '6000', 1, 'Bancal', '6', '1', 1, '2', 6, 1, 'Apartment', 'properties/3BV46PCAGq2EErK0o0jnjddFZJMpnd5u4Gtl1rzc.jpg', 'Parking,Aircon,Laundry', '2025-10-22 07:18:56', '2025-11-27 03:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `property_galleries`
--

CREATE TABLE `property_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_galleries`
--

INSERT INTO `property_galleries` (`id`, `property_id`, `image`, `created_at`, `updated_at`) VALUES
(5, 2, 'properties/4VSOlIzXgP9btfMhmRY8CzuWWOxRtZOCM9SXpH2a.jpg', '2025-10-22 07:03:09', '2025-10-22 07:03:09'),
(6, 1, 'gallery/bRHZbGuHmUW7gx4qggrDSjqmW8NQBRWl6uZVv6G3.jpg', '2025-10-23 02:47:21', '2025-10-23 02:47:21'),
(7, 1, 'gallery/4adWEJDO61h6wdrNAFv8jtpUXPtKaYmEzKCGHZxa.jpg', '2025-10-23 02:47:21', '2025-10-23 02:47:21'),
(10, 3, 'gallery/AQf87j29ZUNHHuuIM6kNRKT4m9iYbKP10z70SsYb.jpg', '2025-11-27 03:14:12', '2025-11-27 03:14:12'),
(11, 3, 'gallery/gfy7Ui6P9NecE9OFvqNwQ9RFVVKaGrSeal5cx2Mk.jpg', '2025-11-27 03:14:12', '2025-11-27 03:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FujlBiHcdMRIvOmoCUrbIsetb8r7YHCyTpc1XWBf', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiclQxS1BiSTNLQ0ZvU0ExUnpTRTl6eUJlUGVRdEkxS1B2UXNrNGRydSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9wZXJ0eS8yIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjU7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkUENXWncvZENpTW4zSi9xdGZTY0Z5T0NJZC9BMjdsWk1sdGZEVVRnb0ZlUEpvWTQvWE5DS0siO30=', 1764242101),
('qqv3Ndxsutiak4zFxAdUF9IP3Nxjp1pDHeyWK1Fp', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRndJVllPUGx0OUNoM09nUHZEbVEzc2xDWVUxdEoxWnJTVzVKRE9qWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9ib29rZWQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUyOiJsb2dpbl9hZG1pbl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMiRQQ1dady9kQ2lNbjNKL3F0ZlNjRnlPQ0lkL0EyN2xaTWx0ZkRVVGdvRmVQSm9ZNC9YTkNLSyI7fQ==', 1764286389);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Emmanuel Josh Velo', 'emmanuel@gmail.com', NULL, '$2y$12$fQXhTFxR4fHFTeD3iLhL/.u50kHCp97y6rCH314r67K5EN0OsHGV6', NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-12 01:53:50', '2025-07-12 01:53:50'),
(2, 'Emmanuel Josh Velo', 'josh@gmail.com', NULL, '$2y$12$RVpT7SQcwaHmeLzfG1.MguCgKmWBpHksg6QoS2NDqDMcvLYtK52LG', NULL, NULL, NULL, NULL, NULL, NULL, '2025-10-30 15:41:35', '2025-10-30 15:41:35'),
(3, 'David Roxas', 'david@gmail.com', NULL, '$2y$12$nun0ijk.WoCs3Cf9vgQgieNXCMJyei2Pzk2hkX3mq1HWm4aHk9Y3i', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-06 14:44:22', '2025-11-06 14:44:22'),
(4, 'Aldrich Manansala', 'aldrich@gmail.com', NULL, '$2y$12$Pg5ERyEkkQak7LQ55ARzzOaT/uO/EINWBnjsCOROFvpzTkJX6fQrK', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-10 07:48:11', '2025-11-10 07:48:11'),
(5, 'Kimberly Manalili', 'kim@gmail.com', NULL, '$2y$12$PCWZw/dCiMn3J/qtfScFyOCId/A27lZMltfDUTgoFePJoY4/XNCKK', NULL, NULL, NULL, NULL, NULL, NULL, '2025-11-27 03:07:48', '2025-11-27 03:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `payment_info` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `dob`, `gender`, `civil_status`, `phone`, `address`, `image`, `payment_method`, `payment_info`, `created_at`, `updated_at`) VALUES
(1, 1, '2001-12-27', 'Male', 'Single', '09752162057', 'San Vicente, Lubao, Pampanga', 'users/xeG0AzZgm8f43X0zDvBbdxukTi2FyEyvLYID76b1.png', NULL, NULL, '2025-07-12 02:04:00', '2025-07-13 03:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `landlord_id` bigint(20) UNSIGNED NOT NULL,
  `amount` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 = Pending, 1 = Approved, 2 = Rejected',
  `comment` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_property_id_foreign` (`property_id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_booking_id_foreign` (`booking_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_landlord_id_foreign` (`landlord_id`);

--
-- Indexes for table `property_galleries`
--
ALTER TABLE `property_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_galleries_property_id_foreign` (`property_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraws_landlord_id_foreign` (`landlord_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `property_galleries`
--
ALTER TABLE `property_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_landlord_id_foreign` FOREIGN KEY (`landlord_id`) REFERENCES `admins` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_galleries`
--
ALTER TABLE `property_galleries`
  ADD CONSTRAINT `property_galleries_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD CONSTRAINT `withdraws_landlord_id_foreign` FOREIGN KEY (`landlord_id`) REFERENCES `admins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
