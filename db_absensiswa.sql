-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 14, 2023 at 09:49 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_absensiswa`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `id_user`, `nip`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 1, '7472024675850001', '082233445566', 'Bandung', '2023-03-20 21:24:31', '2023-06-13 21:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int NOT NULL,
  `kelas` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `updated_at`, `created_at`) VALUES
(1, 'X-A', '2023-03-21 08:34:41', '2023-03-21 08:34:41'),
(2, 'X-B', '2023-03-21 08:59:54', '2023-03-21 08:59:54');

-- --------------------------------------------------------

--
-- Table structure for table `koordinats`
--

CREATE TABLE `koordinats` (
  `id` bigint UNSIGNED NOT NULL,
  `latitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `koordinats`
--

INSERT INTO `koordinats` (`id`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, '-6.946267', '107.560174', '2023-03-20 21:24:31', '2023-06-14 01:41:43');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` bigint UNSIGNED NOT NULL,
  `id_user` bigint UNSIGNED NOT NULL,
  `nisn` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tahun_masuk` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int NOT NULL,
  `id_tahunajar` int NOT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`id`, `id_user`, `nisn`, `nis`, `tahun_masuk`, `id_kelas`, `id_tahunajar`, `no_hp`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 2, '12345678', '12345678', '2022', 1, 1, '081234567890	', 'Jalan Merdeka No. 1', '2023-04-19 08:14:20', '2023-04-19 08:14:20'),
(2, 3, '23456789', '23456789', '2022', 1, 1, '082345678901	', 'Jalan Merdeka No. 2', '2023-04-19 08:14:20', '2023-04-19 08:14:20'),
(3, 4, '224567802', '2245678', '2022', 1, 1, '081234567890	', 'Jalan Merdeka No. 2', '2023-06-13 21:39:43', '2023-06-13 21:39:43'),
(4, 5, '224567803', '2245679', '2022', 1, 1, '081234567891	', 'Jalan Merdeka No. 3', '2023-06-13 21:39:43', '2023-06-13 21:39:43'),
(5, 6, '224567804', '2245680', '2022', 1, 1, '081234567890	', 'Jalan Merdeka No. 2', '2023-06-13 22:05:11', '2023-06-13 22:05:11'),
(6, 7, '224567805', '2245682', '2022', 1, 1, '081234567891	', 'Jalan Merdeka No. 3', '2023-06-13 22:05:11', '2023-06-13 22:05:11'),
(7, 8, '224567809', '2245690', '2022', 1, 1, '081234567890	', 'Jalan Merdeka No. 2', '2023-06-14 00:29:33', '2023-06-14 00:29:33'),
(8, 9, '224567811', '2245692', '2022', 1, 1, '081234567891	', 'Jalan Merdeka No. 3', '2023-06-14 00:29:33', '2023-06-14 00:29:33'),
(9, 10, '22456790', '2245790', '2022', 1, 1, '081234567890	', 'Jalan Merdeka No. 2', '2023-06-14 02:41:16', '2023-06-14 02:41:16'),
(10, 11, '224567911', '2245780', '2022', 1, 1, '081234567891	', 'Jalan Merdeka No. 3', '2023-06-14 02:41:16', '2023-06-14 02:41:16');

-- --------------------------------------------------------

--
-- Table structure for table `siswa_absensi`
--

CREATE TABLE `siswa_absensi` (
  `id` bigint UNSIGNED NOT NULL,
  `id_siswa` bigint UNSIGNED NOT NULL,
  `id_tahunajar` int NOT NULL,
  `id_kelas` int NOT NULL,
  `tgl` date NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_keluar` time DEFAULT NULL,
  `jam_kerja` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `siswa_absensi`
--

INSERT INTO `siswa_absensi` (`id`, `id_siswa`, `id_tahunajar`, `id_kelas`, `tgl`, `jam_masuk`, `jam_keluar`, `jam_kerja`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 1, '2023-06-14', '15:56:46', NULL, NULL, '2023-06-14 01:56:46', '2023-06-14 01:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `tahunajar`
--

CREATE TABLE `tahunajar` (
  `id` int NOT NULL,
  `tahunajar` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tahunajar`
--

INSERT INTO `tahunajar` (`id`, `tahunajar`, `created_at`, `updated_at`) VALUES
(1, '2023/2024', '2023-06-13 22:42:02', '2023-06-13 22:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `level`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin', 'admin@gmail.com', NULL, 'admin123', NULL, '2023-03-20 21:24:31', '2023-03-20 21:24:31'),
(2, 'John Doe', 'siswa', 'john.doe@example.com', NULL, '12345678', NULL, '2023-04-19 08:14:20', '2023-04-19 08:14:20'),
(3, 'Jane Doe', 'siswa', 'jane.doe@example.com', NULL, '12345678', NULL, '2023-04-19 08:14:20', '2023-04-19 08:14:20'),
(4, 'John Doe5', 'siswa', 'john.doe235@example.com', NULL, 'inipassword', NULL, '2023-06-13 21:39:43', '2023-06-13 21:39:43'),
(5, 'John Doe6', 'siswa', 'john.doe236@example.com', NULL, 'inipassword', NULL, '2023-06-13 21:39:43', '2023-06-13 21:39:43'),
(6, 'John Doe7', 'siswa', 'john.doe237@example.com', NULL, 'inipassword', NULL, '2023-06-13 22:05:11', '2023-06-13 22:05:11'),
(7, 'John Doe8', 'siswa', 'john.doe238@example.com', NULL, 'inipassword', NULL, '2023-06-13 22:05:11', '2023-06-13 22:05:11'),
(8, 'John Doe9', 'siswa', 'john.doe250@example.com', NULL, 'inipassword', NULL, '2023-06-14 00:29:33', '2023-06-14 00:29:33'),
(9, 'John Doe10', 'siswa', 'john.doe252@example.com', NULL, 'inipassword', NULL, '2023-06-14 00:29:33', '2023-06-14 00:29:33'),
(10, 'John Doe12', 'siswa', 'john.doe257@example.com', NULL, 'inipassword', NULL, '2023-06-14 02:41:16', '2023-06-14 02:41:16'),
(11, 'John Doe13', 'siswa', 'john.doe259@example.com', NULL, 'inipassword', NULL, '2023-06-14 02:41:16', '2023-06-14 02:41:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_nip_unique` (`nip`),
  ADD KEY `admins_id_user_foreign` (`id_user`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `koordinats`
--
ALTER TABLE `koordinats`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guru_p_n_s_nip_unique` (`nisn`),
  ADD KEY `guru_p_n_s_id_user_foreign` (`id_user`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_tahunajar` (`id_tahunajar`);

--
-- Indexes for table `siswa_absensi`
--
ALTER TABLE `siswa_absensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `siswa_absens_id_siswa_foreign` (`id_siswa`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_tahunajar` (`id_tahunajar`);

--
-- Indexes for table `tahunajar`
--
ALTER TABLE `tahunajar`
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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `koordinats`
--
ALTER TABLE `koordinats`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `siswa_absensi`
--
ALTER TABLE `siswa_absensi`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tahunajar`
--
ALTER TABLE `tahunajar`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `siswa_ibfk_2` FOREIGN KEY (`id_tahunajar`) REFERENCES `tahunajar` (`id`);

--
-- Constraints for table `siswa_absensi`
--
ALTER TABLE `siswa_absensi`
  ADD CONSTRAINT `siswa_absens_id_siswa_foreign` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `siswa_absensi_ibfk_1` FOREIGN KEY (`id_tahunajar`) REFERENCES `tahunajar` (`id`),
  ADD CONSTRAINT `siswa_absensi_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id`),
  ADD CONSTRAINT `siswa_absensi_ibfk_3` FOREIGN KEY (`id_tahunajar`) REFERENCES `tahunajar` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
