-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2020 at 11:54 AM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodshala`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `ordered_by` int(11) NOT NULL,
  `ordered_from` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `item_id`, `ordered_by`, `ordered_from`, `quantity`) VALUES
(2, 9, 6, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` int(11) NOT NULL,
  `cust_email` varchar(60) NOT NULL,
  `cust_name` varchar(60) NOT NULL,
  `cust_mobile` varchar(15) NOT NULL,
  `cust_city` varchar(50) NOT NULL,
  `cust_password_hash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_email`, `cust_name`, `cust_mobile`, `cust_city`, `cust_password_hash`) VALUES
(6, 'cust@example.com', 'Sample Customer', '9479475120', 'Mumbai', 'ddac418a1be76098d01107464026f65d2a3192bf');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `item_id` int(11) NOT NULL,
  `rest_id` int(11) NOT NULL,
  `item_name` varchar(30) NOT NULL,
  `item_price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`item_id`, `rest_id`, `item_name`, `item_price`) VALUES
(9, 4, 'Paneer Butter Masala - Full', 120),
(10, 4, 'Paneer Butter Masala - Half', 70),
(11, 4, 'Pizza - Normal', 200),
(12, 4, 'Pizza - Small', 120);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `ordered_by` int(11) NOT NULL,
  `ordered_from` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `ordered_by`, `ordered_from`, `item_id`, `quantity`) VALUES
(1, 6, 4, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE `restaurants` (
  `rest_id` int(11) NOT NULL,
  `rest_name` varchar(100) NOT NULL,
  `rest_mobile` varchar(15) NOT NULL,
  `rest_email` varchar(50) NOT NULL,
  `rest_addr` varchar(200) NOT NULL,
  `rest_city` varchar(50) NOT NULL,
  `rest_password_hash` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`rest_id`, `rest_name`, `rest_mobile`, `rest_email`, `rest_addr`, `rest_city`, `rest_password_hash`) VALUES
(4, 'Vicky Bakery', '9479475120', 'rest@example.com', 'ABC Building', 'Mumbai', 'ddac418a1be76098d01107464026f65d2a3192bf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `cust_id` (`cust_id`),
  ADD UNIQUE KEY `cust_id_2` (`cust_id`),
  ADD UNIQUE KEY `cust_id_3` (`cust_id`),
  ADD UNIQUE KEY `cust_email` (`cust_email`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `restaurants`
--
ALTER TABLE `restaurants`
  ADD PRIMARY KEY (`rest_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `restaurants`
--
ALTER TABLE `restaurants`
  MODIFY `rest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
