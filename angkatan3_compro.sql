-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2024 at 12:50 PM
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
-- Database: `angkatan3_compro`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(9) NOT NULL,
  `name` varchar(55) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `subject` varchar(55) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `subject`, `message`, `deleted_at`) VALUES
(5, 'Tri Adhy Yulianto', 'tri@gmail.com', 'Coba kontak ah..', 'gg bosque', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonial`
--

CREATE TABLE `testimonial` (
  `id` int(11) NOT NULL,
  `nama` varchar(55) DEFAULT NULL,
  `profesi` varchar(45) DEFAULT NULL,
  `testimony` varchar(45) DEFAULT NULL,
  `foto` varchar(180) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonial`
--

INSERT INTO `testimonial` (`id`, `nama`, `profesi`, `testimony`, `foto`, `deleted_at`) VALUES
(5, 'TRI ADHY YULIANTO', 'Kang Kung', 'Suka menjual kangkung di jalan tol.', 'bunga.jpg', NULL),
(6, 'Sulis', 'Kang Guru', 'Suka jadi Kang Guru di Australia.', 'WhatsApp Image 2024-09-01 at 16.25.57.jpeg', NULL),
(7, 'Ganda', 'Bu Jang an', 'Saya seorang Bujangan', 'Welcome Scan.jpg', NULL),
(8, 'Sinyorita', 'Berburu Kepiting', 'Saya suka berburu kepiting', 'Welcome Scan.jpg', NULL),
(9, 'Danu', 'Dagang Bambu', 'Saya suka dagang bambu, tapi gak laku :(', 'daisys-1392171.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'Reza Ibrahim123', 'admin@gmail.com', '12345678', 'php.jpg', '2024-10-22 04:32:39', '2024-10-23 08:18:45'),
(4, 'Bambang1', 'bambang@gmail.com', '12345678', '', '2024-10-23 04:56:47', '2024-10-23 08:53:27'),
(7, 'bunga', 'bunga@gmail.com', '12345678', 'php.jpg', '2024-10-23 07:26:17', '2024-10-23 07:26:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
