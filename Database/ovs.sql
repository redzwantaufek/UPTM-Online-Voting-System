-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 31, 2023 at 12:34 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
(1, 'Muhammad Redzwan Bin Md Taufek', 'redzwantaufek2@gmail.com', '14250', '0194678990', 'System Admin', 'uploads/profile 1.jpg'),
(8, 'Ahmad Bin Najmi', 'ahmad@gmail.com', '14250', '0193438449', 'Staff HEP', 'uploads/pic1.jpg'),
(9, 'Abu bin Bakar', 'abu@gmail.com', '1425', '0194583764', 'Staff HEP', 'uploads/profile6m.png'),
(17, 'Zul bin Arif', 'zul@gmail.com', '1425', '0194683645', 'Staff HEP', 'uploads/profile5m.avif'),
(20, 'Nur Helena binti Zakariah', 'helenaNur@gmail.com', '14250', '0198493857', 'Staff HEP', 'uploads/profile3f.png');

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
  `candName` varchar(255) NOT NULL,
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

--
-- Dumping data for table `apply`
--

INSERT INTO `apply` (`applyId`, `studentId`, `applyPic`, `name`, `email`, `contact`, `course`, `faculty`, `semester`, `manifesto`, `link`, `status`) VALUES
(29, 1, 'uploads/pic1.jpg', 'Muhammad Redzwan', 'taufekredzwan@gmail.com', '0194678990', 'CC101 - Diploma in Computer Science', 'FCOM', 'Semester 6', 'Free Porsche For Each Students', '', 'Accept'),
(30, 2, 'uploads/profile3f.png', 'nur', 'nur@gmail.com', '123456789', 'Nur', 'Nur', 'Semester 10', 'Popcorn Free', '', 'Accept'),
(31, 5, 'uploads/profile4f.jpg', 'Nur Helen', 'helen@gmail.com', '1023874659', 'CC101 - Computer Science', 'FCOM', 'Semester 5', 'HIhi', '', 'Accept');

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
  `voteNum` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`candidateId`, `studentId`, `candNo`, `candidateName`, `candidatePic`, `faculty`, `courseName`, `email`, `manifesto`, `links`, `contact`, `voteNum`) VALUES
(4, 1, 1, 'Muhammad Redzwan', 'uploads/pic1.jpg', 'FCOM', 'CC101 - Diploma in Computer Science', 'taufekredzwan@gmail.com', 'Free Porsche For Each Students and Free Popcorn Delights', 'https://www.facebook.com/redzwan.taufek', '0194678990', 0),
(5, 2, 2, 'nur', 'uploads/profile3f.png', 'Nur', 'Nur', 'nur@gmail.com', 'Popcorn Free', 'popdelight.com', '123456789', 0),
(6, 5, 3, 'Nur Helen', 'uploads/profile4f.jpg', 'FCOM', 'CC101 - Computer Science', 'helen@gmail.com', 'HIhi', '', '1023874659', 0);

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

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`electionId`, `electionTitle`, `voteNo`, `start`, `end`, `date`, `rules`) VALUES
(18, 'Hihi General Election', 2, '2023-10-31 17:53:00', '2023-10-31 23:59:00', '2023-10-31', 'Each Student Only Can Choose Two Candidates.');

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
(1, 'uploads/profile5m.avif', 'Muhammad Redzwan', 'taufekredzwan@gmail.com', '14250', '0194678990', 0, 'CC101 - Diploma in Computer Science', 'FCOM', 1),
(2, 'uploads/profile6m.png', 'nur', 'nur@gmail.com', '12345', '123456789', 0, 'Nur', 'Nur', 1),
(5, 'uploads/profile3f.png', 'Nur Helen', 'helen@gmail.com', '12345', '1023874659', 0, 'CC101 - Computer Science', 'FCOM', 1),
(6, 'uploads/pic1.jpg', 'Porsche', 'porsche@gmail.com', '12345', '019345334', 0, 'CC101', 'FCOM', 0);

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
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `analytic`
--
ALTER TABLE `analytic`
  MODIFY `analyticId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `annId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `applyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
