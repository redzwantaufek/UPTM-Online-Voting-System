-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2023 at 10:12 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ovs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `adminName` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `pic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `adminName`, `email`, `password`, `contact`, `position`, `pic`) VALUES
(1, 'Muhammad Redzwan Bin Md Taufek', 'redzwantaufek2@gmail.com', '14250', '0194678990', 'System Admin', 'uploads/photo_3_2023-11-08_16-41-41.jpg'),
(27, 'Ali bin Abu Bakar', 'ali@gmail.com', '12345', '0128790180', 'HEP Staff', 'uploads/360_F_224869519_aRaeLneqALfPNBzg0xxMZXghtvBXkfIA.jpg'),
(28, 'Amir bin Muhammad', 'amir@gmail.com', '12345', '012-500 4526', 'HEP Staff', 'uploads/360_F_326985142_1aaKcEjMQW6ULp6oI9MYuv8lN9f8sFmj.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `analytic`
--

CREATE TABLE `analytic` (
  `analyticId` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `metric` varchar(255) NOT NULL,
  `value` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `annId` int(11) NOT NULL,
  `elecTitle` varchar(255) NOT NULL,
  `candName` text NOT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `apply`
--

CREATE TABLE `apply` (
  `applyId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `applyPic` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `course` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `manifesto` text NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Review'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `candidateId` int(11) NOT NULL,
  `studentId` int(11) NOT NULL,
  `candNo` int(11) NOT NULL,
  `candidateName` varchar(80) NOT NULL,
  `candidatePic` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `courseName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `manifesto` text NOT NULL,
  `links` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `voteNum` int(255) NOT NULL,
  `poster` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `electionId` int(11) NOT NULL,
  `electionTitle` varchar(255) NOT NULL,
  `voteNo` int(50) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `date` date NOT NULL,
  `rules` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentId` int(11) NOT NULL,
  `studentPic` varchar(255) NOT NULL,
  `studentName` varchar(80) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `votingHistory` tinyint(4) NOT NULL DEFAULT 0,
  `course` varchar(255) NOT NULL,
  `faculty` varchar(255) NOT NULL,
  `apply` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentId`, `studentPic`, `studentName`, `email`, `password`, `contact`, `votingHistory`, `course`, `faculty`, `apply`) VALUES
(1, 'uploads/IMG-20211110-WA0001.jpg', 'Muhammad Redzwan bin Muhammad Taufek', 'taufekredzwan@gmail.com', '14250', '0194678990', 0, 'CC101 - Diploma in Computer Science', 'FCOM', 0),
(7, 'uploads/360_F_326985142_1aaKcEjMQW6ULp6oI9MYuv8lN9f8sFmj.jpg', 'Azlan bin Shah', 'azlan@gmail.com', '12345', '0123456789', 0, 'AA103-Diploma of Accountancy', 'FBASS', 0),
(17, 'uploads/cand1.jpg', 'Shaifullah Azzim Bin Bustaman', 'azzim@gmail.com', '12345', '016-505 3035', 0, 'CT204 - Bachelor of Information Technology in Computer Application Development', 'FCOM', 0),
(18, 'uploads/cand2.jpg', 'Muhammad Syahmi Bin Ahmad Suhaimi', 'syahmi@gmail.com', '12345', '010-717 7458', 0, 'AB201 - Bachelor Of Business Adminstration Human Resource Management', 'FBASS', 0),
(19, 'uploads/cand3.jpg', 'Muhammad Adib Zikri Bin Kamarul Idzham', 'adib@gmail.com', '12345', '012-212 7307', 0, 'BE101 - Diploma in Teaching English As a Second Language(TESL)', 'FEHA', 0),
(20, 'uploads/cand4.png', 'Muhammad Amirul Fithri Bin Datuk Abdul Hafiz', 'amirul@gmail.com', '12345', '016-505 3035', 0, 'AB201 - Bachelor Of Business Administration Human Resource Management', 'FBASS', 0),
(21, 'uploads/cand5.jpg', 'Hafiz Alfikri Bin Amri', 'hafiz@gmail.com', '12345', '010-717 7458', 0, 'BE203 - Bachelor In Teaching English As A Second Language', 'FEHA', 0),
(22, 'uploads/cand6.jpeg', 'Nur Alia Yasmin Binti Mohammad Azlan', 'alia@gmail.com', '12345', '012-212 7307', 0, 'BE101 - Diploma In Teaching English As A Second English', 'FEHA', 0),
(23, 'uploads/cand7.jpg', 'Muhammad Naqiuddin Bin Mohd Taha', 'naqiu@gmail.com', '12345', '016-505 3035', 0, 'BK201 - Bachelor Of Communication In Corporate Communication', 'FEHA', 0),
(24, 'uploads/cand8.jpg', 'Muhammad Shafiq Bin Saharudin', 'shafiq@gmail.com', '12345', '016-505 3035', 0, 'CT204 - Bachelor Of Information Technology In Computer Application Development', 'FCOM', 0),
(25, 'uploads/photo_8_2023-11-02_13-21-30.jpg', 'ABDUL MUHAIMIE AR-BAAIN BIN MASORROWEE AWAE', 'muhaimie@gmail.com', '12345', '012-212 7307', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(26, 'uploads/photo_1_2023-11-02_13-21-30.jpg', 'MOHAMMED MUQSIT BIN OSMAN', 'muqsit@gmail.com', '12345', '010-717 7458', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(27, 'uploads/photo_15_2023-11-02_13-21-30.jpg', 'MUHAMAD KAMIL BIN MUHAMAD ZAIN', 'kamil@gmail.com', '12345', '012-212 7307', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(28, 'uploads/photo_2023-11-02_13-21-37.jpg', '(MUHAMMAD IMRAN BIN MOHD HANIFAH', 'imran@gmai.com', '12345', '016-505 3035', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(29, 'uploads/photo_5_2023-11-02_13-21-30.jpg', 'MUHAMMAD IRFAN BIN MOHD RIZAL', 'irfan@gmail.com', '12345', '03-8938 7179', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(30, 'uploads/WhatsApp Image 2023-11-06 at 12.51.48 PM - MUHAMMAD SHAFIQ RASHDI BIN MOHD SAZELI _.jpeg', 'MUHAMMAD SHAFIQ RASHDI BIN MOHD SAZELI', 'rashdi@gmail.com', '12345', '011-4731 3530', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(31, 'uploads/DFE787F9-B9EB-4EFE-95FD-DAC050636148 - Muhammad Zuhair.jpeg', 'MUHAMMAD ZAFRAN BIN ZAILAN', 'zafran@gmail.com', '12345', '011-4731 3530', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(32, 'uploads/350B2684-85E5-4A25-BBD0-DA7009F3034E - MUHAMMAD ZUHAIRI BIN ZAHURIN _.jpeg', 'MUHAMMAD ZUHAIRI BIN ZAHURIN', 'hairi@gmail.com', '12345', '016-505 3035', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(33, 'uploads/IMG_9191 - NUR AIN BINTI JAMROS _.jpeg', 'NUR AIN BINTI JAMROS', 'ain@gmail.com', '12345', '011-4731 3530', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(34, 'uploads/IMG_1619 - SHAIFUL ZHARFAN BIN SHAIFUL ZAHREIN _.jpeg', 'SHAIFUL ZHARFAN BIN SHAIFUL ZAHREIN', 'zharfan@gmail.com', '12345', '010-881 0302', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(35, 'uploads/IMG_9191 - NUR AIN BINTI JAMROS _.jpeg', 'SHARIFFAH MUNIRAH BINTI SYED MUHAMMAD NASIR', 'munirah@gmail.com', '12345', '010-881 0302', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(36, 'uploads/photo_1_2023-11-02_13-21-30.jpg', 'WAN MOHD HAKIMI BIN WAN MOHAMAD BAKI', 'kimi@gmail.com', '12345', '010-881 0302', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(37, 'uploads/IMG_9715 - WAN AHMAD DANIAL BIN ZAKARIA _.png', 'WAN AHMAD DANIAL BIN ZAKARIA', 'ahmad@gmail.com', '12345', '012-212 7307', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(38, 'uploads/IMG_3345 - WAN HAIDHIR SYAQIMI BIN WAN SOFIAN _.jpeg', 'WAN HAIDHIR SYAQIMI BIN WAN SOFIAN', 'didi@gmail.com', '12345', '010-881 0302', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(39, 'uploads/photo_29_2023-11-02_13-21-30.jpg', 'MUHAMMAD ILYAS BIN MOHD ABDUL HAKIM', 'ilyas@gmail.com', '12345', '010-881 0302', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(40, 'uploads/DFE787F9-B9EB-4EFE-95FD-DAC050636148 - Muhammad Zuhair.jpeg', 'MUHAMMAD HAWARI BIN AZUWAR', 'hawari@gmail.com', '12345', '012-212 7307', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(41, 'uploads/photo_29_2023-11-02_13-21-30.jpg', 'AMIRUN AFIQ BIN IBRAHIM', 'amirun@gmail.com', '12345', '010-881 0302', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(42, 'uploads/photo_5_2023-11-02_13-21-30.jpg', 'AZIB SAFWAN BIN AHMAD SAKRI', 'azib@gmail.com', '12345', '010-881 0302', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0),
(43, 'uploads/photo_8_2023-11-02_13-21-30.jpg', 'IBRAHIM AQIL BIN ARMAN', 'aqil@gmail.com', '12345', '011-4731 3530', 0, 'CC101 - Diploma In Computer Science', 'FCOM', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `voteId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `studentId` int(11) NOT NULL,
  `candidateId` int(11) NOT NULL,
  `electionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `analytic`
--
ALTER TABLE `analytic`
  ADD PRIMARY KEY (`analyticId`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`annId`);

--
-- Indexes for table `apply`
--
ALTER TABLE `apply`
  ADD PRIMARY KEY (`applyId`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`candidateId`),
  ADD KEY `studentId` (`studentId`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`electionId`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentId`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`voteId`),
  ADD KEY `studentId` (`studentId`),
  ADD KEY `candidateId` (`candidateId`),
  ADD KEY `vote_ibfk_3` (`electionId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `analytic`
--
ALTER TABLE `analytic`
  MODIFY `analyticId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `annId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `applyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `voteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `student` (`studentId`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`studentId`) REFERENCES `student` (`studentId`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`candidateId`) REFERENCES `candidate` (`candidateId`),
  ADD CONSTRAINT `vote_ibfk_3` FOREIGN KEY (`electionId`) REFERENCES `election` (`electionId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
