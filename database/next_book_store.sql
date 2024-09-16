-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2019 at 12:08 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `next_book_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `ID` int(11) NOT NULL,
  `Name` char(50) DEFAULT NULL,
  `Email` char(50) DEFAULT NULL,
  `Password` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`ID`, `Name`, `Email`, `Password`) VALUES
(2, 'Sandipan Roy', 'sandipanroy177@gmail.com', 'abcd1234');

-- --------------------------------------------------------

--
-- Table structure for table `exclusive_add`
--

CREATE TABLE `exclusive_add` (
  `ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exclusive_add`
--

INSERT INTO `exclusive_add` (`ID`) VALUES
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `tmp_user`
--

CREATE TABLE `tmp_user` (
  `Name` char(50) DEFAULT NULL,
  `Email` char(50) DEFAULT NULL,
  `Password` char(15) DEFAULT NULL,
  `Pass_Key` int(11) DEFAULT NULL,
  `Expiary_Time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_user`
--

INSERT INTO `tmp_user` (`Name`, `Email`, `Password`, `Pass_Key`, `Expiary_Time`) VALUES
('sandipan roy', 'sandipanroy177@gmail.com', 'abcd1234', 5012, '15:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `upload_record`
--

CREATE TABLE `upload_record` (
  `ID` int(11) NOT NULL,
  `Email` char(50) DEFAULT NULL,
  `Book_Name` char(30) DEFAULT NULL,
  `Author` char(30) DEFAULT NULL,
  `Subject` char(30) DEFAULT NULL,
  `Price` int(11) DEFAULT NULL,
  `Description` text,
  `PDF_Name` text,
  `Image_Name` text,
  `downloads` int(11) DEFAULT '0',
  `views` int(11) DEFAULT '0',
  `Upload_Date_Time` datetime DEFAULT CURRENT_TIMESTAMP,
  `Priority_Points` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload_record`
--

INSERT INTO `upload_record` (`ID`, `Email`, `Book_Name`, `Author`, `Subject`, `Price`, `Description`, `PDF_Name`, `Image_Name`, `downloads`, `views`, `Upload_Date_Time`, `Priority_Points`) VALUES
(5, 'sayantanroy189@gmail.com', 'Java', 'Sayantan', 'Computer Science', 100, 'Total Overview Of Java', 'java.pdf', 'back2.jpg', 0, 1, '2019-09-03 15:16:48', 1),
(6, 'sayantanroy189@gmail.com', 'Matlab Image Processing', 'Sayantan', 'Computer Science', 100, 'Image Processing Using Matlab', 'Matlab-Image_Processing_Tutorial.pdf', 'background4.jpg', 0, 0, '2019-09-03 15:16:48', 0),
(7, 'sayantanroy189@gmail.com', 'Assembly language', 'Sayantan', 'Computer Science', 100, 'Assembly Language Using NASM', 'assembly_programming_tutorial.pdf', 'background23.jpg', 0, 0, '2019-09-03 15:16:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `ID` int(11) NOT NULL,
  `Email` char(50) DEFAULT NULL,
  `Name` char(50) DEFAULT NULL,
  `Password` char(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`ID`, `Email`, `Name`, `Password`) VALUES
(1, 'sayantanroy189@gmail.com', 'Sayantan Roy', 'abcd1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `upload_record`
--
ALTER TABLE `upload_record`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upload_record`
--
ALTER TABLE `upload_record`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
