-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2025 at 03:43 AM
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
-- Database: `pembayaran-pln`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'admin@gmail.com', NULL, '$2y$12$3Ne/wz6Z79MsGIPY6xuP4.nbdZvG.44leGLEK6N.KgK1mt8dQBzKy', 'xueDsECxaHXehTAgNAxjGQLmP5U4Kw9BilHxhszkQAGWfd6SlEkE9XltyGeF', '2025-02-19 18:29:40', '2025-03-13 20:03:42');

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
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3', 'i:1;', 1742055530),
('livewire-rate-limiter:a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1742055530;', 1742055530);

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
-- Table structure for table `daftar_tagihans`
--

CREATE TABLE `daftar_tagihans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idpel` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `nomor_meter` varchar(255) NOT NULL,
  `bulan_tagihan` date NOT NULL,
  `pemakaian_kwh` int(11) NOT NULL,
  `tarif_per_kwh` decimal(10,2) NOT NULL,
  `total_tagihan` decimal(15,2) NOT NULL,
  `status_pembayaran` enum('Belum','Lunas') NOT NULL DEFAULT 'Belum',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `daftar_tagihans`
--

INSERT INTO `daftar_tagihans` (`id`, `idpel`, `nama_pelanggan`, `nomor_meter`, `bulan_tagihan`, `pemakaian_kwh`, `tarif_per_kwh`, `total_tagihan`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(2, '100764322700', 'ZELIKA SHERIL AMILLAH SALSABILA', '4658009', '2025-03-01', 303, 2000.00, 611000.00, 'Lunas', '2025-03-02 21:27:22', '2025-03-13 08:07:03');

-- --------------------------------------------------------

--
-- Table structure for table `data_pelanggans`
--

CREATE TABLE `data_pelanggans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idpel` varchar(12) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `nomor_meter` varchar(15) NOT NULL,
  `daya` int(11) NOT NULL,
  `jenis_meteran` enum('Prabayar','Pascabayar') NOT NULL,
  `jenis_tarif` varchar(10) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `data_pelanggans`
--

INSERT INTO `data_pelanggans` (`id`, `idpel`, `nama`, `alamat`, `no_telepon`, `email`, `nomor_meter`, `daya`, `jenis_meteran`, `jenis_tarif`, `nik`, `created_at`, `updated_at`) VALUES
(2, '100764322700', 'ZELIKA SHERIL AMILLAH SALSABILA', 'Desa Kedungsegog RT09/RW04', '082313817169', 'zelikasas@gmail.com', '4658009', 1500, 'Pascabayar', 'B1', '3325703208020002', '2025-02-19 20:41:35', '2025-02-19 20:41:35');

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
-- Table structure for table `konsultasis`
--

CREATE TABLE `konsultasis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `konsultasis`
--

INSERT INTO `konsultasis` (`id`, `nama`, `email`, `pesan`, `created_at`, `updated_at`) VALUES
(1, 'Zelika Sheril', 'zelikasas@gmail.com', 'Listrik Padam', '2025-03-17 19:42:08', '2025-03-17 19:42:08');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_pembayaran`
--

CREATE TABLE `laporan_pembayaran` (
  `no_ref` varchar(255) NOT NULL,
  `idpel` varchar(255) NOT NULL,
  `id_pelanggan` bigint(20) UNSIGNED NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL,
  `jumlah_bayar` decimal(10,2) NOT NULL,
  `biaya_admin` decimal(10,2) NOT NULL,
  `total_akhir` decimal(10,2) NOT NULL,
  `status_pembayaran` enum('LUNAS','BELUM LUNAS') NOT NULL DEFAULT 'LUNAS',
  `jenis_pembayaran` enum('PRABAYAR','PASCABAYAR') NOT NULL,
  `token` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dibayar_oleh` bigint(20) UNSIGNED DEFAULT NULL,
  `nama_pembayar` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_hidden` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporan_pembayaran`
--

INSERT INTO `laporan_pembayaran` (`no_ref`, `idpel`, `id_pelanggan`, `nama_pelanggan`, `jumlah_bayar`, `biaya_admin`, `total_akhir`, `status_pembayaran`, `jenis_pembayaran`, `token`, `created_at`, `updated_at`, `dibayar_oleh`, `nama_pembayar`, `deleted_at`, `is_hidden`) VALUES
('REF-OLDVPQIR1W', '100764322700', 2, 'ZELIKA SHERIL AMILLAH SALSABILA', 611000.00, 5000.00, 616000.00, 'LUNAS', 'PRABAYAR', NULL, '2025-03-13 08:07:03', '2025-03-13 08:07:03', 1, 'ZELIKA SHERIL AMILLAH SALSABILA', NULL, 0);

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
(1, '0001_01_01_000000_create_admins_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_02_17_015024_create_users_table', 1),
(5, '2025_02_19_012148_create_data_pelanggans_table', 1),
(11, '2025_02_19_142224_create_tarif_listriks_table', 2),
(12, '2025_02_24_035841_create_daftar_tagihans_table', 3),
(13, '2025_02_20_025239_add_saldo_to_users_table', 4),
(16, '2025_03_04_041809_add_dibayar_oleh_to_laporan_pembayaran', 6),
(17, '2025_03_04_050800_add_nama_pembayar_to_laporan_pembayaran', 7),
(18, '2025_03_06_015400_add_deleted_at_to_laporan_pembayaran', 8),
(19, '2025_03_06_050657_add_is_hidden_to_laporan_pembayaran', 9),
(24, '2025_02_20_010032_create_laporan_pembayarans_table', 10),
(25, '2025_03_11_154544_create_konsultasis_table', 10),
(26, '2025_03_13_152011_update_laporan_pembayaran', 11),
(27, '2025_03_15_163736_add_user_id_to_laporan_pembayaran', 12),
(28, '2025_03_15_165830_remove_user_id_from_laporan_pembayaran', 13);

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
('4ZgRAan3SkoubkQVeOap7lAjfZfLYoAH5GqMnkEw', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWWRDTEx4UXdURlJPNDRSaFFNam9Ea1Zob1BaQzFqMVFFZXluVmxZTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742260868),
('c1hcBpCJLiHvpN3GIhbV3HqUyGBRIkj5iw1b23XJ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiUXRnRlhVNEEyMmJ5QzF5VzJXTjhLbzFERUt5ZjF6aWN0aVVQU25QWSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Jpd2F5YXQtcGVtYmF5YXJhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742264062),
('fMiKjoqC7UhcXhOmWYWvMPjXtCHOoWQL10EjN46Z', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiaEpLOFJnRjZtenc5UTBXSkhRWXZwYmtQa09pRWU4Y2tNdWo3RUNZaCI7czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTk6InBhc3N3b3JkX2hhc2hfYWRtaW4iO3M6NjA6IiQyeSQxMiQzTmUvd3o2Wjc5TXNHSVBZNnh1UDQubmJkWnZHLjQ0bGVHTEVLNk4uS2dLMW10OGRRQnpLeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYWZ0YXItdGFnaWhhbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1742264086),
('MzjQEiest0IDeZg6QNc8Rhl18B2rSPkDGQecm2wT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUcwakkzUldzbjU4Z2tNUGN1N3loSVg1MFM1TmlIWUJ2cnJTQngybCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742260863),
('OubmJc1oVR9yNsziENW2cGDd3yXt8pngxX97alnF', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiODU2blBuZFlBTm05UVF6UVczRG5qdlZsbE04QUk1NkFtYWhlcG1NOCI7czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTk6InBhc3N3b3JkX2hhc2hfYWRtaW4iO3M6NjA6IiQyeSQxMiQzTmUvd3o2Wjc5TXNHSVBZNnh1UDQubmJkWnZHLjQ0bGVHTEVLNk4uS2dLMW10OGRRQnpLeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYWZ0YXItdGFnaWhhbnMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1742264083),
('tt3ITyk7jGG5aIRlM1LHOCdhUd3AOF5ej1yv0xo4', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiUWxuTWRsYXd3U2ZuMnNTVlRKbUNQYUsxb1hIQzVYZVREZXI5QlpPTyI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2Zvcm0ta29uc3VsdGFzaSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTI6ImxvZ2luX2FkbWluXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE5OiJwYXNzd29yZF9oYXNoX2FkbWluIjtzOjYwOiIkMnkkMTIkM05lL3d6Nlo3OU1zR0lQWTZ4dVA0Lm5iZFp2Ry40NGxlR0xFSzZOLktnSzFtdDhkUUJ6S3kiO30=', 1742265731),
('u9wglYeNsVOYwr9tY1RcYTznFm8opdmTsvnT82qZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRlJHN1dOekREcnY2NTB2VnR0ZjFGVEloaGFoaEZROXYyd3lObnczYiI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0MDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Jpd2F5YXQtcGVtYmF5YXJhbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1742264044);

-- --------------------------------------------------------

--
-- Table structure for table `tarif_listriks`
--

CREATE TABLE `tarif_listriks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `golongan` varchar(255) NOT NULL,
  `daya` int(11) NOT NULL,
  `tarif_per_kwh` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tarif_listriks`
--

INSERT INTO `tarif_listriks` (`id`, `golongan`, `daya`, `tarif_per_kwh`, `created_at`, `updated_at`) VALUES
(1, 'R1', 450, 1000.00, NULL, NULL),
(2, 'R1', 900, 1500.00, NULL, NULL),
(3, 'R2', 450, 750.00, NULL, NULL),
(4, 'B1', 1500, 2000.00, NULL, NULL);

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
  `saldo` decimal(15,2) NOT NULL DEFAULT 0.00,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `saldo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ZELIKA SHERIL AMILLAH SALSABILA', 'zelikasas@gmail.com', NULL, '$2y$12$/e1.iyyhzYj/YT0q6ZVOTe4R3.eywV.2a2hAnXH8P0DyMADlFXIYi', 87602000.00, 'WCDasXGkzZIAhVJVhwZ0jsnoEFYqSVbwhRkZWkRmFD8L4KQYlSGAzR3Bi6aH', '2025-02-19 18:33:29', '2025-03-17 19:32:56');

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
-- Indexes for table `daftar_tagihans`
--
ALTER TABLE `daftar_tagihans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `daftar_tagihans_idpel_foreign` (`idpel`);

--
-- Indexes for table `data_pelanggans`
--
ALTER TABLE `data_pelanggans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `data_pelanggans_idpel_unique` (`idpel`),
  ADD UNIQUE KEY `data_pelanggans_nomor_meter_unique` (`nomor_meter`),
  ADD UNIQUE KEY `data_pelanggans_nik_unique` (`nik`);

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
-- Indexes for table `konsultasis`
--
ALTER TABLE `konsultasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_pembayaran`
--
ALTER TABLE `laporan_pembayaran`
  ADD PRIMARY KEY (`no_ref`),
  ADD UNIQUE KEY `laporan_pembayaran_idpel_unique` (`idpel`),
  ADD KEY `laporan_pembayaran_id_pelanggan_foreign` (`id_pelanggan`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tarif_listriks`
--
ALTER TABLE `tarif_listriks`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `daftar_tagihans`
--
ALTER TABLE `daftar_tagihans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `data_pelanggans`
--
ALTER TABLE `data_pelanggans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
-- AUTO_INCREMENT for table `konsultasis`
--
ALTER TABLE `konsultasis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tarif_listriks`
--
ALTER TABLE `tarif_listriks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `daftar_tagihans`
--
ALTER TABLE `daftar_tagihans`
  ADD CONSTRAINT `daftar_tagihans_idpel_foreign` FOREIGN KEY (`idpel`) REFERENCES `data_pelanggans` (`idpel`) ON DELETE CASCADE;

--
-- Constraints for table `laporan_pembayaran`
--
ALTER TABLE `laporan_pembayaran`
  ADD CONSTRAINT `laporan_pembayaran_id_pelanggan_foreign` FOREIGN KEY (`id_pelanggan`) REFERENCES `data_pelanggans` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
