-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2019 at 05:24 PM
-- Server version: 10.1.37-MariaDB-3
-- PHP Version: 7.2.4-1+b2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TOPS`
--

-- --------------------------------------------------------

--
-- Table structure for table `CategoryModule`
--

CREATE TABLE `CategoryModule` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `MappingProductCategory`
--

CREATE TABLE `MappingProductCategory` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ProductModule`
--

CREATE TABLE `ProductModule` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `SKU` varchar(10) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(5) NOT NULL,
  `updatedAt` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CategoryModule`
--
ALTER TABLE `CategoryModule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ProductModule`
--
ALTER TABLE `ProductModule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `SKU` (`SKU`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CategoryModule`
--
ALTER TABLE `CategoryModule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ProductModule`
--
ALTER TABLE `ProductModule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
