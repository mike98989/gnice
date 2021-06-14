-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2021 at 06:59 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gnice`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `status`) VALUES
(1, 'SELL FASTER, BUY SMARTER', 1),
(3, 'SELL FASTER, BUY SMARTER', 1),
(4, 'EVERYTHING YOU NEED IN ONE PLACE', 0),
(5, 'new banner', 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `address` varchar(100) NOT NULL,
  `click-counts` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `address`, `click-counts`, `status`) VALUES
(1, 'Vehicles', 'categories/vehicles', 0, 1),
(2, 'Property', 'category/property', 0, 1),
(3, 'Mobile Phones & Tablets', 'category/phones_tablets', 0, 1),
(4, 'Gadgets', 'Products/Gadgets', 0, 1),
(5, 'Fashion', 'Products/Fashion', 0, 1),
(6, 'Gadgets', 'Products/Gadgets', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `header-navigation`
--

CREATE TABLE `header-navigation` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  `click-counts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `hero`
--

CREATE TABLE `hero` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `sub_title` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hero`
--

INSERT INTO `hero` (`id`, `title`, `sub_title`, `image`, `status`) VALUES
(1, 'Loreme enim repudiandae veniam.', 'Lorem iadipisicing elit. Facere beatae itaque fugiat perspiciatis v', 'location/image 1', 0),
(2, ' Expedita, unde necessitatibus cumque ', 'Lorem ipsum dolor sit,ipisicing elit. Facere beatae itaque fugiat perspiciatis v', 'location/image-2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `most_view`
--

CREATE TABLE `most_view` (
  `id` int(11) NOT NULL,
  `product_code` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `most_view`
--

INSERT INTO `most_view` (`id`, `product_code`, `view_count`, `status`) VALUES
(1, 12344, 100, 1),
(3, 646376, 6, 1),
(4, 66554, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_description` varchar(255) NOT NULL,
  `long_description` text NOT NULL,
  `category` varchar(255) NOT NULL,
  `sub_category` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `price` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `seller_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand`, `product_code`, `color`, `name`, `short_description`, `long_description`, `category`, `sub_category`, `image`, `price`, `date_added`, `seller_id`) VALUES
(1, 'Iphone', '12344', 'black', 'iphone 7s', 'Lorem ipsum dolor sit, amet consectetur adipisicin', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere beatae itaque fugiat perspiciatis vitae in cum libero ea, iste neque? Expedita, unde necessitatibus cumque qui ut, hic, distinctio ullam neque asperiores beatae eum voluptate. Sapiente ad nostrum, id earum magnam maxime deleniti ratione architecto, molestias assumenda nobis ipsum sunt soluta inventore autem repudiandae mollitia tempore distinctio a. Ipsam eveniet labore ex', '3', '6', 'location/image', '0', '0000-00-00 00:00:00', '676655'),
(2, 'samsung', '66554', 'silver', 'samsung s20', 'lorem ipsum some description', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Facere beatae itaque fugiat perspiciatis vitae in cum libero ea, iste neque? Expedita, unde necessitatibus cumque qui ut, hic, distinctio ullam neque asperiores beatae eum voluptate. Sapiente ad nostrum, id earum magnam maxime deleniti ratione architecto, molestias assumenda nobis ipsum sunt soluta inventore autem repudiandae mollitia tempore distinctio a. Ipsam eveniet labore ex', '3', '1', 'location-4', '1200', '0000-00-00 00:00:00', '6664764'),
(7, 'Kia', '27466465', 'black', 'kia rio', 'this is a short descrition', 'this is a long description', '4', '2', 'image-link', '1200', '2021-06-14 14:58:15', '774738'),
(8, 'oukitel', '278744', 'white', 'oukitel u16 max', 'this is a short descrition', 'this is a long description', '3', '4', 'image-link2', '1500', '2021-06-14 15:01:29', '774738'),
(9, 'iphone', '278748', 'white', 'iphone 12 pro max', 'this is a short descrition', 'this is a long description', '3', '6', 'image-link88', '2000', '2021-06-14 15:03:55', '774738'),
(11, 'iphone', '9tdlNAJhu4sZ', 'white', 'iphone 12 pro max', 'this is a short descrition', 'this is a long description', '3', '6', 'image-link88', '2000', '2021-06-14 15:30:00', '774738'),
(12, 'iphone', '2YHeub5jwDJg4oZV', 'white', 'iphone 11 pro max', 'this is a short descrition', 'this is a long description', '3', '6', 'image-link88', '1800', '2021-06-14 15:32:00', '774738'),
(13, 'iphone', 'QtIeo5p4T8EoyObe', 'white', 'iphone X pro max', 'this is a short descrition', 'this is a long description', '3', '6', 'image-link88', '3000', '2021-06-14 15:33:29', '774738'),
(14, 'iphone', 'XGC5FLOzDrteoPA1', 'white', 'iphone X pro max', 'this is a short descrition', 'this is a long description', '3', '6', 'image-link88', '3000', '2021-06-14 15:36:22', '774738'),
(15, 'iphone', 'UchVdp0Qm3ytp5RK', 'gold', 'iphone X pro max', 'this is a short descrition', 'this is a long description', '3', '6', 'image-link88', '3000', '2021-06-14 15:36:32', '774738'),
(16, 'iphone', 'leymst08Cf3BOLeD', 'gold', 'iphone X pro max', 'this is a short descrition', 'this is a long description', '3', '6', 'image-link88', '3000', '2021-06-14 15:36:34', '774738'),
(17, 'iphone%~)(& alert()', 'YGx1usAKQL2CXoOF', 'gold $IDncn', 'iphone X pro max', 'this is a short descrition', 'this is a long description', '3', '6', 'image-link88', '3000', '2021-06-14 15:43:13', '774738'),
(18, 'iphone%~)(& alert()', 'UN32OKDQMtQ6xyU3', 'gold $IDncn', 'iphone X pro max', 'this is a short descrition', 'this is a long description alert(); console(&#39;this is console&#39;);', '3', '6', 'image-link88', '3000', '2021-06-14 15:47:07', '774738'),
(19, 'iphone%~)(& alert()', 'Xt2Bpr6Qe9yL5XZQ', 'gold $IDncn', 'iphone 8', 'this is a short descrition strong text', 'this is a long description alert(); console(&#39;this is console&#39;);', '3', '6', 'image-link88', '2000', '2021-06-14 16:20:04', '774738'),
(20, 'iphone%~)(& alert()', 'l2wHjDZo9cafFW3i', 'gold $IDncn', 'iphone 8', 'this is a short descrition strong text', 'this is a long description alert(); console(&#39;this is console&#39;);', '3', '6', 'image-link88', '2000', '2021-06-14 17:20:01', '774738'),
(21, 'iphone 7', '8610231', 'gold $IDncn', 'iphone 8', 'this is a short descrition strong text', 'this is a long description alert(); console(&#39;this is console&#39;);', '3', '6', '', '1200', '2021-06-14 17:32:39', '774738'),
(22, 'iphone 6', '8827505', 'gold $IDncn', 'iphone 8', 'this is a short descrition strong text', 'this is a long description alert(); console(&#39;this is console&#39;);', '3', '6', '', '1200', '2021-06-14 17:33:08', '774738'),
(23, 'iphone 6', '21430549', 'gold $IDncn', 'iphone 8', 'this is a short descrition strong text', 'this is a long description alert(); console(&#39;this is console&#39;);', '3', '6', '', '1200', '2021-06-14 17:48:27', 'AG-45144851'),
(24, 'iphone 6', '89109265', 'gold $IDncn', 'iphone 8', 'this is a short descrition strong text', 'this is a long description alert(); console(&#39;this is console&#39;);', '3', '6', '', '1200', '2021-06-14 17:54:58', 'AG-90709887');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `rating_score` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_code`, `customer_id`, `rating_score`, `status`) VALUES
(1, '66554', '78588', '100', 1),
(2, '66554', '8646758', '10', 1),
(3, '66554', '78588', '200', 1),
(4, '66554', '8646758', '300', 1);

-- --------------------------------------------------------

--
-- Table structure for table `seller_ratings`
--

CREATE TABLE `seller_ratings` (
  `id` int(11) NOT NULL,
  `seller_id` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `rating_score` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sub-pages`
--

CREATE TABLE `sub-pages` (
  `id` int(11) NOT NULL,
  `parent-id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `parent_id`, `title`, `address`, `status`) VALUES
(1, 1, 'Kia', 'lorem/lorem/ipsum', 1),
(2, 1, 'Toyota', 'lorem/lorem/564', 1),
(3, 3, 'samsung', 'lorem/lorem/mobile', 1),
(6, 3, 'Iphone', 'lorem/lorem/iphone', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `wish_date` date NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `product_code`, `wish_date`, `customer_id`, `status`) VALUES
(1, '12344', '2021-06-03', '16362635253', 1),
(2, '66554', '0000-00-00', '734364865', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `header-navigation`
--
ALTER TABLE `header-navigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `most_view`
--
ALTER TABLE `most_view`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_code` (`product_code`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller_ratings`
--
ALTER TABLE `seller_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub-pages`
--
ALTER TABLE `sub-pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `header-navigation`
--
ALTER TABLE `header-navigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hero`
--
ALTER TABLE `hero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `most_view`
--
ALTER TABLE `most_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `seller_ratings`
--
ALTER TABLE `seller_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub-pages`
--
ALTER TABLE `sub-pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
