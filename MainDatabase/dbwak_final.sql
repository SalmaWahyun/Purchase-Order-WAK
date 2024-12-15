-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2024 at 09:18 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbwak`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_riwayat_pesanan`
--

CREATE TABLE `detail_riwayat_pesanan` (
  `id_tr_pesanan` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL,
  `sub_total` int NOT NULL,
  `nama_produk` varchar(25) NOT NULL,
  `ms_pesanan_id_pesanan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detail_riwayat_pesanan`
--

INSERT INTO `detail_riwayat_pesanan` (`id_tr_pesanan`, `jumlah`, `harga`, `sub_total`, `nama_produk`, `ms_pesanan_id_pesanan`) VALUES
(7, 10, 36000, 360000, 'Ayam cincang', 16),
(8, 20, 34000, 680000, 'Cakar Ayam', 16),
(9, 20, 36000, 720000, 'Ayam cincang', 16),
(52, 1, 34000, 34000, 'Kepala Ayam', 31),
(53, 1, 34000, 34000, 'Dda Dimas', 32),
(54, 1, 34000, 34000, 'Sayap Ayam', 32),
(55, 1, 100000, 100000, 'Kudanil Goreng', 32),
(56, 1, 34000, 34000, 'Cakar Ayam', 33),
(57, 1, 34000, 34000, 'Kepala Ayam', 33),
(58, 1, 34000, 34000, 'Sayap Ayam', 33),
(50, 1, 100, 100, 'Kudanil Goreng', 30),
(51, 1, 34000, 34000, 'Kepala Ayam', 30);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_konsumen`
--

CREATE TABLE `ms_konsumen` (
  `id_konsumen` int NOT NULL,
  `nama_konsumen` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_konsumen`
--

INSERT INTO `ms_konsumen` (`id_konsumen`, `nama_konsumen`, `alamat`, `no_hp`, `email`) VALUES
(1, 'Rumah Makan XYZ', 'Jl. Jati no 19', '084267165542', 'xyzrm@gmail.com'),
(2, 'Ayam Nyam Nyam', 'jl. Kenanga no 3', '016273916543', 'ayamnyam@gmail.com'),
(3, 'Warung Ayam', 'Jl. Kecapit no 3', '089266782453', 'wrgayam@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ms_pesanan`
--

CREATE TABLE `ms_pesanan` (
  `id_pesanan` int NOT NULL,
  `tanggal_pesan` datetime DEFAULT NULL,
  `tanggal_kirim` datetime DEFAULT NULL,
  `penerima` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `catatan` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` enum('pesanan','dikirim','selesai') CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `ms_user_id_user` int NOT NULL,
  `ms_konsumen_id_konsumen` int NOT NULL,
  `ms_suplier_id_suplier` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ms_pesanan`
--

INSERT INTO `ms_pesanan` (`id_pesanan`, `tanggal_pesan`, `tanggal_kirim`, `penerima`, `catatan`, `status`, `ms_user_id_user`, `ms_konsumen_id_konsumen`, `ms_suplier_id_suplier`) VALUES
(35, '2024-12-25 15:33:00', '2024-12-26 15:33:00', NULL, NULL, 'pesanan', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ms_produk`
--

CREATE TABLE `ms_produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(512) DEFAULT NULL,
  `harga_produk` int DEFAULT NULL,
  `satuan` enum('Ons','Kg','Ton') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ms_produk`
--

INSERT INTO `ms_produk` (`id_produk`, `nama_produk`, `deskripsi`, `harga_produk`, `satuan`) VALUES
(4, 'Cakar Ayam', 'Daging ayam bagian cakar', 34000, 'Kg'),
(5, 'Kepala Ayam', 'Kepala ayam', 34000, 'Kg'),
(6, 'Sayap Ayam', 'juhu', 8000, 'Ons'),
(15, 'cakar', 'ajqwh', 10000, 'Kg'),
(16, 'Ayam cincang', 'Daging ayam cincang', 36000, 'Kg'),
(17, 'Sayap', 'gfsgha', 34000, 'Ton'),
(19, 'Kudanil Goreng', 'Adadsadasd', 100, 'Ons');

-- --------------------------------------------------------

--
-- Table structure for table `ms_suplier`
--

CREATE TABLE `ms_suplier` (
  `id_suplier` int NOT NULL,
  `nama_suplier` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_hp` varchar(16) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ms_suplier`
--

INSERT INTO `ms_suplier` (`id_suplier`, `nama_suplier`, `alamat`, `no_hp`, `email`) VALUES
(1, 'Ayam Potong BCS', 'Jl. Ambarawa no 22', '089236153887', 'abcayam@gmail.com'),
(2, 'Ayam Pedaging QWE', 'Jl. mejakursi no 6', '089212382453', 'qwe@gmail.com'),
(3, 'yshfhdsx', 'hgdsxhndcs', 'yhggdsbn', 'ghgsxgsdx');

-- --------------------------------------------------------

--
-- Table structure for table `ms_user`
--

CREATE TABLE `ms_user` (
  `id_user` int NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `pin_user` varchar(6) DEFAULT NULL,
  `level` enum('superadmin','admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ms_user`
--

INSERT INTO `ms_user` (`id_user`, `nama_user`, `password`, `pin_user`, `level`) VALUES
(0, 'dhana', '9b57369ab3cddfaa04e2bf629d485e90', '456', 'superadmin'),
(1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', '123456', 'superadmin');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pesanan`
--

CREATE TABLE `riwayat_pesanan` (
  `id_pesanan` int NOT NULL,
  `tanggal_pesan` datetime NOT NULL,
  `tanggal_kirim` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `nama_konsumen` varchar(255) NOT NULL,
  `nama_suplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `riwayat_pesanan`
--

INSERT INTO `riwayat_pesanan` (`id_pesanan`, `tanggal_pesan`, `tanggal_kirim`, `status`, `nama_user`, `nama_konsumen`, `nama_suplier`) VALUES
(16, '2024-12-07 01:04:00', '2024-12-13 01:04:00', 'selesai', 'superadmin', 'Rumah Makan XYZ', 'Ayam Pedaging QWE'),
(30, '2024-12-23 23:05:00', '2024-12-25 23:06:00', 'selesai', 'superadmin', 'Rumah Makan XYZ', 'Ayam Potong BCS'),
(31, '2025-01-02 01:13:00', '2025-01-09 01:13:00', 'selesai', 'superadmin', 'Rumah Makan XYZ', 'Ayam Potong BCS'),
(32, '2024-12-04 14:36:00', '2025-01-03 14:36:00', 'selesai', 'superadmin', 'Rumah Makan XYZ', 'Ayam Potong BCS'),
(33, '2024-12-15 15:28:00', '2024-12-16 15:28:00', 'selesai', 'superadmin', 'Rumah Makan XYZ', 'Ayam Potong BCS');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('HjdeVSTQgWHxHMlqvgrHTYGtsZbya65GpSHZm0JZ', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiS1NjR1VpbWpvTk5EamtndnJYeUExYlBDUzVydFNnTllkM1poZGVxUSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yaXdheWF0LXBlc2FuYW4iO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6ODoiYWRtaW5faWQiO2k6MTtzOjEwOiJhZG1pbl9uYW1lIjtzOjEwOiJzdXBlcmFkbWluIjt9', 1734252953);

-- --------------------------------------------------------

--
-- Table structure for table `tr_pesanan`
--

CREATE TABLE `tr_pesanan` (
  `id_tr_pesanan` int NOT NULL,
  `jumlah` int DEFAULT NULL,
  `harga` int DEFAULT NULL,
  `sub_total` int DEFAULT NULL,
  `ms_produk_id_produk` int NOT NULL,
  `ms_pesanan_id_pesanan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `tr_pesanan`
--

INSERT INTO `tr_pesanan` (`id_tr_pesanan`, `jumlah`, `harga`, `sub_total`, `ms_produk_id_produk`, `ms_pesanan_id_pesanan`) VALUES
(60, 1, 34000, 34000, 5, 35);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint UNSIGNED NOT NULL,
  `nama_user` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin_user` varchar(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('superadmin','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `detail_riwayat_pesanan`
--
ALTER TABLE `detail_riwayat_pesanan`
  ADD KEY `foreign_detail_riwayat` (`ms_pesanan_id_pesanan`);

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
-- Indexes for table `ms_konsumen`
--
ALTER TABLE `ms_konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indexes for table `ms_pesanan`
--
ALTER TABLE `ms_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `fk_ms_pesanan_ms_user1_idx` (`ms_user_id_user`),
  ADD KEY `fk_ms_pesanan_ms_konsumen1_idx` (`ms_konsumen_id_konsumen`),
  ADD KEY `fk_ms_pesanan_ms_suplier1_idx` (`ms_suplier_id_suplier`);

--
-- Indexes for table `ms_produk`
--
ALTER TABLE `ms_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `ms_suplier`
--
ALTER TABLE `ms_suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indexes for table `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `riwayat_pesanan`
--
ALTER TABLE `riwayat_pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tr_pesanan`
--
ALTER TABLE `tr_pesanan`
  ADD PRIMARY KEY (`id_tr_pesanan`),
  ADD KEY `fk_tr_pesanan_ms_produk_idx` (`ms_produk_id_produk`),
  ADD KEY `fk_tr_pesanan_ms_pesanan1_idx` (`ms_pesanan_id_pesanan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ms_konsumen`
--
ALTER TABLE `ms_konsumen`
  MODIFY `id_konsumen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ms_pesanan`
--
ALTER TABLE `ms_pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `ms_produk`
--
ALTER TABLE `ms_produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `ms_suplier`
--
ALTER TABLE `ms_suplier`
  MODIFY `id_suplier` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tr_pesanan`
--
ALTER TABLE `tr_pesanan`
  MODIFY `id_tr_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_riwayat_pesanan`
--
ALTER TABLE `detail_riwayat_pesanan`
  ADD CONSTRAINT `foreign_detail_riwayat` FOREIGN KEY (`ms_pesanan_id_pesanan`) REFERENCES `riwayat_pesanan` (`id_pesanan`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `ms_pesanan`
--
ALTER TABLE `ms_pesanan`
  ADD CONSTRAINT `fk_ms_pesanan_ms_konsumen1` FOREIGN KEY (`ms_konsumen_id_konsumen`) REFERENCES `ms_konsumen` (`id_konsumen`),
  ADD CONSTRAINT `fk_ms_pesanan_ms_suplier1` FOREIGN KEY (`ms_suplier_id_suplier`) REFERENCES `ms_suplier` (`id_suplier`),
  ADD CONSTRAINT `fk_ms_pesanan_ms_user1` FOREIGN KEY (`ms_user_id_user`) REFERENCES `ms_user` (`id_user`);

--
-- Constraints for table `tr_pesanan`
--
ALTER TABLE `tr_pesanan`
  ADD CONSTRAINT `fk_tr_pesanan_ms_pesanan` FOREIGN KEY (`ms_pesanan_id_pesanan`) REFERENCES `ms_pesanan` (`id_pesanan`),
  ADD CONSTRAINT `fk_tr_pesanan_ms_produk` FOREIGN KEY (`ms_produk_id_produk`) REFERENCES `ms_produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
