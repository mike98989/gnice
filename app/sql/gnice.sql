-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jun 24, 2021 at 08:08 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `status` tinyint(4) NOT NULL DEFAULT '0'
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
  `title` varchar(255) NOT NULL,
  `address` varchar(100) NOT NULL,
  `click-counts` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `address`, `click-counts`, `image`, `status`) VALUES
(1, 'Vehicles', 'categories/vehicles', 0, 'cars.png', 1),
(2, 'Property', 'category/property', 0, 'property.png', 1),
(3, 'Mobile Phones & Tablets', 'category/phones_tablets', 0, 'mobile.png', 1),
(5, 'Fashion', 'Products/Fashion', 0, 'glass-unix.png', 1),
(8, 'Electronics', '', 0, 'laptop.png', 1),
(9, 'Home, Furniture and Appliances', '', 0, 'furniture.png', 1),
(12, 'Health and Bueaty', '', 0, 'health.png', 1),
(16, 'Toys, Babies and Kids', '', 0, 'toys-kids.png', 1),
(17, 'Outdoor and Sports', '', 0, 'soccer.png', 1),
<<<<<<< HEAD
(20, 'Animals and Pets', '', 0, 'pets,png', 1);
=======
(20, 'Animals and Pets', '', 0, 'pets.png', 1);
>>>>>>> f15f13677480791ef4b920eee340834fee3baee4

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
  `status` tinyint(4) NOT NULL DEFAULT '0'
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
  `id` bigint(20) NOT NULL,
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
  `seller_id` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `local_government` varchar(255) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand`, `product_code`, `color`, `name`, `short_description`, `long_description`, `category`, `sub_category`, `image`, `price`, `date_added`, `seller_id`, `state`, `local_government`, `location`) VALUES
(4, 'Apple', '88230249', 'ashes', 'Iphone 12', 'lorem short description', 'lorem ipsum long description long', '3', '7', 'pro60d1cdd08c3f6000100000.jpg,pro60d1cdd0901ae100000000.jpg,pro60d1cdd0906da100000000.jpg', '100000', '2021-06-22 12:47:28', 'AG-8614937', '', '', ''),
(5, 'Samsung', '29287074', 'black', 'samsung s20', 'lorem short description', 'lorem ipsum long description long', '3', '7', 'pro60d1ce26eb2c9000001000.jpg,pro60d1ce26eb814000001000.jpg,pro60d1ce26ebd5c000000100.jpg', '90000', '2021-06-22 12:48:54', 'AG-91933000', '', '', ''),
(6, 'Xaiomi', '37341927', 'red, black', 'xaiomi redmi 6', 'lorem short description', 'lorem ipsum long description long', '3', '7', 'pro60d1ce643456c000000001.jpg,pro60d1ce6434af9001000000.jpg', '90000', '2021-06-22 12:49:56', 'AG-93843232', '', '', ''),
(7, 'HP', '19678428', 'silver', 'HP laptop envy', 'lorem short description', 'lorem ipsum long description long', '8', '12', 'pro60d1d058e959f000001000.jpg,pro60d1d058e9aa7000100000.jpg,pro60d1d058e9f8a000001000.jpg', '90000', '2021-06-22 12:58:16', 'AG-60722385', '', '', ''),
(8, 'Lenovo', '55860887', 'silver', 'Silver m4', 'lorem short description', 'lorem ipsum long description long', '8', '12', 'pro60d1d0843ccb5000010000.jpg,pro60d1d0843d251010000000.jpg,pro60d1d0843d76c000010000.jpg', '70000', '2021-06-22 12:59:00', 'AG-90470554', '', '', ''),
(9, 'Apple', '36376549', 'silver', 'macbook pro', 'lorem short description', 'lorem ipsum long description long', '8', '12', 'pro60d1d0cf8926e000001000.jpg,pro60d1d0cf89786010000000.jpg,pro60d1d0cf89bd0000100000.jpg', '70000', '2021-06-22 13:00:15', 'AG-42990797', '', '', ''),
(10, 'Apple', '78518873', 'black', 'Apple desktop', 'lorem short description', 'lorem ipsum long description long', '8', '12', 'pro60d1d12697b21100000000.jpg', '70000', '2021-06-22 13:01:42', 'AG-79974221', '', '', ''),
(11, 'Xaiomi', '30645954', 'black', 'Xaiomi headset', 'lorem short description', 'lorem ipsum long description long', '8', '19', 'pro60d1d1cfee06e100000000.jpg', '70000', '2021-06-22 13:04:31', 'AG-19693443', '', '', ''),
(12, 'Beats by Dre', '83291175', 'black, red', 'Headset', 'lorem short description', 'lorem ipsum long description long', '8', '19', 'pro60d1d24460ce9000000100.jpg,pro60d1d2446126b001000000.jpg', '8000', '2021-06-22 13:06:28', 'AG-7748728', '', '', ''),
(13, 'Beats by Dre', '55598537', 'black, red', 'Headset', 'lorem short description', 'lorem ipsum long description long', '8', '19', 'pro60d1d286d5ee6000001000.jpg,pro60d1d286d63f7000010000.jpg', '8000', '2021-06-22 13:07:34', 'AG-79867936', '', '', ''),
(14, 'Airpods', '57247936', 'white', 'Headset', 'lorem short description', 'lorem ipsum long description long', '3', '10', 'pro60d1d53f72083000100000.jpg', '80000', '2021-06-22 13:19:11', 'AG-67980776', '', '', ''),
(15, 'Apple', '3875669', 'white', 'airpod max', 'lorem short description', 'lorem ipsum long description long', '8', '19', 'pro60d1d5bea2bcf001000000.jpg', '80000', '2021-06-22 13:21:18', 'AG-67743888', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `product_cart`
--

CREATE TABLE `product_cart` (
  `id` bigint(20) NOT NULL,
  `product_code` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `date_added` datetime NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` bigint(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `customer_id` varchar(255) NOT NULL,
  `rating_score` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_id` bigint(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_id`, `parent_id`, `title`, `address`, `image`, `status`) VALUES
(7, 3, 'Mobile Phones', '', 'mobile.png', 1),
(8, 3, 'Smart Watches & Trackers', '', '', 1),
(9, 3, 'Tablets', '', 'tablet.png', 1),
(10, 3, 'Phone and Tablet Accessories', '', '', 1),
(11, 3, 'Phone & Tablet Parts', '', 'computer-repair.png', 1),
(12, 8, 'Laptops & Computers', '', 'laptop.png', 1),
(13, 8, 'Accessories & Supplies For Electronics', '', '', 1),
(14, 8, 'TV and DVD Equipments', '', 'tv.png', 1),
(15, 8, 'Audio & Music Equipments', '', 'audio.png', 1),
(16, 8, 'Video Equipments', '', 'video.png', 1),
(17, 8, 'Computer & Laptop Accessories', '', 'webcam.png', 1),
(18, 8, 'Computer Hardwares', '', 'computer-parts.png', 1),
(19, 8, 'Headphones', '', 'headset.png', 1),
(20, 8, 'Networking Products & Equipments', '', 'network.png', 1),
(21, 8, 'Photo & Video Cameras', '', 'camera.png', 1),
(22, 8, 'Printers & Scanners', '', 'printers.png', 1),
(23, 8, 'Security Survellance', '', 'security.png', 1),
(24, 8, 'Video Game Consoles', '', 'games-console,png', 1),
(25, 8, 'Softwares', '', '', 1),
(26, 8, 'Game Softwares', '', '', 1),
(27, 1, 'Cars', '', 'car2.png', 1),
(28, 1, 'Buses & Microbuses', '', 'bus.png', 1),
(29, 1, 'Heavy Equipments', '', 'heavy.png', 1),
(30, 1, 'Motorcycles & Scooters', '', 'motorcycle.png', 1),
(31, 1, 'Vehicle Parts & Accessories', '', '', 1),
(32, 1, 'Trucks & Trailers', '', 'trucks.png', 1),
(33, 1, 'Motorcycle & Scooter Parts, Accessories', '', 'motorcycle.png', 1),
(34, 1, 'Boats ', '', '', 1),
(35, 5, 'Women Bags', '', '', 1),
(36, 5, 'Women Clothing', '', '', 1),
(37, 5, 'Women Clothing Accessories', '', '', 1),
(38, 5, 'Jewelry', '', '', 1),
(39, 5, 'Women Shoes', '', '', 1),
(40, 5, 'Watches', '', '', 1),
(41, 5, 'Wedding Wears & Accessories', '', '', 1),
(42, 2, 'House & Apartments For Rent', '', '', 1),
(43, 2, 'House & Apartments For Sale', '', '', 1),
(44, 2, 'Lands & Plots For Sale', '', '', 1),
(45, 2, 'Lands & Plots For Rent', '', '', 1),
(46, 2, 'Commercial Properties For Sale', '', '', 1),
(47, 2, 'Commercial Properties For Rent', '', '', 1),
(48, 2, 'Event Centres & Venues For Rent', '', '', 1),
(49, 2, 'Short Lets', '', '', 1),
(50, 9, 'Furniture', '', 'furniture.png', 1),
(51, 9, 'Garden', '', '', 1),
(52, 9, 'Home Appliances', '', '', 1),
(53, 9, 'Kitchen Appliances', '', '', 1),
(54, 9, 'Kitchen & Dining', '', '', 1),
(55, 9, 'Home Accessories', '', '', 1),
(56, 5, 'Men Clothing', '', '', 1),
(57, 5, 'Clothing Accessories', '', '', 1),
(58, 5, 'Men Shoes', '', '', 1),
(59, 5, 'Men Bags', '', '', 1),
(60, 12, 'Bath & Body', '', '', 1),
(61, 12, 'Fragrance', '', '', 1),
(62, 12, 'Hair Beauty', '', '', 1),
(63, 12, 'Makeup', '', '', 1),
(64, 12, 'Sexual Wellness', '', '', 1),
(65, 12, 'Skin Care', '', '', 1),
(66, 12, 'Tobacco Accessories', '', '', 1),
(67, 12, 'Tools & Accessories', '', '', 1),
(68, 12, 'Vitamins & Supplements', '', '', 1),
(69, 17, 'Arts & Craft', '', '', 1),
(70, 17, 'Books & Games', '', '', 1),
(71, 17, 'Camping Gear', '', '', 1),
(72, 17, 'CDs & DVDs', '', '', 1),
(73, 17, 'Musical Instruments & Gear', '', '', 1),
(74, 17, 'Sports Equipment', '', '', 1),
(75, 16, 'Babies & Kids Accessories', '', '', 1),
(76, 16, 'Baby & Child Care', '', '', 1),
(77, 16, 'Children\'s Clothing', '', '', 1),
(78, 16, 'Children\'s Furniture', '', '', 1),
(79, 16, 'Children\'s Gear & Safety', '', '', 1),
(80, 16, 'Children\'s Shoes', '', '', 1),
(81, 16, 'Maternity & Pregnancy', '', '', 1),
(82, 16, 'Prams & Strollers', '', '', 1),
(83, 16, 'Toys', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
<<<<<<< HEAD
  `first_name` tinytext NOT NULL,
  `last_name` tinytext NOT NULL,
=======
  `fullname` tinytext NOT NULL,
>>>>>>> f15f13677480791ef4b920eee340834fee3baee4
  `gender` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `address` tinytext NOT NULL,
  `state` tinytext NOT NULL,
  `country` tinytext NOT NULL,
  `whatsapp` varchar(25) NOT NULL,
  `mobile1` varchar(25) NOT NULL,
<<<<<<< HEAD
=======
  `seller` int(11) NOT NULL DEFAULT '0',
  `seller_id` varchar(25) NOT NULL,
>>>>>>> f15f13677480791ef4b920eee340834fee3baee4
  `account_type` int(11) NOT NULL,
  `image` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  `token` tinytext NOT NULL,
  `last_login` datetime NOT NULL,
  `signup_date` date NOT NULL,
  `user_confirm_id` varchar(25) NOT NULL,
  `user_recover_id` varchar(15) NOT NULL,
  `activated` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

<<<<<<< HEAD
INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `phone`, `address`, `state`, `country`, `whatsapp`, `mobile1`, `account_type`, `image`, `password`, `token`, `last_login`, `signup_date`, `user_confirm_id`, `user_recover_id`, `activated`, `status`) VALUES
(1, 'Clement', 'Abel', 'Male', 'test2@test.com', '07060678275', 'Karu Abuja ', 'Delta', '', '', '', 2, 'public/images/uploads/profile_images/default_avatar.jpg', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '1c5765a6d563dbef92967a5865beca3b456e675eba4d802bfac93a1e5abaf3c14095fa78255e1629b343ef456dd4c55ca3b3968b94b154f26ba4b16a1d49f578', '2021-04-14 03:09:25', '2019-09-12', '58642', '388967', 1, 1),
(38, 'John', 'Doe', 'Male', 'test@test.com', '07060678275', 'Karu Abuja', 'Fct', '', '', '', 1, 'public/images/uploads/profile_images/default_avatar.jpg', '$2y$10$KDrBTneo/7jCyLGcd6exr.9ZO7Y8FKPPezs1G/lcy2NMaToBfBldu', 'a4f6212765e6a42f595b1cc6e65b5c51779bf4805469952152737e4bb68cc32f9f03d5279dab3edda3862f42c1c314016cd56dc916b32ae9c33a75e8169f97ab', '2021-06-16 21:42:43', '2020-04-29', '63258', '', 1, 1),
(39, 'Sunday', 'Sunday', 'Male', 'test3@test.com', '0703300000', 'address', '', 'Nigeria', '', '', 3, 'public/images/uploads/profile_images/default_avatar.jpg', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '5f5833dcfb04705fb94237628ada4c953d134c756694b1b204cbc3adf50a6b3a388fc690b53468d682c365bac2ab4ec4b4d900fa11f39bfc130049f0b86c7203', '2021-04-12 15:02:15', '0000-00-00', '', '', 1, 1),
(40, 'George', 'Friday', '2', 'directorate@test.com', '0703300000', '', '37', '', '', '', 1, 'public/images/uploads/profile_images/default_avatar.jpg', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'df7c9ee838f7f1a0cd60c1d9436033c31544e39196f515b622f3d3f3a72639d6fe89548f67f11e9fe588659e1cd7bd1eef0d1230d586a6a918e5afde71ded70f', '2021-04-12 15:35:33', '0000-00-00', '', '', 1, 1);
=======
INSERT INTO `users` (`id`, `fullname`, `gender`, `email`, `phone`, `address`, `state`, `country`, `whatsapp`, `mobile1`, `seller`, `seller_id`, `account_type`, `image`, `password`, `token`, `last_login`, `signup_date`, `user_confirm_id`, `user_recover_id`, `activated`, `status`) VALUES
(1, 'Michael Akpobome', 'Male', 'mike98989@gmail.com', '07060678275', 'Karu Abuja ', 'Delta', '', '', '', 1, 'AG-8614937', 2, 'default.png', '$2y$10$cdsQoJrHlQ6G5fXxhcbUo.r2Q3AAGIcit603WthEGFHGtRxIA9c32', '4c44184594184df4659f56ca4d1c5e2a43582f3641dfea4214dbe83169050ab03332d9457f66d0ac8c755cf9fe863e1cc586920987fc1bc6fa243e2f99359603', '2021-06-23 22:45:41', '2019-09-12', '58642', '1341', 1, 1),
(38, 'John Doe', 'Male', 'test@test.com', '08174077714', 'Karu Abuja', 'Fct', '', '', '', 1, 'AG-91933000', 1, 'default2.png', '$2y$10$KDrBTneo/7jCyLGcd6exr.9ZO7Y8FKPPezs1G/lcy2NMaToBfBldu', 'a4f6212765e6a42f595b1cc6e65b5c51779bf4805469952152737e4bb68cc32f9f03d5279dab3edda3862f42c1c314016cd56dc916b32ae9c33a75e8169f97ab', '2021-06-16 21:42:43', '2020-04-29', '63258', '', 1, 1),
(39, 'Sunday', 'Male', 'test3@test.com', '0703300000', 'address', '', 'Nigeria', '', '', 0, '', 3, 'default.png', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '5f5833dcfb04705fb94237628ada4c953d134c756694b1b204cbc3adf50a6b3a388fc690b53468d682c365bac2ab4ec4b4d900fa11f39bfc130049f0b86c7203', '2021-04-12 15:02:15', '0000-00-00', '', '', 1, 1),
(40, 'George', '2', 'directorate@test.com', '0703300000', '', '37', '', '', '', 0, '', 1, 'default.png', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'df7c9ee838f7f1a0cd60c1d9436033c31544e39196f515b622f3d3f3a72639d6fe89548f67f11e9fe588659e1cd7bd1eef0d1230d586a6a918e5afde71ded70f', '2021-04-12 15:35:33', '0000-00-00', '', '', 1, 1);
>>>>>>> f15f13677480791ef4b920eee340834fee3baee4

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
-- Indexes for table `product_cart`
--
ALTER TABLE `product_cart`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

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
<<<<<<< HEAD
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
=======
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
>>>>>>> f15f13677480791ef4b920eee340834fee3baee4

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `product_cart`
--
ALTER TABLE `product_cart`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seller_ratings`
--
ALTER TABLE `seller_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
<<<<<<< HEAD
COMMIT;
=======
>>>>>>> f15f13677480791ef4b920eee340834fee3baee4

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
