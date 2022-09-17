-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2019 at 03:14 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.0.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shopping`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `admin_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `login_id` varchar(30) NOT NULL,
  `a_password` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `contact_no` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `name`, `login_id`, `a_password`, `email_id`, `contact_no`) VALUES
(101, 'admina', 'admin', 'admin', 'admin@admin.com', '31521316');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `bill_id` int(10) NOT NULL,
  `cust_id` int(10) NOT NULL,
  `price` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `purch_date` date NOT NULL,
  `deliv_date` date NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bill_id`, `cust_id`, `price`, `discount`, `total`, `purch_date`, `deliv_date`, `comments`) VALUES
(45, 1006, 29998.00, 599960.00, -569962.00, '2019-09-02', '2019-09-07', ''),
(46, 1006, 44997.00, 2249.85, 42747.15, '2019-09-02', '2019-09-07', ''),
(47, 1006, 14999.00, 749.95, 14249.05, '2019-09-02', '2019-09-07', '');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartid` int(10) NOT NULL,
  `custid` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(10) NOT NULL,
  `cat_name` varchar(20) NOT NULL,
  `cat_des` text NOT NULL,
  `maincat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_des`, `maincat_id`) VALUES
(110, 'Electronics', 'Various types of Electronics product', 4001),
(115, 'Books', 'gjgjgsa', 0),
(122, 'Electronics', 'Electronics and Accessaries', 0),
(123, 'Mobile Phones', 'Mobile Phones and Accessaries', 122);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custid` int(10) NOT NULL,
  `custfname` varchar(20) NOT NULL,
  `custlname` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `contactno` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `c_password` varchar(20) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custid`, `custfname`, `custlname`, `dob`, `address`, `state`, `country`, `contactno`, `email`, `c_password`, `lastlogin`, `created_at`, `status`) VALUES
(1001, 'ggg', 'Sharm', '2002-12-02', '3rd floor, B wing,pearl city, manipal', 'Maharastra', 'India', '8634762125', 'riyaS@gmail.com', '123456', '2012-12-03 05:37:09', '2012-12-01 17:21:43', 'available'),
(1002, 'Fida', 'Khan', '0000-00-00', '', '', '', '754588869', 'fida@yahoo.com', 'gjgjhg', '0000-00-00 00:00:00', '2012-12-14 00:00:00', 'Approved'),
(1005, 'arvind', 'abcd', '0000-00-00', 'mangalore', 'Maharastra', 'India', '9453231211', 'arvind@gmail.com', '123', '0000-00-00 00:00:00', '2012-12-15 00:00:00', 'Approved'),
(1006, 'Ranjan ', 'kumar', '0000-00-00', '', '', '', '7738294882', 'ranjukum2999@gmail.com', 'q1w2e3r4/', '2019-09-02 02:44:37', '2019-09-02 02:43:18', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mess_id` int(25) NOT NULL,
  `mess_type` varchar(25) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `date` datetime NOT NULL,
  `receiver_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mess_id`, `mess_type`, `subject`, `description`, `user_id`, `date`, `receiver_id`) VALUES
(123, 'supplier', 'fghgjhg', 'gfufjuyjuy', 'sheikh@gma', '2012-12-20 11:11:44', 0),
(124, 'Customer', 'adsfsdfsdf', 'safsdfsdfsdf', 'fida@yahoo', '2013-01-18 08:29:37', 0),
(125, 'Customer', 'sadfsdf', 'sdfsdfsdf', 'riyaS@gmai', '2013-01-18 08:29:41', 0),
(126, 'Customer', 'sadfsdf', 'sdfsdfsdf', 'riyaS@gmail.com', '2013-01-18 08:30:12', 0),
(127, 'Customer', 'asdfsdf', 'sdfsdfsdf', 'fida@yahoo.com', '2013-01-18 08:30:16', 0),
(128, 'Customer', 'dfgfdg', 'fgdfg', 'fida@yahoo.com', '2013-01-29 08:47:32', 0),
(129, 'CustomerAdministrator', 'Hello', 'Test message', '1006', '2019-09-02 03:12:55', 0),
(130, 'AdministratorCustomer', 'hello', 'hai', 'Administrator', '2019-09-02 03:13:36', 1006);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `subcat_id` int(10) NOT NULL,
  `supp_id` int(10) NOT NULL,
  `prodname` varchar(25) NOT NULL,
  `price` double(10,2) NOT NULL,
  `discount` float(15,2) NOT NULL,
  `p_warranty` varchar(30) NOT NULL,
  `stock_status` varchar(20) NOT NULL,
  `deliveredin` int(3) NOT NULL,
  `prod_specif` text NOT NULL,
  `images` text NOT NULL,
  `Start_at` date NOT NULL,
  `End_at` date NOT NULL,
  `status` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `cat_id`, `subcat_id`, `supp_id`, `prodname`, `price`, `discount`, `p_warranty`, `stock_status`, `deliveredin`, `prod_specif`, `images`, `Start_at`, `End_at`, `status`) VALUES
(2118, 122, 123, 2012, 'Redmi Note 7 Pro', 14999.00, 5.00, '1', 'Available', 4, '6 GB RAM | 64 GB ROM | Expandable Upto 256 GB\r\n16.0 cm (6.3 inch) FHD+ Display\r\n48MP + 5MP | 13MP Front Camera\r\n4000 mAh Li-polymer Battery\r\nQualcomm Snapdragon 675 Processor\r\nSplash Proof - Protected by P2i\r\nQuick Charge 4.0 Support', 'redmi.jpeg', '2019-09-01', '2022-09-28', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purch_id` int(10) NOT NULL,
  `bill_id` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `qty` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purch_id`, `bill_id`, `prod_id`, `qty`) VALUES
(1, 0, 2118, '2'),
(2, 46, 2118, '3'),
(3, 47, 2118, '1');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supp_id` int(10) NOT NULL,
  `compregno` varchar(25) NOT NULL,
  `compname` varchar(25) NOT NULL,
  `complogo` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  `login_id` varchar(20) NOT NULL,
  `s_password` varchar(20) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supp_id`, `compregno`, `compname`, `complogo`, `address`, `state`, `country`, `contact_no`, `login_id`, `s_password`, `lastlogin`, `created_at`, `status`) VALUES
(2001, '3001', 'Samsung', '', 'Delhi', 'Delhi', 'India', '7639782343', 'samsung@nexus.com', 'workinghand', '2012-10-06 08:29:00', '2012-01-30 15:23:15', 'available'),
(2012, 'XIAMI', 'xiami', 'mi.png', 'mi, bangalore', 'Karnataka', 'India', '8877739283', 'admin@mi.com', 'q1w2e3r4/', '2019-09-02 02:57:28', '2019-09-02 02:48:57', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`bill_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custid`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mess_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purch_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `admin_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=904;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `bill_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1007;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mess_id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2119;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purch_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2013;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
