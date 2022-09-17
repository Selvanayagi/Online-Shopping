-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2013 at 09:59 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE IF NOT EXISTS `administrator` (
  `admin_id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `login_id` varchar(30) NOT NULL,
  `a_password` varchar(30) NOT NULL,
  `email_id` varchar(30) NOT NULL,
  `contact_no` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=904 ;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`admin_id`, `name`, `login_id`, `a_password`, `email_id`, `contact_no`) VALUES
(101, 'admina', 'admin', 'adminm', 'admin@admin.com', '31521316'),
(801, 'aliya', 'aliya@gmail.com', 'gfhgh', 'aliya@gmail.com', '852220229'),
(903, 'Spoorthi', '123', 'ghgf', 'spoo@gmail.com', '658989');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE IF NOT EXISTS `billing` (
  `bill_id` int(10) NOT NULL AUTO_INCREMENT,
  `cust_id` int(10) NOT NULL,
  `price` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `purch_date` date NOT NULL,
  `deliv_date` date NOT NULL,
  PRIMARY KEY (`bill_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bill_id`, `cust_id`, `price`, `discount`, `total`, `purch_date`, `deliv_date`) VALUES
(45, 1001, 0.00, 25239.50, 60505.50, '2013-03-11', '2013-03-16'),
(46, 1001, 0.00, 3630.20, 32671.80, '2013-03-11', '2013-03-16'),
(47, 1001, 0.00, 1864.50, 16780.50, '2013-03-10', '2013-03-11'),
(48, 1001, 0.00, 24997.50, 58327.50, '2013-03-11', '2013-03-16'),
(50, 1001, 0.00, 1864.50, 16780.50, '2013-03-11', '2013-03-16'),
(51, 1001, 0.00, 1864.50, 16780.50, '2013-03-11', '2013-03-16'),
(52, 1001, 0.00, 24997.50, 58327.50, '2013-03-11', '2013-03-16'),
(53, 1001, 0.00, 3899.00, 35091.00, '2013-03-11', '2013-03-16'),
(54, 1001, 0.00, 0.00, 0.00, '2013-03-11', '2013-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cartid` int(10) NOT NULL AUTO_INCREMENT,
  `custid` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  PRIMARY KEY (`cartid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartid`, `custid`, `prod_id`, `qty`) VALUES
(21, 0, 0, 3),
(22, 1001, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(10) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(20) NOT NULL,
  `cat_des` text NOT NULL,
  `maincat_id` int(10) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `cat_des`, `maincat_id`) VALUES
(130, 'Mobiles', 'Contains all types of mobile phone.', 0),
(131, 'Computers', 'Contains all types of laptops.', 0),
(132, 'Clothing', 'Contains all brands and type of clothing', 0),
(133, 'Jewelry', 'Contains variety of jewels of gold, silver and platinum.', 0),
(137, 'Cell Phones', 'Various Cell phones.', 130),
(139, 'Mobile Memory cards', 'Mobile Memory cards for various cell phones.', 130),
(141, 'Laptops', 'Laptops & Tablets of all types', 131),
(147, 'Womens shirts', 'Womens shirts and blouses', 132),
(148, 'Mens shirts', 'Mens shirts and blouses.', 132),
(149, 'Womens Contemporary', 'Womens Contemporary', 132),
(150, 'Rings', 'Rings of silver, gold, diamond, gemstone etc.', 133),
(152, 'Earrings', 'Earrings of silver, gold, diamond, gemstone etc.', 133);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `custid` int(10) NOT NULL AUTO_INCREMENT,
  `custfname` varchar(20) NOT NULL,
  `custlname` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `address` text NOT NULL,
  `state` varchar(20) NOT NULL,
  `country` varchar(20) NOT NULL,
  `contactno` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `c_password` varchar(20) NOT NULL,
  `lastlogin` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`custid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1006 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custid`, `custfname`, `custlname`, `dob`, `address`, `state`, `country`, `contactno`, `email`, `c_password`, `lastlogin`, `created_at`, `status`) VALUES
(1001, 'Riya', 'Sharm', '2002-12-02', '3rd floor, B wing,pearl city, manipal', 'Maharastra', 'India', '8634762125', 'riyaS@gmail.com', '741', '2013-03-11 09:54:47', '2012-12-01 17:21:43', 'available'),
(1003, 'Fida', 'sdfsdf', '0000-00-00', 'sadf', 'sdfs', 'sdfsdf', '754588869', 'fida@yahoo.com', 'gjgjhg', '0000-00-00 00:00:00', '2012-12-14 00:00:00', 'Approved'),
(1005, 'arvind', 'abcd', '0000-00-00', 'mangalore', 'Maharastra', 'India', '9453231211', 'arvind@gmail.com', '123', '2013-03-11 07:17:52', '2012-12-15 00:00:00', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `mess_id` int(25) NOT NULL AUTO_INCREMENT,
  `mess_type` varchar(25) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `receiver_id` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`mess_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=152 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mess_id`, `mess_type`, `subject`, `description`, `user_id`, `receiver_id`, `date`) VALUES
(149, 'SupplierCustomer', 'gfgdfg', 'fgdsg', '2001', '', '2013-03-11 07:09:59'),
(150, '', 'dsds', 'xcxc', 'riyaS@gmail.com', '101', '2013-03-11 08:35:43'),
(151, 'AdministratorCustomer', 'sdasda', 'sdsada', '101', '', '2013-03-11 08:49:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `prod_id` int(10) NOT NULL AUTO_INCREMENT,
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
  `status` varchar(25) NOT NULL,
  PRIMARY KEY (`prod_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2193 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `cat_id`, `subcat_id`, `supp_id`, `prodname`, `price`, `discount`, `p_warranty`, `stock_status`, `deliveredin`, `prod_specif`, `images`, `Start_at`, `End_at`, `status`) VALUES
(2169, 130, 137, 2003, 'Sony Xperia ZL', 35990.00, 10.00, '1', 'Available', 5, 'Android v4.1 (Jelly Bean) OS,\r\n13 MP Primary Camera,\r\n5-inch Touchscreen,\r\n2 MP Secondary Camera.', 'sony-xperia-zl.jpeg', '2013-03-17', '2014-03-31', ''),
(2170, 130, 137, 2003, 'Sony Xperia Z', 38990.00, 10.00, '1', 'Available', 5, '13 MP Primary Camera,\r\nAndroid v4.1 (Jelly Bean) OS,\r\n5-inch Touchscreen,\r\n2 MP Secondary Camera.', 'sony-xperia-z.jpeg', '2013-03-10', '2014-03-31', ''),
(2171, 130, 137, 2003, 'Sony Xperia U', 12990.00, 0.00, '1', 'Available', 7, 'Android v2.3 (Gingerbread) OS,\r\n5 MP Primary Camera,\r\n0.3 MP Secondary Camera,\r\n3.5-inch TFT Touchscreen.', 'sony-xperia-u.jpeg', '2013-03-08', '2014-03-31', ''),
(2174, 130, 139, 2003, 'Sony Memory Card SR-4N4/T', 210.00, 0.00, '5', 'Available', 2, '4 GB Memory Card,\r\nClass 4 Memory Card,\r\nMemory Card File Rescue and x-Pict Story.', 'sony-sr-4GB.jpeg', '2013-03-08', '2014-06-30', ''),
(2175, 130, 139, 2003, 'Sony Memory Card SR-8N4/T', 335.00, 0.00, '5', 'Available', 3, '8 GB Memory Card,\r\nClass 4 Memory Card.', 'sony-sr-8GB.jpeg', '2013-03-08', '2014-12-22', ''),
(2176, 131, 141, 2003, 'Sony VAIO SVE15115EN', 36302.00, 10.00, '1', 'Available', 3, '2nd Gen Ci3/ 4GB/ 500GB/ Win7 HB/ 1GB Graph', 'Sony VAIO SVE15115EN.jpeg', '2013-03-01', '2014-12-23', 'Approved'),
(2177, 131, 141, 2003, 'Sony VAIO SVE1511AEN', 29843.00, 10.00, '1', 'Available', 3, '2nd Gen Ci3/ 2GB/ 320GB/ Win7 HB', 'Sony VAIO SVE1511AEN.jpeg', '2013-03-02', '2014-03-31', ''),
(2178, 130, 137, 2001, 'Samsung Galaxy Grand Duos', 21299.00, 0.00, '1', 'Available', 3, '8 MP Primary Camera,\r\nAndroid v4.1 (Jelly Bean) OS,\r\n5-inch Touchscreen,\r\nDual SIM (GSM + GSM).', 'Samsung Galaxy Grand Duos.jpeg', '2013-03-08', '2014-03-31', ''),
(2179, 130, 137, 2001, 'Samsung Galaxy Note 2', 35500.00, 10.00, '1', 'Available', 3, 'Android v4.1 OS,\r\n8 MP Primary Camera,\r\n1.9 MP Secondary Camera,\r\n5.55-inch Touchscreen.', 'Samsung Galaxy Note 2 N7100.jpeg', '2013-03-01', '2013-03-31', 'Pending'),
(2180, 130, 137, 2001, 'Samsung Galaxy S3', 29500.00, 0.00, '1', 'Available', 3, 'Android v4.0 OS\r\n8 MP Primary Camera\r\nSecondary Camera Support\r\n4.8-inch Touchscreen', 'Samsung Galaxy S3.jpeg', '2013-03-01', '2014-03-31', 'Pending'),
(2181, 131, 141, 2001, 'Samsung NP900X3A-A01IN', 81075.00, 10.00, '1', 'Available', 8, '2nd Gen Ci5/ 4GB/ 128GB SSD/ Win7 HP', 'Samsung NP900X3A-A01IN.jpeg', '2013-03-01', '2014-12-31', ''),
(2182, 131, 141, 2001, 'Samsung NP350V5C-S06IN', 54982.00, 10.00, '1', 'Available', 8, '3rd Gen Ci7/ 8GB/ 1TB/ Win7 HP/ 2GB Graph', 'Samsung NP350V5C-S06IN.jpeg', '2013-03-01', '2014-03-31', ''),
(2183, 132, 147, 2010, 'GUESS High-Contrast Flora', 2420.00, 10.00, '0', 'Available', 3, 'Womens shirt,\r\ncowl-neck,\r\ndraped short sleeves,\r\nrelaxed fit,\r\nabstract floral graphic on front neckline.', 'GUESS High-Contrast Floral Tee.jpg', '2013-03-01', '2013-09-30', 'Approved'),
(2184, 132, 147, 2010, 'GUESS Sophia Faux-Leather', 6490.00, 10.00, '0', 'Available', 4, 'zipper closure\r\nWomens outerwear\r\nfaux-leather jacket\r\nmock collar\r\nlong sleeves with zippered cuffs\r\nfront zipper closure', 'GUESS Sophia Faux-Leather Jacket.jpg', '2013-03-01', '2013-11-26', ''),
(2185, 132, 148, 2010, 'GUESS Logan Long-Sleeve', 3300.00, 10.00, '0', 'Available', 3, '100-percent-cotton\r\nMens shirt\r\nlong sleeves\r\nsingle barrel cuffs\r\nregular laguna fit\r\nshirttail hem', 'GUESS Logan Long-Sleeve.jpg', '2013-03-01', '2013-12-31', ''),
(2186, 132, 148, 2010, 'GUESS Unknown Desert Crew', 1595.00, 5.00, '0', 'Available', 3, '100-percent-cotton\r\nMens tee\r\nCrewneck\r\nShort sleeves', 'GUESS Unknown Desert Crewneck Tee.jpg', '2013-03-01', '2013-10-27', 'Rejected'),
(2187, 132, 149, 2010, 'Guess Franco Womens Rebel', 14850.00, 20.00, '0', 'Available', 8, 'Whimsical insects and nocturnal flora jazz up the classic silhouette of Eva Francos Rebel dress.', 'Eva Franco Womens Rebel Dress.jpg', '2013-03-01', '2013-03-31', ''),
(2188, 132, 149, 2010, 'Guess Womens Fitted Shift', 17875.00, 20.00, '0', 'Available', 6, 'Dry Clean Only\r\nBoat neck\r\nSleeveless\r\nHidden back zipper', 'Guess Womens Fitted Shift Dress.jpg', '2013-03-01', '2013-03-31', ''),
(2189, 133, 150, 2015, 'Diamond Eternity Ring', 51242.20, 20.00, '0', 'Available', 6, 'Fashionable bezel and prong set Diamond eternity ring', 'Diamond eternity ring.jpg', '2013-03-01', '2013-12-30', ''),
(2190, 133, 150, 2015, 'Diamond Ladies Engagement', 18645.00, 10.00, '0', 'Available', 2, '0.50 Ct.T.W. round cut diamonds in prong setting\r\nCrafted in pure 14K White Gold\r\nDiamond Weight : 0.50 ct tw.', 'Diamond Ladies Engagement Bridal.jpg', '2013-03-01', '2013-03-31', 'Approved'),
(2191, 133, 152, 2015, 'Diamond Inside-Outside Ho', 83325.00, 30.00, '0', 'Available', 3, '14k White Gold 1.5 Cttw Diamond Inside-Outside Hoop Earrings', 'Diamond Inside-Outside Hoop Earrings.jpg', '2013-03-01', '2013-12-22', 'Approved'),
(2192, 133, 152, 2015, 'Diamond Twist Earrings', 12650.00, 20.00, '0', 'Available', 5, 'All our diamond suppliers certify that to their best knowledge their diamonds are not conflict diamonds.', 'Diamond Twist Earrings.jpg', '2013-03-01', '2013-11-27', '');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `purch_id` int(10) NOT NULL AUTO_INCREMENT,
  `bill_id` int(10) NOT NULL,
  `prod_id` int(10) NOT NULL,
  `qty` varchar(20) NOT NULL,
  PRIMARY KEY (`purch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purch_id`, `bill_id`, `prod_id`, `qty`) VALUES
(4, 45, 2191, '1'),
(5, 45, 2183, '1'),
(6, 46, 0, '0'),
(7, 46, 2176, '1'),
(8, 47, 2190, '1'),
(9, 48, 0, '1'),
(10, 48, 2191, '1'),
(11, 49, 2190, '0'),
(12, 50, 2190, '1'),
(13, 51, 2190, '1'),
(14, 52, 2191, '1'),
(15, 53, 2170, '1');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supp_id` int(10) NOT NULL AUTO_INCREMENT,
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
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`supp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2016 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supp_id`, `compregno`, `compname`, `complogo`, `address`, `state`, `country`, `contact_no`, `login_id`, `s_password`, `lastlogin`, `created_at`, `status`) VALUES
(2001, 'SAM001', 'Samsung', 'samsung-logo.jpg', 'fghgfggg', 'Karnataka', 'India', '7639782343', 'samsung@nexus.com', 'workinghand', '2013-03-11 07:47:20', '2013-01-30 15:23:15', 'Approved'),
(2003, 'Sony001', 'Sony Inc.', 'sony-logo.jpg', 'Minato, Tokyo, Japan', 'Tokyo', 'Japan', '5236548264', 'sony@nexus.com', 'sonyvaio', '2013-03-09 13:27:00', '2013-02-03 15:12:23', 'Approved'),
(2010, 'Guess001', 'Guess', 'guess.jpg', 'asbvhebvh', 'Karnataka', 'India', '5683745923', 'guess@nexus.com', 'GuessGuess', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Approved'),
(2015, 'LH001', 'Lois Hill', 'LoisHill.jpg', 'hdvjhsdvjhdsjh', 'Jeddah', 'Saudi Arabia', '6737624764', 'lh@nexus.com', 'Lois Hill', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Approved');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
