-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Des 2024 pada 08.36
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_konsumen`
--

CREATE TABLE `ms_konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `nama_konsumen` varchar(50) DEFAULT NULL,
  `alamat` varchar(128) DEFAULT NULL,
  `no_hp` varchar(16) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ms_konsumen`
--

INSERT INTO `ms_konsumen` (`id_konsumen`, `nama_konsumen`, `alamat`, `no_hp`, `email`) VALUES
(1, 'Rumah Makan XYZ', 'Jl. Jati no 11', '084267165542', 'xyzrm@gmail.com'),
(2, 'Ayam Nyam Nyam', 'jl. Kenanga no 3', '016273916543', 'ayamnyam@gmail.com'),
(3, 'Warung Ayam', 'Jl. Kecapit no 3', '089266782453', 'wrgayam@gmail.com'),
(4, 'fvddc', 'gfdfvs', 'fgffs', 'fvddf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_pesanan`
--

CREATE TABLE `ms_pesanan` (
  `id_pesanan` int(14) NOT NULL,
  `tanggal_pesan` datetime DEFAULT NULL,
  `tanggal_kirim` datetime DEFAULT NULL,
  `penerima` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `catatan` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `status` enum('pesanan','dikirim','selesai') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ms_user_id_user` int(11) NOT NULL,
  `ms_konsumen_id_konsumen` int(11) NOT NULL,
  `ms_suplier_id_suplier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `ms_pesanan`
--

INSERT INTO `ms_pesanan` (`id_pesanan`, `tanggal_pesan`, `tanggal_kirim`, `penerima`, `catatan`, `status`, `ms_user_id_user`, `ms_konsumen_id_konsumen`, `ms_suplier_id_suplier`) VALUES
(1, '2024-11-16 18:06:05', '2024-11-17 07:00:00', NULL, NULL, 'pesanan', 0, 1, 1),
(2, '2024-11-16 08:18:52', '2024-11-17 07:00:00', NULL, NULL, 'dikirim', 0, 2, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_produk`
--

CREATE TABLE `ms_produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(50) DEFAULT NULL,
  `deskripsi` varchar(512) DEFAULT NULL,
  `harga_produk` int(11) DEFAULT NULL,
  `satuan` enum('Ons','Kg','Ton') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `ms_produk`
--

INSERT INTO `ms_produk` (`id_produk`, `nama_produk`, `deskripsi`, `harga_produk`, `satuan`) VALUES
(1, 'Dada Ayam', 'Daging ayam bagian dada', 34000, 'Kg'),
(2, 'Paha Ayam', 'Daging ayam bagian paha', 34000, 'Kg'),
(3, 'Sayap Ayam', 'Daging ayam bagian sayap', 34000, 'Kg'),
(4, 'Cakar Ayam', 'Daging ayam bagian cakar', 34000, 'Kg'),
(5, 'Kepala Ayam', 'Kepala ayam', 34000, 'Kg'),
(6, 'Sayap Ayam', 'juhu', 8000, 'Ons'),
(15, 'cakar', 'ajqwh', 10000, 'Kg'),
(16, 'Ayam cincang', 'Daging ayam cincang', 36000, 'Kg'),
(17, 'Sayap', 'gfsgha', 34000, 'Ton');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_suplier`
--

CREATE TABLE `ms_suplier` (
  `id_suplier` int(11) NOT NULL,
  `nama_suplier` varchar(50) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `no_hp` varchar(16) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `ms_suplier`
--

INSERT INTO `ms_suplier` (`id_suplier`, `nama_suplier`, `alamat`, `no_hp`, `email`) VALUES
(1, 'Ayam Potong ABC', 'Jl. Ambarawa no 22', '089236153887', 'abcayam@gmail.com'),
(2, 'Ayam Pedaging QWE', 'Jl. mejakursi no 6', '089212382453', 'qwe@gmail.com'),
(3, 'yshfhdsx', 'hgdsxhndcs', 'yhggdsbn', 'ghgsxgsdx');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ms_user`
--

CREATE TABLE `ms_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `pin_user` varchar(6) DEFAULT NULL,
  `level` enum('superadmin','admin') NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `ms_user`
--

INSERT INTO `ms_user` (`id_user`, `nama_user`, `password`, `pin_user`, `level`) VALUES
(0, 'dhana', '9b57369ab3cddfaa04e2bf629d485e90', '456', 'superadmin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('OvhV7AOmuJr9tE4afxZKg58cdhWm1txYylNIE3Se', 0, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUVNubkN0ZEJFQ0FOUkJoYWY4T3lrMElNVklyc2NwbTJHVjFUZmtERyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MDtzOjEwOiJhZG1pbl9uYW1lIjtzOjU6ImRoYW5hIjtzOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czozMjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL21hcmtldGxpc3QiO319', 1734075153);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tr_pesanan`
--

CREATE TABLE `tr_pesanan` (
  `id_tr_pesanan` int(14) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `sub_total` int(11) DEFAULT NULL,
  `tr_pesanancol` varchar(45) NOT NULL,
  `ms_produk_id_produk` int(11) NOT NULL,
  `ms_pesanan_id_pesanan` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `tr_pesanan`
--

INSERT INTO `tr_pesanan` (`id_tr_pesanan`, `jumlah`, `harga`, `sub_total`, `tr_pesanancol`, `ms_produk_id_produk`, `ms_pesanan_id_pesanan`) VALUES
(1, 1, 34000, 34000, '', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `pin_user` varchar(6) NOT NULL,
  `level` enum('superadmin','admin') NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ms_konsumen`
--
ALTER TABLE `ms_konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indeks untuk tabel `ms_pesanan`
--
ALTER TABLE `ms_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `fk_ms_pesanan_ms_user1_idx` (`ms_user_id_user`),
  ADD KEY `fk_ms_pesanan_ms_konsumen1_idx` (`ms_konsumen_id_konsumen`),
  ADD KEY `fk_ms_pesanan_ms_suplier1_idx` (`ms_suplier_id_suplier`);

--
-- Indeks untuk tabel `ms_produk`
--
ALTER TABLE `ms_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indeks untuk tabel `ms_suplier`
--
ALTER TABLE `ms_suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indeks untuk tabel `ms_user`
--
ALTER TABLE `ms_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tr_pesanan`
--
ALTER TABLE `tr_pesanan`
  ADD PRIMARY KEY (`id_tr_pesanan`),
  ADD KEY `fk_tr_pesanan_ms_produk_idx` (`ms_produk_id_produk`),
  ADD KEY `fk_tr_pesanan_ms_pesanan1_idx` (`ms_pesanan_id_pesanan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `ms_konsumen`
--
ALTER TABLE `ms_konsumen`
  MODIFY `id_konsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `ms_pesanan`
--
ALTER TABLE `ms_pesanan`
  MODIFY `id_pesanan` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `ms_produk`
--
ALTER TABLE `ms_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `ms_suplier`
--
ALTER TABLE `ms_suplier`
  MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tr_pesanan`
--
ALTER TABLE `tr_pesanan`
  MODIFY `id_tr_pesanan` int(14) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `ms_pesanan`
--
ALTER TABLE `ms_pesanan`
  ADD CONSTRAINT `fk_ms_pesanan_ms_konsumen1` FOREIGN KEY (`ms_konsumen_id_konsumen`) REFERENCES `ms_konsumen` (`id_konsumen`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ms_pesanan_ms_suplier1` FOREIGN KEY (`ms_suplier_id_suplier`) REFERENCES `ms_suplier` (`id_suplier`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ms_pesanan_ms_user1` FOREIGN KEY (`ms_user_id_user`) REFERENCES `ms_user` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ketidakleluasaan untuk tabel `tr_pesanan`
--
ALTER TABLE `tr_pesanan`
  ADD CONSTRAINT `fk_tr_pesanan_ms_pesanan` FOREIGN KEY (`ms_pesanan_id_pesanan`) REFERENCES `ms_pesanan` (`id_pesanan`),
  ADD CONSTRAINT `fk_tr_pesanan_ms_produk` FOREIGN KEY (`ms_produk_id_produk`) REFERENCES `ms_produk` (`id_produk`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
