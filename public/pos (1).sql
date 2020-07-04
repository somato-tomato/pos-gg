-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2020 at 10:37 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idKategori` bigint(20) DEFAULT NULL,
  `kodeBarang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaBarang` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `satuan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hargaJualSatuan` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `minStock` int(11) NOT NULL,
  `jmlPerdus` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `idKategori`, `kodeBarang`, `namaBarang`, `satuan`, `hargaJualSatuan`, `stock`, `minStock`, `jmlPerdus`, `created_at`, `updated_at`) VALUES
(1, 1, 'NSTL-00001', 'Nestle Bubur Bayi', 'PCS', 1000, 200, 100, 10, '2020-06-22 17:39:16', '2020-06-22 17:39:16'),
(3, 1, 'NSTL-00002', 'Nestle Bubur Kacang', 'PCS', 1000, 110, 100, 10, '2020-06-22 17:44:42', '2020-06-22 17:44:42'),
(5, 1, 'MIE-0001', 'Indomie Goreng Kuah', 'Buah', 2500, 1000, 200, 100, '2020-06-24 19:02:09', '2020-06-24 19:02:09');

-- --------------------------------------------------------

--
-- Table structure for table `barang_raks`
--

CREATE TABLE `barang_raks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idBarang` bigint(20) NOT NULL,
  `idRak` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_raks`
--

INSERT INTO `barang_raks` (`id`, `idBarang`, `idRak`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '2020-07-04 01:33:01', '2020-07-04 01:33:01');

-- --------------------------------------------------------

--
-- Table structure for table `barang_stocks`
--

CREATE TABLE `barang_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idBarang` bigint(20) NOT NULL,
  `idSupplier` bigint(20) NOT NULL,
  `stockMasuk` int(11) NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_stocks`
--

INSERT INTO `barang_stocks` (`id`, `idBarang`, `idSupplier`, `stockMasuk`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 3, 0, 50, 'asldjashdk', '2020-06-22 18:57:57', '2020-06-22 18:57:57'),
(2, 3, 1, 10, 'asd', '2020-06-27 16:11:08', '2020-06-27 16:11:08');

-- --------------------------------------------------------

--
-- Table structure for table `barang_suppliers`
--

CREATE TABLE `barang_suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `idSupplier` bigint(20) NOT NULL,
  `idBarang` bigint(20) NOT NULL,
  `hargaBeli` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_suppliers`
--

INSERT INTO `barang_suppliers` (`id`, `idSupplier`, `idBarang`, `hargaBeli`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 50000, '2020-06-24 18:38:05', '2020-06-24 18:59:24'),
(2, 2, 3, 100000, '2020-06-24 18:44:12', '2020-06-24 18:44:12'),
(3, 2, 5, 100000, '2020-06-24 19:03:31', '2020-06-24 19:03:31'),
(4, 1, 3, 190000, '2020-06-25 17:35:10', '2020-06-30 16:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kategoris`
--

CREATE TABLE `kategoris` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaKategori` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kategoris`
--

INSERT INTO `kategoris` (`id`, `namaKategori`, `created_at`, `updated_at`) VALUES
(1, 'Makanan', '2020-07-03 02:26:11', '2020-07-03 02:26:11'),
(2, 'Minuman', '2020-07-03 02:29:02', '2020-07-03 02:29:02'),
(3, 'Shampo', '2020-07-03 02:29:10', '2020-07-03 02:29:10'),
(4, 'Sabun', '2020-07-03 02:29:15', '2020-07-03 02:29:15'),
(5, 'Mie Instan', '2020-07-03 02:31:10', '2020-07-03 02:31:10'),
(6, 'Minuman Botol', '2020-07-03 02:31:19', '2020-07-03 02:31:19'),
(7, 'Minuman Kotak', '2020-07-03 02:31:27', '2020-07-03 02:31:27'),
(8, 'Chiki', '2020-07-03 02:31:35', '2020-07-03 02:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_06_20_054458_create_suppliers_table', 1),
(5, '2020_06_20_054641_create_barangs_table', 1),
(6, '2020_06_20_105601_create_barang_stocks_table', 1),
(7, '2020_06_24_230317_create_barang_suppliers_table', 2),
(10, '2020_06_30_234837_create_kategoris_table', 3),
(11, '2020_06_30_234912_create_barang_raks_table', 3),
(12, '2020_06_30_235834_create_raks_table', 3),
(13, '2020_06_30_235932_create_barang_kategoris_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `raks`
--

CREATE TABLE `raks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `namaRak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `raks`
--

INSERT INTO `raks` (`id`, `namaRak`, `created_at`, `updated_at`) VALUES
(1, 'Rak Makanan 1', '2020-07-03 20:06:57', '2020-07-03 20:06:57'),
(2, 'Rak Makanan 2', '2020-07-03 20:07:05', '2020-07-03 20:07:05');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kodeSupplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaSupplier` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `namaKontak` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `noHP` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `kodeSupplier`, `namaSupplier`, `alamat`, `namaKontak`, `noHP`, `status`, `created_at`, `updated_at`) VALUES
(1, 'NSTL', 'CV Mitra Nestle Abadi', 'Bandung Barat', 'Rizal', '082291919811', 'aktif', '2020-06-22 17:36:46', '2020-06-22 17:36:46'),
(2, 'MIEIND', 'Indomie Enak Bandung', 'Bandung', 'Ujang', '123123123912', 'aktif', '2020-06-22 20:46:01', '2020-06-22 20:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Diaz Faisal Malik', 'diazfmalik@gmail.com', NULL, '$2y$10$fcc7bafqMBzW5mhOIAtaBe4fDMYlsiOjdfcYNPVRhLFxDfvGSH71i', 'admin', NULL, '2020-06-22 17:34:17', '2020-06-22 17:34:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_raks`
--
ALTER TABLE `barang_raks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_stocks`
--
ALTER TABLE `barang_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_suppliers`
--
ALTER TABLE `barang_suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategoris`
--
ALTER TABLE `kategoris`
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
-- Indexes for table `raks`
--
ALTER TABLE `raks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `barang_raks`
--
ALTER TABLE `barang_raks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang_stocks`
--
ALTER TABLE `barang_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `barang_suppliers`
--
ALTER TABLE `barang_suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kategoris`
--
ALTER TABLE `kategoris`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `raks`
--
ALTER TABLE `raks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
