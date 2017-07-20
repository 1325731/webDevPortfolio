-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2015 at 01:02 PM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pizzaproj`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `User` varchar(25) NOT NULL,
  `Title` char(4) NOT NULL,
  `FName` varchar(20) NOT NULL,
  `Init` char(2) NOT NULL,
  `LName` varchar(20) NOT NULL,
  `Address` varchar(30) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Prov` char(2) NOT NULL DEFAULT 'QC',
  `Postal` char(7) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `Password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`User`, `Title`, `FName`, `Init`, `LName`, `Address`, `City`, `Prov`, `Postal`, `Email`, `Phone`, `Password`) VALUES
('imtheworstatphp', 'Mr.', 'Im Screwed', 'QQ', 'Sorry Mike', '123 Main street', 'Pincourt', 'QC', 'X5X-6W6', 'theworst@itell.you', '514-514-5144', 'sodead123');

-- --------------------------------------------------------

--
-- Table structure for table `pizza`
--

CREATE TABLE `pizza` (
  `Ino` int(4) NOT NULL,
  `Name` varchar(15) NOT NULL,
  `Size` varchar(1) NOT NULL,
  `Price` decimal(4,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pizza Products';

--
-- Dumping data for table `pizza`
--

INSERT INTO `pizza` (`Ino`, `Name`, `Size`, `Price`) VALUES
(1, 'All Dressed', 'S', '8.99'),
(2, 'All Dressed', 'M', '15.99'),
(3, 'All Dressed', 'L', '24.99'),
(4, 'Hawaiian', 'S', '8.00'),
(5, 'Hawaiian', 'M', '13.99'),
(6, 'Hawaiian', 'L', '19.99'),
(7, 'Mexican', 'S', '7.99'),
(8, 'Mexican', 'M', '14.99'),
(9, 'Mexican', 'L', '21.99'),
(10, 'Vegetarian', 'S', '6.99'),
(11, 'Vegetarian', 'M', '12.99'),
(12, 'Vegetarian', 'L', '18.99');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`User`);

--
-- Indexes for table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`Ino`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `Ino` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
