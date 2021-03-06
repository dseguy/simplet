-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 13, 2014 at 03:04 PM
-- Server version: 5.5.36
-- PHP Version: 5.5.10-1+deb.sury.org~precise+1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Simplet`
--

-- --------------------------------------------------------

--
-- Table structure for table `Members`
--

CREATE TABLE IF NOT EXISTS `Members` (
	`ID` varchar(64) NOT NULL,
	`Mail` varchar(250) NOT NULL,
	`Name` varchar(250) NOT NULL,
	`Admin` int(1) NOT NULL,
	`Groups` varchar(1000) NOT NULL,
	`Status` varchar(100) NOT NULL,
	`PassV` int(2) NOT NULL,
	`Pass` varchar(1000) NOT NULL,
	`Salt` varchar(64) NOT NULL,
	`2fa` VARCHAR(16) NOT NULL,
	`Created` int(11) NOT NULL,
	`Modified` int(11) NOT NULL,
	UNIQUE KEY `ID` (`ID`),
	INDEX `Mail` (`Mail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Sessions`
--

CREATE TABLE IF NOT EXISTS `Sessions` (
	`ID` int(255) NOT NULL AUTO_INCREMENT,
	`Member_ID` varchar(64) NOT NULL,
	`Mail` varchar(255) NOT NULL,
	`IP` varchar(255) NOT NULL,
	`Cookie` varchar(64) NOT NULL,
	`Active` int(1) NOT NULL,
	`Created` int(11) NOT NULL,
	`Modified` int(11) NOT NULL,
	UNIQUE KEY `ID` (`ID`),
	INDEX `Member_ID` (`Member_ID`),
	INDEX `Mail` (`Mail`),
	INDEX `Cookie` (`Cookie`),
	INDEX `Active` (`Active`)
) ENGINE=InnoDB	DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Failures`
--

CREATE TABLE IF NOT EXISTS `Failures` (
	`ID` int(255) NOT NULL AUTO_INCREMENT,
	`Member_ID` varchar(64) NOT NULL,
	`Mail` varchar(255) NOT NULL,
	`IP` varchar(255) NOT NULL,
	`Created` int(11) NOT NULL,
	UNIQUE KEY `ID` (`ID`),
	INDEX `Member_ID` (`Member_ID`),
	INDEX `Mail` (`Mail`),
	INDEX `IP` (`IP`)
) ENGINE=InnoDB	DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Runonce`
--

CREATE TABLE IF NOT EXISTS `Runonce` (
	`Member_ID` varchar(64) NOT NULL,
	`Key` varchar(64) NOT NULL,
	`Status` varchar(12) NOT NULL,
	`IP` varchar(64) NOT NULL,
	`Created` int(11) NOT NULL,
	`Modified` int(11) NOT NULL,
	`Notes` mediumtext NOT NULL,
	UNIQUE KEY `Key` (`Key`),
	INDEX `Member_ID` (`Member_ID`),
	INDEX `Status` (`Status`),
	INDEX `IP` (`IP`),
	INDEX `Created` (`Created`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Settings`
--

CREATE TABLE IF NOT EXISTS `Settings` (
	`Name` varchar(64) NOT NULL,
	`Value` varchar(64) NOT NULL,
	`Created` int(11) NOT NULL,
	`Modified` int(11) NOT NULL,
	UNIQUE KEY `Name` (`Name`),
	INDEX `Value` (`Value`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Categories`
--

CREATE TABLE IF NOT EXISTS `Categories` (
	`Member_ID` varchar(64) NOT NULL,
	`Status` varchar(12) NOT NULL,
	`Title` varchar(255) NOT NULL,
	`Slug` varchar(255) NOT NULL,
	`Description` varchar(255) NOT NULL,
	`Topics` int(10) NOT NULL,
	`Created` int(11) NOT NULL,
	`Modified` int(11) NOT NULL,
	UNIQUE KEY `Slug` (`Slug`),
	INDEX `Member_ID` (`Member_ID`),
	INDEX `Status` (`Status`),
	INDEX `Topics` (`Topics`),
	INDEX `Created` (`Created`),
	INDEX `Modified` (`Modified`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Topics`
--

CREATE TABLE IF NOT EXISTS `Topics` (
	`Member_ID` varchar(64) NOT NULL,
	`Status` varchar(12) NOT NULL,
	`Category` varchar(255) NOT NULL,
	`Slug` varchar(500) NOT NULL,
	`Title` varchar(500) NOT NULL,
	`Responses` int(10) NOT NULL,
	`Created` int(11) NOT NULL,
	`Modified` int(11) NOT NULL,
	UNIQUE KEY `Slug` (`Slug`),
	INDEX `Member_ID` (`Member_ID`),
	INDEX `Status` (`Status`),
	INDEX `Category` (`Category`),
	INDEX `Responses` (`Responses`),
	INDEX `Created` (`Created`),
	INDEX `Modified` (`Modified`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Responses`
--

CREATE TABLE IF NOT EXISTS `Responses` (
	`ID` int(255) NOT NULL AUTO_INCREMENT,
	`Member_ID` varchar(64) NOT NULL,
	`Canonical` varchar(500) NOT NULL,
	`Type` varchar(12) NOT NULL,
	`Status` varchar(12) NOT NULL,
	`Helpfulness` int(11) NOT NULL DEFAULT '0',
	`Rating` int(12) NOT NULL,
	`Post` mediumtext NOT NULL,
	`Created` int(11) NOT NULL,
	`Modified` int(11) NOT NULL,
	UNIQUE KEY `ID` (`ID`),
	INDEX `Member_ID` (`Member_ID`),
	INDEX `Canonical` (`Canonical`),
	INDEX `Type` (`Type`),
	INDEX `Status` (`Status`),
	INDEX `Helpfulness` (`Helpfulness`),
	INDEX `Rating` (`Rating`),
	INDEX `Created` (`Created`),
	INDEX `Modified` (`Modified`)
) ENGINE=InnoDB	DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Helpfulness`
--

CREATE TABLE IF NOT EXISTS `Helpfulness` (
	`ID` int(255) NOT NULL AUTO_INCREMENT,
	`Response_Canonical` varchar(500) NOT NULL,
	`Response_ID` int(255) NOT NULL,
	`Member_ID` varchar(64) NOT NULL,
	`Helpfulness` varchar(4) NOT NULL,
	`Created` int(12) NOT NULL,
	`Modified` int(12) NOT NULL,
	UNIQUE KEY (`ID`),
	INDEX `Response_Canonical` (`Response_Canonical`),
	INDEX `Response_ID` (`Response_ID`),
	INDEX `Member_ID` (`Member_ID`),
	INDEX `Helpfulness` (`Helpfulness`)
) ENGINE=InnoDB	DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Views`
--

CREATE TABLE IF NOT EXISTS `Views` (
	`ID` int(255) NOT NULL AUTO_INCREMENT,
	`Request` varchar(2500) NOT NULL,
	`Canonical` varchar(2500) NOT NULL,
	`Post_Type` varchar(255) NOT NULL,
	`IP` varchar(255) NOT NULL,
	`Cookie` varchar(64) NOT NULL,
	`Auth` varchar(5) NOT NULL,
	`Member_ID` varchar(64) NOT NULL,
	`Admin` varchar(5) NOT NULL,
	`Time` int(12) NOT NULL,
	UNIQUE KEY `ID` (`ID`),
	INDEX `Request` (`Request`),
	INDEX `Canonical` (`Canonical`),
	INDEX `Post_Type` (`Post_Type`),
	INDEX `IP` (`IP`),
	INDEX `Cookie` (`Cookie`),
	INDEX `Auth` (`Auth`),
	INDEX `Member_ID` (`Member_ID`),
	INDEX `Admin` (`Admin`),
	INDEX `Time` (`Time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;