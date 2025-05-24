-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 06:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `talktome`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aemail` varchar(255) NOT NULL,
  `apassword` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aemail`, `apassword`) VALUES
('admin@ttm.com', '123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appoid` int(11) NOT NULL,
  `pid` int(10) DEFAULT NULL,
  `apponum` int(3) DEFAULT NULL,
  `scheduleid` int(10) DEFAULT NULL,
  `appodate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appoid`, `pid`, `apponum`, `scheduleid`, `appodate`) VALUES
(1, 1, 1, 1, '2022-06-03'),
(7, 3, 1, 11, '2025-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `docid` int(11) NOT NULL,
  `docemail` varchar(255) DEFAULT NULL,
  `docname` varchar(255) DEFAULT NULL,
  `docpassword` varchar(255) DEFAULT NULL,
  `docnic` varchar(15) DEFAULT NULL,
  `doctel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`docid`, `docemail`, `docname`, `docpassword`, `docnic`, `doctel`, `specialties`) VALUES
(1, 'doctor@ttm.com', 'ttm Doctor', '123', '000000000', '0110000000', 1),
(2, 'deeya@gmail.com', 'deeya', '123', '555', '98616880', 8),
(3, 'sarita@gmail.com', 'Sarita Neupane', '111', '', '98616880', 2);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `problem` text NOT NULL,
  `matched_specialties` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `matched_specialties_ids` text DEFAULT NULL,
  `recommended_doctors` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `pemail` varchar(255) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ppassword` varchar(255) DEFAULT NULL,
  `paddress` varchar(255) DEFAULT NULL,
  `pnic` varchar(15) DEFAULT NULL,
  `pdob` date DEFAULT NULL,
  `ptel` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `pemail`, `pname`, `ppassword`, `paddress`, `pnic`, `pdob`, `ptel`) VALUES
(9, 'surajo14ry@gmail.com', 'suraj chaudhary', '14rysuraj1234@A', 'balkhu', NULL, '2004-03-03', '9808191548'),
(10, 'deeya333333@gmail.com', 'sarita Neupane', 'Ss1$sssss', '111Kalanki', NULL, '2009-04-02', '9871671611'),
(3, 'shreya@gmail.com', 'Shreya Subedi', '3121', 'Imadol', '3121', '2004-01-19', '0123456789'),
(4, 'shreya111@gmail.com', 'Shreya Subedi', '333', 'Imadol, mahalaxmi municipality', '333111222', '2003-10-14', '0123456789'),
(5, 'shreya654@gmail.com', 'Shreya Subedi', '333', 'Imadol, mahalaxmi municipality', '3121', '2025-03-04', '0123456789'),
(6, 'shreya65432@gmail.com', 'Shreya Subedi', '555', 'Imadol, mahalaxmi municipality', '3121', '2025-03-04', '9876543211'),
(7, 'shreya999@gmail.com', 'Shreya Subedi', '8910', 'Imadol, mahalaxmi municipality', '3121', '2025-03-04', '9877666544'),
(8, 'shreya678@gmail.com', 'Shreya Subedi', '999', 'Imadol, mahalaxmi municipality', '3121', '2025-03-04', '9877666544'),
(11, 'ram@gmail.com', 'ram sharma', '123Rr*sss', 'Kalanki', NULL, '2007-10-16', '9872622524'),
(12, 'abc@gmail.com', 'sarita Neupane', '123Ss*abc', 'Kalanki', NULL, '2009-04-16', '9871615141'),
(13, 'ojanmaharjan03@gmail.com', 'ojan maharjan', '@Ojan12345', 'Khokana', NULL, '2009-04-17', '9861627437'),
(14, 'xyzzz@gmail.com', 'xyz xyz', '12345678Ss*', 'Kalanki', NULL, '2009-04-15', '9871615141'),
(15, 'shreyasubedi4@gmail.com', 'shreya subedi', '12345678Ss*', 'Kalanki', NULL, '2009-04-20', '9861688014');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `scheduleid` int(11) NOT NULL,
  `docid` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `scheduledate` date DEFAULT NULL,
  `scheduletime` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`scheduleid`, `docid`, `title`, `scheduledate`, `scheduletime`, `nop`) VALUES
(11, '2', 'Group therapy', '2025-04-24', '13:00:00', 4),
(12, '3', 'sports therapy', '2025-04-24', '14:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `id` int(2) NOT NULL,
  `sname` varchar(50) DEFAULT NULL,
  `keywords` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`id`, `sname`, `keywords`) VALUES
(1, 'Clinical Psychology', 'clinical, diagnosis, mental disorder, therapy, treatment, psychiatric, depression, anxiety, OCD, PTSD'),
(2, 'Child Psychology', 'child, children, kid, teen, adolescent, behavior, school issues, bullying, developmental delay\r\n'),
(3, 'Counseling Psychology', 'counseling, relationship, breakup, family issues, marriage, divorce, stress, grief, trauma, emotional support'),
(4, 'Forensic Criminal Psychology', 'crime, criminal, forensic, court, legal, offender, investigation, victim, witness, testimony'),
(5, 'Educational Psychology', 'education, learning, academic, memory, study, attention, concentration, school, cognitive development'),
(6, 'Sports Psychology', 'sports, athlete, performance, motivation, confidence, injury recovery, focus, team, competition'),
(7, 'Health Psychology', 'health, illness, chronic pain, coping, medical, stress management, wellbeing, disease, cancer, heart'),
(8, 'Abnormal Psychology', 'abnormal, hallucination, delusion, psychosis, schizophrenia, bipolar, extreme behavior, mood swings'),
(9, 'Cognitive Psychology', 'cognition, memory, perception, attention, decision making, reasoning, thinking, problem solving'),
(10, 'Rehabilitation Psychology', 'rehabilitation,recovery,trauma,injury,disability,adjustment,physical therapy,stroke,loss,addiction,drug,alcohol,substance abuse,relapse,detox,counseling\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@ttm.com', 'a'),
('doctor@ttm.com', 'd'),
('patient@edoc.com', 'p'),
('emhashenudara@gmail.com', 'p'),
('shreya@gmail.com', 'p'),
('shreya111@gmail.com', 'p'),
('shreya654@gmail.com', 'p'),
('shreya65432@gmail.com', 'p'),
('shreya999@gmail.com', 'p'),
('shreya678@gmail.com', 'p'),
('deeya@gmail.com', 'd'),
('sarita@gmail.com', 'd'),
('surajo14ry@gmail.com', 'p'),
('deeya333333@gmail.com', 'p'),
('ram@gmail.com', 'p'),
('abc@gmail.com', 'p'),
('ojanmaharjan03@gmail.com', 'p'),
('xyzzz@gmail.com', 'p'),
('shreyasubedi4@gmail.com', 'p');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aemail`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appoid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `scheduleid` (`scheduleid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`docid`),
  ADD KEY `specialties` (`specialties`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`scheduleid`),
  ADD KEY `docid` (`docid`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `scheduleid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
