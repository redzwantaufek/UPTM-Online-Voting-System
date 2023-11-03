-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2023 at 06:50 PM
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

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`annId`, `elecTitle`, `candName`, `info`) VALUES
(25, 'Pilihanraya MPP Sesi 2023-2024', 'Muhammad Redzwan', 'jhjkas'),
(26, 'Pilihanraya MPP Sesi 2023-2024', 'Hazirah binti Abdul Rahim', 'jhjkas');

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
(33, 1, 'uploads/profile6m.png', 'Muhammad Redzwan', 'taufekredzwan@gmail.com', '0194678990', 'CC101 - Diploma in Computer Science', 'FCOM', 'Semester 6', 'abc', '', 'Reject'),
(34, 7, 'uploads/profile 9.jpg', 'Azlan bin Shah', 'azlan@gmail.com', '012-345 6789', 'AA103-Diploma of Accountancy', 'FBASS', 'Semester 6', 'def', '', 'Reject'),
(35, 8, 'uploads/profile10.jpeg', 'Hazirah binti Abdul Rahim', 'hazirah@gmail.com', '03-7953 7252', 'BK101-Diploma in Corporate Communication', 'FEHA', 'Semester 5', 'fgh', '', 'Accept'),
(36, 9, 'uploads/profile 7.png', 'Hafiz bin Jamaluddin', 'hafiz@gmail.com', '03-5832 3553', 'Bachelor of Information Technology in Cyber Security', 'FCOM', 'Semester 4', 'hfhd', '', 'Accept'),
(37, 10, 'uploads/profile4f.jpg', 'Izzati binti Idris', 'izzati@gmail.com', '013-245 4740', 'Bachelor of Bussiness Administration', 'FBASS', 'Semester 7', 'fdbdfvb', '', 'Accept'),
(38, 15, 'uploads/profile 9.jpg', 'Faris', 'faris@gmail.com', '123456677', 'CC101', 'FCOM', 'Semester 6', 'gdfgdfgfd', '', 'Accept');

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
(8, 1, 1, 'Muhammad Redzwan', 'uploads/profile6m.png', 'FCOM', 'CC101 - Diploma in Computer Science', 'taufekredzwan@gmail.com', 'abc', '', '0194678990', 0),
(9, 8, 2, 'Hazirah binti Abdul Rahim', 'uploads/profile10.jpeg', 'FEHA', 'BK101-Diploma in Corporate Communication', 'hazirah@gmail.com', 'fgh', '', '03-7953 7252', 0),
(10, 9, 3, 'Hafiz bin Jamaluddin', 'uploads/profile 7.png', 'FCOM', 'Bachelor of Information Technology in Cyber Security', 'hafiz@gmail.com', 'hfhd', '', '03-5832 3553', 0),
(11, 10, 4, 'Izzati binti Idris', 'uploads/profile4f.jpg', 'FBASS', 'Bachelor of Bussiness Administration', 'izzati@gmail.com', 'fdbdfvb', '', '013-245 4740', 0),
(12, 15, 5, 'Faris', 'uploads/profile 9.jpg', 'FCOM', 'CC101', 'faris@gmail.com', 'gdfgdfgfd', '', '123456677', 0);

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
(20, 'Pilihanraya MPP Sesi 2023-2024', 2, '2023-11-01 10:30:00', '2023-11-01 11:27:00', '2023-11-02', 'Each student can choose 2 candidates');

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
(1, 'uploads/profile 9.jpg', 'Muhammad Redzwan', 'taufekredzwan@gmail.com', '14250', '0194678990', 1, 'CC101 - Diploma in Computer Science', 'FCOM', 1),
(7, 'uploads/profile 9.jpg', 'Azlan bin Shah', 'azlan@gmail.com', '12345', '012-345 6789', 0, 'AA103-Diploma of Accountancy', 'FBASS', 1),
(8, 'uploads/profile10.jpeg', 'Hazirah binti Abdul Rahim', 'hazirah@gmail.com', '12345', '03-7953 7252', 0, 'BK101-Diploma in Corporate Communication', 'FEHA', 1),
(9, 'uploads/profile 7.png', 'Hafiz bin Jamaluddin', 'hafiz@gmail.com', '12345', '03-5832 3553', 0, 'Bachelor of Information Technology in Cyber Security', 'FCOM', 1),
(10, 'uploads/profile4f.jpg', 'Izzati binti Idris', 'izzati@gmail.com', '12345', '013-245 4740', 0, 'Bachelor of Bussiness Administration', 'FBASS', 1),
(11, 'uploads/profile2.png', 'Iqbal Bin Ismail', 'iqbal@gmail.com', '12345', '013-819 1677', 0, 'CT203-Bachelor of Information Technology in Bussiness Computing', 'FCOM', 0),
(12, 'uploads/profile5m.avif', 'Izara binti Kamarulzaman', 'izara@gmail.com', '12345', '03-2153 1539', 0, 'BE203-Bachelor of Education in Teaching English As A Second Language', 'FEHA', 0),
(13, 'uploads/pic1.jpg', 'Porsche', 'prosche@gmail.com', '12345', '0194678990', 0, 'CC101 - Computer Science', 'FCOM', 0),
(14, 'uploads/profile3f.png', 'siti', 'siti@gmail.com', '12345', '019234567', 0, 'CC101', 'FCOM', 0),
(15, 'uploads/profile10.jpeg', 'Faris', 'faris@gmail.com', '12345', '123456677', 0, 'CC101', 'FCOM', 1);

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
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`voteId`, `time`, `studentId`, `candidateId`, `electionId`) VALUES
(10, '2023-11-02 02:44:23', 1, 8, 20),
(11, '2023-11-02 02:44:23', 1, 9, 20);

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
  MODIFY `annId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `apply`
--
ALTER TABLE `apply`
  MODIFY `applyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `candidateId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `electionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `voteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
