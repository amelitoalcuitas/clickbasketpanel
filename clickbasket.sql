-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 08, 2017 at 03:36 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clickbasket`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_deleted` enum('true','false') NOT NULL DEFAULT 'false',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_deleted`, `date_created`, `date_modified`) VALUES
(1, 'Fresh Vegetable', 'false', '2017-03-01 02:03:33', '2017-03-01 02:03:33'),
(2, 'Fruits', 'false', '2017-03-01 02:14:03', '2017-03-01 02:14:03'),
(3, 'Breakfast', 'false', '2017-03-01 02:26:48', '2017-03-01 02:26:48'),
(4, 'Beverages', 'false', '2017-03-01 02:33:06', '2017-03-01 02:33:06'),
(5, 'Fruits', 'false', '2017-03-01 23:17:10', '2017-03-01 23:17:10'),
(6, 'Foods', 'false', '2017-03-01 23:22:30', '2017-03-01 23:22:30'),
(7, 'Toiletries', 'false', '2017-03-02 12:26:08', '2017-03-02 12:26:08'),
(8, 'Dairy', 'false', '2017-03-02 12:48:00', '2017-03-02 12:48:00'),
(9, 'Fresh Meat', 'false', '2017-03-02 13:07:51', '2017-03-02 13:07:51'),
(10, 'Snacks', 'false', '2017-03-02 15:19:08', '2017-03-02 15:19:08'),
(11, 'Toiletries', 'false', '2017-03-02 15:23:16', '2017-03-02 15:23:16'),
(12, 'Vegetables', 'false', '2017-03-02 15:28:38', '2017-03-02 15:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `consumers`
--

CREATE TABLE `consumers` (
  `consumer_id` int(11) NOT NULL,
  `consumer_fname` varchar(55) NOT NULL,
  `consumer_lname` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `mobilenumber` varchar(15) NOT NULL,
  `consumer_password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumers`
--

INSERT INTO `consumers` (`consumer_id`, `consumer_fname`, `consumer_lname`, `email`, `mobilenumber`, `consumer_password`, `date_created`, `date_modified`) VALUES
(1, 'Louis Marcel', 'Tan', 'macsho2008@yahoo.com', '09339885822', '65d84dcc14737879f68112a9a59d8436', '2017-03-01 02:56:00', '2017-03-01 02:56:00'),
(2, 'Mac', 'Macmac', 'ym@yahoo.com', '112345678908765', '7f8c1209be0fd9c8a9cb118a51472aba', '2017-03-02 02:54:00', '2017-03-02 14:55:04'),
(3, 'Adrian Kim', 'Dy', 'kibsimba22@gmail.com', '09279782350', '4731cfcddbc6b275775929a6c2210e32', '2017-03-02 11:09:00', '2017-03-02 11:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `consumers_address`
--

CREATE TABLE `consumers_address` (
  `building_name` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `floorunitroom_num` varchar(255) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `postcode` int(11) NOT NULL,
  `instructions` varchar(255) DEFAULT NULL,
  `consumer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consumers_address`
--

INSERT INTO `consumers_address` (`building_name`, `street_name`, `floorunitroom_num`, `city_name`, `postcode`, `instructions`, `consumer_id`) VALUES
('941 - 5 Boy Isidro Building', 'Gov. M. Cuenco Ave.', 'Room 7', 'Cebu City', 6000, 'hello', 1),
('8', '1234', '1', 'Cebu', 182371293, NULL, 2),
('25', 'Paseo John', 'G. Floor', 'Banilad, Cebu City', 6000, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupons_id` int(11) NOT NULL,
  `coupons_code` varchar(255) NOT NULL,
  `coupons_description` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notif_id` int(11) NOT NULL,
  `notif_title` varchar(255) NOT NULL,
  `status` enum('read','unread') NOT NULL DEFAULT 'unread',
  `notif_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `store_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_status` enum('pending','processing','completed','declined','cancelled') NOT NULL DEFAULT 'pending',
  `decline_reason` varchar(255) DEFAULT NULL,
  `order_subtotal` float(11,2) NOT NULL,
  `order_vat` float(11,2) NOT NULL,
  `grandtotal` float(11,2) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `consumer_id` int(11) NOT NULL,
  `coupons_id` int(11) DEFAULT NULL,
  `eta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_status`, `decline_reason`, `order_subtotal`, `order_vat`, `grandtotal`, `date_created`, `date_modified`, `consumer_id`, `coupons_id`, `eta`) VALUES
(1, 'cancelled', 'Too expensive', 633.60, 86.40, 720.00, '2017-03-02 16:20:37', '2017-03-03 02:36:53', 1, 3, '2017-03-08 16:20:00'),
(2, 'pending', NULL, 238.48, 32.52, 271.00, '2017-03-02 23:07:50', '2017-03-02 23:07:50', 1, 3, '2017-03-06 22:30:00'),
(3, 'pending', NULL, 627.97, 85.63, 713.60, '2017-03-02 23:17:07', '2017-03-02 23:17:07', 3, 3, '2017-03-07 17:00:00'),
(4, 'pending', NULL, 444.40, 60.60, 505.00, '2017-03-02 23:19:26', '2017-03-02 23:19:26', 1, 3, '2017-03-06 10:00:00'),
(5, 'cancelled', 'No more budget', 198.53, 27.07, 225.60, '2017-03-02 23:28:32', '2017-03-02 23:34:30', 3, 3, '2017-03-14 11:27:00'),
(6, 'pending', NULL, 281.60, 38.40, 320.00, '2017-03-02 23:34:01', '2017-03-02 23:34:01', 3, 3, '2017-03-04 11:33:00'),
(7, 'cancelled', 'Wrong Order', 264.00, 36.00, 300.00, '2017-03-03 00:13:40', '2017-03-03 00:16:25', 3, 3, '2017-03-04 00:13:00'),
(8, 'pending', NULL, 352.00, 48.00, 400.00, '2017-03-03 00:17:19', '2017-03-03 00:17:19', 3, NULL, '2017-03-04 00:17:00'),
(9, 'pending', NULL, 250.45, 34.15, 284.60, '2017-03-03 11:35:52', '2017-03-03 11:35:52', 1, 2, '2017-03-06 11:30:00'),
(10, 'pending', NULL, 250.45, 34.15, 284.60, '2017-03-03 11:37:24', '2017-03-03 11:37:24', 1, 2, '2017-03-06 11:00:00'),
(11, 'pending', NULL, 250.45, 34.15, 284.60, '2017-03-03 11:38:27', '2017-03-03 11:38:27', 1, 2, '2017-03-06 11:00:00'),
(18, 'pending', NULL, 265.76, 36.24, 302.00, '2017-03-03 12:09:53', '2017-03-03 12:09:53', 1, 2, '2017-03-06 12:09:00'),
(19, 'pending', NULL, 737.44, 100.56, 838.00, '2017-03-03 12:13:38', '2017-03-03 12:13:38', 1, NULL, '2017-03-06 12:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `orders_store_products`
--

CREATE TABLE `orders_store_products` (
  `order_id` int(11) NOT NULL,
  `storeprodsub_id` int(11) NOT NULL,
  `order_qty` int(11) NOT NULL,
  `product_price` float(11,2) NOT NULL,
  `product_total` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_store_products`
--

INSERT INTO `orders_store_products` (`order_id`, `storeprodsub_id`, `order_qty`, `product_price`, `product_total`) VALUES
(1, 12, 6, 150.00, 900.00),
(2, 7, 4, 50.00, 200.00),
(2, 36, 2, 35.50, 71.00),
(3, 13, 4, 100.00, 400.00),
(3, 17, 4, 50.00, 200.00),
(3, 36, 4, 35.50, 142.00),
(4, 3, 5, 20.50, 102.50),
(4, 15, 5, 80.50, 402.50),
(5, 33, 4, 70.50, 282.00),
(6, 30, 2, 200.00, 400.00),
(7, 13, 3, 100.00, 300.00),
(8, 13, 4, 100.00, 400.00),
(10, 37, 4, 50.50, 202.00),
(11, 37, 4, 50.50, 202.00),
(18, 36, 5, 35.50, 177.50),
(18, 30, 1, 200.00, 200.00),
(19, 37, 4, 50.50, 202.00),
(19, 52, 4, 159.00, 636.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_desc` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `prod_name`, `prod_desc`, `date_created`) VALUES
(1, 'Cabbage', 'Healthy is good', '2017-03-01 02:06:15'),
(2, 'Sweet Corn', 'Healthy is good', '2017-03-01 02:11:04'),
(3, 'Tomato', 'Healthy is good', '2017-03-01 02:11:04'),
(4, 'Potato', 'Healthy is good', '2017-03-01 02:11:05'),
(5, 'Egg Plant', 'Healthy is good', '2017-03-01 02:11:05'),
(6, 'Apple', 'Good for the health', '2017-03-01 02:17:14'),
(7, 'Pineapple', 'Good for the health\n', '2017-03-01 02:17:14'),
(8, 'Orange', 'Good for the health', '2017-03-01 02:17:14'),
(9, 'Banana', 'Good for the health', '2017-03-01 02:17:15'),
(10, 'Grapes', 'Good for the health', '2017-03-01 02:17:15'),
(11, 'Koko Krunch', 'Good for the health', '2017-03-01 02:31:14'),
(12, 'Honey Stars', 'Good for the health', '2017-03-01 02:31:15'),
(13, 'Corn Flakes', 'Good for the health', '2017-03-01 02:31:15'),
(14, 'Cookie Crisp', 'Good for the health', '2017-03-01 02:31:15'),
(15, 'Fitnesses', 'Good for the health\n', '2017-03-01 02:31:16'),
(16, 'Coca Cola', 'Beat the thirst', '2017-03-01 02:37:09'),
(17, 'Pepsi', 'Beat the thirst', '2017-03-01 02:37:09'),
(18, 'Mountain Dew', 'Beat the thirst', '2017-03-01 02:37:09'),
(19, 'Sprite', 'Beat the thirst', '2017-03-01 02:37:10'),
(20, 'Royal', 'Beat the thirst', '2017-03-01 02:37:10'),
(21, 'Apple', 'Red Apple', '2017-03-01 23:17:47'),
(22, 'Koko Krunch', 'Chocolate crisps', '2017-03-01 23:23:05'),
(23, 'Trix', 'Start the morning with a good breakfast meal!', '2017-03-02 12:20:50'),
(24, 'Frosted Flakes', 'Start the morning with a good breakfast meal!', '2017-03-02 12:20:50'),
(25, 'Apple Jacks', 'Start the morning with a good breakfast meal!', '2017-03-02 12:20:51'),
(26, 'Corn Flakes', 'Start the morning with a good breakfast meal!', '2017-03-02 12:20:51'),
(27, 'Palmolive', 'Smooth and Straight for your healthy hair', '2017-03-02 12:31:23'),
(28, 'Clear For Men', 'Smooth and Straight for your healthy hair', '2017-03-02 12:32:53'),
(29, 'L OREAL', 'Smooth and Straight for your healthy hair', '2017-03-02 12:37:56'),
(30, 'Dove Conditioner', 'Smooth and Straight for your healthy hair', '2017-03-02 12:38:27'),
(31, 'Cream Silk', 'Smooth and Straight for your healthy hair', '2017-03-02 12:38:54'),
(32, 'Dari Cream', 'Mix your delightful ingredients with fresh and healthy ', '2017-03-02 12:57:04'),
(33, 'Eggs', 'Mix your delightful ingredients with fresh and healthy \n', '2017-03-02 12:57:07'),
(34, 'Fresh Milk', 'Mix your delightful ingredients with fresh and healthy ', '2017-03-02 12:57:08'),
(35, 'Gardenia Slice Bread', 'Mix your delightful ingredients with fresh and healthy ', '2017-03-02 12:57:09'),
(36, 'Eden Cheese', 'Mix your delightful ingredients with fresh and healthy ', '2017-03-02 12:57:10'),
(67, 'Thigh', 'Fresh Chicken for you', '2017-03-02 13:16:10'),
(68, 'Breast', 'Fresh Chicken for you\n', '2017-03-02 13:17:48'),
(69, 'Drumstick', 'Fresh Chicken for you', '2017-03-02 13:17:48'),
(70, 'Neck', 'Fresh Chicken for you', '2017-03-02 13:17:49'),
(71, 'Back', 'Fresh Chicken for you', '2017-03-02 13:17:49'),
(72, 'Test Product', 'Test Desc\n', '2017-03-02 14:51:09'),
(73, 'Test2', 'test', '2017-03-02 14:58:41'),
(74, 'test33', 'wew', '2017-03-02 14:59:44'),
(75, 'Banana', 'Fruits are delicious and sweet! ', '2017-03-02 15:18:36'),
(76, 'Grapes', 'Fruits are delicious and sweet! ', '2017-03-02 15:18:37'),
(77, 'Pineapple', 'Fruits are delicious and sweet! ', '2017-03-02 15:18:37'),
(78, 'Orange', 'Fruits are delicious and sweet! ', '2017-03-02 15:18:37'),
(79, 'Vcut', 'Take a break have a snack!', '2017-03-02 15:21:31'),
(80, 'Piatos', 'Take a break have a snack!', '2017-03-02 15:21:31'),
(81, 'Mr Chips', 'Take a break have a snack!', '2017-03-02 15:21:32'),
(82, 'Dove Conditioner', 'Make your hair smooth and beautiful! ', '2017-03-02 15:27:46'),
(83, 'Clear For Men', 'Make your hair smooth and beautiful! ', '2017-03-02 15:27:47'),
(84, 'Cream Silk', 'Make your hair smooth and beautiful! ', '2017-03-02 15:27:47'),
(85, 'Loreal', 'Make your hair smooth and beautiful! ', '2017-03-02 15:27:47'),
(86, 'Palmolive', 'Make your hair smooth and beautiful! ', '2017-03-02 15:27:48'),
(87, 'Sweet Corn', 'Eat Health, Live Freely!', '2017-03-02 15:31:34'),
(88, 'Cabbage', 'Eat Health, Live Freely!', '2017-03-02 15:31:34'),
(89, 'Egg Plant', 'Eat Health, Live Freely!', '2017-03-02 15:31:34'),
(90, 'Potato', 'Eat Health, Live Freely!', '2017-03-02 15:31:35'),
(91, 'Tomato', 'Eat Health, Live Freely!', '2017-03-02 15:31:35');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_address` varchar(255) NOT NULL,
  `store_branch` varchar(255) NOT NULL,
  `store_days` varchar(255) NOT NULL,
  `time_open` time NOT NULL,
  `time_close` time NOT NULL,
  `store_deleted` enum('true','false') NOT NULL DEFAULT 'false',
  `store_image` varchar(255) NOT NULL DEFAULT 'store_image_def.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `store_name`, `store_address`, `store_branch`, `store_days`, `time_open`, `time_close`, `store_deleted`, `store_image`) VALUES
(1, 'Sm SuperMarket', 'Cebu City', 'Mabolo', 'Everyday', '08:00:00', '22:00:00', 'false', 'store_image_479360166.png'),
(2, 'Robinson SuperMarket', 'Cebu City', 'Banilad', 'Everyday', '10:00:00', '22:00:00', 'false', 'store_image_1679045347.png'),
(3, 'Gaisano Country Mall', 'Cebu City', 'Banilad', 'Everyday', '09:00:00', '22:00:00', 'false', 'store_image_561520719.png');

-- --------------------------------------------------------

--
-- Table structure for table `store_category`
--

CREATE TABLE `store_category` (
  `store_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_category`
--

INSERT INTO `store_category` (`store_id`, `category_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(2, 10),
(2, 11),
(2, 12);

-- --------------------------------------------------------

--
-- Table structure for table `store_coupons`
--

CREATE TABLE `store_coupons` (
  `storecoupon_id` int(11) NOT NULL,
  `coupondiscount_type` enum('percentage','amount') NOT NULL,
  `coupons_discount` float(11,2) NOT NULL,
  `coupons_max` int(11) NOT NULL,
  `coupons_status` enum('new','add','extend') NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `coupons_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_coupons_discounts`
--

CREATE TABLE `store_coupons_discounts` (
  `storecoupon_id` int(11) NOT NULL,
  `consumer_id` int(11) NOT NULL,
  `coupons_use` enum('true','false') NOT NULL DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_products`
--

CREATE TABLE `store_products` (
  `storeprod_id` int(11) NOT NULL,
  `storeprod_price` float(11,2) NOT NULL,
  `storeprod_deleted` enum('true','false') NOT NULL DEFAULT 'false',
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `prod_id` int(11) NOT NULL,
  `storeprod_image` varchar(255) NOT NULL DEFAULT 'prod_image_def.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_products`
--

INSERT INTO `store_products` (`storeprod_id`, `storeprod_price`, `storeprod_deleted`, `date_modified`, `prod_id`, `storeprod_image`) VALUES
(1, 25.50, 'false', '2017-03-01 02:38:35', 1, 'prod_image_738552780.jpg'),
(2, 25.50, 'false', '2017-03-01 02:58:10', 2, 'prod_image_388377490.jpg'),
(3, 20.50, 'false', '2017-03-01 02:58:30', 3, 'prod_image_519401043.jpg'),
(4, 15.50, 'false', '2017-03-01 02:58:58', 4, 'prod_image_1558541108.jpg'),
(5, 15.50, 'false', '2017-03-01 02:58:43', 5, 'prod_image_611139810.jpg'),
(6, 12.50, 'false', '2017-03-01 02:24:52', 6, 'prod_image_79531966.png'),
(7, 50.00, 'false', '2017-03-01 02:25:33', 7, 'prod_image_1635505453.jpg'),
(8, 10.50, 'false', '2017-03-01 02:25:20', 8, 'prod_image_1447300275.jpg'),
(9, 10.50, 'false', '2017-03-01 02:25:05', 9, 'prod_image_1341016942.jpg'),
(10, 20.00, 'false', '2017-03-01 02:55:06', 10, 'prod_image_1475885249.jpg'),
(11, 99.50, 'false', '2017-03-01 02:48:30', 11, 'prod_image_542482340.jpeg'),
(12, 150.00, 'false', '2017-03-01 02:54:37', 12, 'prod_image_749161840.jpg'),
(13, 100.00, 'false', '2017-03-01 02:54:15', 13, 'prod_image_762770235.jpg'),
(14, 99.50, 'false', '2017-03-01 02:46:33', 14, 'prod_image_839523864.jpg'),
(15, 80.50, 'false', '2017-03-01 02:48:49', 15, 'prod_image_1768779222.jpg'),
(16, 50.00, 'false', '2017-03-01 02:51:06', 16, 'prod_image_1888803179.jpg'),
(17, 50.00, 'false', '2017-03-01 02:52:04', 17, 'prod_image_1931530220.jpg'),
(18, 50.50, 'false', '2017-03-01 02:49:43', 18, 'prod_image_2070456821.jpg'),
(19, 50.50, 'false', '2017-03-01 02:50:35', 19, 'prod_image_755830794.jpg'),
(20, 50.00, 'false', '2017-03-01 02:53:00', 20, 'prod_image_1759278468.jpg'),
(21, 15.50, 'false', '2017-03-02 12:36:26', 21, 'prod_image_693185987.jpeg'),
(22, 150.00, 'false', '2017-03-01 23:23:30', 22, 'prod_image_1185237032.jpeg'),
(23, 69.50, 'false', '2017-03-02 12:24:14', 23, 'prod_image_1768771566.jpg'),
(24, 70.00, 'false', '2017-03-02 12:24:03', 24, 'prod_image_1802368658.jpg'),
(25, 65.50, 'false', '2017-03-02 12:23:40', 25, 'prod_image_960152751.jpg'),
(26, 60.00, 'false', '2017-03-02 12:23:53', 26, 'prod_image_1361614932.jpg'),
(27, 178.00, 'false', '2017-03-02 12:47:01', 27, 'prod_image_1271542316.jpg'),
(28, 157.00, 'false', '2017-03-02 12:45:24', 28, 'prod_image_313498749.jpg'),
(29, 200.00, 'false', '2017-03-02 12:37:56', 29, 'prod_image_def.jpg'),
(30, 200.00, 'false', '2017-03-02 12:46:45', 30, 'prod_image_600754718.JPG'),
(31, 156.50, 'false', '2017-03-02 12:46:29', 31, 'prod_image_2142783033.jpg'),
(32, 40.50, 'false', '2017-03-02 13:05:46', 32, 'prod_image_2016147808.jpg'),
(33, 70.50, 'false', '2017-03-02 13:06:12', 33, 'prod_image_1394740213.jpg'),
(34, 80.50, 'false', '2017-03-02 13:06:23', 34, 'prod_image_2029805026.jpg'),
(35, 50.50, 'false', '2017-03-02 13:06:44', 35, 'prod_image_779740477.jpg'),
(36, 35.50, 'false', '2017-03-02 13:05:58', 36, 'prod_image_1177980234.jpg'),
(37, 50.50, 'false', '2017-03-02 15:15:25', 67, 'prod_image_75885657.jpg'),
(38, 80.75, 'false', '2017-03-02 15:14:22', 68, 'prod_image_2055580510.jpg'),
(39, 45.50, 'false', '2017-03-02 15:14:36', 69, 'prod_image_1448521933.jpg'),
(40, 30.75, 'false', '2017-03-02 15:14:54', 70, 'prod_image_1995432182.jpg'),
(41, 40.00, 'false', '2017-03-02 15:12:58', 71, 'prod_image_524950753.jpg'),
(42, 20.00, 'false', '2017-03-02 14:51:10', 72, 'prod_image_def.jpg'),
(43, 20.00, 'false', '2017-03-02 14:58:42', 73, 'prod_image_def.jpg'),
(44, 3.00, 'false', '2017-03-02 14:59:44', 74, 'prod_image_def.jpg'),
(45, 30.00, 'false', '2017-03-02 15:31:58', 75, 'prod_image_2017448508.jpg'),
(46, 25.50, 'false', '2017-03-02 15:36:08', 76, 'prod_image_858264135.jpg'),
(47, 50.50, 'false', '2017-03-02 15:18:37', 77, 'prod_image_def.jpg'),
(48, 30.50, 'false', '2017-03-02 15:37:27', 78, 'prod_image_1410779633.jpg'),
(49, 24.00, 'false', '2017-03-02 15:39:09', 79, 'prod_image_648759970.jpg'),
(50, 25.50, 'false', '2017-03-02 15:38:03', 80, 'prod_image_1362503551.png'),
(51, 20.00, 'false', '2017-03-02 15:36:59', 81, 'prod_image_506637593.JPG'),
(52, 159.00, 'false', '2017-03-02 15:33:00', 82, 'prod_image_1336952832.JPG'),
(53, 125.00, 'false', '2017-03-02 15:32:28', 83, 'prod_image_843598136.jpg'),
(54, 124.00, 'false', '2017-03-02 15:32:45', 84, 'prod_image_932438819.jpg'),
(55, 199.00, 'false', '2017-03-02 15:36:28', 85, 'prod_image_1177688991.jpg'),
(56, 99.00, 'false', '2017-03-02 15:37:41', 86, 'prod_image_1245683504.jpg'),
(57, 30.00, 'false', '2017-03-02 15:38:22', 87, 'prod_image_755044297.jpg'),
(58, 40.00, 'false', '2017-03-02 15:32:13', 88, 'prod_image_934370556.jpg'),
(59, 25.00, 'false', '2017-03-02 15:33:14', 89, 'prod_image_1087793888.jpg'),
(60, 20.50, 'false', '2017-03-02 15:31:35', 90, 'prod_image_def.jpg'),
(61, 20.75, 'false', '2017-03-02 15:38:45', 91, 'prod_image_124630292.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `store_products_discounts`
--

CREATE TABLE `store_products_discounts` (
  `discount` float(11,2) NOT NULL,
  `discount_type` enum('percentage','amount') NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `storeprod_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_products_discounts`
--

INSERT INTO `store_products_discounts` (`discount`, `discount_type`, `date_start`, `date_end`, `storeprod_id`) VALUES
(50.00, 'percentage', '2017-03-01', '2017-03-03', 1),
(20.00, 'percentage', '2017-03-02', '2017-03-11', 6);

-- --------------------------------------------------------

--
-- Table structure for table `store_products_inventory`
--

CREATE TABLE `store_products_inventory` (
  `inventory_id` int(11) NOT NULL,
  `inventorytrans_type` enum('order','replenish','deplete','declined','cancelled') NOT NULL,
  `trans_quantity` int(11) NOT NULL,
  `inventory_balance` int(11) NOT NULL,
  `storeprod_id` int(11) NOT NULL,
  `date_edited` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_products_inventory`
--

INSERT INTO `store_products_inventory` (`inventory_id`, `inventorytrans_type`, `trans_quantity`, `inventory_balance`, `storeprod_id`, `date_edited`) VALUES
(1, 'replenish', 200, 200, 1, '2017-03-01 02:06:15'),
(2, 'replenish', 200, 200, 2, '2017-03-01 02:11:04'),
(3, 'replenish', 200, 200, 3, '2017-03-01 02:11:05'),
(4, 'replenish', 200, 200, 4, '2017-03-01 02:11:05'),
(5, 'replenish', 200, 200, 5, '2017-03-01 02:11:05'),
(6, 'replenish', 200, 200, 6, '2017-03-01 02:17:14'),
(7, 'replenish', 200, 200, 7, '2017-03-01 02:17:14'),
(8, 'replenish', 200, 200, 8, '2017-03-01 02:17:15'),
(9, 'replenish', 200, 200, 9, '2017-03-01 02:17:15'),
(10, 'replenish', 200, 200, 10, '2017-03-01 02:17:15'),
(11, 'replenish', 200, 200, 11, '2017-03-01 02:31:15'),
(12, 'replenish', 200, 200, 12, '2017-03-01 02:31:15'),
(13, 'replenish', 200, 200, 13, '2017-03-01 02:31:15'),
(14, 'replenish', 200, 200, 14, '2017-03-01 02:31:16'),
(15, 'replenish', 200, 200, 15, '2017-03-01 02:31:16'),
(16, 'replenish', 200, 200, 16, '2017-03-01 02:37:09'),
(17, 'replenish', 200, 200, 17, '2017-03-01 02:37:09'),
(18, 'replenish', 200, 200, 18, '2017-03-01 02:37:10'),
(19, 'replenish', 200, 200, 19, '2017-03-01 02:37:10'),
(20, 'replenish', 200, 200, 20, '2017-03-01 02:37:10'),
(26, 'replenish', 250, 250, 22, '2017-03-01 23:23:05'),
(49, 'order', -2, 198, 1, '2017-03-02 07:51:00'),
(50, 'order', -4, 196, 13, '2017-03-02 10:05:56'),
(51, 'order', -8, 190, 1, '2017-03-02 10:14:07'),
(52, 'order', -4, 196, 18, '2017-03-02 10:14:07'),
(53, 'order', -4, 196, 12, '2017-03-02 10:15:36'),
(54, 'order', -15, 185, 10, '2017-03-02 10:50:33'),
(55, 'order', -13, 187, 5, '2017-03-02 11:17:24'),
(56, 'order', -6, 194, 4, '2017-03-02 11:17:24'),
(57, 'declined', 13, 213, 5, '2017-03-02 12:18:33'),
(58, 'declined', 6, 206, 4, '2017-03-02 12:18:33'),
(59, 'replenish', 200, 200, 23, '2017-03-02 12:20:50'),
(60, 'replenish', 200, 200, 24, '2017-03-02 12:20:51'),
(61, 'replenish', 200, 200, 25, '2017-03-02 12:20:51'),
(62, 'replenish', 200, 200, 26, '2017-03-02 12:20:51'),
(63, 'cancelled', 4, 204, 13, '2017-03-02 12:26:19'),
(64, 'cancelled', 4, 204, 13, '2017-03-02 12:27:18'),
(65, 'cancelled', 4, 204, 18, '2017-03-02 12:28:13'),
(66, 'cancelled', 8, 208, 1, '2017-03-02 12:28:13'),
(67, 'cancelled', 2, 202, 1, '2017-03-02 12:29:27'),
(68, 'replenish', 200, 200, 27, '2017-03-02 12:31:24'),
(69, 'replenish', 200, 200, 28, '2017-03-02 12:32:54'),
(70, 'order', -5, 195, 4, '2017-03-02 12:33:09'),
(71, 'order', -5, 195, 27, '2017-03-02 12:33:09'),
(72, 'cancelled', 5, 205, 4, '2017-03-02 12:33:24'),
(73, 'cancelled', 5, 205, 27, '2017-03-02 12:33:24'),
(74, 'replenish', 200, 200, 21, '2017-03-02 12:36:21'),
(75, 'replenish', 200, 200, 29, '2017-03-02 12:37:56'),
(76, 'replenish', 200, 200, 30, '2017-03-02 12:38:27'),
(77, 'replenish', 200, 200, 31, '2017-03-02 12:38:54'),
(78, 'replenish', 200, 200, 32, '2017-03-02 12:57:07'),
(79, 'replenish', 200, 200, 33, '2017-03-02 12:57:08'),
(80, 'replenish', 200, 200, 34, '2017-03-02 12:57:09'),
(81, 'replenish', 200, 200, 35, '2017-03-02 12:57:09'),
(82, 'replenish', 200, 200, 36, '2017-03-02 12:57:11'),
(83, 'replenish', 200, 200, 37, '2017-03-02 13:16:10'),
(84, 'replenish', 200, 200, 38, '2017-03-02 13:17:48'),
(85, 'replenish', 200, 200, 39, '2017-03-02 13:17:48'),
(86, 'replenish', 200, 200, 40, '2017-03-02 13:17:49'),
(87, 'replenish', 200, 200, 41, '2017-03-02 13:17:49'),
(88, 'order', -23, 177, 1, '2017-03-02 13:46:42'),
(89, 'cancelled', 23, 223, 1, '2017-03-02 13:47:15'),
(90, 'order', -1, 199, 26, '2017-03-02 13:52:39'),
(91, 'order', -3, 197, 33, '2017-03-02 13:52:40'),
(92, 'order', -1, 199, 19, '2017-03-02 13:52:40'),
(93, 'order', -4, 196, 27, '2017-03-02 14:27:46'),
(94, 'replenish', 200, 200, 42, '2017-03-02 14:51:10'),
(95, 'replenish', 20, 220, 42, '2017-03-02 14:56:09'),
(96, 'replenish', 200, 200, 43, '2017-03-02 14:58:42'),
(97, 'replenish', 5, 5, 44, '2017-03-02 14:59:44'),
(98, 'order', -5, 199, 13, '2017-03-02 15:17:17'),
(99, 'order', -5, 194, 13, '2017-03-02 15:18:26'),
(100, 'replenish', 200, 200, 45, '2017-03-02 15:18:37'),
(101, 'replenish', 200, 200, 46, '2017-03-02 15:18:37'),
(102, 'replenish', 200, 200, 47, '2017-03-02 15:18:37'),
(103, 'replenish', 200, 200, 48, '2017-03-02 15:18:37'),
(104, 'cancelled', 5, 205, 13, '2017-03-02 15:20:32'),
(105, 'replenish', 200, 200, 49, '2017-03-02 15:21:31'),
(106, 'replenish', 200, 200, 50, '2017-03-02 15:21:32'),
(107, 'replenish', 200, 200, 51, '2017-03-02 15:21:32'),
(108, 'replenish', 200, 200, 52, '2017-03-02 15:27:46'),
(109, 'replenish', 200, 200, 53, '2017-03-02 15:27:47'),
(110, 'replenish', 200, 200, 54, '2017-03-02 15:27:47'),
(111, 'replenish', 200, 200, 55, '2017-03-02 15:27:48'),
(112, 'replenish', 200, 200, 56, '2017-03-02 15:27:48'),
(113, 'replenish', 200, 200, 57, '2017-03-02 15:31:34'),
(114, 'replenish', 200, 200, 58, '2017-03-02 15:31:34'),
(115, 'replenish', 200, 200, 59, '2017-03-02 15:31:35'),
(116, 'replenish', 200, 200, 60, '2017-03-02 15:31:35'),
(117, 'replenish', 200, 200, 61, '2017-03-02 15:31:35'),
(118, 'order', -3, 197, 28, '2017-03-02 15:35:30'),
(119, 'order', -3, 196, 26, '2017-03-02 15:35:30'),
(120, 'order', -5, 195, 35, '2017-03-02 16:00:02'),
(121, 'order', -6, 190, 12, '2017-03-02 16:20:37'),
(122, 'order', -4, 196, 7, '2017-03-02 23:07:50'),
(123, 'order', -2, 198, 36, '2017-03-02 23:07:51'),
(124, 'order', -4, 195, 13, '2017-03-02 23:17:07'),
(125, 'order', -4, 196, 17, '2017-03-02 23:17:07'),
(126, 'order', -4, 194, 36, '2017-03-02 23:17:07'),
(127, 'order', -5, 195, 3, '2017-03-02 23:19:26'),
(128, 'order', -5, 195, 15, '2017-03-02 23:19:26'),
(129, 'order', -4, 193, 33, '2017-03-02 23:28:33'),
(130, 'order', -2, 198, 30, '2017-03-02 23:34:01'),
(131, 'cancelled', 4, 204, 33, '2017-03-02 23:34:30'),
(132, 'order', -3, 192, 13, '2017-03-03 00:13:40'),
(133, 'cancelled', 3, 203, 13, '2017-03-03 00:16:25'),
(134, 'order', -4, 191, 13, '2017-03-03 00:17:19'),
(135, 'cancelled', 6, 206, 12, '2017-03-03 01:32:55'),
(136, 'cancelled', 6, 206, 12, '2017-03-03 01:45:26'),
(139, 'order', -5, 189, 36, '2017-03-03 12:09:54'),
(140, 'order', -1, 197, 30, '2017-03-03 12:09:54'),
(141, 'order', -4, 196, 37, '2017-03-03 12:13:38'),
(142, 'order', -4, 196, 52, '2017-03-03 12:13:38');

-- --------------------------------------------------------

--
-- Table structure for table `store_products_rating`
--

CREATE TABLE `store_products_rating` (
  `consumer_id` int(11) NOT NULL,
  `storeprodsub_id` int(11) NOT NULL,
  `storeprod_rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `store_products_subcategory`
--

CREATE TABLE `store_products_subcategory` (
  `storeprodsub_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `storeprod_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_products_subcategory`
--

INSERT INTO `store_products_subcategory` (`storeprodsub_id`, `subcategory_id`, `storeprod_id`, `store_id`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 1, 3, 1),
(4, 1, 4, 1),
(5, 1, 5, 1),
(6, 2, 6, 1),
(7, 2, 7, 1),
(8, 2, 8, 1),
(9, 2, 9, 1),
(10, 2, 10, 1),
(11, 3, 11, 1),
(12, 3, 12, 1),
(13, 3, 13, 1),
(14, 3, 14, 1),
(15, 3, 15, 1),
(16, 4, 16, 1),
(17, 4, 17, 1),
(18, 4, 18, 1),
(19, 4, 19, 1),
(20, 4, 20, 1),
(21, 5, 21, 2),
(22, 6, 22, 3),
(23, 6, 23, 3),
(24, 6, 24, 3),
(25, 6, 25, 3),
(26, 6, 26, 3),
(27, 8, 27, 3),
(28, 8, 28, 3),
(29, 8, 29, 3),
(30, 8, 30, 3),
(31, 8, 31, 3),
(32, 9, 32, 3),
(33, 9, 33, 3),
(34, 9, 34, 3),
(35, 9, 35, 3),
(36, 9, 36, 3),
(37, 10, 37, 3),
(38, 10, 38, 3),
(39, 10, 39, 3),
(40, 10, 40, 3),
(41, 10, 41, 3),
(42, 6, 42, 3),
(43, 6, 43, 3),
(44, 6, 44, 3),
(45, 5, 45, 2),
(46, 5, 46, 2),
(47, 5, 47, 2),
(48, 5, 48, 2),
(49, 11, 49, 2),
(50, 11, 50, 2),
(51, 11, 51, 2),
(52, 12, 52, 2),
(53, 12, 53, 2),
(54, 12, 54, 2),
(55, 12, 55, 2),
(56, 12, 56, 2),
(57, 13, 57, 2),
(58, 13, 58, 2),
(59, 13, 59, 2),
(60, 13, 60, 2),
(61, 13, 61, 2);

-- --------------------------------------------------------

--
-- Table structure for table `store_vendor`
--

CREATE TABLE `store_vendor` (
  `vendor_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `store_vendor`
--

INSERT INTO `store_vendor` (`vendor_id`, `store_id`) VALUES
(3, 1),
(4, 2),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) NOT NULL,
  `subcategory_deleted` enum('true','false') NOT NULL DEFAULT 'false',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`subcategory_id`, `subcategory_name`, `subcategory_deleted`, `date_created`, `date_modified`, `category_id`) VALUES
(1, 'Vegetable', 'false', '2017-03-01 02:03:47', '2017-03-01 02:03:47', 1),
(2, 'Fresh Fruits', 'false', '2017-03-01 02:14:20', '2017-03-01 02:14:20', 2),
(3, 'Cereal', 'false', '2017-03-01 02:27:17', '2017-03-01 02:27:17', 3),
(4, 'Soda', 'false', '2017-03-01 02:33:18', '2017-03-01 02:33:18', 4),
(5, 'Fresh Fruits', 'false', '2017-03-01 23:17:21', '2017-03-01 23:17:21', 5),
(6, 'Cereals', 'false', '2017-03-01 23:22:38', '2017-03-01 23:22:38', 6),
(7, 'Canned Goods', 'true', '2017-03-02 12:24:42', '2017-03-02 13:42:20', 6),
(8, 'Shampoo', 'false', '2017-03-02 12:26:26', '2017-03-02 12:26:26', 7),
(9, 'Dairy Goods', 'false', '2017-03-02 12:48:43', '2017-03-02 12:48:43', 8),
(10, 'Chicken Meat', 'false', '2017-03-02 13:08:09', '2017-03-02 13:08:09', 9),
(11, 'Junk Foods', 'false', '2017-03-02 15:19:35', '2017-03-02 15:19:35', 10),
(12, 'Shampoo', 'false', '2017-03-02 15:23:34', '2017-03-02 15:23:34', 11),
(13, 'Fresh Vegetables', 'false', '2017-03-02 15:28:56', '2017-03-02 15:28:56', 12);

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `superadmin_id` int(11) NOT NULL,
  `superadmin_fname` varchar(255) NOT NULL,
  `superadmin_lname` varchar(255) NOT NULL,
  `superadmin_username` varchar(255) NOT NULL,
  `superadmin_password` varchar(255) NOT NULL,
  `superadmin_email` varchar(255) NOT NULL,
  `restriction` varchar(255) NOT NULL DEFAULT 'superadmin',
  `status` varchar(255) NOT NULL DEFAULT 'confirmed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`superadmin_id`, `superadmin_fname`, `superadmin_lname`, `superadmin_username`, `superadmin_password`, `superadmin_email`, `restriction`, `status`) VALUES
(1, 'Amelito', 'Alcuitas', 'uberfps', '9e0605ed95e467800b1249630cb400e7', 'amelitoalcuitas@gmail.com', 'superadmin', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(11) NOT NULL,
  `vendor_fname` varchar(255) NOT NULL,
  `vendor_lname` varchar(255) NOT NULL,
  `vendor_username` varchar(255) DEFAULT NULL,
  `vendor_password` varchar(255) NOT NULL,
  `vendor_email` varchar(255) NOT NULL,
  `restriction` varchar(255) NOT NULL DEFAULT 'admin',
  `vendor_deleted` enum('true','false') NOT NULL DEFAULT 'false',
  `vendor_key` varchar(255) DEFAULT NULL,
  `vendor_status` enum('confirmed','unconfirmed') NOT NULL DEFAULT 'unconfirmed',
  `vendor_image` varchar(255) NOT NULL DEFAULT 'default_pic.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_fname`, `vendor_lname`, `vendor_username`, `vendor_password`, `vendor_email`, `restriction`, `vendor_deleted`, `vendor_key`, `vendor_status`, `vendor_image`) VALUES
(3, 'Juan', 'DelaCruz', 'juandelacruz', '5f4dcc3b5aa765d61d8327deb882cf99', 'juandelacruz@gmail.com', 'vendor', 'false', NULL, 'confirmed', 'default_pic.png'),
(4, 'Louis Marcel', 'Tan', 'macmac', '5f4dcc3b5aa765d61d8327deb882cf99', 'macmac@gmail.com', 'vendor', 'false', NULL, 'confirmed', 'default_pic.png'),
(5, 'Carlo', 'Espinosa', 'carlomar', '5f4dcc3b5aa765d61d8327deb882cf99', 'carlomar@gmail.com', 'vendor', 'false', NULL, 'confirmed', 'default_pic.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `consumers`
--
ALTER TABLE `consumers`
  ADD PRIMARY KEY (`consumer_id`);

--
-- Indexes for table `consumers_address`
--
ALTER TABLE `consumers_address`
  ADD KEY `consumer_id` (`consumer_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupons_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notif_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `consumer_id` (`consumer_id`),
  ADD KEY `coupons_id` (`coupons_id`);

--
-- Indexes for table `orders_store_products`
--
ALTER TABLE `orders_store_products`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `storeprodsub_id` (`storeprodsub_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `store_category`
--
ALTER TABLE `store_category`
  ADD KEY `store_id` (`store_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `store_coupons`
--
ALTER TABLE `store_coupons`
  ADD PRIMARY KEY (`storecoupon_id`),
  ADD KEY `coupons_id` (`coupons_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `store_coupons_discounts`
--
ALTER TABLE `store_coupons_discounts`
  ADD KEY `consumer_id` (`consumer_id`),
  ADD KEY `storecoupon_id` (`storecoupon_id`);

--
-- Indexes for table `store_products`
--
ALTER TABLE `store_products`
  ADD PRIMARY KEY (`storeprod_id`),
  ADD KEY `prod_id` (`prod_id`);

--
-- Indexes for table `store_products_discounts`
--
ALTER TABLE `store_products_discounts`
  ADD KEY `storeprod_id` (`storeprod_id`);

--
-- Indexes for table `store_products_inventory`
--
ALTER TABLE `store_products_inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `storeprod_id` (`storeprod_id`);

--
-- Indexes for table `store_products_rating`
--
ALTER TABLE `store_products_rating`
  ADD KEY `consumer_id` (`consumer_id`),
  ADD KEY `storeprodsub_id` (`storeprodsub_id`);

--
-- Indexes for table `store_products_subcategory`
--
ALTER TABLE `store_products_subcategory`
  ADD PRIMARY KEY (`storeprodsub_id`),
  ADD KEY `storeprod_id` (`storeprod_id`),
  ADD KEY `subcategory_id` (`subcategory_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `store_vendor`
--
ALTER TABLE `store_vendor`
  ADD KEY `vendor_id` (`vendor_id`),
  ADD KEY `store_id` (`store_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `superadmin`
--
ALTER TABLE `superadmin`
  ADD PRIMARY KEY (`superadmin_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `consumers`
--
ALTER TABLE `consumers`
  MODIFY `consumer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupons_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `store_coupons`
--
ALTER TABLE `store_coupons`
  MODIFY `storecoupon_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `store_products`
--
ALTER TABLE `store_products`
  MODIFY `storeprod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `store_products_inventory`
--
ALTER TABLE `store_products_inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `store_products_subcategory`
--
ALTER TABLE `store_products_subcategory`
  MODIFY `storeprodsub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `superadmin`
--
ALTER TABLE `superadmin`
  MODIFY `superadmin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `consumers_address`
--
ALTER TABLE `consumers_address`
  ADD CONSTRAINT `consumers_address_ibfk_1` FOREIGN KEY (`consumer_id`) REFERENCES `consumers` (`consumer_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`);

--
-- Constraints for table `orders_store_products`
--
ALTER TABLE `orders_store_products`
  ADD CONSTRAINT `orders_store_products_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orders_store_products_ibfk_2` FOREIGN KEY (`storeprodsub_id`) REFERENCES `store_products_subcategory` (`storeprodsub_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
