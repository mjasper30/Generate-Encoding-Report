-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 09:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `generate_encoding_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `encoded`
--

CREATE TABLE `encoded` (
  `id` int(11) NOT NULL,
  `handler` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `date_encoded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `encoded`
--

INSERT INTO `encoded` (`id`, `handler`, `firstname`, `lastname`, `middlename`, `jobtitle`, `date_encoded`) VALUES
(1, 'letty', 'Jasper', 'Macaraeg', 'David', 'Welfare Officer', '2023-07-07 05:16:06'),
(2, 'letty', 'Wencel', 'Santioque', 'Temple', 'Material Manager', '2023-07-07 05:16:16'),
(3, 'mjasper30', 'Ma. Cecilia Angela', 'Dela Rosa', 'M.', 'Piping Engineer', '2023-07-07 05:16:32'),
(4, 'manuel', 'example', 'example', 'dsadsa', 'dsadsa', '2023-07-07 06:01:14'),
(5, 'manuel', 'example', 'example', 'dsadsa', 'dsadsa', '2023-07-07 06:01:24'),
(6, 'manuel', 'Ma. Cecilia Angela', 'Dela Rosa', 'M.', 'test', '2023-07-07 06:02:01'),
(7, 'letty', 'Ma. Cecilia Angela', 'Dela Rosa', 'M.', 'dsada', '2023-07-07 06:03:30'),
(8, 'archie', 'Juan', 'Cardo', 'Dela Cruz', 'Welfare Officer', '2023-07-07 06:26:33'),
(9, 'patrick', 'Daneris', 'Mendoza', 'MEN', 'Master Programmer eyyy', '2023-07-07 07:47:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `encoded`
--
ALTER TABLE `encoded`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `encoded`
--
ALTER TABLE `encoded`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
