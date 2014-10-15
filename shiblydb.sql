-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 17, 2011 at 08:12 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `atnt_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `EmployeeID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(100) DEFAULT NULL,
  `Address` text,
  `Zip` varchar(50) NOT NULL,
  PRIMARY KEY (`EmployeeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employees`
--


-- --------------------------------------------------------

--
-- Table structure for table `mapping`
--

CREATE TABLE IF NOT EXISTS `mapping` (
  `SupplierID` bigint(20) NOT NULL,
  `EmployeeID` bigint(20) NOT NULL,
  PRIMARY KEY (`SupplierID`,`EmployeeID`),
  KEY `fk_map_employee` (`EmployeeID`),
  KEY `fk_map_supplier` (`SupplierID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mapping`
--


-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE IF NOT EXISTS `salary` (
  `EmployeeID` bigint(20) NOT NULL,
  `Basic` decimal(10,2) NOT NULL DEFAULT '0.00',
  `HouseRent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Allowance` decimal(10,2) NOT NULL DEFAULT '0.00',
  `IncomeTax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `NetIncome` decimal(10,2) NOT NULL DEFAULT '0.00',
  `Grade` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`EmployeeID`),
  KEY `fk_salary_employee` (`EmployeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salary`
--


-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE IF NOT EXISTS `suppliers` (
  `SupplierID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Address` text,
  `Zip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`SupplierID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`SupplierID`, `Name`, `Email`, `Phone`, `Address`, `Zip`) VALUES
(1, 'xyz', 'xyz@gmail.com', '01323452', 'Dhaka', '1209'),
(2, 'anonymous', 'anonymous@gmail.com', '098765', 'Dhaka', '1205'),
(3, 'anonymous1', 'anonymous1@yahoo.com', '0984262', 'Dhaka, Mirpur', '1290');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mapping`
--
ALTER TABLE `mapping`
  ADD CONSTRAINT `fk_map_employee` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_map_supplier` FOREIGN KEY (`SupplierID`) REFERENCES `suppliers` (`SupplierID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `fk_salary_employee` FOREIGN KEY (`EmployeeID`) REFERENCES `employees` (`EmployeeID`) ON DELETE CASCADE ON UPDATE CASCADE;
