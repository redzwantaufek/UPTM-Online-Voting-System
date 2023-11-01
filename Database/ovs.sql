-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2023 at 03:31 PM
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
(27, 'Ali bin Abu Bakar', 'ali@gmail.com', '12345', '012-879 0180', 'HEP Staff', 'uploads/profile2.png'),
(28, 'Amir bin Muhammad', 'amir@gmail.com', '12345', '012-500 4526', 'HEP Staff', 'uploads/profile6m.png'),
(29, 'Ain bin Aisyah', 'ain@gmail.com', '12345', '03-5129 4723', 'HEP Staff', 'uploads/profile3f.png'),
(30, 'Aisyah Binti Ahmad', 'aisyah@gmail.com', '12345', '03-6265 6136', 'Staff HEP', 'uploads/profile4f.jpg');

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
  `voteNum` int(255) NOT NULL
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
(1, 'uploads/profile5m.avif', 'Muhammad Redzwan', 'taufekredzwan@gmail.com', '14250', '0194678990', 0, 'CC101 - Diploma in Computer Science', 'FCOM', 0),
(7, 'uploads/profile 9.jpg', 'Azlan bin Shah', 'azlan@gmail.com', '12345', '012-345 6789', 0, 'AA103-Diploma of Accountancy', 'FBASS', 0),
(8, 'uploads/profile10.jpeg', 'Hazirah binti Abdul Rahim', 'hazirah@gmail.com', '12345', '03-7953 7252', 0, 'BK101-Diploma in Corporate Communication', 'FEHA', 0),
(9, 'uploads/profile 7.png', 'Hafiz bin Jamaluddin', 'hafiz@gmail.com', '12345', '03-5832 3553', 0, 'Bachelor of Information Technology in Cyber Security', 'FCOM', 0),
(10, 'uploads/profile4f.jpg', 'Izzati binti Idris', 'izzati@gmail.com', '12345', '013-245 4740', 0, 'Bachelor of Bussiness Administration', 'FBASS', 0),
(11, 'uploads/profile2.png', 'Iqbal Bin Ismail', 'iqbal@gmail.com', '12345', '013-819 1677', 0, 'CT203-Bachelor of Information Technology in Bussiness Computing', 'FCOM', 0),
(12, 'uploads/profile5m.avif', 'Izara binti Kamarulzaman', 'izara@gmail.com', '12345', '03-2153 1539', 0, 'BE203-Bachelor of Education in Teaching English As A Second Language', 'FEHA', 0);

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
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `analytic`
--
ALTER TABLE `analytic`
  MODIFY `analyticId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `annId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

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
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `voteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
