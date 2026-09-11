-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 09, 2025 at 01:27 PM
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
-- Database: `food`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `phone`, `salary`, `position`, `address`, `created_at`) VALUES
(1, 'Mohamed Mamdouh', '01030081420', 25000.00, 'accountant', NULL, '2025-09-29 16:57:37'),
(2, 'sayed mamdouh', '01023317369', 20000.00, 'casher', NULL, '2025-09-29 16:57:37'),
(4, 'Mamdouh Sayed', '01027075765', 60000.00, 'accountant', NULL, '2025-10-01 09:27:56'),
(5, 'Mohamed Sayed', '01045081420', 30000.00, 'casher', NULL, '2025-10-03 11:18:48'),
(7, 'sayed mamdouh', '01098081420', 15000.00, 'cheff', NULL, '2025-10-04 12:36:54'),
(8, 'Eslam Mohamed', '01147370155', 75000.00, 'Manager', NULL, '2025-10-04 12:50:02'),
(9, 'Mostafa Ayman', '01089081420', 30000.00, 'cheff', NULL, '2025-10-05 18:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `is_dropped` tinyint(1) DEFAULT 0,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`id`, `name`, `price`, `image`, `rating`, `is_dropped`, `description`, `created_at`) VALUES
(1, 'Single Meal', 85.00, 'images/Single Meal.png', NULL, 0, 'it contain', '2025-10-01 07:30:33'),
(2, 'Double Meal', 145.00, 'images/Double Meal.png', NULL, 0, 'it contain', '2025-10-01 07:39:52'),
(5, 'Combo Meal', 335.00, 'images/Combo Meal.png', NULL, 1, 'it contain', '2025-10-01 14:22:33'),
(6, 'Pizza', 150.00, 'images/Pizza.jpeg', NULL, 0, 'it contain', '2025-10-03 14:40:03'),
(7, 'Burger', 65.00, 'images/Burger.jpeg', NULL, 1, 'it contain', '2025-10-03 18:04:05'),
(8, 'Fries', 35.00, 'images/Fries.jpeg', NULL, 0, 'it contain', '2025-10-04 12:41:39'),
(9, 'Hotdog', 65.00, 'images/Hotdog.jpeg', NULL, 0, 'it contain', '2025-10-09 10:55:14'),
(10, 'Alfredo', 120.00, 'images/Alfredo.jpeg', NULL, 0, 'it contain', '2025-10-09 10:55:58'),
(11, 'Salad', 45.00, 'images/Salad.jpeg', NULL, 0, 'it contain', '2025-10-09 10:56:31'),
(12, 'Chicken Warp', 135.00, 'images/Chicken Warp.jpeg', NULL, 0, 'it contain', '2025-10-09 10:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `request_status` enum('pending','preparing','delivered','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `request_status`, `created_at`) VALUES
(1, 3, 315.00, 'pending', '2025-10-01 14:25:40'),
(2, 3, 710.00, 'pending', '2025-10-01 14:26:27'),
(3, 4, 715.00, 'pending', '2025-10-01 17:47:19'),
(4, 7, 300.00, 'pending', '2025-10-03 17:52:02'),
(5, 7, 275.00, 'pending', '2025-10-03 18:05:52'),
(6, 5, 445.00, 'pending', '2025-10-04 12:38:06'),
(7, 5, 425.00, 'pending', '2025-10-04 12:51:41'),
(8, 5, 860.00, 'pending', '2025-10-05 18:37:08'),
(9, 3, 360.00, 'pending', '2025-10-09 09:11:04'),
(10, 9, 480.00, 'pending', '2025-10-09 09:49:32');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `meal_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 170.00),
(2, 1, 2, 1, 145.00),
(7, 2, 5, 1, 335.00),
(8, 2, 2, 2, 290.00),
(9, 2, 1, 1, 85.00),
(10, 3, 1, 5, 425.00),
(11, 3, 2, 2, 290.00),
(12, 4, 6, 2, 150.00),
(13, 5, 7, 2, 65.00),
(14, 5, 2, 1, 145.00),
(15, 6, 6, 2, 150.00),
(16, 6, 2, 1, 145.00),
(17, 7, 8, 3, 35.00),
(18, 7, 6, 1, 150.00),
(19, 7, 1, 2, 85.00),
(20, 8, 1, 1, 85.00),
(21, 8, 5, 2, 335.00),
(22, 8, 8, 3, 35.00),
(23, 9, 8, 2, 35.00),
(24, 9, 2, 2, 145.00),
(25, 10, 2, 2, 145.00),
(26, 10, 1, 1, 85.00),
(27, 10, 8, 3, 35.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `is_admin`, `created_at`) VALUES
(1, 'mohamed mamdouh', 'mohamed@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 1, '2025-09-30 15:11:32'),
(3, 'sayed mamdouh', 'sayed@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '2025-09-30 15:45:14'),
(4, 'Mamdouh Sayed', 'mamdouh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '2025-10-01 16:46:24'),
(5, 'mohamed mamdouh', 'mohamed10@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 0, '2025-10-03 11:21:09'),
(7, 'sayed mamdouh', 'sayed10@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 0, '2025-10-03 18:00:36'),
(9, 'Mamdouh Sayed', 'mamdouh10@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 0, '2025-10-09 09:48:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`meal_id`) REFERENCES `meals` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
