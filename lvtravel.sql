-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2023 at 06:14 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lvtravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coustomerid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total` int(11) NOT NULL,
  `tgroup` int(25) NOT NULL,
  `pnames` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pcontact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_role` int(11) DEFAULT NULL,
  `updated_by_role` int(11) DEFAULT NULL,
  `created_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `del_flag` int(11) NOT NULL DEFAULT 1 COMMENT '0=Delete,1=Not Delete',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 0 COMMENT '0=Failed,1=Pendeing,2=approve,3=complete\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `bid`, `coustomerid`, `total`, `tgroup`, `pnames`, `pcontact`, `created_by_role`, `updated_by_role`, `created_by_ip`, `updated_by_ip`, `del_flag`, `deleted_at`, `created_at`, `updated_at`, `status`) VALUES
(46, 'TV000001', '2', 30000, 1, 'Rudarangshu Biswas', '1234567890', NULL, NULL, '127.0.0.1', NULL, 1, NULL, '2023-04-07 00:46:36', '2023-04-07 00:46:36', 0),
(47, 'TV000002', '2', 16000, 1, 'John Doe', '1234567890', NULL, NULL, '127.0.0.1', NULL, 1, NULL, '2023-04-07 00:51:18', '2023-04-07 03:54:45', 2),
(48, 'TV000003', '70', 10000, 1, 'Salman Khan', '345678876', NULL, NULL, '127.0.0.1', NULL, 1, NULL, '2023-04-07 03:56:22', '2023-04-07 03:56:22', 0),
(49, 'TV000004', '70', 10000, 1, 'Rudarangshu Biswas', '345678876', NULL, NULL, '127.0.0.1', NULL, 1, NULL, '2023-04-07 03:57:42', '2023-04-07 03:57:42', 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bookingid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tourprice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by_role` int(11) DEFAULT NULL,
  `created_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `del_flag` int(11) NOT NULL DEFAULT 1 COMMENT '0=Delete,1=Not Delete',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking_details`
--

INSERT INTO `booking_details` (`id`, `bookingid`, `tourid`, `tourprice`, `updated_by_role`, `created_by_ip`, `updated_by_ip`, `del_flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(44, '46', '4', '30000', NULL, '127.0.0.1', NULL, 1, NULL, '2023-04-07 00:46:36', '2023-04-07 00:46:36'),
(45, '47', '2', '16000', NULL, '127.0.0.1', NULL, 1, NULL, '2023-04-07 00:51:18', '2023-04-07 00:51:18'),
(46, '48', '3', '10000', NULL, '127.0.0.1', NULL, 1, NULL, '2023-04-07 03:56:22', '2023-04-07 03:56:22'),
(47, '49', '3', '10000', NULL, '127.0.0.1', NULL, 1, NULL, '2023-04-07 03:57:42', '2023-04-07 03:57:42');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `catname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catslug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `catimage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by_role` int(11) DEFAULT NULL,
  `updated_by_role` int(11) DEFAULT NULL,
  `created_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `del_flag` int(11) NOT NULL DEFAULT 1 COMMENT '0=Delete,1=Not Delete',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `catname`, `catslug`, `catimage`, `created_by`, `updated_by`, `created_by_role`, `updated_by_role`, `created_by_ip`, `updated_by_ip`, `del_flag`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Couple', 'couple_tour', 'categories/pexels-asad-photo-maldives-1024960_1676904541.jpg', 1, NULL, 1, NULL, '127.0.0.1', NULL, 1, NULL, '2023-02-20 09:19:01', '2023-02-20 09:19:01'),
(2, 'Solo', 'solo_tour', 'categories/pexels-bazil-elias-2612228_1676904558.jpg', 1, NULL, 1, NULL, '127.0.0.1', NULL, 1, NULL, '2023-02-20 09:19:18', '2023-02-20 09:19:18'),
(3, 'Family', 'family_tour', 'categories/pexels-rachel-claire-4825701_1676904573.jpg', 1, NULL, 1, NULL, '127.0.0.1', NULL, 1, NULL, '2023-02-20 09:19:33', '2023-02-20 09:19:33'),
(4, 'Friends', 'friends_tour', 'categories/pexels-sake-le-2101538_1676904615.jpg', 1, NULL, 1, NULL, '127.0.0.1', NULL, 1, NULL, '2023-02-20 09:20:15', '2023-02-20 09:20:15'),
(5, 'Friendssss', 'couple_tour', '', 1, 1, 1, 1, '127.0.0.1', '127.0.0.1', 0, '2023-02-20 10:19:35', '2023-02-20 10:18:36', '2023-02-20 10:19:35'),
(6, 'Ddddd', 'couple', '', 1, 1, 1, 1, '127.0.0.1', '127.0.0.1', 0, '2023-02-20 10:20:01', '2023-02-20 10:19:55', '2023-02-20 10:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `cname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cemail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnumber` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `caddress` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgroup` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by_role` int(11) DEFAULT NULL,
  `updated_by_role` int(11) DEFAULT NULL,
  `created_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `del_flag` int(11) NOT NULL DEFAULT 1 COMMENT '0=Delete,1=Not Delete',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(9, '2023_02_12_085827_create_tours_table', 2),
(10, '2023_02_18_074127_create_categories_table', 3),
(13, '2014_10_12_000000_create_users_table', 4),
(14, '2014_10_12_100000_create_password_resets_table', 4),
(15, '2019_08_19_000000_create_failed_jobs_table', 4),
(16, '2019_12_14_000001_create_personal_access_tokens_table', 4),
(17, '2023_02_17_170947_create_tours_table', 5),
(18, '2023_02_18_141158_create_categories_table', 5),
(19, '2023_03_03_152919_create_customers_table', 6),
(20, '2023_03_13_132945_create_bookings_table', 7),
(21, '2023_03_13_134002_create_customers_table', 8),
(22, '2023_03_13_134343_create_booking_details_table', 9),
(23, '2023_03_26_051353_create_payment_models_table', 10),
(24, '2023_03_26_051353_create_payments_table', 11);

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `orderid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `orderid`, `payid`, `entity`, `amount`, `currency`, `status`, `created_by`, `created_by_ip`, `created_at`, `updated_at`) VALUES
(21, 'TV000002', 'pay_LanhSk9XcJvEnS', 'payment', '16000', 'INR', 'authorized', '2', '127.0.0.1', '2023-04-07 00:51:41', '2023-04-07 00:51:41');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` int(11) NOT NULL,
  `tour_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_start` date NOT NULL,
  `tour_duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_group` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tour_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=Active,2=Inactive',
  `del_flag` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=Delete,1=Not Delete',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_by_role` int(11) DEFAULT NULL,
  `updated_by_role` int(11) DEFAULT NULL,
  `created_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by_ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `cat_id`, `tour_name`, `tour_price`, `tour_start`, `tour_duration`, `tour_image`, `tour_group`, `tour_place`, `tour_description`, `tour_status`, `del_flag`, `created_by`, `updated_by`, `created_by_role`, `updated_by_role`, `created_by_ip`, `updated_by_ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'Travelling With Friends', '20000', '2023-05-16', '5', 'tours/thailand_1676971341.jpg', '12', 'Thailand', 'Superb!!!!!', '1', '1', 1, 1, 1, 1, '127.0.0.1', '127.0.0.1', '2023-02-20 11:24:20', '2023-03-10 21:31:41', '2023-02-20 23:53:10'),
(2, 3, 'Travelling With Family', '16000', '2023-07-13', '4', 'tours/paris_1676912506.jpg', '5', 'Paris', 'Awesome!!!', '1', '1', 1, 1, 1, 1, '127.0.0.1', NULL, '2023-02-20 11:31:46', '2023-03-10 21:31:19', NULL),
(3, 2, 'Travelling Alone', '10000', '2023-04-28', '3', 'tours/bankok_1676912766.jpg', '10', 'Bankok', 'Only You!', '1', '1', 1, 1, 1, 1, '127.0.0.1', NULL, '2023-02-20 11:36:06', '2023-03-10 21:31:01', NULL),
(4, 1, 'Behold Adventure', '30000', '2023-04-20', '4', 'tours/maldives_1676912881.jpg', '5', 'Maldives', 'Enjoy Your Trip!', '1', '1', 1, 1, 1, 1, '127.0.0.1', NULL, '2023-02-20 11:38:01', '2023-02-25 08:17:25', NULL),
(5, 3, 'Travelling To Heaven', '20000', '2023-04-13', '3', 'tours/Julian Alps_1676992662.jpg', '6', 'Julian Alps', 'Best Tour in this Price!!!!', '1', '1', NULL, 1, NULL, 1, NULL, NULL, '2023-02-21 03:37:51', '2023-03-10 21:30:23', NULL),
(6, 2, 'The Real Adventure Co.', '10000', '2023-04-13', '5', 'tours/london_1676970951.jpg', '5', 'London', 'Find Your Way!!', '1', '1', NULL, 1, NULL, 1, NULL, NULL, '2023-02-21 03:38:40', '2023-03-10 21:29:54', NULL),
(8, 2, 'Dream Place', '2000', '2023-03-30', '4', 'tours/il-vagabiondo-8eNt0CQamB0-unsplash_1678715567.jpg', '12', 'Dubai', 'Best', '1', '1', 1, NULL, 1, NULL, '127.0.0.1', NULL, '2023-03-13 08:22:47', '2023-03-13 08:22:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `baseid` int(25) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` int(25) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '2' COMMENT '1=Admin, 2=Customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0=Inactive, 1=Active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `baseid`, `name`, `email`, `profile`, `contact`, `address`, `role`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admins', 'admin@gmail.com', 'profile/c_1676904348.jpg', NULL, NULL, '1', NULL, '$2y$10$ijfYi4fQKqlKVFDXYc0L3.z406gXlp5iA5Tc2Kzh5M4.hc7d8xgbG', '1', NULL, '2023-02-20 09:14:47', '2023-02-20 09:14:47'),
(2, NULL, 'Rudrangshu Biswas', 'rudrabsws23@gmail.com', NULL, 2147483647, 'Kolkata', '2', NULL, '$2y$10$hvRfQ3u2dh9vhFRe3eIBl.Jp877U640pt.TU.LnbnrbQ60SQdufXO', '1', NULL, '2023-02-25 21:20:25', '2023-04-07 00:51:18'),
(70, NULL, 'John Doe', 'sunnydeolyo@gmail.com', NULL, 345678876, 'Kolkata', '2', NULL, '$2y$10$yRY1XcFtoyhMJwd3CLKTcuB97iwunQovZAry50pH3s7piKo0k8XT6', '1', NULL, '2023-04-07 03:55:27', '2023-04-07 03:57:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
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
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
