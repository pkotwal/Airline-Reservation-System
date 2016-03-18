-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2016 at 12:22 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `airline`
--

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

CREATE TABLE IF NOT EXISTS `airline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  `logo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`id`, `name`, `code`, `logo`) VALUES
(1, 'Air India', 'AI', 'ai.jpg'),
(2, 'Go Air', 'GA', 'ga.jpg'),
(3, 'Jet Airways', 'JA', 'ja.jpg'),
(4, 'Spice Jet', 'SG', 'sg.jpg'),
(5, 'Indigo', '6E', '6e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL,
  `flight` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `num` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `date` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `number`, `type`, `flight`, `price`, `num`, `user`, `date`) VALUES
(2, '1212121212121212', 'credit', 3, 32000, 4, 4, '2015-10-18'),
(3, '2312431243242353', 'credit', 3, 32000, 4, 5, '2016-01-23'),
(4, '5675675765757657', 'credit', 3, 16000, 2, 4, '2016-10-16'),
(5, '1901235672983290', 'credit', 14, 34000, 10, 4, '2016-03-03'),
(7, '233234343', 'credit', 13, 79920, 8, 5, '2016-03-11'),
(8, '12312', 'debit', 9, 90000, 6, 5, '2016-07-21'),
(9, '12312', 'debit', 9, 90000, 6, 4, '2016-06-21'),
(11, '65465', 'debit', 9, 30000, 2, 5, '2015-12-21'),
(14, '1432', 'credit', 9, 15000, 1, 5, '2016-10-12'),
(15, '14325', 'debit', 3, 8000, 1, 4, '2016-02-27'),
(16, '121321321', 'credit', 18, 2399, 1, 4, '2016-08-21'),
(17, '123123098', 'debit', 2, 15000, 1, 4, '2015-10-26'),
(18, '7897684645645646', 'debit', 3, 8000, 1, 4, '2016-12-31'),
(19, '12332312', 'credit', 31, 1200, 1, 4, '2015-11-30'),
(20, '21312235325', 'debit', 9, 30000, 2, 6, '2016-12-31'),
(21, '21312413', 'debit', 22, 13665, 3, 6, '2016-12-31'),
(22, '1212', 'debit', 25, 6910, 2, 4, '2015-10-24'),
(23, '12312431423', 'debit', 18, 7197, 3, 4, '2015-10-23'),
(24, '1s2s2wwx', 'credit', 30, 6500, 1, 5, '2015-10-23'),
(25, '131343', 'debit', 19, 14240, 4, 5, '2016-01-01'),
(27, '123123', 'credit', 22, 18220, 4, 6, '2015-10-24'),
(28, '12', 'debit', 28, 20100, 3, 4, '2015-10-23'),
(29, '312324134', 'debit', 25, 6910, 2, 4, '2015-10-30'),
(30, 'kadjvhkj', 'credit', 21, 4798, 2, 1, '2015-11-21'),
(31, 'h', 'debit', 21, 4798, 2, 1, '2015-11-13'),
(32, 'p', 'debit', 21, 4798, 2, 1, '2015-11-12'),
(33, 'ghj', 'debit', 21, 4798, 2, 1, '2015-11-20'),
(34, '2648712648726148', 'debit', 30, 6500, 1, 1, '2015-11-26'),
(35, '2356357846587465', 'debit', 25, 13820, 4, 4, '2015-11-27'),
(36, '7325233446328746', 'debit', 28, 20100, 3, 5, '2015-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE IF NOT EXISTS `flights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num` varchar(10) NOT NULL,
  `airline` int(20) NOT NULL,
  `source` varchar(10) NOT NULL,
  `destination` varchar(10) NOT NULL,
  `seats` int(11) NOT NULL,
  `avail` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `departure` varchar(10) NOT NULL,
  `arrival` varchar(10) NOT NULL,
  `del` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `num`, `airline`, `source`, `destination`, `seats`, `avail`, `price`, `departure`, `arrival`, `del`) VALUES
(2, '878', 3, 'Mumbai', 'Delhi', 200, 29, 15000, '1000', '1245', 0),
(3, '999', 2, 'Mumbai', 'Delhi', 125, 0, 8000, '1735', '2015', 0),
(4, '348', 3, 'Bangalore', 'Mumbai', 133, 23, 3499, '1256', '1543', 0),
(5, '412', 2, 'Bangalore', 'Mumbai', 157, 0, 1299, '0835', '1115', 0),
(6, '334', 1, 'Bangalore', 'Mumbai', 112, 3, 2599, '0430', '0716', 0),
(7, '211', 4, 'Bangalore', 'Mumbai', 200, 50, 2378, '1855', '2230', 0),
(8, '766', 1, 'Mumbai', 'Bangalore', 190, 0, 1234, '2000', '2305', 0),
(9, '900', 5, 'Mumbai', 'Bangalore', 100, 73, 15000, '1905', '2100', 0),
(10, '015', 2, 'Mumbai', 'Bangalore', 200, 0, 4478, '0634', '0944', 0),
(11, '344', 4, 'Delhi', 'Mumbai', 244, 45, 5699, '0520', '0810', 0),
(12, '309', 3, 'Delhi', 'Mumbai', 300, 15, 4500, '1235', '1505', 0),
(13, '099', 5, 'Delhi', 'Mumbai', 234, 48, 9990, '2030', '2300', 0),
(14, '023', 1, 'Chennai', 'Mumbai', 230, 0, 3400, '0415', '0745', 0),
(15, '024', 1, 'Mumbai', 'Chennai', 230, 33, 3445, '0830', '1105', 0),
(16, '459', 5, 'Mumbai', 'Chennai', 180, 45, 9300, '1805', '2055', 0),
(17, '458', 5, 'Chennai', 'Mumbai', 180, 36, 4899, '2130', '2355', 0),
(18, '234', 4, 'Chennai', 'Mumbai', 213, 48, 2399, '0950', '1230', 0),
(19, '233', 4, 'Mumbai', 'Chennai', 213, 17, 3560, '1350', '1730', 0),
(20, '902', 1, 'Bangalore', 'Chennai', 220, 2, 10099, '0405', '0502', 0),
(21, '903', 1, 'Chennai', 'Bangalore', 220, 81, 2399, '0625', '0735', 0),
(22, '313', 5, 'Bangalore', 'Chennai', 115, 13, 4555, '1255', '1410', 0),
(23, '312', 5, 'Chennai', 'Bangalore', 115, 76, 3790, '1500', '1605', 1),
(24, '110', 1, 'Bangalore', 'Delhi', 344, 92, 3800, '0655', '1045', 0),
(25, '109', 1, 'Delhi', 'Bangalore', 344, 92, 3455, '1115', '1455', 0),
(26, '331', 2, 'Bangalore', 'Delhi', 220, 21, 8999, '1735', '2055', 0),
(27, '314', 2, 'Delhi', 'Bangalore', 220, 45, 9000, '2115', '2359', 0),
(28, '123', 1, 'Chennai', 'Delhi', 170, 61, 6700, '0640', '1010', 0),
(29, '124', 1, 'Delhi', 'Mumbai', 170, 4, 7800, '1100', '1455', 1),
(30, '990', 5, 'Delhi', 'Chennai', 350, 348, 6500, '1000', '1230', 0),
(31, '777', 5, 'Mumbai', 'Bangalore', 190, 189, 1200, '1200', '1330', 1),
(32, '232', 1, 'Chennai', 'Delhi', 100, 100, 1200, '1230', '1500', 1),
(33, '111', 1, 'Delhi', 'Chennai', 50, 50, 10000, '1230', '1425', 0),
(34, '133', 5, 'Delhi', 'Mumbai', 50, 50, 1020, '1000', '1230', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(4, 'Pratik', 'pkotwal16@gmail.com', '1cd3c693132f4c31b5b5e5f4c5eed6bd', 5),
(5, 'Pratik', 'pratikkotwal@yahoo.com', '3b2285b348e95774cb556cb36e583106', 0),
(6, 'Aarti ', 'aartimankani21@gmail.com', 'c04cd38aeb30f3ad1f8ab4e64a0ded7b', 1),
(7, 'shubha', '123@gmail.com', '83878c91171338902e0fe0fb97a8c47a', 0),
(8, '666666', '8888@rtrt', '83878c91171338902e0fe0fb97a8c47a', 0),
(10, 'Pratik', '1233@gmail.com', '83878c91171338902e0fe0fb97a8c47a', 0),
(12, 'Pratik', 'pkotwal13@gmail.com', '83878c91171338902e0fe0fb97a8c47a', 0),
(13, 'iuyiu', 'pkotwal19@gmail.com', 'c483f6ce851c9ecd9fb835ff7551737c', 0),
(14, 'aarti', 'aartim@gmail.com', '47bce5c74f589f4867dbd57e9ca9f808', 0),
(15, 'prat', 'popo@popo.com', 'c483f6ce851c9ecd9fb835ff7551737c', 0),
(16, 'Harry', 'harry@gmail.com', '3b2285b348e95774cb556cb36e583106', 0),
(17, 'Mary', 'mary@hmail.com', '3b2285b348e95774cb556cb36e583106', 0),
(18, 'Mary', 'mary@gmail.com', '3b2285b348e95774cb556cb36e583106', 0),
(19, 'Mary', 'm@gmail.com', '3b2285b348e95774cb556cb36e583106', 0),
(20, 'Prat', 'prat@gmail.com', '3b2285b348e95774cb556cb36e583106', 0),
(21, 'Po', 'po@gmail.com', '3b2285b348e95774cb556cb36e583106', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
