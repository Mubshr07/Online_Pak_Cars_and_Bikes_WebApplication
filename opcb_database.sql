-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 25, 2020 at 11:35 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `opcb_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

DROP TABLE IF EXISTS `advertisement`;
CREATE TABLE IF NOT EXISTS `advertisement` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `userID` int(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `brandName` varchar(100) NOT NULL,
  `modelName` varchar(100) NOT NULL,
  `makeYear` varchar(50) NOT NULL,
  `engineCapacity` varchar(100) NOT NULL,
  `seatingCapacity` varchar(100) NOT NULL,
  `bodyType` varchar(100) NOT NULL,
  `conditionType` varchar(100) NOT NULL DEFAULT 'Second Hand',
  `condition_is` varchar(100) NOT NULL DEFAULT '5',
  `registered` varchar(100) DEFAULT NULL,
  `registrationCity` varchar(50) NOT NULL,
  `mileageDriven` varchar(100) NOT NULL DEFAULT '100',
  `price` varchar(100) NOT NULL,
  `pics` varchar(500) DEFAULT NULL,
  `ownerRemarks` varchar(200) NOT NULL,
  `contactNo` varchar(100) NOT NULL DEFAULT '+92-3xx',
  `uploadingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatingDate` varchar(100) DEFAULT NULL,
  `soldDelete` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `advertisement`
--

INSERT INTO `advertisement` (`id`, `userID`, `title`, `type`, `brandName`, `modelName`, `makeYear`, `engineCapacity`, `seatingCapacity`, `bodyType`, `conditionType`, `condition_is`, `registered`, `registrationCity`, `mileageDriven`, `price`, `pics`, `ownerRemarks`, `contactNo`, `uploadingDate`, `updatingDate`, `soldDelete`) VALUES
(28, 1, 'Unnamed Car, I want to sale.', 'Jeep', 'Honda', 'I don\'t know it\'s model.', '2010-03', '250c', '4', 'Sports Car', 'Second-Hand', '8', 'registered', 'Karachi', '987456', '67846321', '1601074967_unnamed.jpg', 'This is the remarks content of the owner.', '+92-318-5099232', '2020-09-25 23:02:47', '2020-09-25 23:16:19', 0),
(26, 1, 'My GMC Car', 'Car', 'Honda', 'GMC Car', '2010-10', '250c', '4', 'Car type', 'Second-Hand', '8', 'registered', 'Taxila', '8979856', '54654321', '1601074754_test.png', 'my GMC Car review', '+92-318-5099232', '2020-09-25 22:59:14', '2020-09-25 23:16:28', 0),
(25, 1, 'My Blue Sports Car', 'Car', 'Honda', 'I don\'t know it\'s model.', '1983-02', '250c', '4', 'Sports Car', 'Second-Hand', '10', 'registered', 'Multan', '564678', '5456456', '1601074604_tset2.png', 'Fifth Dummy Post.', '+92-318-5099232', '2020-09-25 22:56:44', '2020-09-25 23:16:32', 0),
(24, 1, 'My Yellow Car', 'Car', 'Honda', 'I don\'t know it\'s model.', '2010-03', '250c', '2', 'Sports Car', 'Second-Hand', '10', 'registered', 'Multan', '6545631', '9875623', '1601075001_outlaw.png', 'Fourth Dummy Car Post.', '+92-318-5099232', '2020-09-25 22:54:54', '2020-09-25 23:16:37', 0),
(23, 1, 'Double Cabine', 'Bike', 'Honda', 'Double Cabine', '2008-04', '250c', '4', 'Double Cabine', 'Second-Hand', '9', 'registered', 'Karachi', '6542146', '3521200', '1601074381_adsa.jpg', 'This is Third Dummy post.', '+92-318-5099232', '2020-09-25 22:53:01', '2020-09-25 23:16:42', 0),
(22, 1, 'mahindra E20 Electric car', 'Car', 'Honda', 'E20', '2008-07', '250c', '4', 'Car type', 'Second-Hand', '10', 'registered', 'Lahore', '6251321', '697553', '1601074220_unnamed.jpg', 'This Third Dummy Post.', '+92-318-5099232', '2020-09-25 22:50:20', '2020-09-25 23:16:47', 0),
(21, 1, 'Toyota Prium White Car', 'Car', 'Honda', 'Model Prius', '2015-07', '250c', '4', 'Car type', 'Second-Hand', '10', 'registered', 'Lahore', '35406', '1165110', '1601073297_car.png', 'This is the second Dummy post.', '+92-318-5099232', '2020-09-25 22:34:57', '2020-09-25 23:16:54', 0),
(20, 1, 'Toyota Prium White Car', 'Car', 'Honda', 'Model Prius', '2015-07', '250c', '4', 'Car type', 'Second-Hand', '10', 'registered', 'Lahore', '35406', '1165110', '1601073297_car.png', 'This is the second Dummy post.', '+92-318-5099232', '2020-09-25 22:34:57', '2020-09-25 23:16:59', 0),
(19, 1, 'Honda Sports Bike', 'Bike', 'Honda', 'Model-500', '2015-06', '250c', '2', 'Sports Body', 'Second-Hand', '9', 'registered', 'Rawalpindi', '20916', '400000', '1601072763_2200821eng.jpg', 'I am Selling my Honda Sports Bike Model-500. This is a dummy post don\'t call me. I don\'t have this bike. hahahahahaha', '+92-318-5099232', '2020-09-25 22:26:03', '2020-09-25 23:17:08', 0),
(27, 1, 'Blade Bike', 'Bike', 'Honda', 'Blade Bike model-60', '1985-07', '250c', '2', 'Sports Bike', 'Second-Hand', '7', 'registered', 'Wah Cantt', '65412', '6548432', '1601074864_blade.png', 'This is remarks from owner.', '+92-318-5099232', '2020-09-25 23:01:04', '2020-09-25 23:15:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(100) NOT NULL,
  `date_of_addition` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brandName`, `date_of_addition`) VALUES
(1, 'Honda', '2020-09-21 01:07:59'),
(2, 'Yamaha', '2020-09-21 01:07:59'),
(3, 'Suzuki', '2020-09-21 01:07:59'),
(4, 'Toyota', '2020-09-21 01:07:59'),
(5, 'Audi', '2020-09-21 01:07:59'),
(6, 'Mercedes', '2020-09-21 01:07:59'),
(7, 'Ford', '2020-09-21 01:07:59'),
(8, 'Hyundai', '2020-09-21 01:07:59'),
(9, 'Daihatsu', '2020-09-21 01:07:59'),
(10, 'Mitsubishi', '2020-09-21 01:07:59'),
(11, 'Nissan', '2020-09-21 01:07:59'),
(12, 'Sabaru', '2020-09-21 01:07:59'),
(13, 'Others', '2020-09-21 01:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `enginecapacity`
--

DROP TABLE IF EXISTS `enginecapacity`;
CREATE TABLE IF NOT EXISTS `enginecapacity` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `capacity` varchar(50) NOT NULL,
  `date_of_addition` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enginecapacity`
--

INSERT INTO `enginecapacity` (`id`, `capacity`, `date_of_addition`) VALUES
(1, 'Below660cc', '2020-09-21 00:56:05'),
(14, 'Above2000cc', '2020-09-21 01:00:20'),
(3, '660cc', '2020-09-21 00:56:34'),
(13, '2000cc', '2020-09-21 01:00:20'),
(12, '1800cc', '2020-09-21 01:00:20'),
(6, '800cc', '2020-09-21 00:57:02'),
(7, '1000cc', '2020-09-21 00:57:02'),
(11, '1600cc', '2020-09-21 01:00:20'),
(10, '1300cc', '2020-09-21 01:00:20'),
(16, '70cc', '2020-09-22 00:50:17'),
(17, '100cc', '2020-09-22 00:50:42'),
(18, '110c', '2020-09-22 00:50:42'),
(21, '125c', '2020-09-22 00:51:22'),
(22, '150c', '2020-09-22 00:51:22'),
(23, '250c', '2020-09-22 00:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `searchtable`
--

DROP TABLE IF EXISTS `searchtable`;
CREATE TABLE IF NOT EXISTS `searchtable` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `searchText` varchar(500) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `searchtable`
--

INSERT INTO `searchtable` (`id`, `searchText`, `dateTime`) VALUES
(1, 'Toyota', '2020-09-25 19:47:26'),
(2, 'This is title Changed', '2020-09-25 19:49:20'),
(3, 'ChildThemeGeneratePress', '2020-09-25 19:49:32'),
(4, 'ChildTheme', '2020-09-25 19:49:39'),
(5, 'Toyota', '2020-09-25 22:11:23'),
(6, 'Toyota', '2020-09-25 22:11:29'),
(7, 'Toyota', '2020-09-25 22:11:35'),
(8, 'Toyota', '2020-09-25 22:11:42'),
(9, 'Toyota', '2020-09-25 23:04:20');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL DEFAULT '+92-3',
  `password` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'Subscriber',
  `valid` int(10) NOT NULL DEFAULT '1',
  `date_of_join` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` varchar(100) DEFAULT NULL,
  `hash` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `firstName`, `lastName`, `email`, `mobile`, `password`, `type`, `valid`, `date_of_join`, `last_login`, `hash`) VALUES
(1, 'mubi', 'Mubashir', 'Iqbal', 'mubshr7@gmail.com', '+92-318-5099232', '$2y$10$pQuCUgILd6IWX2lfm8a4Ie4r/O6wKh6eeuWknCcEoGf0PGMyy8e06', 'admin', 1, '2020-09-21 15:18:04', '2020-09-25 23:09:02', 'fc8001f834f6a5f0561080d134d53d29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
